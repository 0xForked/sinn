<?php

namespace Console\Bootstrap;

use Dotenv\Dotenv;
use Dotenv\Exception\InvalidFileException;
use Illuminate\Support\Env;
use JetBrains\PhpStorm\NoReturn;
use Symfony\Component\Console\Output\ConsoleOutput;

class LoadEnvironmentVariables
{
    /**
     * Create a new loads environment variables instance.
     *
     * @param string $path
     * @param string|null $name
     * @return void
     */
    public function __construct(
        protected string $path,
        protected string|null $name = null
    ) { }

    /**
     * Setup the environment variables.
     *
     * If no environment file exists, we continue silently.
     *
     * @return void
     */
    public function bootstrap()
    {
        try {
            $this->createDotenv()->safeLoad();
        } catch (InvalidFileException $e) {
            $this->writeErrorAndDie([
                'The environment file is invalid!',
                $e->getMessage(),
            ]);
        }
    }

    /**
     * Create a Dotenv instance.
     *
     * @return Dotenv
     */
    protected function createDotenv(): Dotenv
    {
        return Dotenv::create(
            Env::getRepository(),
            $this->path,
            $this->name
        );
    }

    /**
     * Write the error information to the screen and exit.
     *
     * @param  string[]  $errors
     * @return void
     */
    #[NoReturn] protected function writeErrorAndDie(array $errors)
    {
        $output = (new ConsoleOutput)->getErrorOutput();

        foreach ($errors as $error) {
            $output->writeln($error);
        }

        exit(1);
    }
}