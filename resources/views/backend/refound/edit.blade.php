
<div class="modal-body">
	<div class="content-ayokulakan">
		<form id="dataFormModal" action="{{ url($pageUrl.$record->id) }}" method="POST">
			{!! csrf_field() !!}
			<input type="hidden" name="_method" value="PUT">
			<input type="hidden" name="id" value="{{ $record->id }}">
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label for="">Type Barang / Sewa</label>
						<input type="text" class="form-control" placeholder="Type Barang / Sewa" required="" value="{{ $record->typeLabel() }}" readonly="">
					</div>		
				</div>
				@if($record->form_type == 'img_barang')
					
						<div class="col-md-4">
							<div class="form-group">
								<label for="">Order Id</label>
								<select name="trans_id" class="form-control selectpicker" required="" data-dropup-auto="false" data-size="10" data-style="none" data-live-search="true" >
									{!! \App\Models\TransaksiAmpas\TransaksiAmpase::options('order_id', 'id', ['selected' => $record->trans_id], ('Pilih Order Id')) !!}
								</select>		
							</div>	
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="">Lapak</label>
								<select name="lapak_id" class="form-control child target selectpicker" required="" data-dropup-auto="false" data-size="10" data-style="none" data-child="showBarang" data-namas='form_id' data-live-search="true">
									{!! \App\Models\Lapak\Lapak::options('nama_lapak', 'id', ['selected' => $record->lapak_id], ('Pilih Lapak')) !!}
							</select>					
							</div>		
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="">Pilih Barang</label>
								<select name="form_id" class="form-control child target changeSelects selectpicker" required="" data-dropup-auto="false" data-size="10" data-style="none">
									{!! \App\Models\Barang\LapakBarang::options('nama_barang', 'id', ['selected' => $record->form_id,'filters' => ['id_trans_lapak' => $record->lapak_id]], ('Pilih Lapak')) !!}
								</select>	
								<div id="showBarang">
									
								</div>					
							</div>
						</div>
						
				@else
				
							<div class="col-md-4">
								<div class="form-group">
									<label for="">Order Id</label>
									<select name="trans_id" class="form-control selectpicker" required="" data-dropup-auto="false" data-size="10" data-style="none" data-live-search="true" >
										{!! \App\Models\TransaksiAmpas\TransaksiAmpase::options('order_id', 'id', ['selected' => $record->trans_id], ('Pilih Order Id')) !!}
									</select>		
								</div>	
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="">Lapak</label>
									<select name="lapak_id" class="form-control child target selectpicker" required="" data-dropup-auto="false" data-size="10" data-style="none" data-child="showRental" data-namas='form_id' data-live-search="true">
										{!! \App\Models\Lapak\Lapak::options('nama_lapak', 'id', ['selected' => $record->lapak_id], ('Pilih Lapak')) !!}
								</select>					
								</div>		
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="">Pilih Sewa</label>
									<select name="form_id" class="form-control child target changeSelects selectpicker" required="" data-dropup-auto="false" data-size="10" data-style="none">
										{!! \App\Models\Rental\Rental::options('judul', 'id', ['selected' => $record->form_id,'filters' => ['created_by' => $record->lapak->created_by]], ('Pilih Lapak')) !!}
									</select>	
									<div id="showRental">
										
									</div>					
								</div>
							</div>
				@endif
				<div class="col-md-12">
					<div class="form-group">
						<label for="">Status Terkini</label>
						<select name="status" class="form-control selectpicker" required="" data-dropup-auto="false" data-size="10" data-style="none" >
							<option value="">Pilih Status</option>
							<option value="Menunggu Pengembalian Barang" {{ ($record->status == 'Menunggu Pengembalian Barang') ? 'selected' : '' }}>Menunggu Pengembalian Barang</option>
							<option value="Menunggu Pengembalian Uang" {{ ($record->status == 'Menunggu Pengembalian Uang') ? 'selected' : '' }}>Menunggu Pengembalian Uang</option>
							<option value="Proses" {{ ($record->status == 'Proses') ? 'selected' : '' }}>Proses</option>
							<option value="Gagal" {{ ($record->status == 'Gagal') ? 'selected' : '' }}>Gagal</option>
							<option value="Berhasil" {{ ($record->status == 'Berhasil') ? 'selected' : '' }}>Berhasil</option>
						</select>
					</div>	
				</div>
			</div>
		</form>
	</div>
</div>
<div class="modal-footer">
	<button type="button" class="btn btn-outline-secondary " data-dismiss="modal" aria-label="Close"><i class="ion-android-close"></i> Tutup</button>
	<button type="button" class="btn btn-outline-success save-modal save-ayokulakan"><i class="ion-ios-paper"></i> Simpan</button>
</div>
</div>
</div>
</div>