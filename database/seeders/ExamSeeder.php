<?php

namespace Database\Seeders;

use App\Models\exam;
use Illuminate\Database\Seeder;

class ExamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Exam::create([
            'title'=>'Ujian Pretest Alpro',
            'type'=>'pretest',
            'duration'=>60,
            'idSubject'=>1
        ]);
        Exam::create([
            'title'=>'ujian postest alpro',
            'type'=>'postest',
            'duration'=>60,
            'idSubject'=>1
        ]);
    }
}
