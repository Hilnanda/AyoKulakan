<div class="row">
  <div class="col-md-12 mt-15 mt-lg-0">
    <div class="tab-content">
      <div class="tab-pane active show tab-pane-ampas" role="tabpanel" style="background-color: #ffeee2;">
        <div class="myaccount-content">
          <h3>Pesan Tiket </h3>
          <div class="content-ayokulakan" style="padding-top: 12px">
            <form id="dataFormPageCekKuris" action="{{ url('check-ticket/store') }}" method="POST">
              {!! csrf_field() !!}
              <input type="hidden" name="org" value="{{ $request['rute_asal'] }}">
              <input type="hidden" name="dewasa" value="{{ $request['dewasa'] }}">
              <input type="hidden" name="anak" value="{{ $request['anak'] }}">
              <input type="hidden" name="org" value="{{ $request['rute_asal'] }}">
              <input type="hidden" name="dest" value="{{ $request['rute_tujuan'] }}">
              <input type="hidden" name="date" value="{{ $request['tanggal_berangkat'] }}">
              <input type="hidden" name="tanggal_kepulangan" value="{{ $request['tanggal_kepulangan'] or '-' }}">
              <input type="hidden" name="pulang_pergi" value="{{ $request['pulang_pergi'] or '-' }}">
              <div class="row">
                @if($record && $hasilKepulangan)
                <div class="col-md-6">
                  @if(count($record['schedule']) > 0)
                  <div class="saved-message" style="max-height: 35rem !important;overflow-y: scroll;overflow-x: hidden !important;">
                    <h3>{{ $request['rute_asal'] }} - {{ $request['rute_tujuan'] }}</h3>

                    @foreach($record['schedule'] as $k => $value)
                    @if($value->availability > 0)
                    @php
                    $start = Carbon\Carbon::parse($value->departTime);
                    $end = Carbon\Carbon::parse($value->arriveTime);
                    $final = $start->diff($end)->format('%hj %Im');
                    @endphp
                    <div class="input-group mb-3">
                      
                      <div class="form-group ">
                        <div class="input-group">
                          <div class="input-group-addon">
                            @if($value->availability > 0)
                          <!-- <div class="custom-control custom-radio"> -->
                            <input type="radio" class="custom-control-input" id="customControlValidationKeretaBerangkat{{$k}}" name="berangkat[trainNo]" value="{{ $value->fareId or '' }}" data-class="{{ $value->class or '' }}" data-subclassbr="{{ $value->subClass or '' }}" data-jam="{{ $value->arriveTime or '' }}" required><br>
                            @endif
                            <label class="custom-control-label" for="customControlValidationKeretaBerangkat{{$k}}">{{ $value->trainName or '' }} ({{ ($value->availability == 0) ? 'KOSONG' : 'TERSEDIA' }}) </label><br>
                            <label><u><i>{{ $value->departTime or '' }} - {{ $value->arriveTime or '' }} ({{ $final or '' }})</i></u></label><br>
                            <label><i>{{ $value->class or '' }} ({{ $value->subClass or '' }}) </i></label>
                          <!-- </div> -->
                          </div>
                        </div>
                      </div><br>
                    </div>
                    @endif
                    @endforeach
                    @else
                    Data Tidak Ditemukan
                    @endif
                  </div>
                </div>
                <div class="col-md-6">
                  @if(count($hasilKepulangan['schedule']) > 0)
                  <div class="saved-message" style="max-height: 35rem !important;overflow-y: scroll;overflow-x: hidden !important;">
                    <h3>{{ $request['rute_tujuan'] }} - {{ $request['rute_asal'] }}</h3>

                    @foreach($hasilKepulangan['schedule'] as $k => $value)
                    @if($value->availability > 0)    

                    @php
                    $start = Carbon\Carbon::parse($value->departTime);
                    $end = Carbon\Carbon::parse($value->arriveTime);
                    $final = $start->diff($end)->format('%hj %Im');
                    @endphp
                    
                    <div class="input-group mb-3">
                      <div class="form-group ">
                        <div class="input-group">
                          <div class="input-group-addon">
                          @if($value->availability > 0)    
                            <input type="radio" class="custom-control-input" id="customControlValidationKeretaPulang{{$k}}" name="kepulangan[trainNo]" value="{{ $value->fareId or '' }}" data-classkepulangan="{{ $value->class or '' }}" data-subclasskp="{{ $value->subClass or '' }}" data-jam="{{ $value->departTime or '' }}" required><br>
                            @endif
                            <label class="custom-control-label" for="customControlValidationKeretaPulang{{$k}}">{{ $value->trainName or '' }} ({{ ($value->availability == 0) ? 'KOSONG' : 'TERSEDIA' }}) </label><br>
                            <label>
                              <u><i>{{ $value->departTime or '' }} - {{ $value->arriveTime or '' }} ({{ $final or '' }})</i></u>
                            </label><br>
                            <label><i>{{ $value->class or '' }} ({{ $value->subClass or '' }}) </i></label>
                          </div>
                        </div>
                      </div><br>
                    </div>
                    @endif
                    @endforeach
                    @else
                    Data Tidak Ditemukan
                    @endif
                  </div>
                </div>
                @else
                <div class="col-md-12">
                  @if(count($record['schedule']) > 0)
                  
                  <div class="saved-message">
                    @foreach($record['schedule'] as $k => $value)
                    @if($value->availability > 0)                        
                    @php
                    $start = Carbon\Carbon::parse($value->departTime);
                    $end = Carbon\Carbon::parse($value->arriveTime);
                    $final = $start->diff($end)->format('%hj %Im');
                    @endphp
                    <div class="input-group mb-3">
                      <div class="form-group ">
                        <div class="input-group">
                          <div class="input-group-addon">
                            @if($value->availability > 0)
                            <input type="radio" class="custom-control-input" id="customControlValidation{{$k}}" name="berangkat[trainNo]" value="{{ $value->fareId or '' }}" data-subclassbr="{{ $value->subClass or '' }}" data-class="{{ $value->class or '' }}" required>
                            @endif
                            <label><i>{{ $value->class or '' }} ({{ $value->subClass or '' }}) </i></label> -
                            <label class="custom-control-label" for="customControlValidation{{$k}}">{{ $value->trainName or '' }} ({{ ($value->availability == 0) ? 'KOSONG' : 'TERSEDIA' }}) <u><i>{{ $value->departTime or '' }} - {{ $value->arriveTime or '' }} ({{ $final or '' }})</i></u></label>
                          </div>
                        </div>
                      </div><br>
                    </div>
                    @endif
                    @endforeach
                    @else
                    Data Tidak Ditemukan
                    @endif
                  </div>
                </div>
                @endif
                <div class="col-md-12">
                  <div class="saved-message">
                    <div class="row">
                      <div class="col-md-12">
                        @if($request['dewasa'] > 0)
                        @for($i=0;$i<$request['dewasa'];$i++)
                        <div class="card">
                          <div class="card-header">
                            Penumpang Dewasa (3 tahun ke atas)
                          </div>
                          <div class="card-body">
                            <div class="row">
                              <div class="col-md-4">
                                <div class="form-group">
                                  <label>Title</label>
                                  <select name="berangkat[passenger][adult][{{ $i+1 }}][title]" class="form-control selectpicker" required="" data-dropup-auto="false" data-size="10">
                                    <option value="">Title</option>
                                    <option value="Tuan">Tuan</option>
                                    <option value="Nyonya">Nyonya</option>
                                    <option value="Nona">Nona</option>
                                  </select>
                                </div>
                              </div>
                              <div class="col-md-8">
                                <div class="form-group">
                                  <label>Nama Penumpang</label>
                                  <input type="text" name="berangkat[passenger][adult][{{ $i+1 }}][name]" class="form-control" placeholder="Nama Sesuai KTP">
                                </div>
                              </div>
                              <div class="col-md-4">
                                <div class="form-group">
                                  <label>Tanda Pengenal</label>
                                  <select name="berangkat[passenger][adult][{{ $i+1 }}][tanda_pengenal]" class="form-control selectpicker" required="" data-dropup-auto="false" data-size="10">
                                    <option value="">Tanda Pengenal</option>
                                    <option value="KTP">KTP</option>
                                    <option value="Passpor">Passpor</option>
                                    <option value="SIM">SIM</option>
                                    <option value="Lainnya">Lainnya</option>
                                  </select>
                                </div>
                              </div>
                              <div class="col-md-8">
                                <div class="form-group">
                                  <label>No. Tanda Pengenal</label>
                                  <input type="text" name="berangkat[passenger][adult][{{ $i+1 }}][id]" class="form-control" placeholder="Umur dibawah 18 (isi:akta lahir / kartu pelajar)">
                                </div>
                              </div>
                              <div class="col-md-4">
                                <div class="form-group">
                                  <label>Tanggal Lahir</label>
                                  <input type="text" name="berangkat[passenger][adult][{{ $i+1 }}][dob]" class="bots-date form-control" placeholder="Tanggal Lahir" readonly="">
                                </div>
                              </div>
                              <div class="col-md-8">
                                <div class="form-group">
                                  <label>No Hp</label>
                                  <input type="text" name="berangkat[passenger][adult][{{ $i+1 }}][phone]" class="form-control" placeholder="No Hp">
                                </div>
                              </div>
                            </div>
                          </div>
                        </div><br>
                        @endfor
                        @endif

                        @if($request['anak'] > 0)
                        @for($i=0;$i<$request['anak'];$i++)
                        <div class="card">
                          <div class="card-header">
                            Penumpang Bayi (Bawah 3 tahun)
                          </div>
                          <div class="card-body">
                            <div class="row">
                              <div class="col-md-4">
                                <div class="form-group">
                                  <label>Title</label>
                                  <select name="berangkat[passenger][infant][{{ $i+1 }}][title]" class="form-control selectpicker" required="" data-dropup-auto="false" data-size="10">
                                    <option value="">Title</option>
                                    <option value="Tuan">Tuan</option>
                                    <option value="Nona">Nona</option>
                                  </select>
                                </div>
                              </div>
                              <div class="col-md-8">
                                <div class="form-group">
                                  <label>Nama Penumpang</label>
                                  <input type="text" name="berangkat[passenger][infant][{{ $i+1 }}][name]" class="form-control" placeholder="Nama Penumpang">
                                </div>
                              </div>
                              <div class="col-md-4">
                                <div class="form-group">
                                  <label>Tanggal Lahir</label>
                                  <input type="text" name="berangkat[passenger][infant][{{ $i+1 }}][dob]" class="bots-date form-control" placeholder="Tanggal Lahir" readonly="">
                                </div>
                              </div>
                            </div>
                          </div>
                        </div><br>
                        @endfor
                        @endif
                      </div>
                    </div>

                  </div>
                </div>
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="card" style="">
                        <div class="card-header mb-3">
                          Pilih Kursi Keberangkatan Dalam 1 Gerbong Berisi ({{ $request['dewasa'] }} Orang)
                          <button type="button" data-toggle="tooltip" data-placement="bottom" title="Cek Kursi" class="btn btn-sm bg-primary check-tiket button" data-url="check-kursi" data-form="dataFormPageCekKuris" data-show="showKursi"><i class="fa fa-search  text-white"></i></button>
                        </div>
                        <div class="card-body">
                          <div class="showKursi">

                          </div>
                        </div>
                        @if(\Auth::check())
                        <button type="button" class="btn btn-success save-page save-frontend pull-right" data-title="Pesan Sekarang ?" data-confirm="Pesan" data-batal="Batal" data-forms="dataFormPageCekKuris"><i class="ion-ios-plus"></i> Pesan Sekarang</button>
                        @endif
                      </div>    
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
$('.bots-date').datepicker({
    format: 'yyyy-mm-dd',
    todayHighlight: true,
    autoclose: true
});
$(document).on('change','input[name="berangkat[trainNo]"]',function(){
  var pulangPergi = $('input[name="pulang_pergi"]').val();
  var tanggalKeberangkatan = $('input[name="date"]').val();
  var tanggalKepulangan = $('input[name="tanggal_kepulangan"]').val();
  
  var checkSampe = $('input[name="berangkat[trainNo]"]:checked').data('jam');
  var checkKepulangan = $('input[name="kepulangan[trainNo]"]:checked').data('jam');
  console.log('checkKepulangan',checkKepulangan)
  if(pulangPergi != '-'){
    if(tanggalKeberangkatan == tanggalKepulangan){
      if(checkKepulangan !== undefined){
        if(checkSampe > checkKepulangan){
          
          swal(
          'Silakan pilih kereta pulang lainnya!',
          'Pastikan Anda memilih kereta pulang yang berangkat setelah waktu kedatangan Anda.',
          'error'
          );
          $('.show-tiket-kereta').html('');
        }
      }
    }
  }
});

$(document).on('change','input[name="kepulangan[trainNo]"]',function(){
  var pulangPergi = $('input[name="pulang_pergi"]').val();
  var tanggalKeberangkatan = $('input[name="date"]').val();
  var tanggalKepulangan = $('input[name="tanggal_kepulangan"]').val();
  
  var checkSampe = $('input[name="berangkat[trainNo]"]:checked').data('jam');
  var checkKepulangan = $('input[name="kepulangan[trainNo]"]:checked').data('jam');
  console.log('checkSampe',checkSampe)

  if(pulangPergi != '-'){
    if(tanggalKeberangkatan == tanggalKepulangan){
      if(checkSampe !== undefined){
        if(checkSampe > checkKepulangan){
          swal(
          'Silakan pilih kereta pulang lainnya!',
          'Pastikan Anda memilih kereta pulang yang berangkat setelah waktu kedatangan Anda.',
          'error'
          );
          $('.show-tiket-kereta').html('');
        }
      }
    }
  }
});

$(document).on('click','#myTabs a', function (e) {
  console.log('asd',$(this).data('checkno'));
  $('.tab-check').removeClass('show active');
  $('#myTabsContent').find('div').removeClass('show active')
  $('#body'+$(this).data('checkno')).addClass('show active');
});

$(document).on('click','input[name^="berangkat[seats]"]',function(e){
  var dewasa = $('input[name="dewasa"]').val();
  console.log('dewasa',dewasa)
  var checkLength = $('.custom-datas-checkbox:checked').serializeArray().length;
  if(checkLength > dewasa){
    $(this).prop('checked',false);
  }

});

// // KEPULANGAN

$(document).on('click','#myTabsKp a', function (e) {
  $('.tab-checkKp').removeClass('show active');
  $('#myTabsContentKp').find('div').removeClass('show active')
  $('#body'+$(this).data('checkno')).addClass('show active');
});

$(document).on('click','input[name^="kepulangan[seats]"]',function(){
  var dewasa = $('input[name="dewasa"]').val();
  var checkLength = $('.custom-datasKp-checkbox:checked').serializeArray().length;
  if(checkLength > dewasa){
    $(this).prop('checked',false);
  }
});
</script>
