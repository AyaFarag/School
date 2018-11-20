<?php

use Illuminate\Database\Seeder;

class StudentsPointsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\StudentPoint::class, 10) -> create();
    }
}
