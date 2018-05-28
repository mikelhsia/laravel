<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;

class TasksController extends Controller
{
	public function index () {
	    $tasks = Task::all(); // Eloquent method
	    return view("tasks.index", compact("tasks"));
	}
	// Route model binding, variable name needs to be the same in the web.php
	public function show (Task $task) {  // will do Task:find(wildcard);
	// public function show ($id) {
	    // $task = Task::find($id); // Eloquent method
	    return view("tasks.show", compact("task"));
	}
}
