<?php

namespace Console;

use Console\Commands\ConsoleMakeCommand;
use Console\Commands\FactoryMakeCommand;
use Console\Base\BaseConsoleKernel;

class Command extends BaseConsoleKernel
{
    /**
     * The Artisan commands provided by the application.
     *
     * @var array
     */
    protected array $commands = [
        ConsoleMakeCommand::class,
        FactoryMakeCommand::class
    ];
}