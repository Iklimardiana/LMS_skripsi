<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AnswerDiscussion;

class AnswerDiscussionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AnswerDiscussion::create([
            'answer' => 'jawaban 1',
            'image' => 'thumbnailDefault.jpg',
            'idUser' => '1',
            'idQuestion' => '1'
        ]);
        AnswerDiscussion::create([
            'answer' => 'jawaban 2',
            'image' => 'thumbnailDefault.jpg',
            'idUser' => '1',
            'idQuestion' => '1'
        ]);
        AnswerDiscussion::create([
            'answer' => 'jawaban 3',
            'image' => 'thumbnailDefault.jpg',
            'idUser' => '2',
            'idQuestion' => '1'
        ]);
        AnswerDiscussion::create([
            'answer' => 'jawaban 1',
            'image' => 'thumbnailDefault.jpg',
            'idUser' => '3',
            'idQuestion' => '2'
        ]);
        AnswerDiscussion::create([
            'answer' => 'jawaban 2',
            'image' => 'thumbnailDefault.jpg',
            'idUser' => '2',
            'idQuestion' => '2'
        ]);
        AnswerDiscussion::create([
            'answer' => 'jawaban 3',
            'image' => 'thumbnailDefault.jpg',
            'idUser' => '3',
            'idQuestion' => '2'
        ]);
    }
}
