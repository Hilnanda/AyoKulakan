<div class="content-ayokulakan" style="padding-top: 12px">
  <form id="dataFormPageCekTiketKereta" action="#" method="">
    {!! csrf_field() !!}
    <div class="row">
      <div class="col-md-12">
        <div class="row">
          <input type="hidden" name="type" value="ticket_kereta">
          <div class="col-md-6">
            <div class="form-group">
              <label>Pilih Rute Keberangkatan</label>
              <select name="rute_asal" class="form-control selectpicker" data-dropup-auto="false" data-size="10" required="" data-live-search="true" >
                {!! App\Models\Master\TicketingStatsiunKereta::options(function ($ticket) {
                  return ''.$ticket->group_code.' - '.$ticket->name.' ('.$ticket->code.')';
                }, 'code', [], 'Pilih Rute Keberangkatan') !!}
              </select> 
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Pilih Rute Tujuan</label>
              <select name="rute_tujuan" class="form-control selectpicker" required="" data-live-search="true" data-dropup-auto="false" data-size="10">
                {!! App\Models\Master\TicketingStatsiunKereta::options(function ($ticket) {
                  return ''.$ticket->group_code.' - '.$ticket->name.' ('.$ticket->code.')';
                }, 'code', [], 'Pilih Rute Tujuan') !!}
              </select> 
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <div class="input-group mb5">
                <label style="padding-right: 5px">Tanggal Keberangkatan Pulang Pergi?</label>
                <div class="custom-control custom-checkbox mb-3" style="margin-bottom: 8px !important">
                  <input name="pulang_pergi" type="checkbox" class="custom-control-input" id="customControlValidationS" required value="1">
                  <label class="custom-control-label" for="customControlValidationS">(Checklist Jika Pulang Pergi)</label>
                </div>
              </div>
              <div class="">
                <input type="text" name="tanggal_berangkat" class="form-control start-date" placeholder="Tanggal Keberangkatan" readonly="">   
                <input type="text" name="tanggal_kepulangan" class="form-control tanggal_kepulangan end-date" readonly="" placeholder="Tanggal Kepulangan" style="display: none"> 
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <label style="margin-bottom: 10px !important">Penumpang</label>
            <div class="form-group" style="padding-bottom: 20px !important">
              <select name="dewasa" class="form-control selectpicker" data-dropup-auto="false" data-size="10" required="" data-live-search="true" >
                <option value="1" selected">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
              </select>    
            </div>
            <div class="form-group">
              <select name="anak" class="form-control selectpicker" data-dropup-auto="false" data-size="10" required="" data-live-search="true" >
                <option value="">Penumpang Balita</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
              </select>  
            </div>
          </div>
          <div class="col-md-12">
            <button type="button" class="pull-right btn btn-success check-tiket" data-url="kereta" data-form="dataFormPageCekTiketKereta" data-show="show-tiket-kereta"><i class="ion-android-refresh"></i> Cek Keberangkatan</button>
          </div>
        </div>    
      </div>
    </div>
  </form>
</div><br>
<div class="show-tiket-kereta">

</div>