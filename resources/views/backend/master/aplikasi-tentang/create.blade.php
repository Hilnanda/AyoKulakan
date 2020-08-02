<script type="text/javascript">
		$(document).ready(function(){
			$(document).on('select','change',function(){
				console.log('as')
			});
		});
		$(document).on('input[name="judul"]','click',function(){
				console.log('asas')
			});
	</script>
<div class="modal-body">
	<div class="content-ayokulakan">
		<form id="dataFormModal" action="{{ url($pageUrl) }}" method="POST">
			{!! csrf_field() !!}
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label for="">Judul</label>
						<input type="text" name="judul" class="form-control" placeholder="Judul" required="">
						
					</div>	
					<div class="form-group">
						<label for="">Deskripsi</label>
						<textarea name="deskripsi" class="form-control summernote" rows="2"></textarea>
						
					</div>	
					<div class="form-group">
						<label for="">Kategori Aplikasi</label>
						<select name="kategori" class="form-control selectpicker" required="" data-dropup-auto="false" data-size="10" data-style="none" >
							<option>Pilih Kategori</option>
							<option value="Tentang">Tentang</option>
							<option value="Aturan Pengguna">Aturan Pengguna</option>
							<option value="Kebijakan Privasi">Kebijakan Privasi</option>
							<option value="Identitas Brand">Identitas Brand</option>
							<option value="Kontak Kami">Kontak Kami</option>
							<option value="Tentang Haji & Umroh">Tentang Haji & Umroh</option>
						</select>
						
					</div>	
					<div class="form-group shows-inputs">
						<div class="shows-input">
							
						</div>
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
@section('modalss')
	<script type="text/javascript">
		$("#formModals").modal(function(){
					$(document).on('input[name="judul"]','click',function(){
				console.log('asas')
			});
		})
		initModal = function(){
			console.log('asdasdas')
		}
		$(document).on('input[name="judul"]','click',function(){
				console.log('asas')
			});
	</script>
@endsection