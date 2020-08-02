
<div class="card">
	<div class="card-body">
		<div class="form-group">
			<label>{{ $foto or 'Upload Foto' }}</label>
			<div class="custom-file">
			    <input type="file" class="custom-file-input" id="inputGroupFile01" name="attachment[]" required="" autocomplete="off" accept="image/*" {{ $multi or '' }}>
			    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
			</div>		
		</div>
	</div>
</div><br>

@if(isset($record))
@if(isset($record->attachMany))
<div class="card">
	<div class="card-body">
		<div class="row">
			@if($record->attachMany->count() > 0)
			@foreach($record->attachMany as $file)
			<div class="col-md-4">	
				<div class="form-group">
					<center><div class="card" style="width: 25rem;">
						<a href="{{ url('storage/'.$file->url) }}">
							<img class="img-responsive" src="{{ url('storage/'.$file->url) }}" alt="Card image cap" style="height: 165px">
						</a>
					</div></center>
				</div>
			</div>
			@endforeach
			@endif
		</div>
	</div>
</div>
@endif
@endif
