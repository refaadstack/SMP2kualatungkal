<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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
            'role' =>'admin',
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('adminadmin'),
            'remember_token' => Str::random(60),
        ]);
        DB::table('users')->insert([
            'role' =>'siswa',
            'name' => 'siswa',
            'email' => 'siswa@gmail.com',
            'password' => bcrypt('siswasiswa'),
            'remember_token' => Str::random(60),
        ]);
        
    }
}
