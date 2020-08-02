
<div class="modal-body">
	<div class="content-ayokulakan">
		<form id="dataFormModal" action="{{ url($pageUrl) }}" method="POST">
			{!! csrf_field() !!}
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label for="">Nama Negara</label>
						<input type="text" name="negara" class="form-control" placeholder="Nama Negara" required="">
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