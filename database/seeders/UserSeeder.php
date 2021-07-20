<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{

    public function run()
    {


        User::factory()->count(1)->create([
            'name' => "Jane Doe",
            'email' => "jane@gmail.com",
            'mobile_no' => "0123456789",
            'password' => 'password', // password
        ]);

        User::factory()->count(1)->create([
            'name' => "John Doe",
            'email' => "john@gmail.com",
            'mobile_no' => "1234567890",
            'password' => 'password', // password
        ]);

        User::factory()->count(5)->create();
    }
}
