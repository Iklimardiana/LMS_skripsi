<?php

namespace Database\Seeders;

use App\Models\Answer;
use Illuminate\Database\Seeder;

class AnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Answer::truncate();

        Answer::create([
            'answer_content' => 'A. Lorem Ipsum',
            'isCorrect' => '1',
            'idQuestion' => '1'
        ]);
        Answer::create([
            'answer_content' => 'B. Lorem Ipsum',
            'isCorrect' => '0',
            'idQuestion' => '1'
        ]);
        Answer::create([
            'answer_content' => 'C. Lorem Ipsum',
            'isCorrect' => '0',
            'idQuestion' => '1'
        ]);
        Answer::create([
            'answer_content' => 'D. Lorem Ipsum',
            'isCorrect' => '0',
            'idQuestion' => '1'
        ]);
        Answer::create([
            'answer_content' => 'A. Lorem Ipsum2',
            'isCorrect' => '0',
            'idQuestion' => '2'
        ]);
        Answer::create([
            'answer_content' => 'B. Lorem Ipsum2',
            'isCorrect' => '0',
            'idQuestion' => '2'
        ]);
        Answer::create([
            'answer_content' => 'C. Lorem Ipsum2',
            'isCorrect' => '1',
            'idQuestion' => '2'
        ]);
        Answer::create([
            'answer_content' => 'D. Lorem Ipsum2',
            'isCorrect' => '0',
            'idQuestion' => '2'
        ]);
    }
}
