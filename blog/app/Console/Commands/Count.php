<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Count extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'count:user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Count the total number of user registered today';

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
        echo "This is a test output message";
    }
}
