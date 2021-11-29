<?php

namespace Console\Commands;

use Illuminate\Console\Command;

class DatabaseMakeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:make';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create new Database if Not Exist';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
    }
}