<script type="text/javascript">
	$(document).on('change','select[name="form_type"]',function(){
		var val = $(this).val();
		if(val == 'img_barang'){
			$('.appendAttr').html(`
				<div class="img_barang">
							<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label for="">Order Id</label>
									<select name="trans_id" class="form-control selectpicker" required="" data-dropup-auto="false" data-size="10" data-style="none" data-live-search="true" >
										{!! \App\Models\TransaksiAmpas\TransaksiAmpase::options('order_id', 'id', [], ('Pilih Order Id')) !!}
									</select>		
								</div>	
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="">Lapak</label>
									<select name="lapak_id" class="form-control child target selectpicker" required="" data-dropup-auto="false" data-size="10" data-style="none" data-child="showBarang" data-namas='form_id' data-live-search="true">
										{!! \App\Models\Lapak\Lapak::options('nama_lapak', 'id', [], ('Pilih Lapak')) !!}
								</select>					
								</div>		
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="">Pilih Barang</label>
									<select name="form_id" class="form-control child target changeSelects selectpicker" required="" data-dropup-auto="false" data-size="10" data-style="none">
									</select>	
									<div id="showBarang">
										
									</div>					
								</div>
							</div>
							</div>
						</div>
			`);
		}else if(val == 'img_rental'){
			$('.appendAttr').html(`
				<div class="img_rental">
							<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label for="">Order Id</label>
									<select name="trans_id" class="form-control selectpicker" required="" data-dropup-auto="false" data-size="10" data-style="none" data-live-search="true" >
										{!! \App\Models\TransaksiAmpas\TransaksiAmpase::options('order_id', 'id', [], ('Pilih Order Id')) !!}
									</select>		
								</div>	
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="">Lapak</label>
									<select name="lapak_id" class="form-control child target selectpicker" required="" data-dropup-auto="false" data-size="10" data-style="none" data-child="showRental" data-namas='form_id' data-live-search="true">
										{!! \App\Models\Lapak\Lapak::options('nama_lapak', 'id', [], ('Pilih Lapak')) !!}
								</select>					
								</div>		
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="">Pilih Sewa</label>
									<select name="form_id" class="form-control child target changeSelects selectpicker" required="" data-dropup-auto="false" data-size="10" data-style="none">
									</select>	
									<div id="showRental">
										
									</div>					
								</div>
							</div>
							</div>
						</div>
			`);
		}
		$('.selectpicker').selectpicker();
	});
</script>
<div class="modal-body">
	<div class="content-ayokulakan">
		<form id="dataFormModal" action="{{ url($pageUrl) }}" method="POST">
			{!! csrf_field() !!}
			<div class="row">
				<div class="col-md-12">
					<input type="hidden" name="status" value="Menunggu Pengembalian Barang">
					<div class="form-group">
						<label for="">Type Barang / Sewa</label>
						<select name="form_type" class="form-control selectpicker" required="" data-dropup-auto="false" data-size="10" data-style="none" >
							<option value="">Pilih Kategori</option>
							<option value="img_rental">Sewa</option>
							<option value="img_barang">Barang</option>
						</select>
					</div>	
					<div class="appendAttr">
				
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
