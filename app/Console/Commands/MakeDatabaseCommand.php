<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class MakeDatabaseCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:database';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return int
     */
    public function handle()
    {

        $DB_HOST = env('DB_HOST');
        $DB_USERNAME = env('DB_USERNAME');
        $DB_PASSWORD = env('DB_PASSWORD');
        $DB_DATABASE = env('DB_DATABASE');
        $pdo = new \PDO("mysql:host=$DB_HOST", $DB_USERNAME, $DB_PASSWORD);
        $pdo->exec("CREATE DATABASE {$DB_DATABASE} CHARACTER SET utf8 COLLATE utf8_general_ci");
        $this->info("CREATE DATABASE {$DB_DATABASE}");
        return 0;
    }


}
