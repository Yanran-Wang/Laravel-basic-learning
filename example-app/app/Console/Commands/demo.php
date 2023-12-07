<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class demo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:demo';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'print out name';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        echo "demo test";
    }
}
