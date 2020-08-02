<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Master\PPOBPulsa;
use App\Models\Master\PPOBPdam;
use App\Models\Master\TicketingAirport;
use App\Models\Master\TicketingStatsiunKereta;
use App\Helpers\HelpersTiketPesawat;
use App\Helpers\HelpersTiketKapal;
use App\Models\Master\WilayahNegara;
use App\Models\Master\WilayahProvinsi;
use App\Models\Master\WilayahKota;
use App\Models\Master\WilayahKecamatan;
use App\Models\Master\TicketingPelni;

class getPriceListPPOB extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ppob:pricelist {--queue=}';

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
        $this->info('Synchronize mulai');

        $username   = "0895422649167";
        $apiKey   = "8585cfe52cfc0dff";
        $signature  = md5($username.$apiKey.'pl');

        $json = '{
                  "commands" : "pricelist",
                  "username" : "0895422649167",
                  "sign"     : "16bdad92c280b7ee9b0febabb630523b"
                }';

        $url = "https://testprepaid.mobilepulsa.net/v1/legacy/index";

        $ch  = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $data = curl_exec($ch);
        curl_close($ch);
        $ampas = json_decode($data);
        $record = [];
        if(isset($ampas->data)){
            foreach ($ampas->data as $value) {
                $record['pulsa_code'] = $value->pulsa_code;
                $record['pulsa_op'] = $value->pulsa_op;
                $record['pulsa_nominal'] = $value->pulsa_nominal;
                $record['pulsa_price'] = $value->pulsa_price;
                $record['pulsa_type'] = $value->pulsa_type;
                $record['status'] = $value->status;
                $record['masaaktif'] = $value->masaaktif;
                $save = PPOBPulsa::where('pulsa_code',$value->pulsa_code)->first();
                if($save){
                  $save->fill($record);
                  $save->save();
                }else{
                  $save = new PPOBPulsa;
                  $save->fill($record);
                  $save->save();
                }
            }
        }

        // PPOB PDAM
        $jsonPD ='{
            "commands" : "pricelist-pasca",
            "username" : "0895422649167",
            "sign"     : "16bdad92c280b7ee9b0febabb630523b",
            "status"   : "all"
        }';
        $urlPD = "https://testpostpaid.mobilepulsa.net/api/v1/bill/check/pdam";
        
        $chPD  = curl_init();
        curl_setopt($chPD, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($chPD, CURLOPT_URL, $urlPD);
        curl_setopt($chPD, CURLOPT_POSTFIELDS, $jsonPD);
        curl_setopt($chPD, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($chPD, CURLOPT_RETURNTRANSFER, true);

        $dataPD = curl_exec($chPD);
        curl_close($chPD);
        $ampasPD = json_decode($dataPD);
        $recordPD = [];
        if(isset($ampasPD->data)){
            foreach ($ampasPD->data->pasca as $value) {
                $recordPD['code'] = $value->code;
                $recordPD['name'] = $value->name;
                $recordPD['fee'] = $value->fee;
                $recordPD['komisi'] = $value->komisi;
                $recordPD['type'] = $value->type;
                $recordPD['status'] = $value->status;
                $recordPD['province'] = $value->province;
                $savePD = PPOBPdam::where('code',$value->code)->first();
                if($savePD){
                  $savePD->fill($recordPD);
                  $savePD->save();
                }else{
                  $savePD = new PPOBPdam;
                  $savePD->fill($recordPD);
                  $savePD->save();
                }
            }
        }

        // PPOB DESTINATION KRETA
        $jsonDK ='{
            "commands" : "station-list",
            "sign"     : "e84b6ec531ad186194446d4f818667c4"
        }';
        $urlDK = "https://testpostpaid.mobilepulsa.net/api/v1/tiket";
        
        $chDK  = curl_init();
        curl_setopt($chDK, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($chDK, CURLOPT_URL, $urlDK);
        curl_setopt($chDK, CURLOPT_POSTFIELDS, $jsonDK);
        curl_setopt($chDK, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($chDK, CURLOPT_RETURNTRANSFER, true);

        $dataDK = curl_exec($chDK);
        curl_close($chDK);
        $ampasDK = json_decode($dataDK);
        $recordDK = [];
        if($ampasDK->data){
            foreach ($ampasDK->data->station as $value) {
              if(is_array($value->group)){
                foreach ($value->group as $k => $v) {
                  $recordDK['group_code'] = $value->groupCode;
                  $recordDK['code'] = $v->code;
                  $recordDK['name'] = $v->name;
                  $saveDK = TicketingStatsiunKereta::where('code',$recordDK['code'])->first();
                  if($saveDK){
                    $saveDK->fill($recordDK);
                    $saveDK->save();
                  }else{
                    $saveDK = new TicketingStatsiunKereta;
                    $saveDK->fill($recordDK);
                    $saveDK->save();
                  }
                }
              }else{
                  $recordDK['group_code'] = $value->groupCode;
                  $recordDK['code'] = $value->group->code;
                  $recordDK['name'] = $value->group->name;
                  $saveDK = TicketingStatsiunKereta::where('code',$recordDK['code'])->first();
                  if($saveDK){
                    $saveDK->fill($recordDK);
                    $saveDK->save();
                  }else{
                    $saveDK = new TicketingStatsiunKereta;
                    $saveDK->fill($recordDK);
                    $saveDK->save();
                  }
              }
                
            }
        } 

        $ticketingAirport = HelpersTiketPesawat::TiketGetAirport();
        if(isset($ticketingAirport->all_airport)){
          if(count($ticketingAirport->all_airport->airport) > 0){
            foreach ($ticketingAirport->all_airport->airport as $k => $value) {
              $saveAirport['airport_name'] = $value->airport_name;
              $saveAirport['airport_code'] = $value->airport_code;
              $saveAirport['location_name'] = $value->location_name;
              $saveAirport['country_id'] = $value->country_id;
              $saveAirport['country_name'] = $value->country_name;
              $saveAirP = TicketingAirport::where('airport_code',$saveAirport['airport_code'])->first();
              if($saveAirP){
                $saveAirP->fill($saveAirport);
                $saveAirP->save();
              }else{
                $saveAirP = new TicketingAirport;
                $saveAirP->fill($saveAirport);
                $saveAirP->save();
              }
            }
          }
        }     

        // LIST COUNTRY
        $ListCountry = HelpersTiketPesawat::TiketGetCountry();
        if(isset($ListCountry->listCountry)){
          if(count($ListCountry->listCountry) > 0){
            foreach ($ListCountry->listCountry as $k => $value) {
              $saveCount['area_id'] = $value->country_id;
              $saveCount['negara'] = $value->country_name;
              $saveCount['area_code'] = $value->country_areacode;

              $saveCounts = WilayahNegara::where('area_id',$saveCount['area_id'])->first();
              if($saveCounts){
                $saveCounts->fill($saveCount);
                $saveCounts->save();
              }else{
                $saveCounts = new WilayahNegara;
                $saveCounts->fill($saveCount);
                $saveCounts->save();
              }
            }
          }
        }

        // CEK WILAYAH KOTA / KAB
        // $listProvince = [
        //   ["id"=>"11","nama"=>"Aceh"],
        //   ["id"=>"36","nama"=>"Banten"],
        //   ["id"=>"51","nama"=>"Bali"],
        //   ["id"=>"12","nama"=>"Sumatera Utara"],
        //   ["id"=>"13","nama"=>"Sumatera Barat"],
        //   ["id"=>"14","nama"=>"Riau"],
        //   ["id"=>"15","nama"=>"Jambi"],
        //   ["id"=>"16","nama"=>"Sumatera Selatan"],
        //   ["id"=>"17","nama"=>"Bengkulu"],
        //   ["id"=>"18","nama"=>"Lampung"],
        //   ["id"=>"19","nama"=>"Kepulauan Bangka Belitung"],
        //   ["id"=>"21","nama"=>"Kepulauan Riau"],
        //   ["id"=>"31","nama"=>"DKI Jakarta"],
        //   ["id"=>"32","nama"=>"Jawa Barat"],
        //   ["id"=>"33","nama"=>"Jawa Tengah"],
        //   ["id"=>"34","nama"=>"DKI Yogyakarta"],
        //   ["id"=>"35","nama"=>"Jawa Timur"],
        //   ["id"=>"52","nama"=>"Nusa Tenggara Barat"],
        //   ["id"=>"53","nama"=>"Nusa Tenggara Timur"],
        //   ["id"=>"61","nama"=>"Kalimantan Barat"],
        //   ["id"=>"62","nama"=>"Kalimantan Tengah"],
        //   ["id"=>"63","nama"=>"Kalimantan Selatan"],
        //   ["id"=>"64","nama"=>"Kalimantan Timur"],
        //   ["id"=>"65","nama"=>"Kalimantan Utara"],
        //   ["id"=>"71","nama"=>"Sulawesi Utara"],
        //   ["id"=>"72","nama"=>"Sulawesi Tengah"],
        //   ["id"=>"73","nama"=>"Sulawesi Selatan"],
        //   ["id"=>"74","nama"=>"Sulawesi Tenggara"],
        //   ["id"=>"75","nama"=>"Gorontalo"],
        //   ["id"=>"76","nama"=>"Sulawesi Barat"],
        //   ["id"=>"81","nama"=>"Maluku"],
        //   ["id"=>"82","nama"=>"Maluku Utara"],
        //   ["id"=>"91","nama"=>"Papua Barat"],
        //   ["id"=>"94","nama"=>"Papua"]]; 
        // foreach ($listProvince as $value) {
        //   $recKab = HelpersTiketPesawat::TiketGetKabKot($value['id']);
        //   // dd($value['nama']);
        //   $cekProvince = WilayahProvinsi::where('provinsi', '=', $value['nama'])->first();
        //   // dd($cekProvince);
        //   foreach ($recKab->kabupatens as $value1) {
        //     $recKota['id_negara'] = 253;
        //     $recKota['id_provinsi'] = $cekProvince->id;
        //     $recKota['kota'] = $value1->nama;

        //     $saveKota = new WilayahKota;
        //     $saveKota->fill($recKota);
        //     $saveKota->save();

        //     $recKecam = HelpersTiketPesawat::TiketGetKecamatan($value1->id);
        //     foreach ($recKecam->kecamatans as $value2) {
        //       $recSave['id_negara'] = 253;
        //       $recSave['id_provinsi'] = $cekProvince->id;
        //       $recSave['id_kota'] = $saveKota->id;
        //       $recSave['kecamatan'] = $value2->nama;

        //       $saveKecam = new WilayahKecamatan;
        //       $saveKecam->fill($recSave);
        //       $saveKecam->save();
        //     }
        //   }
        // }
      // Helpers Tiket Kapal

       
      $this->info('Synchronize selesai');
    }
}
