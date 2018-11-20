<?php

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
        $this -> call(AdminsTableSeeder::class);
        $this -> call(SettingsTableSeeder::class);
        $this -> call(YearsTableSeeder::class);
        $this -> call(LevelsTableSeeder::class);
        $this -> call(BranchesTableSeeder::class);
        $this -> call(SubjectsTableSeeder::class);
        $this -> call(ClassesTableSeeder::class);
        $this -> call(TeachersTableSeeder::class);
        $this -> call(SemesterSessionsTableSeeder::class);
        $this -> call(AnnouncementsTableSeeder::class);
        $this -> call(SchedulesTableSeeder::class);
        $this -> call(SessionsTableSeeder::class);
        $this -> call(ParentsTableSeeder::class);
        $this -> call(StudentsTableSeeder::class);
        $this -> call(QuizzesTableSeeder::class);
        $this -> call(QuizResponsesTableSeeder::class);
        $this -> call(StudentsOfDayTableSeeder::class);
        $this -> call(StudentsPointsTableSeeder::class);
        $this -> call(VideosTableSeeder::class);
    }
}
