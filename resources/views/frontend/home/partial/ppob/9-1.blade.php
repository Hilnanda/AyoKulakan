<script type="text/javascript">
    $(document).ready(function(){
          $('.selectpicker').selectpicker();
          $('.bots-date').datepicker({
                format: 'yyyy-mm-dd',
                todayHighlight: true,
                autoclose: true,
            });
    });
</script>
<div class="row">
    <div class="col-md-12 mt-15 mt-lg-0">
        <div class="tab-content">
            <div class="tab-pane fade active show tab-pane-ampas" irole="tabpanel" style="background-color: #ffeee2;">
                <div class="myaccount-content">
                    <h3>Daftar Pesawat </h3>
                    
                        <div class="content-ayokulakan" style="padding-top: 12px">
                            <form id="dataFormPagePesnPswt" action="#" method="POST">
                                {!! csrf_field() !!}
                                <input type="hidden" name="pulang_pergi" value="{{ $request['pulang_pergi'] or '-' }}">
                                <div class="row">
                                    <div class="saved-message col-md-12">
                                         @if($request['pswt']['dewasa'] > 0)
                                            @for($i=0;$i<$request['pswt']['dewasa'];$i++)
                                            <div class="card">
                                              <div class="card-header">
                                                Penumpang Dewasa
                                              </div>
                                              <div class="card-body">
                                                <div class="row">
                                                  <div class="col-md-4">
                                                    <div class="form-group">
                                                      <label>Title</label>
                                                      <select name="berangkat[dewasa][{{ $i+1 }}][title]" class="form-control selectpicker" required="" data-dropup-auto="false" data-size="10">
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
                                                      <input type="text" name="berangkat[dewasa][{{ $i+1 }}][name]" class="form-control" placeholder="Nama Sesuai KTP">
                                                    </div>
                                                  </div>
                                                  <div class="col-md-12">
                                                    <div class="form-group">
                                                      <label>Kewarganegaraan</label>
                                                      <select name="berangkat[dewasa][{{ $i+1 }}][negara]" class="form-control selectpicker" required="" data-live-search="true" data-dropup-auto="false" data-size="10" >
                                                            {!! App\Models\Master\WilayahNegara::options('negara','id',[],'Pilih Kewarganegaraan') !!}
                                                        </select>
                                                    </div>
                                                  </div>
                                                </div>
                                              </div>
                                            </div><br>
                                            @endfor
                                            @endif

                                            @if($request['pswt']['anak'] > 0)
                                            @for($i=0;$i<$request['pswt']['anak'];$i++)
                                            <div class="card">
                                              <div class="card-header">
                                                Penumpang Anak
                                              </div>
                                              <div class="card-body">
                                                <div class="row">
                                                  <div class="col-md-4">
                                                    <div class="form-group">
                                                      <label>Title</label>
                                                      <select name="berangkat[anak][{{ $i+1 }}][title]" class="form-control selectpicker" required="" data-dropup-auto="false" data-size="10">
                                                        <option value="">Title</option>
                                                        <option value="Tuan">Tuan</option>
                                                        <option value="Nona">Nona</option>
                                                      </select>
                                                    </div>
                                                  </div>
                                                  <div class="col-md-8">
                                                    <div class="form-group">
                                                      <label>Nama Penumpang</label>
                                                      <input type="text" name="berangkat[anak][{{ $i+1 }}][name]" class="form-control" placeholder="Nama Penumpang">
                                                    </div>
                                                  </div>
                                                  <div class="col-md-4">
                                                    <div class="form-group">
                                                      <label>Tanggal Lahir</label>
                                                      <input type="text" name="berangkat[anak][{{ $i+1 }}][dob]" class="bots-date form-control" placeholder="Tanggal Lahir" readonly="">
                                                    </div>
                                                  </div>
                                                  <div class="col-md-8">
                                                    <div class="form-group">
                                                      <label>Kewarganegaraan</label>
                                                      <select name="berangkat[anak][{{ $i+1 }}][negara]" class="form-control selectpicker" required="" data-live-search="true" data-dropup-auto="false" data-size="10" >
                                                            {!! App\Models\Master\WilayahNegara::options('negara','id',[],'Pilih Kewarganegaraan') !!}
                                                        </select>
                                                    </div>
                                                  </div>
                                                </div>
                                              </div>
                                            </div><br>
                                            @endfor
                                            @endif

                                            @if($request['pswt']['bayi'] > 0)
                                            @for($i=0;$i<$request['pswt']['bayi'];$i++)
                                            <div class="card">
                                              <div class="card-header">
                                                Penumpang Bayi
                                              </div>
                                              <div class="card-body">
                                                <div class="row">
                                                  <div class="col-md-4">
                                                    <div class="form-group">
                                                      <label>Title</label>
                                                      <select name="berangkat[bayi][{{ $i+1 }}][title]" class="form-control selectpicker" required="" data-dropup-auto="false" data-size="10">
                                                        <option value="">Title</option>
                                                        <option value="Tuan">Tuan</option>
                                                        <option value="Nona">Nona</option>
                                                      </select>
                                                    </div>
                                                  </div>
                                                  <div class="col-md-8">
                                                    <div class="form-group">
                                                      <label>Nama Penumpang</label>
                                                      <input type="text" name="berangkat[bayi][{{ $i+1 }}][name]" class="form-control" placeholder="Nama Penumpang">
                                                    </div>
                                                  </div>
                                                  <div class="col-md-4">
                                                    <div class="form-group">
                                                      <label>Tanggal Lahir</label>
                                                      <input type="text" name="berangkat[bayi][{{ $i+1 }}][dob]" class="bots-date form-control" placeholder="Tanggal Lahir" readonly="">
                                                    </div>
                                                  </div>
                                                  <div class="col-md-8">
                                                    <div class="form-group">
                                                      <label>Kewarganegaraan</label>
                                                      <select name="berangkat[bayi][{{ $i+1 }}][negara]" class="form-control selectpicker" required="" data-live-search="true" data-dropup-auto="false" data-size="10" >
                                                            {!! App\Models\Master\WilayahNegara::options('negara','id',[],'Pilih Kewarganegaraan') !!}
                                                        </select>
                                                    </div>
                                                  </div>
                                                </div>
                                              </div>
                                            </div><br>
                                            @endfor
                                            @endif
                                    </div>
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="saved-message col-md-12" >
                                                <table class="table table-responsive table-bordered" >
                                                   <tbody>
                                                    @if($record)
                                                        @if(count($record->departures->result) > 0)
                                                           @foreach($record->departures->result as $k => $value)
                                                                <tr>
                                                                   <td style="width: 150px">
                                                                       {{ $value->airlines_name or '' }}<br>
                                                                       <img src="{!! $value->image or '' !!}" style="width: 105px;height: 55px">
                                                                   </td>
                                                                   <td style="text-align: center; vertical-align: middle;width: 600px">
                                                                       <p><center>{{ $value->duration or '' }}</center></p>
                                                                       {{ $value->full_via or '' }}
                                                                   </td>
                                                                   <td style="text-align: center; vertical-align: middle;width: 190px">
                                                                       Rp.{{ number_format($value->price_value, 0, ".", ".") }}
                                                                   </td>
                                                                   <td style="text-align: center; vertical-align: middle;width: 190px">
                                                                        @if(\Auth::check())
                                                                            <button type="button" class="btn btn-outline-success save-page save-frontend-pswt pull-right" data-title="Pesan Tiket Sekarang ?" data-confirm="Pesan" data-batal="Batal" data-forms="dataFormPagePesnPswt" data-pswtid="{{ $value->flight_id or '' }}"><i class="ion-ios-plus"></i> Pesan Sekarang</button>
                                                                        @endif
                                                                   </td>
                                                                </tr>
                                                            @endforeach
                                                        @endif
                                                    @endif
                                                   </tbody>
                                                </table>
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