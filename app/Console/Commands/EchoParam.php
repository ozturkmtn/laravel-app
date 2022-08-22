<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class EchoParam extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'echo:param {param}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $param = $this->argument('param');
        $this->info('Here EchoParam Command :: '. $param);
        return 0;
    }
}
