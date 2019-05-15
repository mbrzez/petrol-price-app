<?php


namespace App\Console\Commands;

use App\HttpStoreUpdater;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class UpdateAuchanStores extends Command
{
    /**
     * Command signature
     *
     * @var string
     */
    protected $signature = 'auchan-stores:update {--url=} {--api-key=}';

    /**
     * Command description
     *
     * @var string
     */
    protected $description = 'Updates Auchan stores list in database';

    /**
     * Updates AuchanStores models
     *
     * @return void
     */
    public function handle(): void
    {
        $url = $this->option('url') ? $this->option('url') : env('AUCHAN_STORES_URI');
        $apiKey = $this->option('api-key') ? $this->option('api-key') : env('AUCHAN_API_KEY');

        $this->info('Running command for parameters:');
        $this->info('uri: ' . $url);
        $this->info('api-key: ' . $apiKey);

        try {
            $client = new Client();
            $storeUpdater = new HttpStoreUpdater($url, $apiKey, $client);
            $storeUpdater->update();
        } catch (GuzzleException $e) {
            Log::error($e->getMessage());
        }
    }
}