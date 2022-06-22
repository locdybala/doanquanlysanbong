<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        $adminRoles=Role::where('name','admin')->first();
        $authRoles=Role::where('name','auth')->first();
        $userRoles=Role::where('name','user')->first();

        $admin=User::create([
            'name'=>'LocAdmin',
            'email'=>'locdybala11@gmail.com',
            'phone'=>'0366280440',
            'password'=>md5('ngodinhloc')
        ]);
        $auth=User::create([
            'name'=>'LocAuth',
            'email'=>'locdybala12@gmail.com',
            'phone'=>'0366280441',
            'password'=>md5('ngodinhloc')
        ]);
        $user=User::create([
            'name'=>'LocUser',
            'email'=>'locdybala13@gmail.com',
            'phone'=>'0366280442',
            'password'=>md5('ngodinhloc')
        ]);
        $admin->roles()->attach($adminRoles);
        $auth->roles()->attach($authRoles);
        $user->roles()->attach($userRoles);

    }
}
