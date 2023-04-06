<?php

namespace App\Commands;

use Hypernode\Api\Exception\HypernodeApiClientException;
use Hypernode\Api\Exception\HypernodeApiServerException;
use Hypernode\Api\HypernodeClientFactory;
use LaravelZero\Framework\Commands\Command;

class UpdateBrancherNode extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'brancher:update {hypernode} {--token= : The Hypernode API token} {--append-labels} {--label= : Add labels to your Brancher node (comma-separated)}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Update a Brancher node with new labels';

    /**
     * Execute the console command.
     *
     * @return mixed
     * @throws HypernodeApiClientException
     * @throws HypernodeApiServerException
     */
    public function handle()
    {
        $client = HypernodeClientFactory::create($this->option('token') ?? config('hypernode.api_token'));

        $originHypernode = $this->argument('hypernode');

        $labels = array_filter(array_map('trim', explode(',', $this->option('label'))));

        $client->brancherApp->update($originHypernode, ['labels' => $labels], (bool) $this->option('append-labels'));

        $this->line('Brancher node update for ' . $originHypernode . ' requested');
    }
}
