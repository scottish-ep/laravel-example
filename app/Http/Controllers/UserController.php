<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Services\UserService;

class UserController extends Controller
{
    private $userService = null;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index() {
        $value = Cache::get('key');
        return response()->json([
            'list' => $value,
        ]);
    }

    public function detail($id) {
        return response()->json([
            'user' => $this->userService->detail($id),
        ]);
    }
}
