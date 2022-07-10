<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
//permisos
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        /* Permisos */
        $role1=Role::create(['name'=>'admin']);
        $role2=Role::create(['name'=>'empleado']);

        Permission::create(['name'=>'home'])->syncRoles([$role1, $role2]);
        Permission::create(['name'=>'welcome'])->syncRoles([$role1, $role2]);
        Permission::create(['name'=>'modelos.create'])->syncRoles([$role1]);
        Permission::create(['name'=>'modelos.index'])->syncRoles([$role1]);
        Permission::create(['name'=>'modelos.destroy'])->syncRoles([$role1]);
        Permission::create(['name'=>' modelos.borrar'])->syncRoles([$role1]);

        Permission::create(['name'=>'modelos.store'])->syncRoles([$role1]);

        Permission::create(['name'=>'empleado.index'])->syncRoles([$role2]);
        Permission::create(['name'=>'empleado.store'])->syncRoles([$role2]);
        Permission::create(['name'=>'empleado.perfil'])->syncRoles([$role2]);
    }
}
