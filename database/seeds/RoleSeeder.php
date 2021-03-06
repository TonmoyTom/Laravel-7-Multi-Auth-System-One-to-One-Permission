<?php

use Illuminate\Database\Seeder;
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
         //role  

         $rolesuperadmin = Role::create(['guard_name' => 'admin','name' => 'superadmin']);
         $roleadmin = Role::create(['guard_name' => 'admin','name' => 'admin']);
         $roleeditor = Role::create(['guard_name' => 'admin','name' => 'editor']);
         $roleuser = Role::create(['guard_name' => 'admin','name' => 'user']);
        //permission

        $permissions = [
            
             [
                'group_name' => 'dashboard',
                'permissions' => [
                    // admin Permissions
                    'admin.dashboard',
                    
                    
                ]
            ],

            
            [
                'group_name' => 'admin',
                'permissions' => [
                    // admin Permissions
                    'admins.all',
                    'admins.create',
                    'admins.store',
                    'admins.edit',
                    'admins.update',
                    'admins.delete',
                    
                ]
            ],
            [
                'group_name' => 'role',
                'permissions' => [
                    // role Permissions
                    'role.all',
                    'role.create',
                    'role.store',
                    'role.edit',
                    'role.update',
                    'role.delete',
                ]
            ],
        ];
         

        //create Permission

       for($i= 0; $i< count($permissions);$i++){
        $permissionGroup = $permissions[$i]['group_name'];
        for($j = 0; $j < count($permissions[$i]['permissions']); $j++){
            
            $permission = Permission::create(['guard_name' => 'admin','name' => $permissions[$i]['permissions'][$j], 'group_name' => $permissionGroup]);

            $rolesuperadmin->givePermissionTo($permission);
            $permission->assignRole($rolesuperadmin);
        }
       
       }
        DB::table('model_has_roles')->insert([
         'role_id' => 1,
         'model_type' => 'App\Admin',
         'model_id' => 1
        ]);
    }
}
