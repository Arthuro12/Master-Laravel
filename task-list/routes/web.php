<?php

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
            "tasks" => Task::latest()->get()
        ]
    );
})->name("tasks");

Route::view("/tasks/create", "create_task")->name("tasks.create");

Route::get("/tasks/{id}", function ($id) {
    return view("task", [
        "task" => Task::findOrFail($id)
    ]);
})->name("tasks.show");

Route::post("/tasks", function (Request $request) {
    $taskInput = $request->validate([
        "title" => "required|max:255",
        "description" => "required",
        "long_description" => "required"
    ]);

    $task = new Task;
    $task->title = $taskInput["title"];
    $task->description = $taskInput["description"];
    $task->long_description = $taskInput["long_description"];

    $task->save();

    return redirect()->route("tasks.show", ["id" => $task->id])->with("SUCCESS", "Task created successfully!");
})->name("tasks.store");

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