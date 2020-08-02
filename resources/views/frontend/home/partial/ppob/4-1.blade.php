<script type="text/javascript">
          $('.selectpicker').selectpicker();
</script>
<div class="row">
    <div class="col-md-12 mt-15 mt-lg-0">
        <div class="tab-content">
            <div class="tab-pane active show tab-pane-ampas" irole="tabpanel" style="background-color: #ffeee2;">
                <div class="myaccount-content">
                    <h3>{!! $record['code'] or '' !!} - {{ $record['tr_name'] or '' }}</h3>
                    <p class="mb-0">
                        <div class="content-ayokulakan" style="padding-top: 12px">
                                    <form id="dataFormPageBpjs" action="{{ url('ppob-pasca/store') }}" method="POST">
                                        {!! csrf_field() !!}
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <input type="hidden" name="ppob_pelanggan" class="form-control" placeholder="Nomor Pelanggan" value="{{ $record['hp'] or '' }}">
                                                    <input type="hidden" name="month" placeholder="Pilih Bulan" readonly="" value="{{ $request['month'] or '' }}">   
                                                    <input type="hidden" name="type" value="BPJS">
                                                    <input type="hidden" name="types" value="BPJS">

                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <label>Nominal</label>
                                                            <input type="text" name="nominal" class="form-control" placeholder="Nominal" readonly="" value="{{ $record['price'] or '' }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2" style="padding-top: 33px">
                                                        @if(\Auth::check())
                                                        <button type="button" class="btn btn-success save-page save-frontend" data-title="Bayar Sekarang ? Pastikan Nomor Sudah Benar." data-confirm="Bayar" data-batal="Batal" data-forms="dataFormPageBpjs"><i class="ion-ios-plus"></i> Bayar Sekarang</button>
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