<div class="content-ayokulakan" style="padding-top: 12px">
  <form id="dataFormPageInternetLG" action="{{ url('ppob-pulsa/store') }}" method="POST">
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
                <option value="Megavision" selected">Megavision</option>
                <option value="Indihome">Indihome</option>
                <option value="MNC">MNC</option>
                <option value="Bizznet">Bizznet</option>
              </select>    
            </div>
          </div>
          <div class="col-md-2" style="padding-top: 23px">
            <button type="button" class="btn btn-success check-inquiry ppob-internetLG" data-url="check-internet" data-form="dataFormPageInternetLG" data-show="show-inquiry-internetLG"><i class="ion-android-refresh"></i> Cek Tagihan</button>
            
          </div>
        </div>    
      </div>
    </div>
  </form>
</div>
<div class="show-inquiry-internetLG">
    
</div>