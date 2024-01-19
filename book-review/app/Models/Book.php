<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Cache;

class Book extends Model
{
    use HasFactory;

    protected static function booted() {
        static::updated(fn(Book $book) => Cache::forget("book:" . $book->id));
        static::deleted(fn(Book $book) => Cache::forget("book:" . $book->id));
    } 

    public function scopeWithAvgRating(Builder $query, $from = null, $to = null): Builder {
        return $query->withAvg(["reviews" => fn(Builder $q) => $this->dateRangeFilter($q, $from, $to)], "rating");
    }

    private function dateRangeFilter (Builder $query, $from = null, $to = null){
        if ($from && !$to)  {
            $query->where("created_at", ">=", $from);
        } elseif (!$from && $to) {
            $query->where("created_at", "<=", $to);
        } elseif ($from && $to) {
            $query->whereBetween("created_at", [$from, $to]);
        }
    }

    public function reviews() {
        return $this->hasMany(Review::class);
    }

    public function scopeHighestRated(Builder $query): Builder {
        return $query->withAvgRating()
            ->orderBy("reviews_avg_rating", "desc");
    }

    public function scopeHighestRatedLast6Months(Builder $query): Builder {
        return $query->highestRated(now()->subMonths(6), now())
            ->popular(now()->subMonths(6), now())
            ->minimumReviews(5);
    }

    public function scopeHighestRatedLastMonth(Builder $query): Builder {
        return $query->highestRated(now()->subMonth(), now())
            ->popular(now()->subMonth(), now())
            ->minimumReviews(2);
    }

    public function scopeMinimumReviews(Builder $query, int $minimum): Builder {
        return $query->having("reviews_count", ">=", $minimum);
    }

    public function scopePopular(Builder $query): Builder {
        return $query->withReviewsCount()
            ->orderBy("reviews_count", "desc");
    } 

    public function scopePopularLast6Months(Builder $query): Builder {
        return $query->popular(now()->subMonths(6), now())
            ->highestRated(now()->subMonths(6), now())
            ->minimumReviews(5);
    }

    public function scopePopularLastMonth(Builder $query): Builder {
        return $query->popular(now()->subMonth(), now())
            ->highestRated(now()->subMonth(), now())
            ->minimumReviews(2);
    }

    public function scopeTitle(Builder $query, string $tite): Builder {
        return $query->where("title", "LIKE", "%" . $tite . "%");
    }

    public function scopeWithReviewsCount(Builder $query, $from = null, $to = null): Builder {
        return $query->withCount([
            "reviews" => fn(Builder $q) => $this->dateRangeFilter($q, $from, $to)
        ]);
    }

}