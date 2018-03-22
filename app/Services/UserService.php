<?php
namespace App\Services;

use App\Repositories\UserRepository;

class UserService
{
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAll()
    {
        return $this->userRepository->getAll();
    }

    //Here is where we creatre the user
    public function create(array $data)
    {

        //Post Validation
        $validator = \Validator::make(
            $data,
            [
                'name' => 'required|string|min:2',
                'email' => 'required|email',
                'passwordConfirm' => 'required|string|min:6'
            ]
        );

        if ($validator->fails()) {
            return array($validator->errors(), 'status' => 422);
        }

        $email = $data['email'];

        //Validation if email already exists       

        $exists = $this->getUserByEmail($email);
        if (!is_null($exists)) {
            return [
                'error' => "A user with the email $email already exists!",
                'status' => 401
            ];
        }

        //Sending data to repository for saving into database
        $user = $this->userRepository->create($data);
       
        //Response if data save successfully into table or not
        if (!is_null($user)) {
            $response = array('operation' => 'create_user', 'response' => 'success', 'email' => $data['email'], 'status' => 200);
        } else {
            $response = array('operation' => 'create_user', 'response' => 'fail', 'status' => 402);
        }
        return $response;
    }

    //update user profile
    public function update(array $data, $id)
    {
        //Post Validation
        /*
        $validator = \Validator::make(
            $data,
            [
                'firstName' => 'required|string|min:2',
                'lastName' => 'required|string|min:2',
                'gender' => 'required|in:1,2,3',
                'dob' => 'required'
            ]
        );

        if ($validator->fails()) {
            return array($validator->errors(), 'status' => 422);
        }
       
         */
        
        //Validation if user exists
        if (!$user = $this->userRepository->getUserById($id)) {
            return array('error' => "User does not exists!", 'status' => 404);
        }
      
        //Sending data to repository for saving into database
        $exists = $this->userRepository->update($user, $data);

        //Response if data upda successfully into table or not
        if (count($exists) == 1) {
            $response = array('operation' => 'update_user', 'response' => 'success', 'status' => 200);
        } else {
            $response = array('operation' => 'update_user', 'response' => 'fail', 'status' => 422);
        }
        return $response;
    }

    public function confirmRegisteredUser($verificationToken)
    {
        /*
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
         */
        $user = $this->userRepository->checkUser($verificationToken);
        if (count($user) == 0) {
            return array('error' => "User does not exists!", 'status' => 404);
        }
          //Sending data to repository for saving into database
        $this->userRepository->updateConfirmation($user);
        return array('operation' => 'registration_verification', 'response' => 'success', 'status' => 200);
    }

    public function getUserByEmail($email)
    {
        return $this->userRepository->getUserByEmailAccount($email);
    }

}
