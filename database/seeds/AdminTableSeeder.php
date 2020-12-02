<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'name' => 'md tuhin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12344321'),
             'phon' => '01719800437',
        ]);
    }
}
