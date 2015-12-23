<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        
        $this->call(CreateUser::class);
        $this->call(CreateRole::class);
        $this->call(CreateUserRole::class);
        $this->call(CreatePermissions::class);
        $this->call(CreateRolePermission::class);
        $this->call(LoadShiftDefination::class);
        Model::reguard();
    }
}
