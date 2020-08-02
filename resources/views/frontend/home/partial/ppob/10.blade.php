<script type="text/javascript">

</script>
<div class="content-ayokulakan" style="padding-top: 12px">
  <form id="dataFormPageCekHotel" action="#" method="">
    {!! csrf_field() !!}
    <div class="row">
      <div class="col-md-12">
        <div class="row">
          <input type="hidden" name="htl[type]" value="hotel">
          <div class="col-md-6">
            <div class="form-group">
              <label>Pilih Negara</label>
              <select name="htl[dest]" class="form-control selectpicker child target" required="" data-live-search="true" data-dropup-auto="false" data-size="10" data-child="cityId" data-namas="cityId">
                {!! App\Models\Master\DarmaHotelNegara::options('name', 'code', [], 'Pilih Salah Satu') !!}
              </select> 
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Pilih Kota</label>
              <select name="htl[dest]" class="form-control selectpicker changeSelects" required="" data-live-search="true" data-dropup-auto="false" data-size="10">
              </select> 
              <div id="cityId">
                
              </div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label>Check In</label>
              <input type="text" name="htl[check_in]" class="form-control start-date" placeholder="Check In" readonly="">   
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Check Out</label>
              <input type="text" name="htl[check_out]" class="form-control end-date" readonly="" placeholder="Check Out" >
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Durasi</label>
              <select name="htl[durasi]" class="form-control selectpicker" required="" data-live-search="true" data-dropup-auto="false" data-size="10">
                <option value="1 Malam">1 Malam</option>
                <option value="2 Malam">2 Malam</option>
                <option value="3 Malam">3 Malam</option>
                <option value="4 Malam">4 Malam</option>
                <option value="5 Malam">5 Malam</option>
                <option value="6 Malam">6 Malam</option>
                <option value="7 Malam">7 Malam</option>
                <option value="8 Malam">8 Malam</option>
                <option value="9 Malam">9 Malam</option>
                <option value="10 Malam">10 Malam</option>
                <option value="11 Malam">11 Malam</option>
                <option value="12 Malam">12 Malam</option>
                <option value="13 Malam">13 Malam</option>
                <option value="14 Malam">14 Malam</option>
                <option value="15 Malam">15 Malam</option>
              </select>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
                <label>Tamu</label>
                <input type="number" name="htl[tamu]" class="form-control spinner-number"  value="1" min="1" max="30" step="0" placeholder="Tamu" oninput="this.value= this.value.replace(/[^0-9.,]/g, '').replace(/(\..*)\.,/g, '$1')"/>
            </div>
          </div>
          <div class="col-md-4">
             <div class="form-group">
                <label>Kamar</label>
                <input type="number" name="htl[kamar]" class="form-control spinner-number"  value="1" min="1" max="8" step="0" placeholder="Kamar" oninput="this.value= this.value.replace(/[^0-9.,]/g, '').replace(/(\..*)\.,/g, '$1')"/>
            </div>
          </div>

        <div class="col-md-12">
          <button type="button" class="pull-right btn btn-success check-tiket" data-url="hotel" data-form="dataFormPageCekHotel" data-show="show-hotel"><i class="ion-android-refresh"></i> Pesan</button>
        </div>
      </div>    
    </div>
  </div>
</form>
</div><br>
<div class="show-hotel">

</div>
