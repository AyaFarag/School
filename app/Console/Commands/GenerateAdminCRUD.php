<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GenerateAdminCRUD extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:crud';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automatically generate policy/request/controller/views for a specific table';

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

    }
}
