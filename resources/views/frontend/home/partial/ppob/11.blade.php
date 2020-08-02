<script type="text/javascript">

</script>
<div class="content-ayokulakan" style="padding-top: 12px">
  <form id="dataFormPageCekPelni" action="#" method="">
    {!! csrf_field() !!}
    <div class="row">
      <div class="col-md-12">
        <div class="row">
          <input type="hidden" name="kpl[type]" value="pelni">
          <div class="col-md-4">
            <div class="form-group">
              <label>Pelabuhan Berangkat</label>
              <select name="kpl[dest]" class="form-control selectpicker" required="" data-live-search="true" data-dropup-auto="false" data-size="10">
                {!! App\Models\Master\TicketingPelni::options('name', 'id', [], 'Pilih Rute Tujuan') !!}
              </select> 
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Pelabuhan Tiba</label>
              <select name="kpl[dest]" class="form-control selectpicker" required="" data-live-search="true" data-dropup-auto="false" data-size="10">
                {!! App\Models\Master\TicketingPelni::options('name', 'id', [], 'Pilih Rute Tujuan') !!}
              </select> 
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Tanggal Berangkat</label>
              <input type="text" name="kpl[tgl_brkt]" class="form-control start-date" placeholder="Tanggal Berangkat" readonly="">   
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group" style="">
              <label>Dewasa</label>
              <input type="number" name="kpl[dewasa]" class="form-control spinner-number pswt-dewasa"  value="1" min="1" max="7" step="0" placeholder="Dewasa (Usia 12+)" oninput="this.value= this.value.replace(/[^0-9.,]/g, '').replace(/(\..*)\.,/g, '$1')"/>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Anak</label>
              <input type="number" name="kpl[anak]" class="form-control spinner-number pswt-anak" min="0" max="6" step="0" placeholder="Anak (Usia 2-11)" oninput="this.value= this.value.replace(/[^0-9.,]/g, '').replace(/(\..*)\.,/g, '$1')"/>
            </div>
            
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Bayi</label>
              <input type="number" name="kpl[bayi]" class="form-control spinner-number pswt-bayi" min="0" max="6" step="0" placeholder="Bayi (Di Bawah 2)" oninput="this.value= this.value.replace(/[^0-9.,]/g, '').replace(/(\..*)\.,/g, '$1')"/>
            </div>
          </div>

        <div class="col-md-12">
          <button type="button" class="pull-right btn btn-success check-tiket" data-url="pelni" data-form="dataFormPageCekPelni" data-show="show-pelni"><i class="ion-android-refresh"></i> Pesan</button>
        </div>
      </div>    
    </div>
  </div>
</form>
</div><br>
<div class="show-pelni">

</div>
