<?php
namespace App\Repositories;
//use Illuminate\Support\Facades\DB;

use App\Models\User;

class AdminUserRepository
{
    public function getAllusers()
    {
        return User::all();
    }

    public function createUser(array $data)
    {
     //create user
    }

    public function updateUser(User $user, array $data)
    {
       //update user
    }
}
