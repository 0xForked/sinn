<?php

namespace Console;

use Console\Commands\ConsoleMakeCommand;
use Console\Commands\DatabaseMakeCommand;
use Console\Commands\FactoryMakeCommand;
use Console\Core\Kernel;

class Command extends Kernel
{
    /**
     * The Artisan commands provided by the application.
     *
     * @var array
     */
    protected array $commands = [
        ConsoleMakeCommand::class,
        DatabaseMakeCommand::class,
        FactoryMakeCommand::class
    ];
}