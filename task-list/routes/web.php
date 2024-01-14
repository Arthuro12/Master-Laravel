<?php

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get("/", function () {
    return redirect("tasks");
});

Route::get('/tasks', function () {
    return view("tasks", 
        [
            "tasks" => Task::latest()->paginate(5)
        ]
    );
})->name("tasks");

Route::view("/tasks/create", "create_task")->name("tasks.create");

Route::get("/tasks/{task}/edit", function (Task $task) {
  return view("edit_task", [
      "task" => $task
  ]);
})->name("tasks.edit");

Route::get("/tasks/{task}", function (Task $task) {
    return view("task", [
        "task" => $task
    ]);
})->name("tasks.show");

Route::post("/tasks", function (TaskRequest $request) {
    // $taskInput = $taskRequest->validated();

    // $task = new Task;
    // $task->title = $taskInput["title"];
    // $task->description = $taskInput["description"];
    // $task->long_description = $taskInput["long_description"];

    // $task->save();
    $task = Task::create($request->validated());

    return redirect()->route("tasks.show", ["task" => $task->id])->with("SUCCESS", "Task created successfully!");
})->name("tasks.store");

Route::put("/tasks/{task}", function (Task $task, TaskRequest $request) {
  // $taskInput = $request->validated();

  // $task->title = $taskInput["title"];
  // $task->description = $taskInput["description"];
  // $task->long_description = $taskInput["long_description"];

  // $task->save();
  $task->update($request->validated());

  return redirect()->route("tasks.show", ["task" => $task->id])->with("SUCCESS", "Task edited successfully!");
})->name("tasks.update");

Route::delete("tasks/{task}", function (Task $task) {
  $task->delete();

  return redirect()->route("tasks")->with("SUCCESS", "Task deleted successfully!");
})->name("tasks.destroy");

Route::put("tasks/{task}/toggle-complete", function (Task $task) {
  $task->toggleComplete();

  return redirect()->back()->with("SUCCESS", "Updated suuccessfully!");
})->name("tasks.toggle-complete");

// Route::get("/hello", function () {
//     return "Hello my friend!";
// })->name("hello");

// Route::get("/hello/{name}", function ($name) {
//     return "Hello " . $name . "!";
// });

// Route::get("/hallo", function () {
//     return redirect("/hello");
// });

// Route::get("/hallo", function () {
//     return redirect()->route("hello");
// });

Route::fallback(function () {
    return "Oups!";
});