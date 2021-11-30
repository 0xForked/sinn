# Database Migration Schema Builder

##### Requirement
- [composer](https://getcomposer.org/)
- [PHP ^8.x](https://www.php.net/downloads) or higher

##### How to use 

- install composer dependencies

    ```bash
    $ composer install
    ```

- copy environment file and update variables

    ```bash
    $ cp .env.example .env
    ```

        DB_CONNECTION=mysql
        DB_HOST=127.0.0.1
        DB_PORT=3306
        DB_DATABASE=sekelton_db
        DB_USERNAME=root
        DB_PASSWORD=root
        DB_CHARSET=utf8
        DB_COLLATION=utf8_general_ci

- Command
    - `php artisan `
      <br> show list of available command!

- option backup

  `--column-statistics=0`

##### Available .SQL backup (mysqldump)

- [/database/dumps](/database/dumps)

##### How to crate new Command

1. Run command 

    ```bash
    $ php artisan make:command {NewCommandName}
    ```
    
   This action will create new `NewCommandName.php` at `src\Commands` automatically.
  
2. After that register the new command at
    
    `src\Command.php`
    
    do update: 
    ```php
    protected array $commands = [];
    ```
   add NewCommandName to $command:
    ```php
    protected array $commands = [
        Console\Commands\NewCommandName::class
    ];
    ```
