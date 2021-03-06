<?php

use Illuminate\Database\Seeder;

class CreateRolePermission extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('permission_role')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Making an manager role
        $role = App\Role::where('name', '=', 'manager')->first();
        $permission = App\Permission::where('name', '=', 'make-shifts')->first();
        // role attach alias
        $role->attachPermission($permission); // parameter can be an Role object, array, or id



        // Making an caller role
        $role = App\Role::where('name', '=', 'caller')->first();
        $permission = App\Permission::where('name', '=', 'schedule-shifts')->first();
        // role attach alias
        $role->attachPermission($permission); // parameter can be an Role object, array, or id


    }
}
