<?php

namespace App\Http\Controllers;


use App\Http\Requests\TaskRequest;
use App\Http\Requests\UpdateRequest;
use App\Http\Resources\FavResource;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{

    // to get all task of a specific user
    public function getusertask()
    {
        $user = Auth::user();
        $tasks = $user->tasks()
            ->select('title', 'description', 'priority')
            ->orderByRaw("FIELD(priority,'high','medium','low')")
            ->get();
        return response()->json($tasks, 200);
    }

    // to get all tasks of all users
    public function index()
    {
        $taskall = Task::select('id', 'title', 'description', 'priority')
            ->orderByRaw("FIELD(priority,'high','medium','low')")
            ->get();
        return response()->json($taskall, 200,);
    }

    // add tasks to user by user_id from token
    public function store(TaskRequest $request)
    {
        $validated = $request->validated();
        try { // check if user exist add to request array and create
            $id = Auth::user()->id;
            $validated['user_id'] = $id;
            $task = Task::create($validated);
            return response()->json([
                'message' => 'Task Created Succesfully',
                'Task' => $task
            ], 201);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'User Not found',
            ], 404);
        }
    }


    public function show(int $id)
    {
        $task = Task::select('title', 'description', 'priority')
            ->find($id);
        return response()->json($task, 201);
    }


    public function update(UpdateRequest $request, int $id)
    {
        $update = Task::findorfail($id);
        $update->update($request->validated());
        return response()->json([
            'message' => 'Task Updated Successfully',
        ], 202);
    }


    public function destroy(int $id)
    {
        $delete = Task::findorfail($id);
        $delete->delete();
        return response()->json([
            'message' => 'Task Deleted Succesfully'
        ], 202);
    }

    // important just read it again
    public function addtasktocategory(Request $request, $id)
    {
        $task = Task::findorfail($id);
        $request->validate([
            'category_id' => 'required|exists:categories,id',
        ]);
        $task->categories()->attach($request->category_id);
        return response()->json([
            'message' => 'task added to category successfully'
        ]);
    }

    // add task to favorites
    public function addtofav($id)
    {
        $task = Task::findorfail($id);
        Auth::user()->addtasktofav()->syncwithoutdetaching($id);
        return response()->json(['Task Added To favorites'], 200);
    }

    // remove task from favorites
        public function removefromfav($id)
    {
        $task = Task::findorfail($id);
        Auth::user()->addtasktofav()->detach($id);
        return response()->json(['Task removed from favorites'], 200);
    }

    
    public function showallfav(){
        $all = Auth::user()->addtasktofav;
        return FavResource::collection($all);
    }

}
