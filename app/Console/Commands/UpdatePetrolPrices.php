<?php


namespace App\Console\Commands;

use App\HttpPetrolUpdater;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class UpdatePetrolPrices extends Command
{
    /**
     * Command signature
     *
     * @var string
     */
    protected $signature = 'petrol-prices:update {--url=} {--api-key=}';

    /**
     * Command description
     *
     * @var string
     */
    protected $description = 'Updates all petrol prices';

    /**
     * Insert new petrol prices from Auchan Store stations
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
            $petrolUpdater = new HttpPetrolUpdater($url, $apiKey, $client);
            $petrolUpdater->update();
        } catch (GuzzleException $e) {
            Log::error($e->getMessage());
        }
    }
}