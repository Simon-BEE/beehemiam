<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class EnsureQueueWorkerIsRunning extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'queue:checkup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Ensure that the queue worker is running.';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        if (! $this->isQueueListenerRunning()) {
            $this->comment('Queue Worker is being started.');
            $pid = $this->startQueueListener();
            $this->saveQueueListenerPID($pid);
        }

        $this->comment('Queue worker is running.');
    }

    /**
     * Check if the queue listener is running.
     *
     * @return bool
     */
    private function isQueueListenerRunning()
    {
        if (! $pid = $this->getLastQueueListenerPID()) {
            return false;
        }

        $process = exec("ps -p $pid -opid=,cmd=");

        $processIsQueueListener = ! empty($process);

        return $processIsQueueListener;
    }

    /**
     * Get any existing queue listener PID.
     *
     * @return bool|string
     */
    private function getLastQueueListenerPID()
    {
        if (! file_exists(__DIR__ . '/queue.pid')) {
            return false;
        }

        return file_get_contents(__DIR__ . '/queue.pid');
    }

    /**
     * Save the queue listener PID to a file.
     *
     * @param integer $pid
     *
     * @return void
     */
    private function saveQueueListenerPID(int $pid)
    {
        file_put_contents(__DIR__ . '/queue.pid', $pid);
    }

    /**
     * Start the queue listener.
     *
     * @return int
     */
    private function startQueueListener()
    {
        $params = '--timeout=60 --rest=0.5 --sleep=5 --tries=3 --max-jobs=1000 --max-time=3600';
        $command = 'php '
            . base_path()
            . '/artisan queue:work ' . $params . ' > /dev/null & echo $!';
        $pid = exec($command);

        return (int)$pid;
    }
}
