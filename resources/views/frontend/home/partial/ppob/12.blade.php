<style type="text/css">
  .bs-callout-warning {
    border-left-color: #aa6708;
}
.bs-callout {
    padding: 20px;
    margin: 20px 0;
    border: 1px solid #eee;
        border-left-color: rgb(238, 238, 238);
        border-left-width: 1px;
    border-left-width: 5px;
    border-radius: 3px;
}
</style>
<div class="content-ayokulakan" style="padding-top: 12px">
  <form id="dataFormInqueryPascaEsamsat" action="{{ url('ppob-pasca/store') }}" method="POST">
    {!! csrf_field() !!}
    <input type="hidden" name="type" value="ESAMSAT.JAWABARAT">
    <div class="row">
      <div class="col-md-12">
        <div class="row">
          <div class="col-md-12" style="margin: 12px;">
            <ul style="list-style-type: circle;">
              <li >Kirim SMS ke 0811 211 9211 (Aplikasi Server SMS Gateway Dispenda Samsat). Kirim SMS dengan format: esamsat [spasi] no.rangka [spasi] NIK / KTP.</li>
              <li>Isi SMS balasan: Kode pembayaran, data kendaraan dan jumlah tagihan. Kode pembayaran akan menjadi nomor pelanggan</li>
              <li>Setelah menerima teks balasan, wajib pajak dapat mengecek pembayaran pajak / membayar pajak.</li>
              <li>Kemudian datang ke kantor Samsat untuk menukar tanda terima pembayaran dengan SKPD di semua kantor Samsat terdekat. Pertukaran ini hanya berlaku selama 30 hari, jika lebih dari 30 hari SKPD tidak dapat dicetak.</li>
            </ul>
          </div>
          <div class="col-md-5 m-t-20">
            <div class="form-group">
              <label>Nomor Register Pelanggan</label>
              <input type="text" name="ppob_pelanggan" class="form-control" placeholder="Nomor Register Pelanggan">
            </div>
          </div>
          <div class="col-md-5 m-t-20">
            <div class="form-group">
              <label>Nomor Identitas</label>
              <input type="text" name="nomor_identitas" class="form-control" placeholder="Masukkan NIK Anda">
            </div>
          </div>
          <div class="col-md-2" style="padding-top: 23px">
            @if(\Auth::check())
            <button type="button" class="btn btn-success check-inquiry ppob-esamsat" data-url="check-esamsat" data-form="dataFormInqueryPascaEsamsat"  data-show="show-inquiry-esamsat"><i class="ion-android-refresh"></i> Cek Tagihan</button>
            @endif
            
          </div>
        </div>    
      </div>
    </div>
  </form>
</div>
<div class="show-inquiry-esamsat">
    
</div>
