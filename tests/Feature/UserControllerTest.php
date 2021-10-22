<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Cache;

use App\Services\UserService;
use App\Http\Controllers\UserController;

use Mockery;
use Mockery\MockInterface;

class UserControllerTest extends TestCase
{
    /**
    * A basic feature test example.
    *
    * @return void
    */
    public function testGetIndex()
    {
        $cacheDriver = app('cache')->driver();
        Cache::shouldReceive('driver')->andReturn($cacheDriver);
        Cache::shouldReceive('get')
        ->once()
        ->with('key')
        ->andReturn('hello world');
        $response = $this->get('/api/users');
        $response->assertStatus(200);
    }

    public function testGetDetail() {
        $mock = Mockery::mock('App\Services\UserService');
        $mock->shouldReceive('detail')
        ->with(1)
        ->once()
        ->andReturn((object)[
            'email' => 'scottish.foldep@gmail.com'
        ]);
        $this->app->instance('App\Services\UserService', $mock);
        $response = $this->get('/api/users/1');
        // $userController = new UserController($mock);
        // $response = $userController->detail(1);
        $response->assertStatus(200);
    }
}
