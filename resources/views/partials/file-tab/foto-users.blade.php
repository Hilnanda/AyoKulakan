
<div class="card">
	<div class="card-body">
		<div class="form-group">
			<label>{{ $foto or 'Upload Foto' }}</label>
			<input type="file" class="form-control-file" name="foto_users[]" required="" autocomplete="off" accept="image/*">
		</div>
	</div>
</div><br>


@if($shows != false)
@if(isset($record))
@if(isset($record->pictureusers))
@if($record->pictureusers->count() > 0)
@foreach($record->pictureusers as $file)
<div class="card">
	<div class="card-body">
		<input type="hidden" class="form-control" name="foto_users_exists[{{$file->id or ''}}]" autocomplete="off" accept="image/*">
		<center><div class="card" style="width: 13rem;">
			<img class="card-img-top" src="{{ url('storage/'.$file->url) }}" alt="Card image cap" style="height: 165px">
		</div></center>
	</div>
</div>
@endforeach
@endif
@endif
@endif
@endif
