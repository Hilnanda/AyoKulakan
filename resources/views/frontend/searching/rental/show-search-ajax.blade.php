<div class="row ">
    @if($record->count() > 0)
    @foreach($record as $k => $v)
    <div class="col-2 col-xs-6 col-md-2 wow fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;width:207;height: 350px">
        <div class="products">
            <div class="product">
                <div class="product-image">
                    <div class="image">
                        @if($v->attachments->count() > 0)
                        <img src="{{ url('storage/'.$v->attachments->first()->url) }}" alt="" style="height: 100px">
                        @else
                        <img src="{{ asset('img/no-images.png') }}" alt="" style="height: 100px">
                        @endif
                    </div>
                    <div class="tag new"><span>new</span></div>
                </div>
                <div class="product-info text-left">
                    @if(isset($v->judul))
                        @if(strlen($v->judul) > 50)
                            <h3 class="name">{{ substr($v->judul,0,50) }}</h3>
                        @else
                            <h3 class="name">{{ $v->judul or '-' }}</h3>
                        @endif
                    @else
                        <h3 class="name">{{ $v->judul or '-' }}</h3>
                    @endif

                    <div class="description"><i class="fa fa-map-marker"></i> {{ $v->lapak->provinsi->provinsi or '-' }}</div>

                    <div class="product-price">
                        <span class="price">
                           Rp. {{ number_format($v->harga_sewa, 0, ',', '.') }}
                       </span><br>
                       <span class="price">
                        @php
                        $totalStar = 0;
                        @endphp
                        @if($v->feedback)
                        @if($v->feedback()->where('form_type','=','img_rental')->count() > 0)
                        @php
                        $totalStar = $v->feedback()->where('form_type','=','img_rental')->sum('rate') / $v->feedback()->where('form_type','=','img_rental')->count();
                        @endphp
                        @endif
                        @endif
                        @if($totalStar > 0)
                        @php
                        $cekStar = 5 - $totalStar;
                        @endphp
                        @for($i = 0; $i < $totalStar; $i++)
                        <span><i class="fa fa-star" style="color:#ff7429;"></i></span>
                        @endfor

                        @for($i1 = 0; $i1 < $cekStar; $i1++)
                        <span><i class="fa fa-star-o"></i></span>
                        @endfor

                        @else
                        @for($i = 0; $i < 5; $i++)
                        <span><i class="fa fa-star-o" ></i></span>
                        @endfor
                        @endif
                    </span>
                    <span class="price-before-discount">( {{ $v->feedback()->where('form_type','=','img_rental')->count() }} )</span>

                </div>

            </div>
            <div class="cart clearfix animate-effect">
                <div class="action" style="position: relative;left: 20px">
                    <ul class="list-unstyled">
                        <li class="add-cart-button btn-group">
                            <a href="javascript:void(0)" class="sharp-show show front-load-show buttons showing btn btn-primary icon" data-name="{{ slugify($v->judul) }}" data-id="{{ $v->id or '' }}">
                                <i class="fa fa-eye"></i>
                            </a>
                        </li>
                        <li class="lnk wishlist">
                            <a href="javascript:void(0)" title="Tambahi" class="ampass add-cart" data-item="{{ $v->id or '' }}" data-type="img_rental">
                                <i class="fa fa-shopping-cart"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
@endif
</div>
<div class="row ">
    <div class="pull-right">
     {!! $record->links('partials.pagination.frontend-pagination') !!}
 </div>
</div>
