
<div class="modal-body">
	<div class="content-ayokulakan">
		<form id="dataFormModal" action="{{ url($pageUrl) }}" method="POST">
			{!! csrf_field() !!}
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label for="">Pulsa Code</label>
						<input type="text" name="pulsa_code" class="form-control" placeholder="Pulsa Code" required="">
					</div>

					<div class="form-group">
						<label for="">Pulsa OP</label>
						<input type="text" name="pulsa_op" class="form-control" placeholder="Pulsa OP" required="">
					</div>
					<div class="form-group">
						<label for="">Pulsa Nominal</label>
						<input type="text" name="pulsa_nominal" class="form-control" placeholder="Pulsa Nominal" required="">
					</div>	
					<div class="form-group">
						<label for="">Pulsa Price</label>
						<input type="text" name="pulsa_price" class="form-control" placeholder="Pulsa Price" required="">
					</div>
					<div class="form-group">
						<label for="">Pulsa Type</label>
						<input type="text" name="pulsa_type" class="form-control" placeholder="Pulsa Type" required="">
					</div>
					<div class="form-group">
						<label for="">Masa Aktif</label>
						<input type="text" name="masaaktif" class="form-control" placeholder="Masa Aktif" required="">
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
