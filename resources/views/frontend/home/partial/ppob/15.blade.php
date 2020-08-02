<div class="content-ayokulakan" style="padding-top: 12px">
  <form id="ppob_telpon_rumah" onsubmit="return false"  method="POST">
    {!! csrf_field() !!}
    <div class="row">
      <div class="col-md-12">
        <div class="row">
          <div class="col-md-10">
            <div class="form-group">
              <label>Nomor Pelanggan</label>
              <input type="text" name="telepon_rumah" class="form-control" placeholder="Nomor Pelanggan">
            </div>
          </div>
          <div class="col-md-2" style="padding-top: 23px">
            <button type="submit" class="btn btn-success"><i class="ion-android-refresh"></i> Cek Tagihan</button>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>
<div id="ppob_telpon_rumah_result" style="display:none">
  <div class="form-group">
    <label>Nama Pelanggan</label>
    <input type="text" class="form-control napel" disabled value="">
  </div>
  <div class="form-group">
    <label>Jumlah Tagihan </label>
    <input type="text" class="form-control juta" disabled value="">
  </div>
  <div class="form-group">
    <label>Periode</label>
    <input type="text" class="form-control periode" disabled value="">
  </div>
</div>
