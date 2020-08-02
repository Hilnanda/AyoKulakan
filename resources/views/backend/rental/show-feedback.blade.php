<script type="text/javascript">
	

</script>
<div class="modal-body">
	<div class="body-content outer-top-xs content-ayokulakan">
		<div class="row single-product">
			<div class="detail-block">
				<div class="row " style="">
	                <div class="col-xs-12 col-sm-6 col-md-5 gallery-holder">
					    <div class="product-item-holder size-big single-product-gallery small-gallery">
					        <div id="owl-single-product">
					        	@if($record->attachments)
					        		@if($record->attachments->count() > 0)
						        		@foreach($record->attachments as $k => $value)
						        		@if($k==0)
								            <div class="single-product-gallery-item active" id="slide1">
								                <a data-lightbox="image-1" data-title="Gallery" href="{{ url('storage/'.$value->url) }}">
								                    <img class="img-responsive" alt="" src="{{ url('storage/'.$value->url) }}" data-echo="{{ url('storage/'.$value->url) }}" />
								                </a>
								            </div>
								        @else
								        	<div class="single-product-gallery-item" id="slide{{$k}}" style="display: none">
								                <a data-lightbox="image-1" data-title="Gallery" href="{{ url('storage/'.$value->url) }}">
								                    <img class="img-responsive" alt="" src="{{ url('storage/'.$value->url) }}" data-echo="{{ url('storage/'.$value->url) }}" />
								                </a>
								            </div>
								        @endif
						            @endforeach
						            @else
						            	<div class="single-product-gallery-item" id="slide1" style="display: none">
							                <a data-lightbox="image-1" data-title="Gallery" href="{{ asset('img/no-images.png') }}">
							                    <img class="img-responsive" alt="" src="{{ asset('img/no-images.png') }}" data-echo="{{ asset('img/no-images.png') }}" />
							                </a>
							            </div>
						            @endif
						         @else
					            	<div class="single-product-gallery-item" id="slide1" style="display: none">
						                <a data-lightbox="image-1" data-title="Gallery" href="{{ asset('img/no-images.png') }}">
						                    <img class="img-responsive" alt="" src="{{ asset('img/no-images.png') }}" data-echo="{{ asset('img/no-images.png') }}" />
						                </a>
						            </div>
						        @endif
						    </div>

					        <div class="single-product-gallery-thumbs gallery-thumbs">
					            <div id="owl-single-product-thumbnails">
					                <div class="row">
					                	@if($record->attachments)
							        		@if($record->attachments->count() > 0)
								        		@foreach($record->attachments as $k => $value)
								        		@if($k==0)
										            <div class="col-sm-2"> 
									                    <a class="horizontal-thumb active" data-target="#owl-single-product" data-slide="1" href="#slide1">
									                        <img class="img-responsive" width="85" alt="" src="{{ url('storage/'.$value->url) }}" data-echo="{{ url('storage/'.$value->url) }}" />
									                    </a>
								                    </div>
										        @else
										        	<div class="col-sm-2"> 
									                    <a class="horizontal-thumb active" data-target="#owl-single-product" data-slide="{{$k}}" href="#slide{{$k}}">
									                        <img class="img-responsive" width="85" alt="" src="{{ url('storage/'.$value->url) }}" data-echo="{{ url('storage/'.$value->url) }}" />
									                    </a>
								                    </div>
										        @endif
								            @endforeach
								            @else
								            	<div class="col-sm-2"> 
								                    <a class="horizontal-thumb active" data-target="#owl-single-product" data-slide="1" href="#slide1">
								                        <img class="img-responsive" width="85" alt="" src="{{ asset('img/no-images.png') }}" data-echo="{{ asset('img/no-images.png') }}" />
								                    </a>
							                    </div>
								            @endif
								         @else
							            	<div class="col-sm-2"> 
							                    <a class="horizontal-thumb active" data-target="#owl-single-product" data-slide="1" href="#slide1">
							                        <img class="img-responsive" width="85" alt="" src="{{ asset('img/no-images.png') }}" data-echo="{{ asset('img/no-images.png') }}" />
							                    </a>
						                    </div>
								        @endif
					                </div>
					            </div>
					        </div>
					    </div>
					</div>
					<div class='col-sm-6 col-md-7 product-info-block'>
						<div class="product-info">
							<h1 class="name">{{ $record->judul or '' }}</h1>
							
							<div class="rating-reviews m-t-20">
								<div class="row">
									<div class="col-sm-3">
										<div class="rating">
											@php
												$totalStar = 0;
											@endphp
											@if($record->feedback)
												@if($record->feedback()->where('form_type','=','img_rental')->count() > 0)
												@php
													$totalStar = $record->feedback()->where('form_type','=','img_rental')->sum('rate') / $record->feedback()->where('form_type','=','img_rental')->count();
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
													<span><i class="fa fa-star-o"></i></span>
                                        		@endfor
											@endif
										</div>
									</div>
									<div class="col-sm-8">
										<div class="reviews">
											<span class="lnk pull-left">({{$totalStar}} Reviews)</span>
										</div>
									</div>
								</div>
							</div>

							<div class="stock-container info-container m-t-10">
								<div class="row">
									<div class="col-sm-2">
										<div class="stock-box">
											<span class="label"><b>Tersedia</b> : {{ $record->unit or '0' }}</span>
										</div>	
									</div>
									<div class="col-sm-9">
										<div class="stock-box">
											<span class="value"> &nbsp;&nbsp;Stock</span>
										</div>	
									</div>
									<div class="col-sm-2">
										<div class="stock-box">
											<span class="label"><b>Tersewa</b> : {{ $record->unit_tersewa or '0' }}</span>
										</div>	
									</div>
									<div class="col-sm-9">
										<div class="stock-box">
											<span class="value">Stock</span>
										</div>	
									</div>
									<div class="col-sm-12">
										<div class="stock-box">
											<span class="label"><b>Kategori</b> : {{ $record->kategori->nama or '0' }}</span>
										</div>	
									</div>
									<div class="col-sm-2">
										<div class="stock-box">
											<span class="label"><b>Lapak</b> : </span>
										</div>	
									</div>
									<div class="col-sm-9">
										<div class="stock-box">
											<span class="value">{{ $record->user->lapak->nama_lapak or '' }}</span>
										</div>	
									</div>
									<div class="col-sm-2">
										<div class="stock-box">
											<span class="label"><b>Lokasi</b> : </span>
										</div>	
									</div>
									<div class="col-sm-9">
										<div class="stock-box">
											<span class="value">{{ $record->user->provinsi->provinsi or '' }}</span>
										</div>	
									</div>
								</div>
							</div>

							<div class="description-container m-t-20">
								<p>{!! $record->keterangan or '' !!}</p>
							</div>

							<div class="price-container info-container m-t-20">
								<div class="row">
									

									<div class="col-sm-6">
										<div class="price-box">
											<span class="price">Rp. {{ $record->harga_sewa or '' }}</span>
											{{-- <span class="price-strike">$900.00</span> --}}
										</div>
									</div>
								</div>
							</div>

							
						</div>
					</div>
				</div>
	        </div>

	        <div class="product-tabs inner-bottom-xs">
					<div class="row">
						<div class="col-sm-3">
							<ul id="product-tabs" class="nav nav-tabs nav-tab-cell">
								<li class="active"><a data-toggle="tab" href="#review">ULASAN</a></li>
							</ul><!-- /.nav-tabs #product-tabs -->
						</div>
						<div class="col-sm-9">
							<div class="tab-content">
								<div id="review" class="tab-pane in active">
									<div class="product-tab">
									@if($record->feedback)
                                		@if($record->feedback()->where('form_type','=','img_rental')->count() > 0)
                                		@foreach($record->feedback()->where('form_type','=','img_rental')->get() as $k => $value)

										<div class="product-reviews">
											<div class="row">
												<div class="col-md-1">
													@if($value->user->pictureusers)
	                                            		@if($value->user->pictureusers->count() > 0)

	                                                		<img src="{{ ($value->user->pictureusers->sortByDesc('created_at')->first()) ? url('storage/'.$value->user->pictureusers->sortByDesc('created_at')->first()->url) : asset('img/users.png') }}" alt="Ayokulakan" style="width: 50px;height: 50px;">
	                                            		@else
	                                            			<img src="{{ asset('img/users.png') }}" alt="Ayokulakan" style="width: 50px;height: 50px;">
	                                            		@endif
	                                            	@else
	                                            		<img src="{{ asset('img/users.png') }}" alt="Ayokulakan" style="width: 50px;height: 50px;">
	                                            	@endif

												</div>
												<div class="col-md-10" style="top: 15px">
													<h4 class="title" style="vertical-align: center">{{ $value->user->nama or '' }}</h4>
												</div>
											</div>
											<div class="reviews">
												<div class="review">
													<div class="review-title"><span class="summary">
														@if( (int)$value->rate == 5 )
	                                                		@for($i = 0; $i < (int)$value->rate; $i++)
																<span><i class="fa fa-star" style="color:#ff7429;"></i></span>
	                                                		@endfor
                                                		@else
                                                			@php
                                                				$cekRate = 5 - (int)$value->rate;
                                                			@endphp
                                                			@for($i = 0; $i < (int)$value->rate; $i++)
																<span><i class="fa fa-star" style="color:#ff7429;"></i></span>
	                                                		@endfor

	                                                		@for($i1 = 0; $i1 < $cekRate; $i1++)
																<span><i class="fa fa-star-o"></i></span>
	                                                		@endfor
	                                                	@endif
													</span>
													<span class="date"><i class="fa fa-calendar"></i><span>{{ $value->created_at or '' }}</span></span></div>
													<div class="text"><p>"{!! $value->message or '' !!}"</p></div>
												</div>
											</div><!-- /.reviews -->
										</div><!-- /.product-reviews -->
										@endforeach
										@else
										<div class="product-reviews">
											<div class="row">
												<center><h4 class="title" style="vertical-align: center">Tidak Ada Ulasan</h4></center>
											</div>
										</div>
										@endif

									@else
										<div class="product-reviews">
											<div class="row">
												<center><h4 class="title" style="vertical-align: center">Tidak Ada Ulasan</h4></center>
											</div>
										</div>
									@endif

							        </div><!-- /.product-tab -->
								</div><!-- /.tab-pane -->
							</div><!-- /.tab-content -->
						</div><!-- /.col -->
					</div><!-- /.row -->
				</div><!-- /.product-tabs -->
	    </div>
	</div>
</div>


