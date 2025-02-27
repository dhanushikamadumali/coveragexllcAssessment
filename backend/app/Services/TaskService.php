<?php
namespace App\Services;

use App\Models\Task;
use Illuminate\Support\Facades\Log;

class TaskService {
    // get all task
    public function getTask(){
        $task = Task::where('status', 1)->orderByDesc('created_at')->limit(5)->get();
       return $task->toArray();
    }
    // store task
    public function storeTask(
        string $title,
        string $description,
    ){
        try {
            Task::create([
                'title'       => $title,
                'description' => $description,
            ]);
            $type = 200;
            $msg = "Insert task successfully";

        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            $type = 400;
            $msg = "Insert task fail";
        }
        return [$type,$msg];
    }

    // update task status
    public function updateTaskStatus(
        object $task,
    ){
        try {
            $task->update(['status' => 0]);
            $type = 200;
            $msg = "Update task successfully";

        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            $type = 400;
            $msg = "Update task fail";
        }
        return [$type,$msg];
    }
}
