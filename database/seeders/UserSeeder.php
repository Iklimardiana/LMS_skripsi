<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'email'=>'student1@gmail.com',
            'first_name'=>'Dian',
            'last_name'=>'Permata',
            'password'=>bcrypt('Pelajar1'),
            'role'=>'student',
            'gender'=>'L',
            'phone'=>'09210929102',
            'avatar'=>'avatarDefault.png',
            'key'=>null,
            'active'=>'1'
        ]);
        User::create([
            'email'=>'student2@gmail.com',
            'first_name'=>'Diana',
            'last_name'=>'Sari',
            'password'=>bcrypt('Pelajar2'),
            'role'=>'student',
            'gender'=>'P',
            'phone'=>'09210929102',
            'avatar'=>'avatarDefault.png',
            'key'=>null,
            'active'=>'1'
        ]);
        User::create([
            'email'=>'teacher1@gmail.com',
            'first_name'=>'Dina',
            'last_name'=>'Mardiana',
            'password'=>bcrypt('Pengajar1'),
            'role'=>'teacher',
            'gender'=>'P',
            'phone'=>'09210929102',
            'avatar'=>'avatarDefault.png',
            'key'=>null,
            'active'=>'1'
        ]);
        User::create([
            'email'=>'teacher2@gmail.com',
            'first_name'=>'Mardiana',
            'last_name'=>'Dina',
            'password'=>bcrypt('Pengajar2'),
            'role'=>'teacher',
            'gender'=>'P',
            'phone'=>'09210929102',
            'avatar'=>'avatarDefault.png',
            'key'=>null,
            'active'=>'1'
        ]);
    }
}
