<?php

namespace Console\Base;

use Illuminate\Contracts\Container\BindingResolutionException;
use Symfony\Component\Console\Application as SymfonyConsoleApplication;
use Illuminate\Console\Application as Artisan;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Contracts\Console\Kernel as KernelContract;
use RuntimeException;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Throwable;

class BaseConsoleKernel implements KernelContract
{
    /**
     * The Artisan application instance.
     *
     * @var Artisan
     */
    protected $artisan;

    /**
     * Indicates if facade aliases are enabled for the console.
     *
     * @var bool
     */
    protected bool $aliases = true;

    /**
     * The Artisan commands provided by the application.
     *
     * @var array
     */
    protected array $commands = [];

    /**
     * Create a new console kernel instance.
     *
     * @param Application $app
     * @return void
     * @throws BindingResolutionException
     */
    public function __construct(
        protected Application $app
    ) {
        $this->app->prepareForConsoleCommand();
    }

    /**
     * Run the console application.
     *
     * @param  InputInterface  $input
     * @param  OutputInterface  $output
     * @return int
     */
    public function handle($input, $output = null): int
    {
        try {
            $this->app->boot();

            return $this->getArtisan()->run($input, $output);
        } catch (Throwable $e) {
            $this->renderException($output, $e);

            return 1;
        }
    }

    /**
     * Bootstrap the application for artisan commands.
     *
     * @return void
     */
    public function bootstrap()
    {
        //
    }

    /**
     * Terminate the application.
     *
     * @param  InputInterface  $input
     * @param  int  $status
     * @return void
     */
    public function terminate($input, $status)
    {
        //
    }

    /**
     * Define the application's command schedule.
     *
     * @param Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        //
    }

    /**
     * Run an Artisan console command by name.
     *
     * @param string $command
     * @param array $parameters
     * @param null $outputBuffer
     * @return int
     * @throws BindingResolutionException
     */
    public function call($command, array $parameters = [], $outputBuffer = null): int
    {
        return $this->getArtisan()->call($command, $parameters, $outputBuffer);
    }

    /**
     * Queue the given console command.
     *
     * @param  string  $command
     * @param  array  $parameters
     * @return void
     */
    public function queue($command, array $parameters = [])
    {
        throw new RuntimeException('Queueing Artisan commands is not supported.');
    }

    /**
     * Get all the commands registered with the console.
     *
     * @return array
     * @throws BindingResolutionException
     */
    public function all(): array
    {
        return $this->getArtisan()->all();
    }

    /**
     * Get the output for the last run command.
     *
     * @return string
     * @throws BindingResolutionException
     */
    public function output(): string
    {
        return $this->getArtisan()->output();
    }

    /**
     * Get the Artisan application instance.
     *
     * @return Artisan
     * @throws BindingResolutionException
     */
    protected function getArtisan(): Artisan
    {
        if (is_null($this->artisan)) {
            return $this->artisan = (new Artisan(
                $this->app,
                $this->app->make('events'),
                'v(^8.x) dms-starter-kit v(1.0.1)'
            ))->resolveCommands($this->getCommands());
        }

        return $this->artisan;
    }

    /**
     * Get the commands to add to the application.
     *
     * @return array
     */
    protected function getCommands(): array
    {
        return array_merge($this->commands, [
            //
        ]);
    }

    /**
     * Report the exception to the exception handler.
     *
     * @param OutputInterface $output
     * @param Throwable $e
     * @return void
     */
    protected function renderException(OutputInterface $output, Throwable $e)
    {
        (new SymfonyConsoleApplication)->renderThrowable($e, $output);
    }

}