
	<div class="row">
		@if($records->count() > 0)
		@foreach($records as $key => $v)
		 <div class="col-6 col-xs-6 col-md-2 wow fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;width:207;height: 300px">
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
                        <h3 class="name">{{ $v->nama_barang or '-' }}</h3>
                        
                        <div class="description"><i class="fa fa-map-marker"></i> {{ $v->lapak->provinsi->provinsi or '-' }}</div>

                        <div class="product-price"> 
                            <span class="price">
                             Rp. {{ $v->harga_barang or '0' }} 
                            </span><br>
                            <span class="price">
                               
                                @php
                                    $totalStar = 0;
                                @endphp
                                @if($v->feedback)
                                    @if($v->feedback()->where('form_type','=','img_barang')->count() > 0)
                                        @php
                                            $totalStar = $v->feedback()->where('form_type','=','img_barang')->sum('rate') / $v->feedback()->where('form_type','=','img_barang')->count();
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
                                ( {{ $v->feedback()->where('form_type','=','img_barang')->count() }} )
                            </span>
                                {{-- <span class="price-before-discount">$ 800</span> --}}

                        </div>

                        </div>
                        <div class="cart clearfix animate-effect">
                        <div class="action" style="position: relative;left: -5px">
                            <ul class="list-unstyled">
                            
                                <li class="add-cart-button btn-group">
                                    <a href="javascript:void(0)" class="btn btn-warning show front-load-show" data-id="{{ $v->id }}" data-name="feedback">
                                        <i class="fa fa-eye"></i>              
                                    </a>
                                </li>
                                <li class="add-cart-button btn-group">
                                    <a href="javascript:void(0)" class="btn btn-success icon others-edit button" data-id="{{$v->id or ''}}" data-urls="edit-barang" data-titlemodal="Ubah Barang Jualan">
                                        <i class="fa fa-edit"></i>              
                                    </a>
                                </li>
                                <li class="add-cart-button btn-group">
                                    <a href="javascript:void(0)" class="btn btn-danger others-deletes button" data-id="{{$v->id or ''}}" data-url="hapus-barang">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
		@endforeach
		@else
			<div class="col-sm-12">
				<div class="single-product-area">
					<div class="product-wrapper listview">
						<center>DATA BARANG YANG DI JUAL KOSONG</center>
					</div>
				</div>
			</div>
		@endif
	</div>

<div>
	{!! $records->links('partials.pagination.frontend-pagination') !!}
</div>