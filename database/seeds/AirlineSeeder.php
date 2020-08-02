<?php

use App\Models\Airline;
use GuzzleHttp\Client;
use Illuminate\Database\Seeder;

class AirlineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $client = new Client();
        // $airlines = $client->get(config('app.url')  . '/api/airline/list')->getBody();

        // foreach (json_decode($airlines) as $airline) {
        //     for ($i = 0; $i < count($airline->airlines); $i++) {
        //         Airline::updateOrCreate(
        //             ['code' => $airline->airlines[$i]->id],
        //             ['name' => $airline->airlines[$i]->name]
        //         );
        //     }
        // }
    }
}
