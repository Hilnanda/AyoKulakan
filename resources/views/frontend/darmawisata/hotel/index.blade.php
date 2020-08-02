@extends('layouts.scaffold')

@section('css')
<style>
    .outline-top {
        margin-top: 200px;
    }

    @media (max-width: 500px) {
        .outline-top {
            margin-top: 299px;
        }
    }
</style>
@endsection

@section('content-frontend')

<form id="dataFormPageCekHotel" action="{{ url('hotel/search') }}" method="GET">
    <div class="container outline-top">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        
                        <!-- <div class="col-md-4">
                                <div class="form-group">
                                  <label>Customers Passport ID</label>
                                  <input type="text" name="paxPassport" class="form-control" placeholder="Customers Passport ID">
                            </div>
                        </div> -->

                        <div class="col-md-6">
                                <div class="form-group">
                                  <label>Pilih Negara</label>
                                  <select name="countryID" class="form-control selectpicker child target" required="" data-live-search="true" data-dropup-auto="false" data-size="10" data-child="cityID" data-namas="cityID">
                                    {!! App\Models\Master\DarmaHotelNegara::options('name', 'code', [], 'Pilih Salah Satu') !!}
                                </select> 
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                              <label>Pilih Kota</label>
                              <select name="cityID" class="form-control selectpicker changeSelects" required="" data-live-search="true" data-dropup-auto="false" data-size="10">
                              </select> 
                              <div id="cityID">

                              </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                              <label>Check In</label>
                              <input type="text" name="checkInDate" class="form-control start-date" placeholder="Check In" readonly="">   
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                              <label>Check Out</label>
                              <input type="text" name="checkOutDate" class="form-control end-date" readonly="" placeholder="Check Out" >
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                              <label>Tipe Ruangan</label>
                              <select class="form-control selectpicker" name="roomRequest[roomType]">
                                  <option value="">Pilih Salah Satu</option>
                                  <option value="Single">Single</option>
                                  <option value="Twin">Twin</option>
                                  <option value="Double">Double</option>
                                  <option value="Triple">Triple</option>
                                  <option value="Quad">Quad</option>
                              </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                              <label>Jumlah Anak Yang Dibawa</label>
                              <input type="text" name="roomRequest[childNum]" class="form-control" placeholder="Jumlah Anak Yang Dibawa Misalkan 3" maxlength="1" oninput="this.value= this.value.replace(/[^0-9.,]/g, '').replace(/(\..*)\.,/g, '$1')">
                              <input type="hidden" name="roomRequest[isRequestChildBed]" class="form-control" placeholder="Umur Anak Yang di Bawa" value="false">
                              <input type="hidden" name="roomRequest[childAges][]" class="form-control" placeholder="Umur Anak Yang di Bawa" >
                            </div>
                        </div>
                        <div class="appendUmur">
                            
                        </div>

                        <div class="col-md-12">
                          <button type="button" class="pull-right btn btn-success check append page" data-form="dataFormPageCekHotel" data-append="formAppend"><i class="ion-android-refresh"></i> Lihat Hotel</button>
                        </div>
                    
                    </div>   
                </div>

            </div>
            <div class="formAppend">
                
            </div>
        </div>
    </div>
</form>
@endsection

@section('js')

<script>
    $(document).on('keyup','input[name="childNum"]',function(){
        val = $(this).val();
        $('.removeUmur').remove();
        for (var i = 0; i < val; i++) {
            $('.appendUmur').append(`
                <div class="col-md-4 removeUmur">
                    <div class="form-group">
                      <label>Umur Anak</label>
                      <input type="text" name="roomRequest[childAges][]" class="form-control" placeholder="Umur Anak Yang di Bawa" >
                    </div>
                </div>
            `);
        }
    });
</script>

<script type="text/javascript" src="{{ url('/plugins/datepicker/bootstrap-datepicker.js') }}"></script>

<script type="text/javascript">
months = [ "January", "February", "March", "April", "May", "June",
"July", "August", "September", "October", "November", "December" ];
$.fn.datepicker.dates['id'] = {
    days: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
    daysShort: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
    daysMin: ["Su", "Mo", "Tu", "We", "Th", "Fr", "Sa"],
    months: ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"],
    monthsShort: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
    today: "Today",
    clear: "Clear",
    format: "mm/dd/yyyy",
    titleFormat: "MM yyyy", /* Leverages same syntax as 'format' */
    weekStart: 0
};
$('.bots-month').datepicker({
    autoclose: true,
    minViewMode: 1,
    format: 'MM',
    language:'id'
});
$('.bots-date').datepicker({
    format: 'yyyy-mm-dd',
    todayHighlight: true,
    autoclose: true,
});
var date = new Date();
var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
var end = new Date(date.getFullYear(), date.getMonth(), date.getDate());

$('.start-date').datepicker({
    format: 'yyyy-mm-dd',
    todayHighlight: true,
    startDate: today,
    autoclose: true,
}).on('changeDate', function (selected) {
    var minDate = new Date(selected.date.valueOf());
    $('.end-date').datepicker('setStartDate', minDate);
});

$('.end-date').datepicker({
    format: 'yyyy-mm-dd',
    todayHighlight: true,
    autoclose: true
}).on('changeDate', function (selected) {
    var maxDate = new Date(selected.date.valueOf());
    $('.start-date').datepicker('setEndDate', maxDate);
});
$('.input-daterange').datepicker({
    format: 'yyyy-mm-dd',
    todayHighlight: true,
    startDate: today,
    autoclose: true,

});
</script>
@endsection
