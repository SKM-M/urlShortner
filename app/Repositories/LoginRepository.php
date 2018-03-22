<?php
namespace App\Repositories;

use App\Models\User;

class LoginRepository
{
    public function getUser($email)
    {
        return User::Where('email', $email)->first();
    }

    public function create(array $data)
    {
        $user = new User();

        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);

        $user->fill($data);
        $user->save();

        return $user;
    }

}
