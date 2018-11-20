<?php

use Illuminate\Database\Seeder;

class SemesterSessionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\SemesterSession::class, 20) -> create();
    }
}
