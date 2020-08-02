
<div class="content-ayokulakan" style="padding-top: 12px">
  <form id="dataFormInqueryPascaBPJS" action="{{ url('ppob-pasca/store') }}" method="POST">
    {!! csrf_field() !!}
    <input type="hidden" name="type" value="BPJS">
    <div class="row">
      <div class="col-md-12">
        <div class="row">
          <div class="col-md-5">
            <div class="form-group">
              <label>Nomor Pelanggan</label>
              <input type="text" name="ppob_pelanggan" class="form-control childPPOBInquery" placeholder="Nomor Pelanggan">
            </div>
          </div>
          <div class="col-md-5">
            <div class="form-group ">
              <label for="">Pilih Bulan</label>
              <input type="text" name="month" class="bots-month form-control" placeholder="Pilih Bulan" readonly="">   
            </div>    
          </div>
          <div class="col-md-2" style="padding-top: 23px">
            <button type="button" class="btn btn-success check-inquiry ppob-bpjs" data-url="check-bpjs" data-form="dataFormInqueryPascaBPJS"  data-show="show-inquiry-bpjs"><i class="ion-android-refresh"></i> Cek Tagihan</button>
           {{--  @if(\Auth::check())
              <button type="button" class="btn btn-success save-page save-frontend" data-title="Beli Paket Data Sekarang ? Pastikan Nomor Sudah Benar." data-confirm="Pesan" data-batal="Batal" data-forms="dataFormInqueryPascaBPJS"><i class="ion-ios-plus"></i> Beli Paket Data</button>
            @else
            @endif --}}
            
          </div>
        </div>    
      </div>
    </div>
  </form>
</div>
<div class="show-inquiry-bpjs">
    
</div>
