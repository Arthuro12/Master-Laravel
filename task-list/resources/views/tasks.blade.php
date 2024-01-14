@extends("layouts.app")

@section("title", "The list of tasks")

@section("content")
    <div class="mb-4">
        <a href="{{ route("tasks.create") }}" class="font-medium text-gray-700 underline decoration-pink-500">Add Task</a>
    </div>
    @forelse($tasks as $currTask)
        <div>
             <a href="{{ route("tasks.show", ["task" => $currTask->id]) }}" @class(["line-through" => $currTask->completed])>{{ $currTask->title }}</a><br />
        </div>
    @empty
        <p>No task found.</p>
    @endforelse

    @if($tasks->count())
        <nav class="mt-4">
            {{ $tasks->links() }}
        </nav>
    @endif
@endsection