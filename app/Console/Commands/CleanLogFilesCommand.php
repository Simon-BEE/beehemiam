<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CleanLogFilesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'logs:clean';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean log file from two weeks ago';

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
        $logFileTwoWeeksAgo = storage_path('logs')
            . '/laravel-'
            . now()->subWeeks(2)->format('Y-m-d')
            . '.log';

        if (file_exists($logFileTwoWeeksAgo)) {
            unlink($logFileTwoWeeksAgo);
        }

        return 0;
    }
}
