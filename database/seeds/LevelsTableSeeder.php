<?php

use Illuminate\Database\Seeder;

use App\Models\Level;
use App\Models\ClassModel;

class LevelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Level::class, 7) -> create();
    }
}
