@extends('layouts.scaffold')

@section('styles')
<meta name="asset-url" content="{{ config('app.url') }}">
<link rel="stylesheet" type="text/css" href="{{ url('/plugins/datepicker/datepicker3.css') }}">
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

@section('scripts')
{{-- <script src="{{ asset('js/vueapp.js') }}" defer></script> --}}
<script type="text/javascript" src="{{ url('/plugins/datepicker/bootstrap-datepicker.js') }}"></script>

<script>
    $(document).ready(function() {
        $('.bots-date').datepicker({
            format: 'yyyy-mm-dd',
            todayHighlight: true,
            autoclose: true,
        });
    });
</script>
@endsection

@section('content-frontend')
{{-- <div id="vueapp">
    <passenger-component :passengers="{
        adult: 1,
        child: 0,
        infant: 0
    }"></passenger-component>
</div> --}}

<form action="{{ url('airline/booking') }}" method="POST">

    {!! csrf_field() !!}

    <input type="hidden" name="accessToken" value="{{ $accessToken }}">
    <input type="hidden" name="airlineID" value="{{ $request->airlineID }}">
    <input type="hidden" name="origin" value="{{ $request->origin }}">
    <input type="hidden" name="destination" value="{{ $request->destination }}">
    <input type="hidden" name="tripType" value="{{ $request->tripType }}">
    <input type="hidden" name="departDate" value="{{ $request->departDate }}">
    <input type="hidden" name="returnDate" value="{{ $request->returnDate }}">
    <input type="hidden" name="paxAdult" value="{{ $request->paxAdult }}">
    <input type="hidden" name="paxChild" value="{{ $request->paxChild }}">
    <input type="hidden" name="paxInfant" value="{{ $request->paxInfant }}">
    <input type="hidden" name="schDepart" value="{{ $request->schDepart }}">

    <input type="hidden" name="schDeparts[airlineCode]" value="{{ $request->airlineCode }}">
    <input type="hidden" name="schDeparts[flightNumber]" value="{{ $request->flightNumber }}">
    <input type="hidden" name="schDeparts[flightClass]" value="{{ $request->flightClass }}">
    <input type="hidden" name="schDeparts[schOrigin]" value="{{ $request->origin }}">
    <input type="hidden" name="schDeparts[schDestination]" value="{{ $request->destination }}">
    <input type="hidden" name="schDeparts[detailSchedule]" value="{{ $request->schDepart }}">
    <input type="hidden" name="schDeparts[schDepartTime]" value="{{ $request->departTime }}">
    <input type="hidden" name="schDeparts[schArrivalTime]" value="{{ $request->arrivalTime }}">
    <input type="hidden" name="schDeparts[garudaNumber]" value="{{ $request->garudaNumber }}">
    <input type="hidden" name="schDeparts[garudaAvailability]" value="{{ $request->garudaNumber }}">

    <div class="container outline-top">
        <div class="row">
            <div class="col-md-8">

                <div class="panel panel-default">
                    <div class="panel-body">
                        <h4>Detail Pemesan</h4>
                        <hr>
                        <div class="row">
                            <div class="col-md-2">
                                <select class="form-control" name="pemesanTitle">
                                    <option value="MR">MR</option>
                                    <option value="MRS">MRS</option>
                                    <option value="MISS">MISS</option>
                                    <option value="MSTR">MSTR</option>
                                </select>
                            </div>

                            <div class="col-md-5">
                                <input required type="text" placeholder="Nama Depan" name="pemesanFirstName"
                                    class="form-control" value="">
                            </div>

                            <div class="col-md-5">
                                <input required type="text" placeholder="Nama Belakang" name="pemesanLastName"
                                    class="form-control" value="">
                            </div>
                        </div>

                        @auth
                        <div class="row" style="margin-top: 10px;">
                            <div class="col-md-6">
                                <input required type="email" placeholder="Alamat Email" name="pemesanEmail"
                                    class="form-control" value="{{ auth()->user()->email ?: '' }}">
                            </div>

                            <div class="col-md-6">
                                <input required type="tel" placeholder="No Telepon" name="pemesanTelepon"
                                    class="form-control" value="{{ auth()->user()->hp ?: '' }}">
                                format telepon : 085212341234
                            </div>
                        </div>
                        @else
                        <div class="row" style="margin-top: 10px;">
                            <div class="col-md-6">
                                <input required type="email" placeholder="Alamat Email" name="pemesanEmail"
                                    class="form-control">
                            </div>

                            <div class="col-md-6">
                                <input required type="tel" placeholder="No Telepon" name="pemesanTelepon"
                                    class="form-control">
                                format telepon : 085212341234
                            </div>
                        </div>
                        @endauth
                    </div>
                </div>

                <!-- Penumpang Dewasa -->
                @for ($i = 0; $i < $request->paxAdult; $i++)
                    <div class="panel panel-default" style="margin-top: 20px">
                        <div class="panel-body">
                            <h4>Penumpang Dewasa {{ $i+1 }}</h4>

                            <input type="hidden" name="pax[adult][{{ $i }}][IDNumber]" value="">

                            @if ($i == 0)
                            {{-- <div class="checkbox">
                                <label>
                                    <input type="checkbox"> Sama dengan pemesan
                                </label>
                            </div> --}}
                            @endif

                            <hr>
                            <div class="row">
                                <div class="col-md-3">
                                    <select required class="form-control" name="pax[adult][{{ $i }}][title]">
                                        <option value="MR">MR</option>
                                        <option value="MRS">MRS</option>
                                        <option value="MISS">MISS</option>
                                        <option value="MSTR">MSTR</option>
                                    </select>
                                </div>

                                <div class="col-md-3">
                                    <input required type="text" placeholder="Nama Depan"
                                        name="pax[adult][{{ $i }}][firstName]" class="form-control">
                                </div>
                                <div class="col-md-3">
                                    <input required type="text" placeholder="Nama Belakang"
                                        name="pax[adult][{{ $i }}][lastName]" class="form-control">
                                </div>

                                <div class="col-md-3">
                                    <select name="pax[adult][{{ $i }}][gender]" class="form-control">
                                        <option value="Male">Laki - Laki</option>
                                        <option value="Female">Perempuan</option>
                                    </select>
                                </div>

                            </div>

                            <div class="row" style="margin-top:20px">
                                <div class="col-md-6">
                                    <input type="text" name="pax[adult][{{ $i }}][birthDate]"
                                        class="form-control bots-date" placeholder="Tanggal Lahir" />
                                </div>
                            </div>

                            <input type="hidden" name="pax[adult][{{ $i }}][nationality]"
                                value="{{ $visitor->geoplugin_countryCode }}" />
                            <input type="hidden" name="pax[adult][{{ $i }}][birthCountry]"
                                value="{{ $visitor->geoplugin_countryCode }}" />
                            <input type="hidden" name="pax[adult][{{ $i }}][parent]" value="" />
                            <input type="hidden" name="pax[adult][{{ $i }}][passportNumber]" value="" />
                            <input type="hidden" name="pax[adult][{{ $i }}][passportIssuedCountry]" value="" />
                            <input type="hidden" name="pax[adult][{{ $i }}][passportIssuedDate]" value="" />
                            <input type="hidden" name="pax[adult][{{ $i }}][passportExpiredDate]" value="" />
                            <input type="hidden" name="pax[adult][{{ $i }}][type]" value="Adult">

                            <div class="row">

                                <input type="hidden" name="pax[adult][{{ $i }}][addOns][0][aoOrigin]"
                                    value="{{ $request->origin }}" />
                                <input type="hidden" name="pax[adult][{{ $i }}][addOns][0][aoDestination]"
                                    value="{{ $request->destination }}" />
                                <input type="hidden" name="pax[adult][{{ $i }}][addOns][0][seat]" value="" />
                                <input type="hidden" name="pax[adult][{{ $i }}][addOns][0][compartment]" value="" />

                                @if (count($baggages) > 0)
                                <div class="col-md-6">
                                    <h4>Bagasi</h4>
                                    <select name="pax[adult][{{ $i }}][addOns][0][baggageString]" class="form-control">
                                        @foreach ($baggages as $baggage)
                                        <option value="{{ $baggage->code }}">
                                            {{ $baggage->desc . ' - Rp. ' . number_format($baggage->fare, 2) }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                @endif

                                @if (count($meals) > 0)
                                <div class="col-md-6">
                                    <h4>Makanan</h4>
                                    <select name="pax[adult][{{ $i }}][addOns][0][meals]" class="form-control">
                                        <option value="">Pilih Makanan</option>
                                        @foreach ($meals as $meal)
                                        <option value="{{ $meal->code }}">
                                            {{ $meal->desc . ' - Rp. ' . number_format($meal->fare, 2) }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                @endif

                            </div>

                        </div>
                    </div>
                    @endfor

                    <!-- Penumpang Anak -->
                    @for ($i = 0; $i < $request->paxChild; $i++)
                        <div class="panel panel-default" style="margin-top: 20px">
                            <div class="panel-body">
                                <h4>Penumpang Anak {{ $i+1 }}</h4>

                                <input type="hidden" name="pax[child][{{ $i }}][IDNumber]" value="">

                                @if ($i == 0)
                                {{-- <div class="checkbox">
                                    <label>
                                        <input type="checkbox"> Sama dengan pemesan
                                    </label>
                                </div> --}}
                                @endif

                                <hr>
                                <div class="row">
                                    <div class="col-md-3">
                                        <select required class="form-control" name="pax[child][{{ $i }}][title]">
                                            <option value="MR">MR</option>
                                            <option value="MRS">MRS</option>
                                            <option value="MISS">MISS</option>
                                            <option value="MSTR">MSTR</option>
                                        </select>
                                    </div>

                                    <div class="col-md-3">
                                        <input required type="text" placeholder="Nama Depan"
                                            name="pax[child][{{ $i }}][firstName]" class="form-control">
                                    </div>
                                    <div class="col-md-3">
                                        <input required type="text" placeholder="Nama Belakang"
                                            name="pax[child][{{ $i }}][lastName]" class="form-control">
                                    </div>

                                    <div class="col-md-3">
                                        <select name="pax[child][{{ $i }}][gender]" class="form-control">
                                            <option value="Male">Laki - Laki</option>
                                            <option value="Female">Perempuan</option>
                                        </select>
                                    </div>

                                </div>

                                <div class="row" style="margin-top:20px">
                                    <div class="col-md-6">
                                        <input type="text" name="pax[child][{{ $i }}][birthDate]"
                                            class="form-control bots-date" placeholder="Tanggal Lahir" />
                                        Penumpang anak harus berusia di bawah 12 tahun.
                                    </div>
                                </div>

                                <input type="hidden" name="pax[child][{{ $i }}][nationality]"
                                    value="{{ $visitor->geoplugin_countryCode }}" />
                                <input type="hidden" name="pax[child][{{ $i }}][birthCountry]"
                                    value="{{ $visitor->geoplugin_countryCode }}" />
                                <input type="hidden" name="pax[child][{{ $i }}][parent]" value="" />
                                <input type="hidden" name="pax[child][{{ $i }}][passportNumber]" value="" />
                                <input type="hidden" name="pax[child][{{ $i }}][passportIssuedCountry]" value="" />
                                <input type="hidden" name="pax[child][{{ $i }}][passportIssuedDate]" value="" />
                                <input type="hidden" name="pax[child][{{ $i }}][passportExpiredDate]" value="" />
                                <input type="hidden" name="pax[child][{{ $i }}][type]" value="Child">

                                <div class="row">

                                    <input type="hidden" name="pax[child][{{ $i }}][addOns][0][aoOrigin]"
                                        value="{{ $request->origin }}" />
                                    <input type="hidden" name="pax[child][{{ $i }}][addOns][0][aoDestination]"
                                        value="{{ $request->destination }}" />
                                    <input type="hidden" name="pax[child][{{ $i }}][addOns][0][seat]" value="" />
                                    <input type="hidden" name="pax[child][{{ $i }}][addOns][0][compartment]" value="" />

                                    @if (count($baggages) > 0)
                                    <div class="col-md-6">
                                        <h4>Bagasi</h4>
                                        <select name="pax[child][{{ $i }}][addOns][0][baggageString]"
                                            class="form-control">
                                            @foreach ($baggages as $baggage)
                                            <option value="{{ $baggage->code }}">
                                                {{ $baggage->desc . ' - Rp. ' . number_format($baggage->fare, 2) }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @endif

                                    @if (count($meals) > 0)
                                    <div class="col-md-6">
                                        <h4>Makanan</h4>
                                        <select name="pax[child][{{ $i }}][addOns][0][meals]" class="form-control">
                                            <option value="">Pilih Makanan</option>
                                            @foreach ($meals as $meal)
                                            <option value="{{ $meal->code }}">
                                                {{ $meal->desc . ' - Rp. ' . number_format($meal->fare, 2) }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @endif

                                </div>

                            </div>
                        </div>
                        @endfor

                        <!-- Penumpang Bayi -->
                        @for ($i = 0; $i < $request->paxInfant; $i++)
                            <div class="panel panel-default" style="margin-top: 20px">
                                <div class="panel-body">
                                    <h4>Penumpang Bayi {{ $i+1 }}</h4>

                                    <input type="hidden" name="pax[infant][{{ $i }}][IDNumber]" value="">

                                    @if ($i == 0)
                                    {{-- <div class="checkbox">
                                    <label>
                                        <input type="checkbox"> Sama dengan pemesan
                                    </label>
                                </div> --}}
                                    @endif

                                    <hr>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <select required class="form-control" name="pax[infant][{{ $i }}][title]">
                                                <option value="MR">MR</option>
                                                <option value="MRS">MRS</option>
                                                <option value="MISS">MISS</option>
                                                <option value="MSTR">MSTR</option>
                                            </select>
                                        </div>

                                        <div class="col-md-3">
                                            <input required type="text" placeholder="Nama Depan"
                                                name="pax[infant][{{ $i }}][firstName]" class="form-control">
                                        </div>
                                        <div class="col-md-3">
                                            <input required type="text" placeholder="Nama Belakang"
                                                name="pax[infant][{{ $i }}][lastName]" class="form-control">
                                        </div>

                                        <div class="col-md-3">
                                            <select name="pax[infant][{{ $i }}][gender]" class="form-control">
                                                <option value="Male">Laki - Laki</option>
                                                <option value="Female">Perempuan</option>
                                            </select>
                                        </div>

                                    </div>

                                    <div class="row" style="margin-top:20px">
                                        <div class="col-md-6">
                                            <input type="text" name="pax[infant][{{ $i }}][birthDate]"
                                                class="form-control bots-date" placeholder="Tanggal Lahir" />
                                            Penumpang bayi harus berusia di atas 3 bulan dan di bawah 2 tahun.
                                        </div>
                                        <div class="col-md-6">
                                            <select name="pax[infant][{{ $i }}][parent]" class="form-control">
                                                @for ($j = 0; $j < $request->paxAdult; $j++)
                                                    <option value="{{ $j }}">Penumpang Dewasa {{ $j + 1 }}</option>
                                                    @endfor
                                            </select>
                                        </div>
                                    </div>

                                    <input type="hidden" name="pax[infant][{{ $i }}][nationality]"
                                        value="{{ $visitor->geoplugin_countryCode }}" />
                                    <input type="hidden" name="pax[infant][{{ $i }}][birthCountry]"
                                        value="{{ $visitor->geoplugin_countryCode }}" />
                                    <input type="hidden" name="pax[infant][{{ $i }}][passportNumber]" value="" />
                                    <input type="hidden" name="pax[infant][{{ $i }}][passportIssuedCountry]" value="" />
                                    <input type="hidden" name="pax[infant][{{ $i }}][passportIssuedDate]" value="" />
                                    <input type="hidden" name="pax[infant][{{ $i }}][passportExpiredDate]" value="" />
                                    <input type="hidden" name="pax[infant][{{ $i }}][type]" value="Infant">

                                    <div class="row">

                                        <input type="hidden" name="pax[infant][{{ $i }}][addOns][0][aoOrigin]"
                                            value="{{ $request->origin }}" />
                                        <input type="hidden" name="pax[infant][{{ $i }}][addOns][0][aoDestination]"
                                            value="{{ $request->destination }}" />
                                        <input type="hidden" name="pax[infant][{{ $i }}][addOns][0][seat]" value="" />
                                        <input type="hidden" name="pax[infant][{{ $i }}][addOns][0][compartment]"
                                            value="" />

                                    </div>

                                </div>
                            </div>
                            @endfor

                            <div class="row" style="margin-bottom: 20px;">
                                <div class="col-md-4 col-md-offset-8">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        Lanjutkan Ke Pembayaran
                                    </button>
                                </div>
                            </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h4>Penerbangan</h4>
                        <b>
                            {{ $cityOrigin->location_name }} -
                            {{ $cityDestination->location_name }}
                        </b> <br>
                        <img src="{{ asset('img/airline/' . $request->airlineID . '.jpg') }}" alt="" width="50">
                        {{ $request->origin }} - {{ $request->destination }}
                        @php
                        $date = date_create($request->departTime);
                        @endphp
                        {{ date_format($date, '- D, d-m-Y') }}
                        <br><br><br>

                        <p><b>Detail Harga</b></p>
                        @foreach ($prices->priceDepart[0]->priceDetail as $price)

                        @if($price->paxType == 'Adult')
                        <b>{{ $price->paxType . ' x' . $request->paxAdult }}</b> <br>
                        {{ 'Harga Pokok'  }} Rp {{ number_format($price->baseFare, 2) }}<br>
                        {{ 'Pajak' }} Rp {{ number_format($price->tax, 2) }}<br>
                        <b>{{ 'Jumlah' }}</b> Rp {{ number_format($price->totalFare, 2) }}<br><br>
                        @endif

                        @if($price->paxType == 'Child')
                        <b>{{ $price->paxType . ' x' . $request->paxChild }}</b> <br>
                        {{ 'Harga Pokok' }} Rp {{ number_format($price->baseFare, 2) }}<br>
                        {{ 'Pajak'  }} Rp {{ number_format($price->tax, 2) }}<br>
                        <b>{{ 'Jumlah' }}</b> Rp {{ number_format($price->totalFare, 2) }}<br><br>
                        @endif

                        @if($price->paxType == 'Infant')
                        <b>{{ $price->paxType . ' x' . $request->paxInfant }}</b> <br>
                        {{ 'Harga Poko' }} Rp {{ number_format($price->baseFare, 2) }}<br>
                        {{ 'Pajak' }} Rp {{ number_format($price->tax, 2) }}<br>
                        <b>{{ 'Jumlah' }}</b> Rp {{ number_format($price->totalFare, 2) }}<br><br>
                        @endif
                        @endforeach
                        <br><br><br>
                        <hr>
                        <b>Total Pembayaran</b> Rp. {{ number_format($prices->sumFare, 2) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
