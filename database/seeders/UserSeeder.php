<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $team_view   =  Permission::create(['name'=>'team.view']);
        $team_create =  Permission::create(['name'=>'team.create']);
        $team_update =  Permission::create(['name'=>'team.update']);
        $team_delete =  Permission::create(['name'=>'team.delete']);
        $view_team =  Permission::create(['name'=>'view.team']);


        $admin_role = Role::create(['name'=>'admin']);
        $admin_role->givePermissionTo([
            $team_view,
            $team_create,
            $team_update,
            $team_delete
        ]);
        $admin = User::create([
            'name'     =>'Admin',
            'email'    =>'admin12@gmail.com',
            'password' =>bcrypt('password')
        ]);
        $admin->assignRole($admin_role);
        $admin->givePermissionTo([
            $team_view,
            $team_create,
            $team_update,
            $team_delete
        ]);
        $user = User::create([
            'name'     =>'user',
            'email'    =>'user12@gmail.com',
            'password' =>bcrypt('password')
        ]);

        $user_role = Role::create(['name'=>'user']);
        $user->assignRole($user_role);
        $user->givePermissionTo([
            $view_team,
        ]);
        

    }
}
