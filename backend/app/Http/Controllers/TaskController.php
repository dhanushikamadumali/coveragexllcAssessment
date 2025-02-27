<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Requests\StoreTaskRequest;
use App\Services\TaskService;
use App\Http\Requests\UpdateTaskRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use TaskService as GlobalTaskService;

class TaskController extends Controller
{
    protected TaskService $taskService;

    public function __construct(TaskService $taskService){
        $this->taskService = $taskService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $responseData = $this->taskService->getTask();
        return response()->json($responseData, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        list($type,$msg) = $this->taskService->storeTask(
            title:$request['title'],
            description:$request['description']
        );
        return response()->json($msg, $type);
    }


    /**
     * Update task status.
     */
    public function updateStatus(Task $task)
    {
        list($type,$msg) = $this->taskService->updateTaskStatus(
            task:$task
        );
        return response()->json($msg, $type);
    }


}
