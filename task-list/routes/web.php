<?php

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class Task
{
  public function __construct(
    public int $id,
    public string $title,
    public string $description,
    public ?string $longDescription,
    public bool $completed,
    public string $createdAt,
    public string $updatedAt
  ) {
  }
}

$tasks = [
  new Task(
    1,
    'Buy groceries',
    'Task 1 description',
    'Task 1 long description',
    false,
    '2023-03-01 12:00:00',
    '2023-03-01 12:00:00'
  ),
  new Task(
    2,
    'Sell old stuff',
    'Task 2 description',
    null,
    false,
    '2023-03-02 12:00:00',
    '2023-03-02 12:00:00'
  ),
  new Task(
    3,
    'Learn programming',
    'Task 3 description',
    'Task 3 long description',
    true,
    '2023-03-03 12:00:00',
    '2023-03-03 12:00:00'
  ),
  new Task(
    4,
    'Take dogs for a walk',
    'Task 4 description',
    null,
    false,
    '2023-03-04 12:00:00',
    '2023-03-04 12:00:00'
  ),
];

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
            "tasks" => \App\Models\Task::latest()->get()
        ]
    );
})->name("tasks");

Route::view("/tasks/create", "create_task")->name("tasks.create");

Route::get("/tasks/{id}", function ($id) {
    return view("task", [
        "task" => \App\Models\Task::findOrFail($id)
    ]);
})->name("tasks.show");

Route::post("/tasks", function (Request $request) {
    dd($request->all());
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