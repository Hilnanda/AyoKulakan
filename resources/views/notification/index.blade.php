@if($record)
    @if($record->count() > 0)
        @foreach($record as $k => $value)
            <li>
                <div class="single-shop-cart-wrapper" >
                    <div class="row">
                        <div class="col-sm-2">
                            @if($value->review == 1)
                                <i class="ion-android-notifications" style="font-size: 50px;color: #fd842b;"></i>
                            @else
                                <i class="ion-android-notifications-none" style="font-size: 50px;"></i>
                            @endif
                        </div>
                        <div class="col-md-10" style="text-align: left;">
                            <a href="javascript:void(0)" class="show-front shows" data-url="{{ url($pageUrl.$value->id.'/2') }}" style="font-size: 13px"><b><u>{{ $value->judul or '' }}</u></b></a>
                            <p class="mb-1">{{ $value->message or '' }}</p>
                            <small class="pull-right">{{ $value->creationDate() }}</small>
                        </div>
                    </div>
                </div>
            </li><hr>
        @endforeach
    @else
        <li>
            <div class="shop-cart-btn">
                <span>empty</span>
            </div>
        </li>
    @endif
@else
    <li>
        <div class="shop-cart-btn">
            <span>empty</span>
        </div>
    </li>
@endif
<li>
    <div class="shop-cart-btn">
        <a href="javascript:void(0)" class="show-front shows" data-url="{{ url($pageUrl.'show-all') }}">Lihat Semua Notifikasi <sup>{{ $count }}</sup></a>
    </div>
</li>