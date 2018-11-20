<?php

use Illuminate\Database\Seeder;

class StudentsOfDayTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\StudentOfDay::class, 40) -> create();
    }
}
