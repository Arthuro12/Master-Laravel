@extends("layouts.app")

@section("title", "The list of tasks")

@section("content")
    @forelse($tasks as $currTask)
        <div>
             <a href="{{ route("tasks.show", ["id" => $currTask->id]) }}">{{ $currTask->title }}</a><br />
        </div>
    @empty
        <p>No task found.</p>
    @endforelse
@endsection