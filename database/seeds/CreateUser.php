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
        //truncate the users table
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('users')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');


        //create admin user
        DB::table('users')->insert([
            'name' => 'Manish Dwibedy',
            'email' => 'manish.dwibedy@gmail.com',
            'password' => bcrypt('admin'),
            'type' => 'admin'
        ]);

        //create manager user
        DB::table('users')->insert([
            'name' => 'manager',
            'email' => 'manager@gmail.com',
            'password' => bcrypt('manager'),
            'type' => 'manager'
        ]);

        //create caller user
        DB::table('users')->insert([
            'name' => 'caller',
            'email' => 'caller@gmail.com',
            'password' => bcrypt('caller'),
            'type' => 'caller'
        ]);

        //create supervisor user
        DB::table('users')->insert([
            'name' => 'supervisor',
            'email' => 'super@gmail.com',
            'password' => bcrypt('super'),
            'type' => 'supervisor'
        ]);
    }
}
