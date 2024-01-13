<?php

namespace Database\Seeders;

use App\Models\Assignment;
use Illuminate\Database\Seeder;

class AssignmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Assignment::create([
            'attachment'=>'www.link.com',
            'type'=>'link',
            'category'=>'fromteacher',
            'score'=>null,
            'idMaterial'=>1,
            'idUser'=>3,
        ]);
        Assignment::create([
            'attachment'=>'file',
            'type'=>'file',
            'category'=>'fromstudent',
            'score'=>null,
            'idMaterial'=>1,
            'idUser'=>1,
        ]);
    }
}
