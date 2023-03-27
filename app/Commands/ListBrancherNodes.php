<?php

namespace App\Commands;

use Hypernode\Api\Exception\HypernodeApiClientException;
use Hypernode\Api\Exception\HypernodeApiServerException;
use LaravelZero\Framework\Commands\Command;
use Hypernode\Api\HypernodeClientFactory;
use Symfony\Component\Console\Helper\Table;

class ListBrancherNodes extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'brancher:list {hypernode} {--output= : Output format (json, default: table)}';

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
     * @throws HypernodeApiClientException
     * @throws HypernodeApiServerException
     */
    public function handle()
    {
        $client = HypernodeClientFactory::create(config('hypernode.api_token'));

        $originHypernode = $this->argument('hypernode');

        $client->brancherApp->list($originHypernode);

        $branchers = $client->brancherApp->list($originHypernode);

        if ($this->option('output') === 'json') {
            $this->line(json_encode($branchers, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
            return Command::SUCCESS;
        }

        $headers = array_keys($branchers[array_key_first($branchers)]);

        $tableData = [];
        foreach ($branchers as $brancher) {
            $brancher['labels'] = array_keys($brancher['labels']);
            foreach ($brancher as $key => $value) {
                if (is_array($value)) $brancher[$key] = implode(', ', $value);
            }
            $tableData[] = $brancher;
        }

        $table = new Table($this->output);
        $table
            ->setHeaders(array_map('ucwords', $headers))
            ->setRows($tableData);
        $table->render();

        return Command::SUCCESS;
    }


}
