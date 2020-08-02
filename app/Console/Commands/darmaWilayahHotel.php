<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Helpers\Darmawisata\Hotel;
use App\Models\Master\DarmaHotelNegara;
use App\Models\Master\DarmaHotelKota;
use GuzzleHttp\Client;

class darmaWilayahHotel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:darmaWilayahHotel  {--queue=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $client = new Client();
        $apiUrl = Config('app.url');

        $result = $client->get($apiUrl.'/api/darmawisata/hotel/city/all',[
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ],
                'verify' => false
            ])->getBody();
        $result = json_decode($result);

        if($result->data){
            if(($result->data->countries) && (count($result->data->countries) > 0)){
                foreach ($result->data->countries as $k => $value) {
                    $record = DarmaHotelNegara::create([
                        'code' => $value->ID,
                        'name' => $value->Name
                    ]);

                    if(($value->cities) && (count($value->cities) > 0)){
                        foreach ($value->cities as $k1 => $value1) {
                            DarmaHotelKota::create([
                                'id_negara' => $record->id,
                                'code' => $value1->ID,
                                'name' => $value1->Name
                            ]);
                        }
                    }
                }
            }
        }
    }
}
