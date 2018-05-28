<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Input\InputArgument;

class CreateDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:database {dbname} {connection?}';

    /**
     * The console command for creating new database directly from migrations.
     *
     * @var string
     */

//    protected $name = "make:database";

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
     * @return mixed
     */
    public function handle()
    {
        {
            try{
                $dbname = $this->argument('dbname');
                $connection = $this->hasArgument('connection') && $this->argument('connection') ? $this->argument('connection'): DB::connection()->getPDO()->getAttribute(PDO::ATTR_DRIVER_NAME);

                $hasDb = DB::connection($connection)->select("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = "."'".$dbname."'");

                if(empty($hasDb)) {
                    DB::connection($connection)->select('CREATE DATABASE '. $dbname);
                    $this->info("Database '$dbname' created for '$connection' connection");
                }
                else {
                    $this->info("Database $dbname already exists for $connection connection");
                }
            }
            catch (\Exception $e){
                $this->error($e->getMessage());
            }
        }
    }

    /**
     * Execute the console command to create database with name.
     *
     * @return mixed
     */

//    protected function getArguments()
//    {
//        return [
//            ['name', InputArgument::REQUIRED, 'deck_cards'],
//        ];
//    }
//
//    public function fire()
//    {
//        DB::getConnection()->statement('CREATE DATABASE :schema', ['schema' => $this->argument('name')]);
//    }
}
