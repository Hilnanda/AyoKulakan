
<div class="modal-body">
	<div class="content-ayokulakan">
		<form id="dataFormModal" action="{{ url($pageUrl.$record->id) }}" method="POST">
			{!! csrf_field() !!}
			<input type="hidden" name="_method" value="PUT">
			<input type="hidden" name="id" value="{{ $record->id or ''}}">
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label for="">Nama Lapak</label>
						<input type="text" name="nama_lapak" class="form-control" placeholder="Nama Lapak" required="" value="{{ $record->nama_lapak or '' }}">
						
					</div>	
					<div class="form-group">
						<label for="">Deskripsi Lapak</label>
						<textarea name="deskripsi_lapak" class="form-control" rows="2" placeholder="Deskripsi Lapak">{!! $record->deskripsi_lapak or '' !!}</textarea>
						
					</div>
					<div class="form-group">
						<label for="">Wilayah Negara</label>
						<select name="id_negara" class="form-control child target dynamic-more-than-5-select selectpicker" required="" data-dropup-auto="false" data-size="10" data-style="none" data-arraynama="id_provinsi,id_kota,id_kecamatan">
							{!! \App\Models\Master\WilayahNegara::options('negara', 'id', ['selected' => $record->id_negara], ('Pilih Wilayah Negara')) !!}
					</select>					
					</div>		
					<div class="form-group">
						<label for="">Wilayah Provinsi</label>
						<select name="id_provinsi" class="form-control child target id_provinsi selectpicker" required="" data-dropup-auto="false" data-size="10" data-style="none">
							{!! \App\Models\Master\WilayahProvinsi::options('provinsi', 'id', ['selected' => $record->id_provinsi,['filters' => ['id_negara' => $record->id_negara]]], ('Pilih Wilayah Provinsi')) !!}
						</select>	
						<div id="id_provinsi">
							
						</div>					
					</div>		
					<div class="form-group">
						<label for="">Wilayah Kab/Kota</label>
						<select name="id_kota" class="form-control child target id_kota selectpicker" required="" data-dropup-auto="false" data-size="10" data-style="none">
							{!! \App\Models\Master\WilayahKota::options('kota', 'id', ['selected' => $record->id_kota,['filters' => ['id_provinsi' => $record->id_provinsi]]], ('Pilih Wilayah Kab/Kota')) !!}
						</select>	
						<div id="id_kota">
							
						</div>					
					</div>		
					<div class="form-group">
						<label for="">Wilayah Kecamatan</label>
						<select name="id_kecamatan" class="form-control child target id_kecamatan selectpicker" required="" data-dropup-auto="false" data-size="10" data-style="none">
							{!! \App\Models\Master\WilayahKecamatan::options('kecamatan', 'id', ['selected' => $record->id_kecamatan,['filters' => ['id_kota' => $record->id_kota]]], ('Pilih Wilayah Kecamatan')) !!}
						</select>	
						<div id="id_kecamatan">
							
						</div>					
					</div>	
					<div class="form-group">
						<label for="">Alamat Lapak</label>
						<textarea name="alamat_lapak" class="form-control" rows="2" placeholder="Alamat Lapak">{{ $record->alamat_lapak or '' }}</textarea>
						
					</div>	
					<div class="form-group">
						<label for="">Kode Pos</label>
						<input type="number" name="kode_pos" class="form-control" placeholder="Kode Pos" required="" value="{{ $record->kode_pos or '' }}">
					</div>	
					<div class="form-group">
						<label for="">No HP Lapak</label>
						<input type="number" name="phone" class="form-control" placeholder="No HP Lapak" required="" value="{{ $record->phone or '' }}">
					</div>
					<div class="form-group">
						@include('partials.file-tab.attachment')
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
