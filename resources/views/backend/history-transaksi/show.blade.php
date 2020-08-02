
<div class="modal-body">
	<div class="content-ayokulakan">
		<form id="dataFormModal">
			<div class="row">
				<div class="col-md-12">
					<div class="alert alert-success" role="alert">
						<h4 class="alert-heading">Pembeli - {{ $record->user->nama or '' }} </span></h4>

						<h6 class="">Untuk No Order <span class="text-danger">{{ $record->order_id or '' }}</span> Status <span class="text-danger">{{ $record->status or '' }}</span></h6>

						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Negara</label>
									<input type="text" class="form-control" value="{{ $record->user->negara->negara or '' }}" readonly="">
								</div>
								<div class="form-group">
									<label>Kota</label>
									<input type="text" class="form-control" value="{{ $record->user->kota->kota or '' }}" readonly="">
								</div>
								<div class="form-group">
									<label>HP</label>
									<input type="text" class="form-control" value="{{ $record->user->hp or '' }}" readonly="">
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<label>Provinsi</label>
									<input type="text" class="form-control" value="{{ $record->user->provinsi->provinsi or '' }}" readonly="">
								</div>
								<div class="form-group">
									<label>Kecamatan</label>
									<input type="text" class="form-control" value="{{ $record->user->kecamatan->kecamatan or '' }}" readonly="">
								</div>
								<div class="form-group">
									<label>Kode Pos</label>
									<input type="text" class="form-control" value="{{ $record->user->kode_pos or '' }}" readonly="">
								</div>
							</div>
						</div>
						<div class="form-group">
							<label>Alamat Tujuan</label>
							<textarea class="form-control" readonly="" rows="1">{{ $record->user->alamat or '' }}</textarea>
						</div>
						@if($record->prepaid)
							<ul style="list-style-type: square;">
								<li><a>Tipe Pesanana : {{ $record->prepaid->type or '' }}</a></li>
								<li><a>Pesanana : {{ $record->prepaid->form->pulsa_nominal or '' }}</a></li>
								<li><a>Pesanana : {{ $record->prepaid->type or '' }}</a></li>
								<li><a>No Pelanggan : {{ $record->prepaid->pelanggan or '' }}</a></li>										  	
							  	<li><a>Harga : <span class="badge badge-secondary" style="font-size: 12px">{{ $record->prepaid->ttl_harga or '' }}</span></a></li>
							  	<li><a>Biaya Admin : <span class="badge badge-secondary" style="font-size: 12px">{{ $record->prepaid->biaya_admin or '-' }}</span></a></li>
							</ul>
						@elseif($record->postpaid)
							<ul style="list-style-type: square;">
								<li><a>No Pelanggan : {{ $record->postpaid->pelanggan or '' }}</a></li>										  	
								<li><a>Pelanggan : {{ $record->postpaid->tr_name or '' }}</a></li>	

								<li><a>Tipe Pesanana : {{ $record->postpaid->type or '' }} ({{ $record->postpaid->server or '' }}) </a></li>
									@if($record->postpaid->form)
										<li><a>Pesanana : {{ $record->postpaid->form->province or '' }} ({{ $record->postpaid->form->name or '' }})</a></li>
									@endif
									@if(isset($record->postpaid->period) && !is_null($record->postpaid->period))
										<li><a>Periode : {{ \Carbon\Carbon::parse($record->postpaid->period)->format('Y-m') }}</a></li>	
									@endif
							  	<li><a>Harga : <span class="badge badge-secondary" style="font-size: 12px">{{ $record->postpaid->ttl_harga or '' }}</span></a></li>
							  	<li><a>Biaya Admin : <span class="badge badge-secondary" style="font-size: 12px">{{ $record->postpaid->biaya_admin or '-' }}</span></a></li>
							</ul>
						@elseif($record->detail)
							@if($record->detail->count() > 0)
								<div class="row">
								@foreach($record->detail as $k => $value)
									@if($value->form_type == 'img_barang')
										<div class="col-md-6">
											<ul style="list-style-type: square;">
												<li><a>Nama Pesanan : {{ $value->form->nama_barang or '' }}</a></li>			  	
												<li><a>Jumlah Pesanan : {{ $value->jumlah_barang or '' }}</a></li>
												<li><a>Harga / Barang : {{ $value->form->harga_barang or '' }}</a></li>	
												<li><a>Pengiriman : {{ ($record->kurir) ? $record->kurir->form->nama : '' }} - {{ ($record->kurir) ? $record->kurir->kurir_child_tipe : '' }}</a></li>	
												<li><a>Harga Pengiriman : {{ ($record->kurir) ? $record->kurir->kurir_child_harga : '' }} - ( {{ ($record->kurir) ? $record->kurir->kurir_child_hari : '' }} )</a></li>	
												
											</ul>
										</div>
									@elseif($value->form_type == 'img_rental')
										<div class="col-md-6">
											<ul style="list-style-type: square;">
												<li><a>Nama Barang Sewaan : {{ $value->form->judul or '' }}</a></li>										  	
												<li><a>Jumlah Barang Sewaan : {{ $value->jumlah_barang or '' }}</a></li>
												<li><a>Harga / Sewa : {{ $value->form->harga_sewa or '' }}</a></li>
											</ul>
										</div>
									@endif
								@endforeach
								</div>
							@endif
						@elseif($record->kereta)
							@if($record->kereta->count())
								<div class="row">
									@foreach($record->kereta as $k => $value)
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

						<div class="alert alert-danger" role="alert">
						  <h6 class="alert-heading"><u>Jika terdapat pesanan sewa harus terdapat Lampiran KTP / KK (Kartu Keluarga) !</u></h6>
						  <div class="row">
							@if($record->attach)
								@if($record->attach->count() > 0)
									@foreach($record->attach as $k => $value)
											<a href="{{  url('storage/'.$value->fileurl) }}"  target="_blank"><img src="{{  url('storage/'.$value->fileurl) }}" class="rounded float-left" alt="..." style="width: 150px;height: 150px"></a>&nbsp;
											
									@endforeach
								@endif
							@endif
						</div>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
<div class="modal-footer">
	<div class="col-md-6">
		<h4>Total Belanja : Rp. <span class="sub-total">{{$record->total_harga or ''}}</span></h4>
	</div>
	<div class="col-md-6 ml-auto">
	</div>
</div>
</div>
</div>
</div>