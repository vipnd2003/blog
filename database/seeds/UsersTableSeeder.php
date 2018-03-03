<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Administrator',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123456'),
            'role' => 1
        ]);

        DB::table('users')->insert([
            'name' => 'User 1',
            'email' => 'user1@gmail.com',
            'password' => bcrypt('123456'),
            'role' => 0
        ]);
    }
}
