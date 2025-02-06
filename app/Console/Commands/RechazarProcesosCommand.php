<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class RechazarProcesosCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:rechazar-procesos-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        \Log::debug("Test schedule: " . date('Y-m-d H:i:s'));
    }
}
