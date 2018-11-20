<?php

use Illuminate\Database\Seeder;

class QuizResponsesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\QuizResponse::class, 50) -> create();
    }
}
