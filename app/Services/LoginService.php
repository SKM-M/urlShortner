<?php
namespace App\Services;

use App\Repositories\LoginRepository;

class LoginService
{
    public function __construct(LoginRepository $loginRepository)
    {
        $this->loginRepository = $loginRepository;
    }

    /**
     *User Login
     *Check if user is allready register if not register it
     */

    public function findOrCreateUser($user, $provider)
    {
        $email = $user->email;
        if (is_null($email)) {
            $email = 'not@provided.com';
        }

        $userExists = $this->loginRepository->getUser($email);

        if ($userExists) {
            return $userExists;
        }

        $userData =
            [
            'name' => $user->name,
            'password' => '555555',
            'email' => $email,
            'provider' => $provider,
            'provider_id' => $user->id,
            'remember_token' => str_random(10),
            'created_at' => date('Y-m-d H:i:s')
        ];

        return $this->loginRepository->create($userData);
    }

}


