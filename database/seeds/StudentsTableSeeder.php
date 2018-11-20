<?php

use Illuminate\Database\Seeder;

class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $students = factory(\App\Models\Student::class, 50) -> create();

        $year = \App\Models\Year::first();

        foreach ($students as $student) {
            $student -> years() -> attach($year -> id, ["seat_number" => mt_rand(0, 50000), "class_id" => \App\Models\ClassModel::inRandomOrder() -> first() -> id]);
        }
    }
}
