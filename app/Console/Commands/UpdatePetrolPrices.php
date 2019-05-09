<?php


namespace App\Console\Commands;

use App\HttpStoreUpdater;
use App\HttpPetrolUpdater;
use GuzzleHttp\Client;
use Illuminate\Console\Command;

class UpdatePetrolPrices extends Command
{
    protected $signature = 'petrol-prices:update {--url=} {--api-key=}';

    protected $description = 'Updates all petrol prices';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $uri = $this->option('uri') ? $this->option('uri') : env('AUCHAN_STORES_URI');
        $apiKey = $this->option('api-key') ? $this->option('api-key') : env('AUCHAN_API_KEY');

        $this->info('Running command for parameters:');
        $this->info('uri: ' . $uri);
        $this->info('api-key: ' . $apiKey);

        $client = new Client();
        $storeUpdater = new HttpStoreUpdater($uri, $apiKey, $client);
        $storeUpdater->update();

        $petrolUpdater = new HttpPetrolUpdater($uri, $apiKey, $client);
        $petrolUpdater->update();
    }
}