@extends("layouts.app")

@section("title", "The list of tasks")

@section("content")
    <div>
        <a href="{{ route("tasks.create") }}">Add Task</a>
    </div>
    @forelse($tasks as $currTask)
        <div>
             <a href="{{ route("tasks.show", ["task" => $currTask->id]) }}">{{ $currTask->title }}</a><br />
        </div>
    @empty
        <p>No task found.</p>
    @endforelse

    @if($tasks->count())
        <nav>
            {{ $tasks->links() }}
        </nav>
    @endif
@endsection