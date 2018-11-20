<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Illuminate\Support\Facades\Artisan;
use DB;

class InitializeDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = "db:init";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Initialize the database (create database | run migrations | run seeds)";

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = env("DB_DATABASE");
        $this -> line("Deleting existing database if exists...");

        try {
            DB::statement("DROP DATABASE $name");
            $this -> info("Deleted old database successfully...");
        } catch (\Illuminate\Database\QueryException $e) {
            $this -> error("No old database was found!");
        }

        $this -> line("Creating an empty database $name...");
        DB::connection("mysql_no_db")
            -> statement("CREATE DATABASE $name DEFAULT CHARACTER SET utf8;");
        $this -> info("$name was created successfully");
    }
}
