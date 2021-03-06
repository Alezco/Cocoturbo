<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;

class createCoco extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'createCoco';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create the database';

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
        DB::Connection()->statement('CREATE DATABASE :schema', ['schema' => 'cocoturbo']);
    }
}
