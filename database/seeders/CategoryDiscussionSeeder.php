<?php

namespace Database\Seeders;

use App\Models\CategoryDiscussion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryDiscussionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CategoryDiscussion::create([
            'name' => 'Kategori 1',
        ]);
        CategoryDiscussion::create([
            'name' => 'Kategori 2',
        ]);
    }
}
