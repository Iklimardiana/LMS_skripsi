<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Question::create([
            'content'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
            'idExam'=>1,
        ]);
        Question::create([
            'content'=>'Nibh nisl condimentum id venenatis. Egestas purus viverra accumsan in.',
            'idExam'=>1,
        ]);
    }
}
