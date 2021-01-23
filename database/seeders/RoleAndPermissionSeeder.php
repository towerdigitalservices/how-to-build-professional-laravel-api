<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;
use App\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            [
                'name' => 'Create Roles',
                'slug' => 'create-roles',
            ],
            [
                'name' => 'Modify Roles',
                'slug' => 'modify-roles',
            ],
            [
                'name' => 'Assign Roles',
                'slug' => 'assign-roles',
            ],
            [
                'name' => 'Delete Roles',
                'slug' => 'delete-roles',
            ],
            [
                'name' => 'Create Users',
                'slug' => 'create-users',
            ],
            [
                'name' => 'Modify Users',
                'slug' => 'modify-users',
            ],
            [
                'name' => 'Delete Users',
                'slug' => 'delete-users',
            ],
            [
                'name' => 'View Users',
                'slug' => 'view-users',
            ],
            [
                'name' => 'View AllPhone Numbers',
                'slug' => 'view-all-phones'
            ],
            [
                'name' => 'Provision Phone Numbers',
                'slug' => 'provision-phones'
            ],
            [
                'name' => 'Delete Phone Numbers',
                'slug' => 'delete-phones'
            ],
            [
                'name' => 'Send SMS Message',
                'slug' => 'send-sms'
            ],
        ];
        $permissionIds = [];
        foreach($permissions as $permission) {
            $permission = Permission::create($permission);
            $permissionIds[$permission->slug] = $permission->id;
        }
        $roles = [
            [
                'name' => 'Admin',
                'slug' => 'admin',
                'permissions' => [
                    'create-roles',
                    'modify-roles',
                    'assign-roles',
                    'delete-roles',
                    'create-users',
                    'modify-users',
                    'delete-users',
                    'view-users',
                    'view-all-phones',
                    'provision-phones',
                    'delete-phones',
                    'send-sms'

            ]
            ],
            [
                'name' => 'Manager',
                'slug' => 'manager',
                'permissions' => [
                    'create-users',
                    'modify-users',
                    'delete-users',
                    'view-users',
                    'view-all-phones',
                    'provision-phones',
                    'delete-phones',
                    'send-sms'
            ]

            ],
            [
                'name' => 'User',
                'slug' => 'user',
                'permissions' => [
                    'view-users',
                    'send-sms'
            ]

            ],

        ];

        foreach($roles as $role) {
            $model = Role::create([
                'name' => $role['name'],
                'slug' => $role['slug'],
            ]);
            $ids = collect($role['permissions'])
            ->map(function($slug) use($permissionIds){
                return $permissionIds[$slug];
            });
            $model->permissions()->attach($ids);
        }
    }
}
