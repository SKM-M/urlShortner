<?php

namespace App\Services;

use App\Repositories\AdminUserRepository;

class AdminService
{
    public function __construct(AdminUserRepository $adminUserRepository)
    {
        $this->adminUserRepository = $adminUserRepository;
    }

    public function getAllusers()
    {
        return $this->adminUserRepository->getAllusers();
    }

    public function createUser(array $data)
    {
        //create user
    }

    public function activateDeactivateUser($verificationToken)
    {
        $data = array('verificationToken' => $verificationToken);
        $validator = \Validator::make(
            $data,
            [
                'verificationToken' => 'required|string|min:2',
            ]
        );

        if ($validator->fails()) {
            return array($validator->errors(), 'status' => 422);
        }

        $userRepository = new \App\Repositories\UserRepository();
        $user = $userRepository->checkUser($verificationToken);

        if (count($user) == 0) {
            return array('error' => "User does not exists!", 'status' => 404);
        }
          //Sending data to repository 
        $user->verified = ($user->verified == 1) ? 0 : 1;
        $user->status = ($user->status == 1) ? 0 : 1;
        $userRepository->updateConfirmation($user);
        return array('operation' => 'Activate_Deactivate_User', 'response' => 'success', 'status' => 200);
    }

    public function sendRegistrationEmail($user)
    {
        $user->notify(new \App\Notifications\UserAccountCreatedNotification());
        return array('operation' => 'sendRegistrationEmail', 'response' => 'success', 'status' => 200);
    }

    public function getUserByEmail($email)
    {
        $userRepository = new \App\Repositories\UserRepository();
        return $userRepository->getUserByEmailAccount($email);
    }
}

