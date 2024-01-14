@extends("layouts.app")

@section("styles")
    .error-message {
        color: red;
        font-size: 0.8rem;
    }
@endsection

@section("title", isset($task) ? "Edit Task" : "Add Task")

@section("content")
    <form method="POST" action="{{ isset($task) ? route("tasks.edit", ["task" => $task->id]) : route("tasks.store") }}">
      @csrf
      @isset($task)
        @method("PUT")
      @endisset
      <div>
        <label for="title">
            title
        </label>
        <input type="text" name="title" id="title" value="{{ $task->title ?? old("title") }}" />
        @error("title")
            <p class="error-message">
                {{ $message }}
            </p>
        @enderror
        <div>
            <label for="description">
                Description
            </label>
            <textarea name="description" id="description" rows="5">{{ $task->description ?? old("description") }}</textarea>
            @error("description")
                <p class="error-message">
                    {{ $message }}
                </p>
            @enderror
        </div>
        <div>
            <label for="long_description">
                Long Description
            </label>
            <textarea name="long_description" id="long-description" rows="10">{{ $task->long_description ?? old("long_description") }}</textarea>
            @error("long_description")
                <p class="error-message">
                    {{ $message }}
                </p>
            @enderror
        </div>
        <div>
            <button type="submit">
                @isset($task) 
                    Edit Task
                @else  
                    Add Task
                @endisset
            </button>
        </div>
      </div>
    </form>
@endsection