<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class MigrateAll extends Command
{
    protected $signature = 'migrate:all';
    protected $description = 'Run all migrations with foreign key constraints';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Disable foreign key constraints
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        // Run migrations
        $this->call('migrate');

        // Enable foreign key constraints
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $this->info('All migrations completed.');
    }
}
