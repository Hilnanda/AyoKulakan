
<div class="content-ayokulakan" style="padding-top: 12px">
  <form id="dataFormPageData" action="{{ url('ppob-pulsa/store') }}" method="POST">
    {!! csrf_field() !!}
    <div class="row">
      <div class="col-md-12">
        <div class="row">
          <input type="hidden" name="ppob_type" value="list_ppob">
          <input type="hidden" name="form_type" value="list_ppob">
          <input type="hidden" name="cek_pane" value="data">
          <input type="hidden" name="type" value="data">

          <div class="col-md-5">
            <div class="form-group">
              <label>Nomor Telepon</label>
              <input type="text" name="ppob_pelanggan" class="form-control child childSelect" placeholder="Nomor Telepon" min="" max="13" data-child="PPOBPaket" data-nama="id_barang" data-type="data">
            </div>
          </div>
          <div class="col-md-5">
            <div class="form-group">
              <label for="">Pilih Nominal</label>
              <select class="form-control child target PPOBPaket selectpicker" name="id_barang" required="" data-dropup-auto="false" data-size="10" >
              </select> 
          
              <div id="PPOBPaket">
                
              </div>          
            </div>    
          </div>
          <div class="col-md-2" style="padding-top: 23px">
            @if(\Auth::check())
              <button type="button" class="btn btn-outline-success save-page save-frontend" data-title="Beli Paket Data Sekarang ? Pastikan Nomor Sudah Benar." data-confirm="Pesan" data-batal="Batal" data-forms="dataFormPageData"><i class="ion-ios-plus"></i> Beli Paket Data</button>
            @else
            @endif
            
          </div>
        </div>    
      </div>
    </div>
  </form>
</div>
