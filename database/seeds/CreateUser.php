<?php

use Illuminate\Database\Seeder;

class CreateUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //create admin user
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'manish.dwibedy@gmail.com',
            'password' => bcrypt('admin'),
        ]);
    }
}
