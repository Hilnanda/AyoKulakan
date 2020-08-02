
<div class="modal-body">
	<div class="content-ayokulakan">
		<form id="dataFormModal" action="{{ url($pageUrl.'pembayaran') }}" method="POST">
			{!! csrf_field() !!}
			<div class="">
				<h4>My Wishlist</h4>
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
										<h3 class="name">
											@if($v->form_type == 'img_barang')
											{{ $v->form->nama_barang or '' }}
											@endif 
										</h3>
										<div class="rating rateit-small rateit">
											<div class="form-group custom-control custom-checkbox">
												<input type="checkbox" class="custom-control-input " id="customCheck{{$k}}" name="accept[barang][{{$v->id}}]" value="{{ $v->id }}">
												<label class="custom-control-label" for="customCheck{{$k}}">
													@if($v->form_type == 'img_barang')
													{{ $v->form->lapak->nama_lapak or '' }}
													@endif
												</label>
											</div>
										</div>
											<span class="price">
												<div class="price appendTotalHarga{{$v->id}}">Rp. 
													@if($v->form_type == 'img_barang')
													{{ $v->form->harga_barang * $v->jumlah_barang }}
													@endif 
												</div>
											</span>
																	
										<div class="description m-t-10">
											<div class="col-md-8">
												<input type="number" name="accept[jumlah_barang][{{$v->id}}]" value="{{ $v->jumlah_barang or '' }}" class="form-control front-ampass-jml" data-harga="@if($v->form_type == 'img_barang')
														{{ $v->form->harga_barang or '' }}
														@endif 
														" data-key="{{$v->id}}" min="0" {{ ($v->form_type == 'img_daftar_haji') ? 'disabled' : '' }} >
											</div>
											<div class="col-md-4">
												<div class="btn btn-danger btn-sm btn-remove-keranjang ampass remove-cart" data-id="{{$v->id}}" data-url="{{ url('keranjang/hapus') }}" ><i class="fa fa-times"></i></div>
																								
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
			</form>
	</div>
	<div class="modal-footer">
		<div class="col-md-6 pull-left" style="text-align: left;">
			<h4>Total Belanja : Rp. <span class="sub-total">0</span></h4>
			<i>Belum Termasuk Ongkos Kirim</i>
		</div>
		<div class="col-md-6" style="position: relative;top: 15px;">
			@if($record->count() > 0)
			<button type="button" class="btn btn-success save-modal save-frontend next-page pull-right"><i class="ion-ios-paper"></i> Lanjutkan Pembayaran</button>
			@endif
		</div>
	</div>
</div>
