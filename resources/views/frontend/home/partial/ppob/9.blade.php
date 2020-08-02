<script type="text/javascript">

</script>
<div class="content-ayokulakan" style="padding-top: 12px">
  <form id="dataFormPageCekTiketPesawat" action="#" method="">
    {!! csrf_field() !!}
    <div class="row">
      <div class="col-md-12">
        <div class="row">
          <input type="hidden" name="pswt[type]" value="ticket_pesawat">
          {{-- {{ dd(App\Helpers\HelpersTiketPesawat::TiketGetAirport()) }} --}}
          <div class="col-md-6">
            <div class="form-group">
              <label>Dari</label>
              <select name="pswt[rute_asal]" class="form-control selectpicker" data-dropup-auto="false" data-size="10" required="" data-live-search="true" data-size="5">
               <option value="">Dari</option>
               @if(App\Models\Master\TicketingAirport::count() > 0)
               @foreach(App\Models\Master\TicketingAirport::get() as $k => $value)
               <option data-subtext="- {{ $value->airport_name or '' }}" value="{{ $value->airport_code or '' }}">{{ $value->location_name or '' }}, {{ $value->country_name or '' }} ({{ $value->airport_code or '' }})</option>
               @endforeach
               @endif
             </select><br><br>
           </div>
         </div>
         <div class="col-md-6">
          <div class="form-group">
            <label>Ke</label>
            <select name="pswt[rute_tujuan]" class="form-control selectpicker" required="" data-live-search="true" data-dropup-auto="false" data-size="10">
             <option value="">Ke</option>
             @if(App\Models\Master\TicketingAirport::count() > 0)
             @foreach(App\Models\Master\TicketingAirport::get() as $k => $value)
             <option data-subtext="- {{ $value->airport_name or '' }}" value="{{ $value->airport_code or '' }}">{{ $value->location_name or '' }}, {{ $value->country_name or '' }} ({{ $value->airport_code or '' }})</option>
             @endforeach
             @endif
           </select><br><br>
         </div>
       </div>
       <div class="col-md-6">
        <div class="form-group">
          <div class="input-group mb5">
            <label style="padding-right: 5px">Tanggal Keberangkatan Pulang Pergi?</label>
            <div class="custom-control custom-checkbox mb-3" style="margin-bottom: 8px !important;display: none">
              <input name="pswt[pulang_pergi]" type="checkbox" class="custom-control-input" id="customPswtPg" required value="1">
              <label class="custom-control-label" for="customPswtPg">(Checklist Jika Pulang Pergi)</label>
            </div>
          </div>
        </div>
        <div class="form-group">
          <input type="text" name="pswt[tanggal_berangkat]" class="form-control start-date" placeholder="Tanggal Keberangkatan" readonly="">   
        </div>
        <div class="form-group">
          <input type="text" name="pswt[tanggal_kepulangan]" class="form-control end-date" readonly="" placeholder="Tanggal Kepulangan" style="display: none">
        </div>
        <div class="form-group">
         <label>Kelas Kabin</label>
         <select name="pswt[kelas_kabin]" class="form-control selectpicker" required="" data-live-search="true" data-dropup-auto="false" data-size="10">
           <option value="">Kelas Kabin</option>
           <option value="ECONOMY">Ekonomi</option>
           <option value="BUSINESS">Bisnis</option>
           <option value="FIRST">First</option>
         </select>
       </div>
     </div>

     <div class="col-md-6">
      <label style="margin-bottom: 10px !important">Penumpang</label>
      <div class="form-group" style="">
        <label>Dewasa</label>
        <input type="number" name="pswt[dewasa]" class="form-control spinner-number pswt-dewasa"  value="1" min="1" max="7" step="0" placeholder="Dewasa (Usia 12+)" oninput="this.value= this.value.replace(/[^0-9.,]/g, '').replace(/(\..*)\.,/g, '$1')"/>
      </div>
      <div class="form-group">
        <label>Anak</label>
        <input type="number" name="pswt[anak]" class="form-control spinner-number pswt-anak" min="0" max="6" step="0" placeholder="Anak (Usia 2-11)" oninput="this.value= this.value.replace(/[^0-9.,]/g, '').replace(/(\..*)\.,/g, '$1')"/>
      </div>
      <div class="form-group">
        <label>Bayi</label>
        <input type="number" name="pswt[bayi]" class="form-control spinner-number pswt-bayi" min="0" max="6" step="0" placeholder="Bayi (Di Bawah 2)" oninput="this.value= this.value.replace(/[^0-9.,]/g, '').replace(/(\..*)\.,/g, '$1')"/>
      </div>
    </div>
    <div class="col-md-12">
      <button type="button" class="pull-right btn btn-success check-tiket" data-url="pesawat" data-form="dataFormPageCekTiketPesawat" data-show="show-tiket-pesawat"><i class="ion-android-refresh"></i> Pesan</button>
    </div>
  </div>    
</div>
</div>
</form>
</div><br>
<div class="show-tiket-pesawat">

</div>
