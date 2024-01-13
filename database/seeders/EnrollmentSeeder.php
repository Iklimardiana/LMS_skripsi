<?php

namespace Database\Seeders;

use App\Models\Enrollment;
use Illuminate\Database\Seeder;

class EnrollmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Enrollment::create([
            'verification'=>'0',
            'idSubject'=>'1',
            'idUser'=>'2'
        ]);
        Enrollment::create([
            'verification'=>'1',
            'idSubject'=>'1',
            'idUser'=>'1'
        ]);
    }
}
