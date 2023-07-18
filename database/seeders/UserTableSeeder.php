<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Str;
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Role::create([
            'name'=>'admin',
            'slug'=>'admin',
            'permission'=>json_encode(['admin'=>true])
        ]);
        Role::create([
            'name'=>'customer',
            'slug'=>'customer',
            'permission'=>json_encode(['customer'=>true])
        ]);
        Role::create([
            'name'=>'broker',
            'slug'=>'broker',
            'permission'=>json_encode(['broker'=>true])
        ]);
        User::create([
            'name'=>'admin',
            'surname'=>'admin',
            'email'=>'admin@elx.com',
            'password'=>bcrypt('123456'),
            'uuid'=>Str::uuid()->toString(),
            'role_id'=>'1',
        ]);
    }
}
