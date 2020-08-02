@extends('mails.component.head',[
  'data' => " ".$title
])
@section('body')
  <p>
  	<center>
  		<b><h2>{!! $subtitle !!}</h2></b>
  	</center>
  		@if(is_array($record))
        @if(count($record) > 0)
            @foreach($record as $k => $value)
                @if(!is_array($value))
                  <li>{!! $k !!} : {!! $value !!}</li>
                @else
                  @if(is_array($value))
                    @foreach($value as $k1 => $value1)
                      <p>
                        {!! $value1 !!}
                      </p>
                    @endforeach
                  @endif
                @endif    
            @endforeach
        @endif
      @else
        {!! $record !!}
      @endif
  </p>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
  <thead>
  </thead>
@if($url)
  <center>
    <a href="{{ $url }}">
      <button style="background-color:#385078;color:white;border:none;padding:15px 15px 15px 15px;border-radius:5px;font-weight:bold;font-size:24px">{{ $linkName }}</button>
    </a>
  </center>
@endif
@endsection
