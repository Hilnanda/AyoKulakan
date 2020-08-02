<script type="text/javascript">
	
// Init function
$.fn.magicRatingInit = function(config) {

    // Init each widget return by the selector
    for (widget of $(this)) {
        var magicRatingWidget = $(widget);
        //// Get datas ////
        // Icon +
        if (magicRatingWidget.data("iconGood") == null) {
            magicRatingWidget.data("iconGood", config.iconGood != null ? config.iconGood : "fa-star");
        };

        // Icon -
        if (magicRatingWidget.data("iconBad") == null) {
            magicRatingWidget.data("iconBad", config.iconBad != null ? config.iconBad : "fa-star-o");
        };

        // Max mark
        if (magicRatingWidget.data("maxMark") == null) {
            magicRatingWidget.data("maxMark", config.maxMark != null ? config.maxMark : 5);
        }

        /*
        console.log(magicRatingWidget.data("iconGood"));
        console.log(magicRatingWidget.data("iconBad"));
        */

        // Clear the widget
        magicRatingWidget.html("");

        // Init icons
        for (i = 1; i <= magicRatingWidget.data("maxMark"); i++) {
            if (i <= magicRatingWidget.data("currentRating")) {
                magicRatingWidget.append('<i class=" ' + magicRatingWidget.data("iconGood") + ' magic-rating-icon" aria-hidden="true" data-default=true data-rating=' + i + '></i>');
            } else {
                magicRatingWidget.append('<i class=" ' + magicRatingWidget.data("iconBad") + ' magic-rating-icon" aria-hidden="true" data-default=false data-rating=' + i + '></i>');
            }
        }

        // Init reset handler
        magicRatingWidget.on("mouseleave", function() {
            var widget = $(this);
            /*
            console.log("mouseleave");
            console.log(widget.data("iconGood"));
            console.log(widget.data("iconBad"));
            */
            widget.children().each(function() {
                var icon = $(this);
                if (icon.data("default") && !icon.hasClass("fa-star")) {
                    icon.removeClass(widget.data("iconBad"));
                    icon.addClass(widget.data("iconGood"));
                } else if (!icon.data("default") && !icon.hasClass("fa-star-o")) {
                    icon.removeClass(widget.data("iconGood"));
                    icon.addClass(widget.data("iconBad"));
                }
            });
        });

        // Init click handler
        magicRatingWidget.on("click", ".magic-rating-icon", function() {
            // Get rating
            var icon = $(this);
            var widget = icon.parent();
            var rating = icon.data("rating");
            /*
            console.log("click");
            console.log(widget.data("iconGood"));
            console.log(widget.data("iconBad"));
            */
            // Update rating
            widget.children().each(function() {
                if ($(this).data("rating") <= rating) {
                    if (!$(this).hasClass(widget.data("iconGood"))) {
                        $(this).removeClass(widget.data("iconBad"));
                        $(this).addClass(widget.data("iconGood"));
                    };
                    $(this).data("default", true);
                } else {
                    if (!$(this).hasClass(widget.data("iconBad"))) {
                        $(this).removeClass(widget.data("iconGood"));
                        $(this).addClass(widget.data("iconBad"));
                    }
                    $(this).data("default", false);
                }
            });

            var callbackSuccess = config.success.bind(null, widget, rating);
            callbackSuccess();
        });

        // Init hover icons
        magicRatingWidget.on("mouseenter", ".magic-rating-icon", function() {
            var icon = $(this);
            var rating = icon.data("rating");
            var widget = icon.parent();
            /*
            console.log("mouseenter");
            console.log(widget.data("iconGood"));
            console.log(widget.data("iconBad"));
            */
            widget.children().each(function() {
                if ($(this).data("rating") <= rating) {
                    if (!$(this).hasClass(widget.data("iconGood"))) {
                        $(this).removeClass(widget.data("iconBad"));
                        $(this).addClass(widget.data("iconGood"));
                    };
                } else {
                    if (!$(this).hasClass(widget.data("iconBad"))) {
                        $(this).removeClass(widget.data("iconGood"));
                        $(this).addClass(widget.data("iconBad"));
                    }
                }
            });
        });
    }
};
$(document).ready(function() {
            $('.rating').magicRatingInit({
                success: function(magicRatingWidget, rating) {
                	if($(magicRatingWidget).data('type') == 'img_barang'){
                		$('.img_barang'+$(magicRatingWidget).data('k')).val(rating);
                	}else{
                		$('.img_rental'+$(magicRatingWidget).data('k')).val(rating);
                	}
                },
                iconGood: "fa-bicycle",
                iconBad: "fa-car",
            });
            // $(".rating2").magicRatingInit({
            //     success: function(magicRatingWidget, rating) {
            //         alert(rating);
            //     }
            // })
        });
// Update for hover icons
</script>
<div class="modal-body">
	<div class="content-ayokulakan">
		<form id="dataFormModal" action="{{ url($pageUrl.'store') }}" method="POST">
			{!! csrf_field() !!}
			<div class="terms-conditions-page">
	            <div class="row">
	                <div class="col-md-12 terms-conditions">
	                    <h2 class="heading-title">Detail Belanja</h2>
	                    <div class="alert alert-success" role="alert">
						  <h4 class="alert-heading">Pesanan Anda!</h4>
						  	<div id="dismissing">
						  		<ul style="list-style-type: square;font-size: 13px">
									<li><a>No Order : {{ $record->trans->order_id or '' }}</a></li>
								  	<li><a>Nama Pemesan : {{ $record->trans->user->nama or '' }}</a></li>
								  	<li><a>Tanggal Pemesanan : <span class="badge badge-secondary" style="font-size: 12px">{{ DateToString($record->created_at) }} - {{ $record->created_at->format('h:m:i') }}</span></a></li>
								  	<li><a>Status Transaksi : <span class="badge badge-secondary" style="font-size: 12px">{{ $record->status or '' }}</span></a></li>

								</ul>
							</div>
								@if($record->trans->prepaid)
								<ul style="list-style-type: square;">
									<li><a>Tipe Pesanan : {{ $record->trans->prepaid->type or '' }}</a></li>
									<li><a>Pesanan : {{ $record->trans->prepaid->form->pulsa_nominal or '' }}</a></li>
									<li><a>No Pelanggan : {{ $record->trans->prepaid->pelanggan or '' }}</a></li>										  	
								  	<li><a>Harga : <span class="badge badge-secondary" style="font-size: 12px">{{ $record->trans->prepaid->ttl_harga or '' }}</span></a></li>
								  	<li><a>Biaya Admin : <span class="badge badge-secondary" style="font-size: 12px">{{ $record->trans->prepaid->biaya_admin or '-' }}</span></a></li>
								</ul>
								@elseif($record->trans->postpaid)
								<ul style="list-style-type: square;">
									<li><a>No Pelanggan : {{ $record->trans->postpaid->pelanggan or '' }}</a></li>										  	
									<li><a>Pelanggan : {{ $record->trans->postpaid->tr_name or '' }}</a></li>	

									<li><a>Tipe Pesanan : {{ $record->trans->postpaid->type or '' }} ({{ $record->trans->postpaid->server or '' }}) </a></li>
										@if($record->trans->postpaid->form)
											<li><a>Pesanan : {{ $record->trans->postpaid->form->province or '' }} ({{ $record->trans->postpaid->form->name or '' }})</a></li>
										@endif
										@if(isset($record->trans->postpaid->period) && !is_null($record->trans->postpaid->period))
											<li><a>Periode : {{ \Carbon\Carbon::parse($record->trans->postpaid->period)->format('Y-m') }}</a></li>	
										@endif
								  	<li><a>Harga : <span class="badge badge-secondary" style="font-size: 12px">{{ $record->trans->postpaid->ttl_harga or '' }}</span></a></li>
								  	<li><a>Biaya Admin : <span class="badge badge-secondary" style="font-size: 12px">{{ $record->trans->postpaid->biaya_admin or '-' }}</span></a></li>
								</ul>
								@elseif($record->trans->detail)
									@if($record->trans->detail->count() > 0)
										<div class="row">
										@foreach($record->trans->detail as $k => $value)
											@if($value->form_type == 'img_barang')
												<div class="col-md-6">
													<ul style="list-style-type: square;">
														<li><a><b>Nama Pesanan : {{ $value->form->nama_barang or '' }}</b></a></li>			<li><a>Jumlah Pesanan : {{ $value->jumlah_barang or '' }}</a></li>
														<li><a>Harga / Barang : {{ $value->form->harga_barang or '' }}</a></li>	
														<li><a><b>Total : {{ $value->form->harga_barang * $value->jumlah_barang }} </b></a></li>	
														<li><a>Pengiriman : {{ ($record->trans->kurir) ? $record->trans->kurir->form->nama : '' }} - {{ ($record->trans->kurir) ? $record->trans->kurir->kurir_child_tipe : '' }}</a></li>	
														<li><a>Harga Pengiriman : {{ ($record->trans->kurir) ? $record->trans->kurir->kurir_child_harga : '' }} - ( {{ ($record->trans->kurir) ? $record->trans->kurir->kurir_child_hari : '' }} )</a></li>	
														@if($record->status == 'success')
														<li>
															<a>Berikan Ulasan & Rating Anda</a>
															<ul style="list-style-type: square;">
																<li>
																	<a>Ulasan</a>
																	<div class="form-group appendRating">
																		Beri Rating - <span id="rating" style="color:#ff7429;" class="rating" data-current-rating="5" data-icon-bad='fa fa-star-o' data-icon-good='fa fa-star' data-k="{{ $k }}" data-type="img_barang"></span>
																		<input type="hidden" class="img_barang{{$k}}" name="feed[img_barang][{{$k}}][form_id]" value="{{ $value->form->id }}">
																		<input type="hidden" name="feed[img_barang][{{$k}}][rate]" value="5">
																		<textarea rows="1" placeholder="ulasan" name="feed[img_barang][{{$k}}][message]" required="" class="form-control"></textarea>
																	</div>
																</li>
															</ul>
														</li>
														@endif
													</ul>
												</div>
											@else
												<div class="col-md-6">
													<ul style="list-style-type: square;">
														<li><a><b>Nama Barang Sewaan : {{ $value->form->judul or '' }}</b></a></li>										  	
														<li><a>Jumlah Barang Sewaan : {{ $value->jumlah_barang or '' }}</a></li>
														<li><a>Harga / Sewa : {{ $value->form->harga_sewa or '' }}</a></li>
														<li><a><b>Total : {{ $value->form->harga_sewa * $value->jumlah_barang }} </b></a></li>	
														@if($record->status == 'success')
														<li>
															<a>Berikan Ulasan & Rating Anda</a>
															<ul style="list-style-type: square;">
																<li>
																	<a>Ulasan</a>
																	<div class="form-group appendRating">
																		Beri Rating - <span id="rating" style="color:#ff7429;" class="rating" data-current-rating="5" data-icon-bad='fa fa-star-o' data-icon-good='fa fa-star' data-k="{{ $k }}" data-type="img_rental"></span>
																		<input type="hidden" class="img_rental{{$k}}" name="feed[img_rental][{{$k}}][form_id]" value="{{ $value->form->id }}">
																		<input type="hidden" name="feed[img_rental][{{$k}}][rate]" value="5">
																		<textarea rows="1" placeholder="ulasan" name="feed[img_rental][{{$k}}][message]" required="" class="form-control"></textarea>
																	</div>
																</li>
															</ul>
														</li>
														@endif	
													</ul>
												</div>
											@endif
										@endforeach
										</div>
									@endif
								@elseif($record->trans->kereta)
									@if($record->trans->kereta->count())
										<div class="row">
											@foreach($record->trans->kereta as $k => $value)
												<ul style="list-style-type: square;">
													<li><a>Nama Kereta: {{ $value->trainName or '' }} - {{ $value->className or '' }} - SubClass {{ $record->subClass or '' }}</a></li>										  	
													<li><a>Kode Pemesanan : {{ $value->bookingCode or '' }}</a></li>										  	
													<li><a>Waktu Pemesanan : {{ $value->bookTime or '' }}</a></li>										  	
													<li><a>Waktu Keberangkatan : {{ $value->departDate or '' }} - {{ $value->departTime or '' }}</a></li>										  	
													<li><a>Waktu Tiba : {{ $value->arriveDate or '' }} - {{ $value->arriveTime or '' }}</a></li>										  	
													<li><a>Destinasi : {{ $value->org or '' }} - {{ $value->dest or '' }}</a></li>										  	
													<li><a>Harga / Tiket : {{ $value->tiketPrice or '' }}</a></li>	
													<li><a>Biaya Admin : {{ $value->admin or '' }}</a></li>	
													<li>
														<a>Penumpang Dewasa</a>
														<ul style="list-style-type: square;">
															<li><a>Nama : {{ $value->adult_name or '' }}</a></li>
															<li><a>No. Identitas : {{ $value->adult_id or '' }}</a></li>
														</ul>
													</li>	
													<li>
														<a>Penumpang Bayi</a>
														<ul style="list-style-type: square;">
															<li><a>Nama : {{ $value->infant_name or '' }}</a></li>
															<li><a>No. Identitas : {{ $value->infant_id or '' }}</a></li>
														</ul>
													</li>
													<li><a>Kursi : {{ $value->kodeWagon or '-' }} - {{ $value->seats or '-' }}</a></li>	

												</ul>
											@endforeach
										</div>
									@endif
								@endif
							</ul>
						</div>
	                </div>          
	            </div>
	        </div>

		
	</form>
	</div>
</div>
<div class="modal-footer">
	<div class="col-md-6 pull-left">
		<h4 class="pull-left">Total Belanja : Rp. <span class="sub-total">{{$record->trans->total_harga or ''}}</span></h4>
	</div>
	<div class="col-md-6 ml-auto">
		@if(Auth::check())
			@if($record->status == 'success')
			@if($record->trans->detail)
				@if($record->trans->detail->count() > 0)
					<button type="button" class="btn btn-outline-success save-modal save-frontend next-page pull-right"><i class="ion-ios-paper"></i> Simpan Ulasan</button>
				@endif
			@endif
			@endif
		@endif
	</div>
</div>
</div>
</div>
</div>