<script type="text/javascript">
          $('.selectpicker').selectpicker();
</script>
<div class="row">
    <div class="col-md-12 mt-15 mt-lg-0">
        <div class="tab-content">
            <div class="tab-pane active show tab-pane-ampas" irole="tabpanel" style="background-color: #ffeee2;">
                <div class="myaccount-content">
                    <h3>{!! $record['meter_no'] or '' !!} - {{ $record['name'] or '' }} | Tarif / Daya : {!! $record['segment_power'] or '' !!}</h3>
                    {{-- <p class="saved-message">You Can't Saved Your Payment Method yet.</p> --}}
                    <p class="mb-0">
                        <div class="content-ayokulakan" style="padding-top: 12px">
                            <form id="dataFormPagePlnPrabayarPost" action="{{ url('ppob-pulsa/store') }}" method="POST">
                                {!! csrf_field() !!}
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <input type="hidden" name="ppob_type" value="list_ppob">
                                            <input type="hidden" name="form_type" value="list_ppob">
                                            <input type="hidden" name="type" value="pln">
                                            <input type="hidden" name="types" value="pln">
                                            <input type="hidden" name="ppob_pelanggan" class="form-control" placeholder="Nomor Pelanggan" value="{{ $record['hp'] or '' }}">
                                            <div class="col-md-10">
                                                <div class="form-group">
                                                  <label for="">Pilih Nominal</label>
                                                  <select name="id_barang" class="form-control selectpicker" required="" data-dropup-auto="false" data-size="10" >
                                                    {!! App\Models\Master\PPOBPulsa::options(function ($ppob) {
                                                        return 'Rp.'.$ppob->pulsa_price;
                                                    }, 'pulsa_code', ['filters' => ['pulsa_type' => 'pln']], 'Choose One') !!}
                                                  </select> 
                                                </div>    
                                              </div>
                                              <div class="col-md-2 pull-right" style="padding-top: 33px">
                                                @if(\Auth::check())
                                                <button type="button" class="btn btn-success save-page save-frontend pull-right" data-title="Bayar Sekarang ? Pastikan Nomor Sudah Benar." data-confirm="Bayar" data-batal="Batal" data-forms="dataFormPagePlnPrabayarPost"><i class="ion-ios-plus"></i> Bayar Sekarang</button>
                                                @else
                                                @endif
                                            </div>
                                            
                                        </div>    
                                    </div>
                                </div>
                            </form>
                        </div>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>