<div class="content-ayokulakan" style="padding-top: 12px">
  <form id="dataFormPagePlnPrabayar" action="{{ url('ppob-pulsa/store') }}" method="POST">
    {!! csrf_field() !!}
    <div class="row">
      <div class="col-md-12">
        <div class="row">
          <input type="hidden" name="type" value="pln">
          <div class="col-md-10">
            <div class="form-group">
              <label>Nomor Meter Listrik</label>
              <input type="text" name="hp" class="form-control" placeholder="" data-child="PPOBPlnPrabayar" data-nama="id_barang" data-type="pln">
            </div>
          </div>
          <div class="col-md-2" style="padding-top: 23px">
            <button type="button" class="btn btn-success check-inquiry ppob-pln-prabayar" data-url="check-pln-prabayar" data-form="dataFormPagePlnPrabayar" data-show="show-inquiry-pln-prabayar"><i class="ion-android-refresh"></i> Cek Tagihan</button>
            
          </div>
        </div>    
      </div>
    </div>
  </form>
</div>
<div class="show-inquiry-pln-prabayar">
    
</div>