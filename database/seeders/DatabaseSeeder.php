<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(SubjectSeeder::class);
        $this->call(EnrollmentSeeder::class);
        $this->call(MaterialSeeder::class);
        $this->call(AssignmentSeeder::class);
        $this->call(ExamSeeder::class);
        $this->call(AnswerSeeder::class);
        $this->call(QuestionSeeder::class);
        $this->call(UserAnswerSeeder::class);
    }
}
