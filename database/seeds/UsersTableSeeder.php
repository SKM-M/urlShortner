<?php
use Illuminate\Database\Seeder;

use App\Models\User;
use Faker\Factory as Faker;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        User::truncate();//Empty all user record

        $faker = Faker::create();

        $password = Hash::make('admin@test');


        $provider = 'social';
        $provider_id = '12345';

        User::create([
            'name' => 'Adminstration',
            'email' => 'admin@test.com',
            'password' => $password,
            'provider' => $provider,
            'provider_id' => $provider_id,
            'remember_token' => str_random(10),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }
}
