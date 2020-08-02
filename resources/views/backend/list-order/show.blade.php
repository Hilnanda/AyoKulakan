
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

						@if($record->detail)
							{{-- @php
								$resultRecord = $record->detail()->where('form_type','img_barang')->whereHas('barang',function($qq){
					                  $qq->where('created_by',auth()->user()->id);
					                });
								})->get();
								dd($resultRecord);
							@endphp --}}
							@if($record->detail->count() > 0)
								<div class="row">
								@foreach($record->detail as $k => $value)
									@if($value->form_type == 'img_barang')
										@if($value->barang->created_by == auth()->user()->id)
											<div class="col-md-6">
												<ul style="list-style-type: square;">
													<li><a>Nama Pesanan : {{ $value->form->nama_barang or '' }}</a></li>										  	
													<li><a>Jumlah Pesanan : {{ $value->jumlah_barang or '' }}</a></li>
													<li><a>Harga / Barang : {{ $value->form->harga_barang or '' }}</a></li>	
													
												</ul>
											</div>
										@endif
									@endif
								@endforeach
								</div>
							@endif
						@endif
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