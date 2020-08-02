<div class="checkout-progress-sidebar ">
    <div class="panel-group">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="unicase-checkout-title">Pilih Tipe Pengiriman</h4>
            </div>
            <div class="panel-body">
                <div class="row">
                    @if($cekCost)
                        @if($cekCost->results)
                            @if(count($cekCost->results) > 0)
                                @foreach($cekCost->results as $k => $value)

                                    @if($value->costs)
                                        @if(count($value->costs) > 0)
                                            @foreach($value->costs as $k1 => $value1)
                                                @if($value1->cost)
                                                    @if(count($value1->cost) > 0)
                                                        @foreach($value1->cost as $k2 => $value2)
                                                        <div class="col-md-4">
                                                            <div class="input-group">
                                                                <span class="input-group-addon" >
                                                                    <input type="radio" class="tipeKurir" data-harga="{{ $value2->value }}" data-hari="{{ $value2->etd }}" data-lapak="{{ $lapak->id }}" name="item_details[{{ $lapak->id }}][kurir_tipe_child]" aria-label="..." value="{{ $value->name }} - ({{ $value1->description }})" style="transform: scale(1.4);">
                                                                </span>
                                                            </div>
                                                            <div class="panel panel-default panel panel-body">
                                                                <h4 class="heading-title">{{ $value->name }} - ({{ $value1->description }})</h4>
                                                                <h6 class="">Harga - ({{ $value2->value }}) | Pengiriman - ({{ $value2->etd }} Hari)</h6>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                    @endif
                                                @endif
                                            @endforeach

                                        @endif
                                    @endif
                                @endforeach
                            @endif
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>