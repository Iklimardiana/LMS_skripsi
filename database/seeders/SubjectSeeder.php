<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Subject::create([
            'name' => 'Informatika',
            'enrollment_key' => 'Informatika2024',
            'idTeacher' => '3',
            'thumbnail' => 'thumbnailDefault.jpg'
        ]);
        Subject::create([
            'name' => 'Matematika',
            'enrollment_key' => 'Matematika2024',
            'idTeacher' => '4',
            'thumbnail' => 'thumbnailDefault.jpg'
        ]);
    }
}
