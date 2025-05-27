<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Interfaces\TaskRepositoryInterface;
use Illuminate\Foundation\Testing\WithFaker;
use App\Services\TaskService;
use App\DTOs\StoreTaskDTO;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

use Mockery;

class TaskServiceTest extends TestCase
{
    public function test_store_task_of_user_and_return_created_task(){

        $dto = new StoreTaskDTO(title:"Same Name Task", description:"Same Description Task");
        $taskRepositoryInterfaceMock = Mockery::mock(TaskRepositoryInterface::class);

        $fakeTask = new Task();
        $fakeTask->title = 'Same Name Task';
        $fakeTask->description = 'Same Description Task';
        $fakeTask->id = 'uuid-fake-id';

        //Mock Auth::user()
        $userMock = new \stdClass();
        $userMock->id = 1;
        Auth::shouldReceive('user')->andReturn($userMock);

        $taskRepositoryInterfaceMock
                        ->shouldReceive('store')
                        ->once()
                        ->with($dto,1)
                        ->andReturn($fakeTask);
        
        $taskService = new TaskService( $taskRepositoryInterfaceMock );

        $result =  $taskService->store( $dto );

        $this->assertEquals('uuid-fake-id', $result->id);
        $this->assertEquals('Same Name Task', $result->title);
        $this->assertEquals('Same Description Task', $result->description);                

    }

    public function test_get_all_tasks_for_authenticated_user()
    {
        $fakeUserId = 'uuid-fake-id';
        $fakeTasks = collect([
            new Task(['id' => 'task-1', 'title' => 'Task One', 'description' => 'Desc One']),
            new Task(['id' => 'task-2', 'title' => 'Task Two', 'description' => 'Desc Two']),
        ]);

        Auth::shouldReceive('user')->andReturn((object)['id' => 'uuid-fake-id']);

        $taskRepositoryMock = Mockery::mock(TaskRepositoryInterface::class);
        $taskRepositoryMock->shouldReceive('getAll')
            ->with($fakeUserId)
            ->andReturn($fakeTasks);

        $taskService = new TaskService($taskRepositoryMock);

        $result = $taskService->getAll();

        $this->assertEquals($fakeTasks, $result);
    }

    public function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
