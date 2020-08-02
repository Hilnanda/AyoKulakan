@if(isset($record))
  @if(isset($record->attachment))
    @if($record->attachment->count() > 0)
      @foreach($record->attachment as $file)
      <div class="ui inline grid field" style="width: 100%">
        <div class="sixteen wide column" style="padding: .5rem 0">
          <div class="ui fluid file input action">
						<input type="text" readonly value="{{ $file->filename or '' }}" data-id="{{ $file->id }}" data-collect="{{ $record }}">
						<div class="ui positive icon button picture-download">
							<i class="download icon"></i>
						</div>
            <div class="ui red icon button hapus-picture file">
              <i class="trash icon"></i>
            </div>
					</div>
          @if(isset($record->waktu))
            @if(!is_null($record->waktu))
              @if(isset($record->tanggal) or isset($record->tanggal_akhir))
                @if(!is_null($record->tanggal) or !is_null($record->tanggal_akhir))
                  @if($file->taken_at != NULL)
                    @if(isset($record->tanggal_akhir))
                    {!! stringTakenAt($file->taken_at, $record->waktu, $record->tanggal_akhir) !!}
                    @else
                    {!! stringTakenAt($file->taken_at, $record->waktu, $record->tanggal) !!}
                    @endif
                  @endif
                @endif
              @endif
            @endif
          @endif
        </div>
      </div>
      @endforeach
    @endif
  @endif
@endif
