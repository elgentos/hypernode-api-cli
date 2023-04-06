<?php

namespace App\Commands;

use Hypernode\Api\Exception\HypernodeApiClientException;
use Hypernode\Api\Exception\HypernodeApiServerException;
use Hypernode\Api\HypernodeClientFactory;
use LaravelZero\Framework\Commands\Command;

class CreateBrancherNode extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'brancher:create {hypernode} {--token= : The Hypernode API token} {--label= : Add labels to your Brancher node (comma-separated, optional)} {--clear-services= : Clear the data for provided service(s) when creating the Brancher instance. Useful when you don\'t want to run the production cron or supervisor. Can also be useful if you want to supply your own anonymized database. Possible options: cron, elasticsearch, mysql, supervisor (comma-separated, optional)}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Create a new Brancher node';

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

        $clearServices = array_filter(array_map('trim', explode(',', $this->option('clear-services'))));
        $labels = array_filter(array_map('trim', explode(',', $this->option('label'))));

        $client->brancherApp->create($originHypernode, [
            'labels' => $labels,
            'clear-services' => $clearServices,
        ]);

        $this->line('Brancher node creation for ' . $originHypernode . ' requested');
    }
}
