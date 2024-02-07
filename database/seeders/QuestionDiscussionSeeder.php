<?php

namespace Database\Seeders;

use App\Models\DiscussionQuestion;
use Illuminate\Database\Seeder;

class QuestionDiscussionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DiscussionQuestion::create([
            'question' => 'pertanyaan 1',
            'idUser' => '1',
            'idCategory' => '1',
            'idSubject' => '1'
        ]);
        DiscussionQuestion::create([
            'question' => 'pertanyaan 2',
            'idUser' => '1',
            'idCategory' => '1',
            'idSubject' => '2'
        ]);
        DiscussionQuestion::create([
            'question' => 'pertanyaan 3',
            'image' => 'thumbnailDefault.jpg',
            'idUser' => '2',
            'idCategory' => '1',
            'idSubject' => '2'
        ]);
        DiscussionQuestion::create([
            'question' => 'pertanyaan 1',
            'image' => 'thumbnailDefault.jpg',
            'idUser' => '3',
            'idCategory' => '2',
            'idSubject' => '1'
        ]);
        DiscussionQuestion::create([
            'question' => 'pertanyaan 2',
            'image' => 'thumbnailDefault.jpg',
            'idUser' => '2',
            'idCategory' => '2',
            'idSubject' => '2'
        ]);
        DiscussionQuestion::create([
            'question' => 'pertanyaan 3',
            'image' => 'thumbnailDefault.jpg',
            'idUser' => '3',
            'idCategory' => '2',
            'idSubject' => '1'
        ]);
    }
}
