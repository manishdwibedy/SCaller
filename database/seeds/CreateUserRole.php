<?php

use Illuminate\Database\Seeder;

class CreateUserRole extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('role_user')->truncate();

        // Making an admin user
        $user = App\User::where('name', '=', 'Manish Dwibedy')->first();
        $admin = App\Role::where('name', '=', 'admin')->first();

        // role attach alias
        $user->attachRole($admin); // parameter can be an Role object, array, or id

        // Making a manager user
        $user = App\User::where('name', '=', 'manager')->first();
        $manager = App\Role::where('name', '=', 'manager')->first();

        // role attach alias
        $user->attachRole($manager); // parameter can be an Role object, array, or id

        // Making a supervisor user
        $user = App\User::where('name', '=', 'supervisor')->first();
        $supervisor = App\Role::where('name', '=', 'supervisor')->first();

        // role attach alias
        $user->attachRole($supervisor); // parameter can be an Role object, array, or id

        // Making a caller user
        $user = App\User::where('name', '=', 'caller')->first();
        $caller = App\Role::where('name', '=', 'caller')->first();

        // role attach alias
        $user->attachRole($caller); // parameter can be an Role object, array, or id
    }
}
