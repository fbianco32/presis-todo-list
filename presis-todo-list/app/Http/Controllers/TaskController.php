<?php

namespace App\Http\Controllers;

use App\Http\Resources\TaskResource;
use App\Models\Task;
use Exception;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return TaskResource::collection(Task::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $title = Task::validateTitle($request->title);
            $status = Task::validateStatus($request->status);

            $task = Task::create([
                'title' => $title,
                'status' => $status,
            ]);
            return response()->json([
                'data' => new TaskResource($task)
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'data' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $task = Task::find($id);
        return response()->json([
            'data' => new TaskResource($task)
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        try {        
            $title = Task::validateTitle($request->title);
            $status = Task::validateStatus($request->status);
    
            $task = Task::find($request->input('id'));
            
            $task->title = isset($title) ? $title : $task->title;
            $task->status = isset($status) ? $status : $task->status;
    
            $task->save();
    
            return response()->json([
                'data' => new TaskResource($task)
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'data' => $e->getMessage()
            ], 400);
        }

    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, string $id)
    // {
    //     //
    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Task::find($id)->delete();
        return response()->json(null,204);
    }
}
