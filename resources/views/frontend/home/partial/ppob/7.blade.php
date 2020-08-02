<div class="content-ayokulakan" style="padding-top: 12px">
  <form id="dataFormPagePlnPostpaid" action="{{ url('ppob-pulsa/store') }}" method="POST">
    {!! csrf_field() !!}
    <div class="row">
      <div class="col-md-12">
        <div class="row">
          <input type="hidden" name="type" value="PLNPOSTPAID">
          <div class="col-md-10">
            <div class="form-group">
              <label>Nomor Pelanggan</label>
              <input type="text" name="ppob_pelanggan" class="form-control" placeholder="Nomor Pelanggan">
            </div>
          </div>
          <div class="col-md-2" style="padding-top: 23px">
            <button type="button" class="btn btn-success check-inquiry ppob-pln-postpaid" data-url="check-pln-postpaid" data-form="dataFormPagePlnPostpaid" data-show="show-inquiry-pln-postpaid"><i class="ion-android-refresh"></i> Cek Tagihan</button>
            
          </div>
        </div>    
      </div>
    </div>
  </form>
</div>
<div class="show-inquiry-pln-postpaid">
    
</div>