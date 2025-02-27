<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Services\TaskService;
use App\Models\Task;

class TaskTest extends TestCase
{
    use DatabaseTransactions, WithFaker;
    private TaskService $taskService;

    public function setUp():void
    {
        parent::setUp();
        $this->taskService =  new TaskService;
    }

    public function testStoreTask()
    {
        $title = $this->faker->text(10);
        $description = $this->faker->text(100);

        $result = $this->taskService->storeTask(
            title:$title,
            description:$description,
        );
        $this->assertEquals([200,'Insert task successfully'],$result);
        $this->assertDatabaseHas('tasks',[
            'title' => $title,
            'description' => $description
        ]);
    }

    public function testStatusUpdate()
    {
        $task = Task::factory()->create();
        $result = $this->taskService->updateTaskStatus(
            task:$task
        );
        $this->assertEquals([200,'Update task successfully'],$result);
        $this->assertDatabaseHas('tasks',[
            'title' => $task->title,
            'description' => $task->description,
            'status' => 0
        ]);

    }
}
