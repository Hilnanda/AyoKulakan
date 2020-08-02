
<div class="modal-body">
	<div class="content-ayokulakan">
		<!-- <form id="dataFormModal" action="{{ url($pageUrl.'pembayaran') }}" method="POST"> -->
			{!! csrf_field() !!}
			<div class="">
				<h4>Favorit Barang</h4>
				<div class="category-product">
				@if($record->count() > 0)
				@foreach($record as $k => $v)	
				<div class="category-product-inner " style="">
					<div class="products">				
			            <div class="product-list product">
			            	<div class="row product-list-row">
								<div class="col col-sm-4 col-lg-4">
									<div class="product-image">
										<div class="image">
											<center><img src="{{ ($v->form->attachments->first()) ? url('storage/'.$v->form->attachments->first()->url) : url('img/no-images.png') }}" alt="" style="width: 230px"></center>
										</div>
									</div><!-- /.product-image -->
								</div><!-- /.col -->
								<div class="col col-sm-8 col-lg-8">
									<div class="product-info">
										@if($v->form_type == 'img_barang')
											<a href="{{ url('sc/barang/'.$v->id_barang) }}" title=""><h3 class="name">
												{{ $v->form->nama_barang or '' }}
											</h3></a>
										@elseif($v->form_type == 'img_rental')
										<a href="{{ url('sc/sewa/'.$v->id_barang) }}" title=""><h3 class="name">
											{{ $v->form->judul or '' }}
										</h3></a>
										@else
										{{ $v->form->jadwal->judul or '' }}<br>Keberangkatan : ({{ $v->form->jadwal->tgl_berangkat or '' }} - {{ $v->form->jadwal->tgl_pulang or '' }})
										@endif 
										
										<div class="rating rateit-small rateit">
											<div class="form-group custom-control custom-checkbox">
												<i class="fa fa-star"></i>
												<label class="custom-control-label" for="customCheck{{$k}}">
													@if($v->form_type == 'img_barang')
													{{ $v->form->lapak->nama_lapak or '' }}
													@elseif($v->form_type == 'img_rental')
													{{ $v->form->user->nama or '' }}
													@else
													Paket : {{ $v->form->paket->type_paket or '' }}
													@endif
												</label>
											</div>
										</div>
											<span class="price">
												<div class="price appendTotalHarga{{$v->id}}">Rp. 
													@if($v->form_type == 'img_barang')
													{{ $v->form->harga_barang * $v->jumlah_barang }}
													@elseif($v->form_type == 'img_rental')
													{{ $v->form->harga_sewa * $v->jumlah_barang }}
													@else
													{{ $v->form->jadwal->harga or '' }}
													@endif 
												</div>
											</span>
																	
										<div class="description m-t-10 pull-right">
											<div class="col-md-12">
												<div class="btn btn-danger btn-sm btn-remove-keranjang ampass remove-cart" data-id="{{$v->id}}" data-url="{{ url('favorit/hapus') }}" ><i class="fa fa-times"></i></div>
																								
											</div>
										</div>
						               		
									</div><!-- /.product-info -->	
								</div><!-- /.col -->
							</div>
			            </div>
			        </div>
			    </div><hr>
			    @endforeach
			    @endif
				</div>
			</div>
			<!-- </form> -->
	</div>
	<div class="modal-footer">
	
	</div>
</div>
