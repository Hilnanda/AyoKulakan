<?php

use Illuminate\Database\Seeder;
use App\Models\Master\KategoriBarang;
class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kategori = [
            'image' => 'kategori/'.rand(1,100),
        ];
        $cate = new KategoriBarang;
        $cate->fill($kategori);
        $cate->save();
    }
}
