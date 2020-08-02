<script type="text/javascript">
          $('.selectpicker').selectpicker();
</script>
<div class="row" style="background-color: #ffeee2;">
    <div class="col-md-12" >
        <div class="tab-content">
            <div class="tab-pane active show tab-pane-ampas" irole="tabpanel">
                <div class="myaccount-content">
                    <h3>Atas Nama {{ $record['tr_name'] or '' }}, - Periode {{ $record['period'] }}</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <label><b>No. Pelanggan :</b></label>
                            {!! $record['hp'] or '' !!}

                        </div>
                        <div class="col-md-6">
                            <label><b>No. Identitas :</b></label>
                            {!! $record['desc']->nomor_identitas or '' !!}

                        </div>
                        <div class="col-md-6">
                            <label><b>No. Rangka :</b></label>
                            {!! $record['desc']->nomor_rangka or '' !!}

                        </div>
                        <div class="col-md-6">
                            <label><b>No. Mesin :</b></label>
                            {!! $record['desc']->nomor_mesin or '' !!}

                        </div>
                        <div class="col-md-6">
                            <label><b>AN (Atas Nama) :</b></label>
                            {!! $record['desc']->milik_kenama or '' !!}
                        </div>
                        <div class="col-md-6">
                            <label><b>No. Polisi :</b></label>
                            {!! $record['desc']->nomor_polisi or '' !!}
                        </div>
                        
                        <div class="col-md-6">
                            <label><b>Tanggal Akhir Pajak :</b></label>
                            {!! $record['desc']->tgl_akhir_pajak_baru or '' !!}
                        </div>

                        <div class="col-md-6">
                            <label><b>Alamat :</b></label>
                            {!! $record['desc']->alamat or '' !!}

                        </div>
                        <br>
                        <div class="col-md-4">
                            <label><b>Biaya Pokok :</b></label><br>
                            BBN : Rp. {!! $record['desc']->biaya_pokok->BBN or '' !!}<br>
                            PKB : Rp. {!! $record['desc']->biaya_pokok->PKB or '' !!}<br>
                            SWD : Rp. {!! $record['desc']->biaya_pokok->SWD or '' !!}
                        </div>
                        <div class="col-md-4">
                            <label><b>Biaya Denda :</b></label><br>
                            BBN : Rp. {!! $record['desc']->biaya_denda->BBN or '' !!}<br>
                            PKB : Rp. {!! $record['desc']->biaya_denda->PKB or '' !!}<br>
                            SWD : Rp. {!! $record['desc']->biaya_denda->SWD or '' !!}
                        </div>
                        <div class="col-md-4">
                            <label><b>Biaya Admin :</b></label><br>
                            BBN : Rp. {!! $record['desc']->biaya_admin->BBN or '' !!}<br>
                            PKB : Rp. {!! $record['desc']->biaya_admin->PKB or '' !!}<br>
                            SWD : Rp. {!! $record['desc']->biaya_admin->SWD or '' !!}
                        </div>
                        <div class="col-md-12">
                            <label class="pull-right"><b>Total Pembayaran. Rp.</b> {{$record['price']}} </label>
                        </div>
                        <div class="col-md-12">
                            <label class="pull-right"><i style="font-size: 10px">*Sudah Termasuk Biaya Admin ({{$record['admin']}})</i></label>
                        </div>
                    </div>
                    {{-- <p class="saved-message">You Can't Saved Your Payment Method yet.</p> --}}
                    <p class="mb-0">
                        <div class="content-ayokulakan" style="padding-top: 12px">
                            <form id="dataFormPageEsamsats" action="{{ url('ppob-pasca/store') }}" method="POST">
                                {!! csrf_field() !!}
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <input type="hidden" name="ppob_pelanggan" class="form-control" placeholder="Nomor Pelanggan" value="{{ $record['hp'] or '' }}">
                                            <input type="hidden" name="type" value="{{ $record['code'] or '' }}">
                                            <input type="hidden" name="types" value="ESAMSAT.JAWABARAT">

                                            <div class="col-md-12 pull-right" style="padding-top: 33px">
                                                @if(\Auth::check())

                                                <button type="button" class="btn btn-success save-page save-frontend pull-right" data-title="Bayar Sekarang ? Pastikan Nomor Sudah Benar." data-confirm="Bayar" data-batal="Batal" data-forms="dataFormPageEsamsats"><i class="ion-ios-plus"></i> Bayar Sekarang</button>
                                                <a href="https://testpostpaid.mobilepulsa.net/api/v1/download/{{ $record['tr_id'] or '' }}" title="" class="btn btn-warning text-warning pull-right ppob-download-file"><i class="fa fa-download"></i> Download Laporan</a>
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