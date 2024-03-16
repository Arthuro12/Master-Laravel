<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    public static array $experiences = ["Entry" => "entry", "Intermediate" => "intermediate", "Senior" => "senior"];

    public static $categories = ["IT", "Finance", "Sales", "Marketing"];
}