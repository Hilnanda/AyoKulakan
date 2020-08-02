
<div class="row">
    <div class="col-md-12 mt-15 mt-lg-0">
        <div class="tab-content">
            <div class="tab-pane active show tab-pane-ampas" irole="tabpanel" style="background-color: #ffeee2;">
                <div class="myaccount-content">
                    <h3>RINGKASAN TAGIHAN - {{ $record['tr_name'] or '' }} </h3>
                    <div class="row">
                        <div class="col-md-6">
                            <label><b>Jenis / Layanan Tagihan :</b></label>
                            {!! $record['code'] or '' !!}

                        </div>
                        <div class="col-md-6">
                            <label><b>Nomor Pelanggan :</b></label>
                            {!! $record['hp'] or '' !!}

                        </div>
                        <div class="col-md-6">
                            <label><b>Periode :</b></label>
                            {!! $record['desc']->kode_tarif or '' !!}

                        </div>
                        <div class="col-md-6">
                            <label><b>Biaya Admin :</b></label>
                            Rp. {!! $record['admin'] !!}

                        </div>
                        <div class="col-md-6">
                            <label><b>Total Tagihan :</b></label>
                            Rp. {!! $record['price'] !!}

                        </div>
                    </div>
                    <div class="saved-message">
                        <table>
                            <thead>
                                <tr>
                                    <th colspan="4" style="border-bottom: 1px solid black"><h6>Detail Pelanggan</h6></th>
                                </tr>
                                <tr>
                                    <th style="width: 100px">Tarif : {{ $record['desc']->tarif or '' }}</th>
                                    <th style="width: 100px">Daya : {{ $record['desc']->daya or '' }}</th>
                                    <th style="width: 150px">Jumlah Tagihan : Rp.{{ $record['desc']->tagihan->detail[0]->nilai_tagihan or '' }}</th>
                                    <th style="width: 100px">Denda : Rp.{{ $record['desc']->tagihan->detail[0]->denda or '' }}</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <p class="mb-0">
                        <div class="content-ayokulakan" style="padding-top: 12px">
                            <form id="dataFormPagePlnPrabayarPost" action="{{ url('ppob-pasca/store') }}" method="POST">
                                {!! csrf_field() !!}
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <input type="hidden" name="type" value="PLNPOSTPAID">
                                            <input type="hidden" name="types" value="PLNPOSTPAID">
                                            <input type="hidden" name="ppob_pelanggan" class="form-control" placeholder="Nomor Pelanggan" value="{{ $record['hp'] or '' }}">
                                            <div class="col-md-12 pull-right" style="padding-top: 33px">
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