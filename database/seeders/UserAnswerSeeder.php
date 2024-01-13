<?php

namespace Database\Seeders;

use App\Models\UserAnswer;
use Illuminate\Database\Seeder;

class UserAnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserAnswer::create([
            'user_answer'=>'A. Lorem Ipsum',
            'is_correct'=>'1',
            'idStudent'=>'1',
            'idQuestion'=>'1',
        ]);
        UserAnswer::create([
            'user_answer'=>'B. Lorem Ipsum',
            'is_correct'=>'0',
            'idStudent'=>'1',
            'idQuestion'=>'2',
        ]);
    }
}
