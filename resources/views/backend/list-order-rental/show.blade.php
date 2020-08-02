
<div class="modal-body">
	<div class="content-ayokulakan">
		<form id="dataFormModal">
			<div class="row">
				<div class="col-md-12">
					<div class="alert alert-success" role="alert">
						<h4 class="alert-heading">Penyewa - {{ $record->user->nama or '' }} </span></h4>

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
						
						@if($record->detail)
							@if($record->detail->count() > 0)
								<div class="row">
								@foreach($record->detail as $k => $value)
									@if($value->form_type == 'img_rental')
										@if($value->barang->created_by == auth()->user()->id)
											<div class="col-md-6">
												<ul style="list-style-type: square;">
													<li><a>Nama Barang Sewaan : {{ $value->form->judul or '' }}</a></li>										  	
													<li><a>Jumlah Barang Sewaan : {{ $value->jumlah_barang or '' }}</a></li>
													<li><a>Harga / Sewa : {{ $value->form->harga_sewa or '' }}</a></li>
												</ul>
											</div>
										@endif
									@endif
								@endforeach
								</div>
							@endif
						@endif

						<div class="alert alert-danger" role="alert">
						  <h4 class="alert-heading">Lampiran !</h4>
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