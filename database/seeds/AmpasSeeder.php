<?php
use Illuminate\Database\Seeder;

use Illuminate\Database\Eloquent\Model;
use App\Models\Master\KategoriBarang;
use Illuminate\Support\Facades\DB;
use App\Models\Users;
use Carbon\Carbon;

class AmpasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $kategori = [
        'image' => 'kategori/'.rand(1,20),
      ];
      $cate = new KategoriBarang;
      $cate->fill($kategori);
      $cate->save();
        // $dataUser = [
        //   'nama' => 'legron',
        //   'username' => 'legron',
        //   'email' => 'legrondhibebzky@gmail.com',
        //   'password' => bcrypt('legron2688'),
        //   'last_activity' => Carbon::now()->format('Y-m-d H:i:s'),
        //   'status' => 1010,
        // ];
        // $user = new Users;
        // $user->fill($dataUser);
        // $user->save();

        // $ayokulakan = [
        //   'nama' => 'ayokulakan',
        //   'username' => 'ayokulakan',
        //   'email' => 'ayokulakan@ayokulakan.com',
        //   'password' => bcrypt('password'),
        //   'last_activity' => Carbon::now()->format('Y-m-d H:i:s'),
        //   'status' => 1010,
        // ];
        // $ayo = new Users;
        // $ayo->fill($ayokulakan);
        // $ayo->save();
    }
}
