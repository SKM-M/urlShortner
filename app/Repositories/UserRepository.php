<?php
namespace App\Repositories;

use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;

class UserRepository
{
    use RegistersUsers;

    public function __construct()
    {
        // $this->middleware('guest');
    }
    public function getAll()
    {
        return User::all();
    }
    //Create new user
    public function create(array $data)
    {
        $user = new User();
        $data['first_name'] = $data['firstName'];
        $data['last_name'] = $data['lastName'];
        $data['password'] = password_hash($data['passwordConfirm'], PASSWORD_BCRYPT);
        $data['provider'] = 'user';
        $data['provider_id'] = '1';
        $data['verified'] = '0';
        $data['verification_token'] = str_random(30);
        $data['dob'] = date('Y-m-d', strtotime($data['dob']));
        //dd($data);
        $user->fill($data);
        $user->save();

        return $user;
    }

    //Edit Profile of user
    public function update(User $user, array $data)
    {
        $user->last_name = '';
        $user->first_name = $data['firstName'];
        if (isset($data['lastName'])) {
            $user->last_name = $data['lastName'];
        }
        $user->dob = date('Y-m-d', strtotime($data['dob']));
        $user->gender = $data['gender'];
        $user->save();
        return $user;
    }

    // Confirm user verificationToken
    public function updateConfirmation($data)
    {
        return User::where('id', $data->id)
            ->where('verification_token', $data->verification_token)
            ->update(['verified' => $data->verified, 'status' => $data->status]);
    }
    
    // check user
    public function checkUser($verificationToken)
    {
        return User::where('verification_token', $verificationToken)->first();
    }
    // get user by email verification

    public function getUserByEmailAccount($email)
    {
        return User::where('email', $email)->first();
    }

    public function getUserById($id)
    {
        return User::find($id);
    }
}
