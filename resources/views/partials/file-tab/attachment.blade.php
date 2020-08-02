
<div class="card">
	<div class="card-body">
		<div class="form-group">
			<label>{{ $foto or 'Upload File' }}</label>
			<div class="custom-file">
			    <input type="file" class="custom-file-input" id="inputGroupFile01" name="attachment[]" required="" autocomplete="off" accept="image/png, image/gif, image/jpeg, image/jpg" {{ $multi or '' }} data-url="{{ $url or '' }}">
			    <label class="custom-file-label" for="inputGroupFile01">Pilih Produk Jual</label>
			</div>		
		</div>
	</div>
</div><br>


@if(isset($record))
@if(isset($record->attachments))
<div class="card">
	<div class="card-body">
		<div class="row">
			@if($record->attachments->count() > 0)
			@foreach($record->attachments as $file)
			<div class="col-md-4">	
				<div class="form-group">
					<input type="hidden" class="form-control" name="attachment_exists[{{$file->id or ''}}]" autocomplete="off" accept="image/*">
					<center><div class="card" style="width: 13rem;">
						<a href="{{ url('storage/'.$file->url) }}">
							<img class="card-img-top" src="{{ url('storage/'.$file->url) }}" alt="Card image cap" style="height: 165px">
						</a>
					</div></center>
				</div>
			</div>
			@endforeach
			@endif
		</div>
	</div>
</div>
@elseif(isset($record->attachment))
<div class="card">
	<div class="card-body">
		<div class="row">
			
			<div class="col-md-4">	
				<div class="form-group">
					<input type="hidden" class="form-control" name="attachment_exists[{{$record->attachment->id or ''}}]" autocomplete="off" accept="image/*">
					<center><div class="card" style="width: 13rem;">
						<a href="{{ url('storage/'.$record->attachment->url) }}">
							<img class="card-img-top" src="{{ url('storage/'.$record->attachment->url) }}" alt="Card image cap" style="height: 165px">
						</a>
					</div></center>
				</div>
			</div>
			
		</div>
	</div>
</div>
@endif
@endif
