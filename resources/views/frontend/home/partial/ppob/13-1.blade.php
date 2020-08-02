<script type="text/javascript">
          $('.selectpicker').selectpicker();
</script>
<div class="row">
    <div class="col-md-12 mt-15 mt-lg-0">
        <div class="tab-content">
            <div class="tab-pane fade active show tab-pane-ampas" irole="tabpanel" style="background-color: #ffeee2;">
                <div class="myaccount-content">
                    <h3>{!! $record['code'] or '' !!} - {{ $record['tr_name'] or '' }}</h3>
                    <p class="mb-0">
                        <div class="content-ayokulakan" style="padding-top: 12px">
                                    <form id="dataFormPageTvByr" action="{{ url('ppob-pasca/store') }}" method="POST">
                                        {!! csrf_field() !!}
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <input type="hidden" name="ppob_pelanggan" class="form-control" placeholder="Nomor Pelanggan" value="{{ $record['hp'] or '' }}">
                                                    <input type="hidden" name="type" value="{{ $record['code'] or '' }}">
                                                    <input type="hidden" name="types" value="{{ $record['code'] or '' }}">
                                                    @if(count($record['desc']->tagihan->detail) > 0)
                                                        @foreach($record['desc']->tagihan->detail as $k => $value)
                                                            <div class="col-md-5">
                                                                <label><b>Perioder :</b></label>
                                                                {!! $value->periode or '' !!}
                                                                <label><b>Tagihan :</b></label>
                                                                {!! $record->nilai_tagihan or '' !!}
                                                                <label><b>admin :</b></label>
                                                                {!! $record->admin or '' !!}
                                                                <label><b>Total :</b></label>
                                                                {!! $record->total or '' !!}
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                    <div class="col-md-12">
                                                        <label class="pull-right"><b>Total Pembayaran. Rp.</b> {{$record['price']}} </label>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label class="pull-right"><i style="font-size: 10px">*Sudah Termasuk Biaya Admin ({{$record['admin']}})</i></label>
                                                    </div>
                                                    <div class="col-md-2" style="padding-top: 33px">
                                                        @if(\Auth::check())
                                                        <button type="button" class="btn btn-outline-success save-page save-frontend" data-title="Bayar Sekarang ? Pastikan Nomor Sudah Benar." data-confirm="Bayar" data-batal="Batal" data-forms="dataFormPageTvByr"><i class="ion-ios-plus"></i> Bayar Sekarang</button>
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