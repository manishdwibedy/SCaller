<?php

use Illuminate\Database\Seeder;

class CreateRole extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // truncating the roles table
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('roles')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        //create admin user
        DB::table('roles')->insert([
            'name' => 'admin'
        ]);

        //create manager user
        DB::table('roles')->insert([
            'name' => 'manager'
        ]);

        //create caller user
        DB::table('roles')->insert([
            'name' => 'caller',
        ]);

        //create supervisor user
        DB::table('roles')->insert([
            'name' => 'supervisor',
        ]);
    }
}
