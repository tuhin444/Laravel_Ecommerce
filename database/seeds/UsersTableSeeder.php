<?php

use Illuminate\Database\Seeder;

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
            'role_id' => '1',
            'first_name' => 'admin',
            'username' => 'Md admin',
            'email' => 'admin@gmail.com',
            'phone_no' => '01719800437',
            'password' => bcrypt('admin'),
        ]);

        DB::table('users')->insert([
            'role_id' => '2',
            'first_name' => 'author',
            'username' => 'author',
            'email' => 'author@gmail.com',
            'phone_no' => '01719800411',
            'password' => bcrypt('author'),
        ]);
    }
}
