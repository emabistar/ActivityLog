<?php

use Illuminate\Database\Seeder;
use App\User;

class TestUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::create(
              ['name'=>'testuser','email'=>'test@example.com','password' =>bcrypt('secret')]
        );
    }
}
