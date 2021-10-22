<?php

namespace App\Services;
use App\User;

class UserService
{
    public function detail($id) {
        return User::find($id);
    }
}
