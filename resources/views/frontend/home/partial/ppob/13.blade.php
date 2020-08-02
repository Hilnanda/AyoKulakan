<div class="content-ayokulakan" style="padding-top: 12px">
  <form id="dataFormPageTv" action="{{ url('ppob-pulsa/store') }}" method="POST">
    {!! csrf_field() !!}
    <div class="row">
      <div class="col-md-12">
        <div class="row">
          <div class="col-md-5">
            <div class="form-group">
              <label>Nomor Pelanggan</label>
              <input type="text" name="ppob_pelanggan" class="form-control" placeholder="Nomor Pelanggan">
            </div>
          </div>
          <div class="col-md-5">
            <div class="form-group" style="padding-bottom: 20px !important">
              <label>Pilih Langganan</label>
              <select name="type" class="form-control selectpicker" data-dropup-auto="false" data-size="10" required="" data-live-search="true" >
                <option value="TVBIG" selected">BIG TV</option>
                <option value="TVFIRST">FIRSTMEDIA</option>
                <option value="TVINDVS">INDOVISION</option>
                <option value="TVNEX">NEX MEDIA</option>
                <option value="TVTLKMV">TELKOMVISION</option>
              </select>    
            </div>
          </div>
          <div class="col-md-2" style="padding-top: 23px">
            <button type="button" class="btn btn-success check-inquiry ppob-tv" data-url="check-tv" data-form="dataFormPageTv" data-show="show-inquiry-tv"><i class="ion-android-refresh"></i> Cek Tagihan</button>
            
          </div>
        </div>    
      </div>
    </div>
  </form>
</div>
<div class="show-inquiry-tv">
    
</div>