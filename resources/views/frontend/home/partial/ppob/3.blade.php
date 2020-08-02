
    
            <div class="row">
                @if($ppobGame->count() > 0)
                @foreach($ppobGame as $k => $value)
                <div class="col-md-4" style="padding-bottom: 5px">
                    <div class="myaccount-tab-menu nav tab-menu-ampas" role="tablist">
                        @php
                            if($value->code == 'Ragnarok'){
                                $name = 'Ragnarok';
                            }else{
                                $name = isset($value->name) ? $value->name : '';
                            }
                        @endphp
                        <a href="#{{$name}}" class="" data-toggle="tab" style="font-size: 11px">
                            <img src="{{ ($value->attachments->first()) ? url('storage/'.$value->attachments->first()->url) : asset('img/slider-ayokulakan.png') }}">
                            {{ $value->code or '' }}
                        </a>

                    </div>
                </div>
                @endforeach
                @endif
            </div>
            <div class="row">
                <div class="col-md-12 mt-15 mt-lg-0">
                    <div class="tab-content" id="myaccountContent">
                        @if($ppobGame->count() > 0)
                        @foreach($ppobGame as $k => $value)
                        @php
                            if($value->code == 'Ragnarok'){
                                $name = 'Ragnarok';
                            }else{
                                $name = isset($value->name) ? $value->name : '';
                            }
                        @endphp
                        <div class="tab-pane fade tab-pane-ampas" id="{{$name}}" role="tabpanel">
                            <div class="myaccount-content">
                                <h3>{{$value->code or ''}}</h3>
                                <p class="mb-0">
                                    {!! $value->deskripsi or '' !!}
                                </p>
                                @if($value->code == 'Ragnarok')
                                <div class="content-ayokulakan" style="padding-top: 12px">
                                    <form id="dataFormPageGame1" action="{{ url('ppob-pulsa/store') }}" method="POST">
                                        {!! csrf_field() !!}
                                        <input type="hidden" name="type" value="game">
                                        <input type="hidden" name="types" value="game">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <input type="hidden" name="ppob_type" value="list_ppob">
                                                    <input type="hidden" name="form_type" value="list_ppob">
                                                    <input type="hidden" name="cek_pane" value="game">
                                                    <input type="hidden" name="game_code" value="127">
                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <label>User ID</label>
                                                            <input type="text" name="ppob_pelanggan" class="form-control" placeholder="User ID" min="" max="13" data-child="PPOBGame" data-nama="id_barang" data-type="game">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <label for="">Pilih Nominal Ragnarok M: Eternal Love</label>
                                                            <select name="id_barang" class="form-control selectpicker" required="" data-dropup-auto="false" data-size="10" >
                                                                {!! App\Models\Master\PPOBPulsa::options(function ($ppob) {
                                                                    return $ppob->pulsa_nominal.' - Rp. '.$ppob->pulsa_price;
                                                                }, 'pulsa_code', ['filters' => ['pulsa_op' => 'Ragnarok M: Eternal Love']], 'Choose One') !!}
                                                            </select>        
                                                        </div>    
                                                    </div>
                                                    <div class="col-md-2" style="padding-top: 33px">
                                                        @if(\Auth::check())
                                                         <button type="button" class="btn btn-success check-pulsa" data-url="check-game" data-form="dataFormPageGame1" ><i class="ion-android-refresh"></i> Cek Data</button>

                                                        <button type="button" class="btn btn-success save-page save-frontend dataFormPageGame1" data-title="Beli Voucher Game Sekarang ? Pastikan Nomor Sudah Benar." data-confirm="Pesan" data-batal="Batal" data-forms="dataFormPageGame1" style="display: none;"><i class="ion-ios-plus"></i> Beli Sekarang</button>
                                                        @else
                                                        @endif

                                                    </div>
                                                </div>    
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                @elseif($value->name == 'wave_game')
                                <div class="content-ayokulakan" style="padding-top: 12px">
                                    <form id="dataFormPageGame2" action="{{ url('ppob-pulsa/store') }}" method="POST">
                                        {!! csrf_field() !!}
                                        <input type="hidden" name="type" value="game">
                                        <input type="hidden" name="types" value="game">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <input type="hidden" name="ppob_type" value="list_ppob">
                                                    <input type="hidden" name="form_type" value="list_ppob">
                                                    <input type="hidden" name="cek_pane" value="game">
                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <label for="">Pilih Voucher</label>
                                                            <select name="id_barang" class="form-control selectpicker" required="" data-dropup-auto="false" data-size="10" >
                                                                {!! App\Models\Master\PPOBPulsa::options(function ($ppob) {
                                                                    return $ppob->pulsa_nominal.' - Rp. '.$ppob->pulsa_price;
                                                                }, 'pulsa_code', ['filters' => ['pulsa_op' => 'Wave Game']], 'Choose One') !!}
                                                            </select>        
                                                        </div>    
                                                    </div>
                                                    <div class="col-md-2" style="padding-top: 33px">
                                                        @if(\Auth::check())
                                                        <button type="button" class="btn btn-success save-page save-frontend" data-title="Beli Voucher Game Sekarang ?" data-confirm="Pesan" data-batal="Batal" data-forms="dataFormPageGame2"><i class="ion-ios-plus"></i> Beli Sekarang</button>
                                                        @else
                                                        @endif

                                                    </div>
                                                </div>    
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                @elseif($value->name == 'battlenet_sea')
                                <div class="content-ayokulakan" style="padding-top: 12px">
                                    <form id="dataFormPageGame3" action="{{ url('ppob-pulsa/store') }}" method="POST">
                                        {!! csrf_field() !!}
                                        <input type="hidden" name="type" value="game">
                                        <input type="hidden" name="types" value="game">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <input type="hidden" name="ppob_type" value="list_ppob">
                                                    <input type="hidden" name="form_type" value="list_ppob">
                                                    <input type="hidden" name="cek_pane" value="game">
                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <label for="">Pilih Voucher</label>
                                                            <select name="id_barang" class="form-control selectpicker" required="" data-dropup-auto="false" data-size="10" >
                                                                {!! App\Models\Master\PPOBPulsa::options(function ($ppob) {
                                                                    return $ppob->pulsa_nominal.' - Rp. '.$ppob->pulsa_price;
                                                                }, 'pulsa_code', ['filters' => ['pulsa_op' => 'Battlenet SEA']], 'Choose One') !!}
                                                            </select>        
                                                        </div>    
                                                    </div>
                                                    <div class="col-md-2" style="padding-top: 33px">
                                                        @if(\Auth::check())
                                                        <button type="button" class="btn btn-success save-page save-frontend" data-title="Beli Voucher Game Sekarang ?" data-confirm="Pesan" data-batal="Batal" data-forms="dataFormPageGame3"><i class="ion-ios-plus"></i> Beli Sekarang</button>
                                                        @else
                                                        @endif

                                                    </div>
                                                </div>    
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                @elseif($value->name == 'steam_sea')
                                <div class="content-ayokulakan" style="padding-top: 12px">
                                    <form id="dataFormPageGame4" action="{{ url('ppob-pulsa/store') }}" method="POST">
                                        {!! csrf_field() !!}
                                        <input type="hidden" name="type" value="game">
                                        <input type="hidden" name="types" value="game">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <input type="hidden" name="ppob_type" value="list_ppob">
                                                    <input type="hidden" name="form_type" value="list_ppob">
                                                    <input type="hidden" name="cek_pane" value="game">
                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <label for="">Pilih Voucher</label>
                                                            <select name="id_barang" class="form-control selectpicker" required="" data-dropup-auto="false" data-size="10" >
                                                                {!! App\Models\Master\PPOBPulsa::options(function ($ppob) {
                                                                    return $ppob->pulsa_nominal.' - Rp. '.$ppob->pulsa_price;
                                                                }, 'pulsa_code', ['filters' => ['pulsa_op' => 'Steam Sea']], 'Choose One') !!}
                                                            </select>        
                                                        </div>    
                                                    </div>
                                                    <div class="col-md-2" style="padding-top: 33px">
                                                        @if(\Auth::check())
                                                        <button type="button" class="btn btn-success save-page save-frontend" data-title="Beli Voucher Game Sekarang ?" data-confirm="Pesan" data-batal="Batal" data-forms="dataFormPageGame4"><i class="ion-ios-plus"></i> Beli Sekarang</button>
                                                        @else
                                                        @endif

                                                    </div>
                                                </div>    
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                @elseif($value->name == 'pubg')
                                <div class="content-ayokulakan" style="padding-top: 12px">
                                    <form id="dataFormPageGame5" action="{{ url('ppob-pulsa/store') }}" method="POST">
                                        {!! csrf_field() !!}
                                        <input type="hidden" name="type" value="game">
                                        <input type="hidden" name="types" value="game">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <input type="hidden" name="ppob_type" value="list_ppob">
                                                    <input type="hidden" name="form_type" value="list_ppob">
                                                    <input type="hidden" name="cek_pane" value="game">
                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <label for="">Pilih Voucher</label>
                                                            <select name="id_barang" class="form-control selectpicker" required="" data-dropup-auto="false" data-size="10" >
                                                                {!! App\Models\Master\PPOBPulsa::options(function ($ppob) {
                                                                    return $ppob->pulsa_nominal.' - Rp. '.$ppob->pulsa_price;
                                                                }, 'pulsa_code', ['filters' => ['pulsa_op' => 'PUBG']], 'Choose One') !!}
                                                            </select>        
                                                        </div>    
                                                    </div>
                                                    <div class="col-md-2" style="padding-top: 33px">
                                                        @if(\Auth::check())
                                                        <button type="button" class="btn btn-success save-page save-frontend" data-title="Beli Voucher Game Sekarang ?" data-confirm="Pesan" data-batal="Batal" data-forms="dataFormPageGame5"><i class="ion-ios-plus"></i> Beli Sekarang</button>
                                                        @else
                                                        @endif

                                                    </div>
                                                </div>    
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                @elseif($value->name == 'megaxus')
                                <div class="content-ayokulakan" style="padding-top: 12px">
                                    <form id="dataFormPageGame6" action="{{ url('ppob-pulsa/store') }}" method="POST">
                                        {!! csrf_field() !!}
                                        <input type="hidden" name="type" value="game">
                                        <input type="hidden" name="types" value="game">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <input type="hidden" name="ppob_type" value="list_ppob">
                                                    <input type="hidden" name="form_type" value="list_ppob">
                                                    <input type="hidden" name="cek_pane" value="game">
                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <label for="">Pilih Voucher</label>
                                                            <select name="id_barang" class="form-control selectpicker" required="" data-dropup-auto="false" data-size="10" >
                                                                {!! App\Models\Master\PPOBPulsa::options(function ($ppob) {
                                                                    return $ppob->pulsa_nominal.' - Rp. '.$ppob->pulsa_price;
                                                                }, 'pulsa_code', ['filters' => ['pulsa_op' => 'Megaxus']], 'Choose One') !!}
                                                            </select>        
                                                        </div>    
                                                    </div>
                                                    <div class="col-md-2" style="padding-top: 33px">
                                                        @if(\Auth::check())
                                                        <button type="button" class="btn btn-success save-page save-frontend" data-title="Beli Voucher Game Sekarang ?" data-confirm="Pesan" data-batal="Batal" data-forms="dataFormPageGame6"><i class="ion-ios-plus"></i> Beli Sekarang</button>
                                                        @else
                                                        @endif

                                                    </div>
                                                </div>    
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                 @elseif($value->name == 'itunes_gift_card_indonesia')
                                <div class="content-ayokulakan" style="padding-top: 12px">
                                    <form id="dataFormPageGame7" action="{{ url('ppob-pulsa/store') }}" method="POST">
                                        {!! csrf_field() !!}
                                        <input type="hidden" name="type" value="game">
                                        <input type="hidden" name="types" value="game">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <input type="hidden" name="ppob_type" value="list_ppob">
                                                    <input type="hidden" name="form_type" value="list_ppob">
                                                    <input type="hidden" name="cek_pane" value="game">
                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <label for="">Pilih Voucher</label>
                                                            <select name="id_barang" class="form-control selectpicker" required="" data-dropup-auto="false" data-size="10" >
                                                                {!! App\Models\Master\PPOBPulsa::options(function ($ppob) {
                                                                    return $ppob->pulsa_nominal.' - Rp. '.$ppob->pulsa_price;
                                                                }, 'pulsa_code', ['filters' => ['pulsa_op' => 'iTunes Gift Card Indonesia']], 'Choose One') !!}
                                                            </select>        
                                                        </div>    
                                                    </div>
                                                    <div class="col-md-2" style="padding-top: 33px">
                                                        @if(\Auth::check())
                                                        <button type="button" class="btn btn-success save-page save-frontend" data-title="Beli Voucher Game Sekarang ?" data-confirm="Pesan" data-batal="Batal" data-forms="dataFormPageGame7"><i class="ion-ios-plus"></i> Beli Sekarang</button>
                                                        @else
                                                        @endif

                                                    </div>
                                                </div>    
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                 @elseif($value->name == 'free_fire')
                                <div class="content-ayokulakan" style="padding-top: 12px">
                                    <form id="dataFormPageGame8" action="{{ url('ppob-pulsa/store') }}" method="POST">
                                        {!! csrf_field() !!}
                                        <input type="hidden" name="type" value="game">
                                        <input type="hidden" name="types" value="game">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <input type="hidden" name="ppob_type" value="list_ppob">
                                                    <input type="hidden" name="form_type" value="list_ppob">
                                                    <input type="hidden" name="cek_pane" value="game">
                                                    <input type="hidden" name="game_code" value="135">
                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <label>User ID</label>
                                                            <input type="text" name="ppob_pelanggan" class="form-control" placeholder="User ID" min="" max="13" data-child="PPOBGame" data-nama="id_barang" data-type="game">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <label for="">Pilih Voucher</label>
                                                            <select name="id_barang" class="form-control selectpicker" required="" data-dropup-auto="false" data-size="10" >
                                                                {!! App\Models\Master\PPOBPulsa::options(function ($ppob) {
                                                                    return $ppob->pulsa_nominal.' - Rp. '.$ppob->pulsa_price;
                                                                }, 'pulsa_code', ['filters' => ['pulsa_op' => 'Free Fire']], 'Choose One') !!}
                                                            </select>        
                                                        </div>    
                                                    </div>
                                                    <div class="col-md-2" style="padding-top: 33px">
                                                        @if(\Auth::check())
                                                         <button type="button" class="btn btn-success check-pulsa" data-url="check-game" data-form="dataFormPageGame8" ><i class="ion-android-refresh"></i> Cek Data</button>

                                                        <button type="button" class="btn btn-success save-page save-frontend dataFormPageGame8" data-title="Beli Voucher Game Sekarang ?" data-confirm="Pesan" data-batal="Batal" data-forms="dataFormPageGame8" style="display: none;"><i class="ion-ios-plus"></i> Beli Sekarang</button>
                                                        @else
                                                        @endif

                                                    </div>
                                                </div>    
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                 @elseif($value->name == 'wifi_id')
                                <div class="content-ayokulakan" style="padding-top: 12px">
                                    <form id="dataFormPageGame9" action="{{ url('ppob-pulsa/store') }}" method="POST">
                                        {!! csrf_field() !!}
                                        <input type="hidden" name="type" value="game">
                                        <input type="hidden" name="types" value="game">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <input type="hidden" name="ppob_type" value="list_ppob">
                                                    <input type="hidden" name="form_type" value="list_ppob">
                                                    <input type="hidden" name="cek_pane" value="game">
                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <label for="">Pilih Voucher</label>
                                                            <select name="id_barang" class="form-control selectpicker" required="" data-dropup-auto="false" data-size="10" >
                                                                {!! App\Models\Master\PPOBPulsa::options(function ($ppob) {
                                                                    return $ppob->pulsa_nominal.' - Rp. '.$ppob->pulsa_price;
                                                                }, 'pulsa_code', ['filters' => ['pulsa_op' => 'Wifi ID']], 'Choose One') !!}
                                                            </select>        
                                                        </div>    
                                                    </div>
                                                    <div class="col-md-2" style="padding-top: 33px">
                                                        @if(\Auth::check())
                                                        <button type="button" class="btn btn-success save-page save-frontend" data-title="Beli Voucher Game Sekarang ?" data-confirm="Pesan" data-batal="Batal" data-forms="dataFormPageGame9"><i class="ion-ios-plus"></i> Beli Sekarang</button>
                                                        @else
                                                        @endif

                                                    </div>
                                                </div>    
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                 @elseif($value->name == 'mobile_legend')
                                <div class="content-ayokulakan" style="padding-top: 12px">
                                    <form id="dataFormPageGame10" action="{{ url('ppob-pulsa/store') }}" method="POST">
                                        {!! csrf_field() !!}
                                        <input type="hidden" name="type" value="game">
                                        <input type="hidden" name="types" value="game">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <input type="hidden" name="ppob_type" value="list_ppob">
                                                    <input type="hidden" name="form_type" value="list_ppob">
                                                    <input type="hidden" name="cek_pane" value="game">
                                                    <input type="hidden" name="game_code" value="103">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>User ID</label>
                                                            <input type="text" name="ppob_pelanggan" class="form-control" placeholder="User ID" min="10" max="10" data-child="PPOBGame" data-nama="id_barang" data-type="game">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label>Server ID</label>
                                                            <input type="text" name="ppob_pelanggan_next" class="form-control" placeholder="User ID" min="4" max="4" data-child="PPOBGame" data-nama="id_barang" data-type="game">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="">Pilih Voucher</label>
                                                            <select name="id_barang" class="form-control selectpicker" required="" data-dropup-auto="false" data-size="10" >
                                                                {!! App\Models\Master\PPOBPulsa::options(function ($ppob) {
                                                                    return $ppob->pulsa_nominal.' - Rp. '.$ppob->pulsa_price;
                                                                }, 'pulsa_code', ['filters' => ['pulsa_op' => 'Mobile Legend']], 'Choose One') !!}
                                                            </select>        
                                                        </div>    
                                                    </div>
                                                    <div class="col-md-2" style="padding-top: 33px">
                                                        @if(\Auth::check())
                                                        <button type="button" class="btn btn-success check-pulsa" data-url="check-game" data-form="dataFormPageGame10" ><i class="ion-android-refresh"></i> Cek Data</button>

                                                        <button type="button" class="btn btn-success save-page save-frontend dataFormPageGame10" data-title="Beli Voucher Game Sekarang ?" data-confirm="Pesan" data-batal="Batal" data-forms="dataFormPageGame10" style="display: none"><i class="ion-ios-plus"></i> Beli Sekarang</button>
                                                        @else
                                                        @endif

                                                    </div>
                                                </div>    
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                 @elseif($value->name == 'point_blank')
                                <div class="content-ayokulakan" style="padding-top: 12px">
                                    <form id="dataFormPageGame11" action="{{ url('ppob-pulsa/store') }}" method="POST">
                                        {!! csrf_field() !!}
                                        <input type="hidden" name="type" value="game">
                                        <input type="hidden" name="types" value="game">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <input type="hidden" name="ppob_type" value="list_ppob">
                                                    <input type="hidden" name="form_type" value="list_ppob">
                                                    <input type="hidden" name="cek_pane" value="game">
                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <label for="">Pilih Voucher</label>
                                                            <select name="id_barang" class="form-control selectpicker" required="" data-dropup-auto="false" data-size="10" >
                                                                {!! App\Models\Master\PPOBPulsa::options(function ($ppob) {
                                                                    return $ppob->pulsa_nominal.' - Rp. '.$ppob->pulsa_price;
                                                                }, 'pulsa_code', ['filters' => ['pulsa_op' => 'Point Blank']], 'Choose One') !!}
                                                            </select>        
                                                        </div>    
                                                    </div>
                                                    <div class="col-md-2" style="padding-top: 33px">
                                                        @if(\Auth::check())
                                                        <button type="button" class="btn btn-success save-page save-frontend" data-title="Beli Voucher Game Sekarang ?" data-confirm="Pesan" data-batal="Batal" data-forms="dataFormPageGame11"><i class="ion-ios-plus"></i> Beli Sekarang</button>
                                                        @else
                                                        @endif

                                                    </div>
                                                </div>    
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                 @elseif($value->name == 'gemscool')
                                <div class="content-ayokulakan" style="padding-top: 12px">
                                    <form id="dataFormPageGame12" action="{{ url('ppob-pulsa/store') }}" method="POST">
                                        {!! csrf_field() !!}
                                        <input type="hidden" name="type" value="game">
                                        <input type="hidden" name="types" value="game">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <input type="hidden" name="ppob_type" value="list_ppob">
                                                    <input type="hidden" name="form_type" value="list_ppob">
                                                    <input type="hidden" name="cek_pane" value="game">
                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <label for="">Pilih Voucher</label>
                                                            <select name="id_barang" class="form-control selectpicker" required="" data-dropup-auto="false" data-size="10" >
                                                                {!! App\Models\Master\PPOBPulsa::options(function ($ppob) {
                                                                    return $ppob->pulsa_nominal.' - Rp. '.$ppob->pulsa_price;
                                                                }, 'pulsa_code', ['filters' => ['pulsa_op' => 'Gemscool']], 'Choose One') !!}
                                                            </select>        
                                                        </div>    
                                                    </div>
                                                    <div class="col-md-2" style="padding-top: 33px">
                                                        @if(\Auth::check())
                                                        <button type="button" class="btn btn-success save-page save-frontend" data-title="Beli Voucher Game Sekarang ?" data-confirm="Pesan" data-batal="Batal" data-forms="dataFormPageGame12"><i class="ion-ios-plus"></i> Beli Sekarang</button>
                                                        @else
                                                        @endif

                                                    </div>
                                                </div>    
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                 @elseif($value->name == 'google_play_indonesia')
                                <div class="content-ayokulakan" style="padding-top: 12px">
                                    <form id="dataFormPageGame13" action="{{ url('ppob-pulsa/store') }}" method="POST">
                                        {!! csrf_field() !!}
                                        <input type="hidden" name="type" value="game">
                                        <input type="hidden" name="types" value="game">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <input type="hidden" name="ppob_type" value="list_ppob">
                                                    <input type="hidden" name="form_type" value="list_ppob">
                                                    <input type="hidden" name="cek_pane" value="game">
                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <label>Nomor Tujuan</label>
                                                            <input type="text" name="ppob_pelanggan" class="form-control" placeholder="Nomor Tujuan" min="12" max="13" data-child="PPOBGame" data-nama="id_barang" data-type="game">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <label for="">Pilih Voucher</label>
                                                            <select name="id_barang" class="form-control selectpicker" required="" data-dropup-auto="false" data-size="10" >
                                                                {!! App\Models\Master\PPOBPulsa::options(function ($ppob) {
                                                                    return $ppob->pulsa_nominal.' - Rp. '.$ppob->pulsa_price;
                                                                }, 'pulsa_code', ['filters' => ['pulsa_op' => 'Google Play Indonesia']], 'Choose One') !!}
                                                            </select>        
                                                        </div>    
                                                    </div>
                                                    <div class="col-md-2" style="padding-top: 33px">
                                                        @if(\Auth::check())
                                                        <button type="button" class="btn btn-success save-page save-frontend" data-title="Beli Voucher Game Sekarang ?" data-confirm="Pesan" data-batal="Batal" data-forms="dataFormPageGame13"><i class="ion-ios-plus"></i> Beli Sekarang</button>
                                                        @else
                                                        @endif

                                                    </div>
                                                </div>    
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                 @elseif($value->name == 'garena')
                                <div class="content-ayokulakan" style="padding-top: 12px">
                                    <form id="dataFormPageGame14" action="{{ url('ppob-pulsa/store') }}" method="POST">
                                        {!! csrf_field() !!}
                                        <input type="hidden" name="type" value="game">
                                        <input type="hidden" name="types" value="game">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <input type="hidden" name="ppob_type" value="list_ppob">
                                                    <input type="hidden" name="form_type" value="list_ppob">
                                                    <input type="hidden" name="cek_pane" value="game">
                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <label for="">Pilih Voucher</label>
                                                            <select name="id_barang" class="form-control selectpicker" required="" data-dropup-auto="false" data-size="10" >
                                                                {!! App\Models\Master\PPOBPulsa::options(function ($ppob) {
                                                                    return $ppob->pulsa_nominal.' - Rp. '.$ppob->pulsa_price;
                                                                }, 'pulsa_code', ['filters' => ['pulsa_op' => 'Garena']], 'Choose One') !!}
                                                            </select>        
                                                        </div>    
                                                    </div>
                                                    <div class="col-md-2" style="padding-top: 33px">
                                                        @if(\Auth::check())
                                                        <button type="button" class="btn btn-success save-page save-frontend" data-title="Beli Voucher Game Sekarang ?" data-confirm="Pesan" data-batal="Batal" data-forms="dataFormPageGame14"><i class="ion-ios-plus"></i> Beli Sekarang</button>
                                                        @else
                                                        @endif

                                                    </div>
                                                </div>    
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                @endif
                            </div>
                        </div>
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>
       
