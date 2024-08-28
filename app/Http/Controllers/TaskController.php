<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\User;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = $this->getAllTasksByUserId();

        if ($tasks->isEmpty()) {
            return view('home', ['tasks' => collect()]); // Use collect() para criar uma coleção vazia
        }

        return view('home', ['tasks' => $tasks]);
    }

    public function store (Request $request)
    {
        $validated = $request->validate([
            'title'=>['required','min:3','max:50'],
            'description'=>['required','min:3','max:255'],
            'category'=>['required','min:3','max:50'],
        ]);
        Task::create([
            'user_id' => Auth::id(),
            'title' => $validated['title'],
            'description' => $validated['description'],
            'category' => $validated['category'],
            'status'=> false,
        ]);

        return redirect()->route('home');
    }

    private function getAllTasksByUserId()
    {
        $user_id = Auth::id();
        return Task::where('user_id', $user_id)->get();
    }

    public function getAllTasks(){
        return User::find(Auth::id())->tasks;
    }
}
