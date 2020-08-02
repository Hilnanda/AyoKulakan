@extends('mails.component.head',[
  'data' => " ".$pesan
])
@section('body')
  <p>
  	<center>
  		<b><h2>Selamat Datang, {{ $record->nama or '' }}!</h2></b>
  	</center>
  	<center>
  		Terima kasih telah melakukan pendaftaran di Ayokulakan. Sebelum melakukan transaksi pertamamu, perhatikan hal-hal berikut, terlebih dahulu.
  	</center>
  </p>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
  <thead>
  </thead>
@if($urls)
  
  <table>
    <tr class="center aligned">
      <td>
      	
      </td>
    </tr>
  </table>
@endif
@endsection
