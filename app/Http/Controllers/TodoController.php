<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTodoRequest;
use App\Models\Todo;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TodoController extends Controller
{
    public function index(): View
    {
        $todos = Todo::all();
        return view('welcome', ['todos' => $todos ]);
    }

    public function store(CreateTodoRequest $request): RedirectResponse
    {

      $user_date = date('Y-m-d H:i', strtotime($request->deadline));
# convert user date to utc date
        $utc_date = Carbon::createFromFormat('Y-m-d H:i', $user_date,$request->timezone);
        $utc_date->setTimezone('UTC');
        Todo::create([
            'user_id' => 1,
            'task' => $request->task,
            'deadline' => $utc_date,
        ]);

        return redirect()->to('/');
    }
}
