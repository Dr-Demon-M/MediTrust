<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255'
        ]);

        auth()->user()->todos()->create([
            'title' => $request->title
        ]);

        return back();
    }

    public function toggle(Todo $todo)
    {
        if ($todo->user_id !== auth()->id()) {
            abort(403);
        }

        $todo->update([
            'completed' => !$todo->completed
        ]);

        return back();
    }

    public function destroy(Todo $todo)
    {
        if ($todo->user_id !== auth()->id()) {
            abort(403);
        }
        $todo->delete();
        return back();
    }
}
