<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;
use Hypernode\Api\HypernodeClientFactory;

class ListBrancherNodes extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'brancher:list {hypernode}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'List all Brancher nodes for a given Hypernode';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $client = HypernodeClientFactory::create(config('hypernode.api_token'));

        $originHypernode = $this->argument('hypernode');

        $client->brancherApp->list($originHypernode);

        print_r($client->brancherApp->list($originHypernode));
    }

    /**
     * Define the command's schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    public function schedule(Schedule $schedule): void
    {
        // $schedule->command(static::class)->everyMinute();
    }
}
