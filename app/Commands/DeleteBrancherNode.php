<?php

namespace App\Commands;

use Hypernode\Api\Exception\HypernodeApiClientException;
use Hypernode\Api\Exception\HypernodeApiServerException;
use Hypernode\Api\HypernodeClientFactory;
use LaravelZero\Framework\Commands\Command;

class DeleteBrancherNode extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'brancher:delete {hypernode} {--token= : The Hypernode API token}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Delete/cancel a Brancher node';

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

        $hypernode = $this->argument('hypernode');

        $client->brancherApp->cancel($hypernode);

        $this->line('Brancher node deletion for ' . $hypernode . ' requested');
    }
}
