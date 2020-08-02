
@extends('layouts.scaffold')

@section('js-filters')
d.nama = $("input[name='filter[name]']").val();
@endsection

@section('scripts')
<script type="text/javascript">

	$( document ).ready(function() {
		var cek = $("textarea");

		$(cek).css('height', 50);

	    console.log(cek)
	});

</script>
@endsection

@section('content-frontend')
<main style="margin-top: 5px"></main>
<div class="terms-conditions-page container" style="margin-bottom: 20px;">
    <div class="row">
        <div class="col-md-12 terms-conditions">
            <h2 class="heading-title" style="margin-left: 50px;">Konversi Mata Uang</h2>
            
            <div style="margin: 20px; padding: 10px; background-color: transparent;">
               <!--Begin Currency Converter Code-->
                <div id="FEXRdivResp" data-pym-src="//www.foreignexchangeresource.com/currency-converter.php?c=EUR&a=IDR&amt=1&panel=1&button=2"></div>
                <script type="text/javascript" src="//www.foreignexchangeresource.com/js/pym.min.js"></script>
                <!--End Currency Converter Code-->
            </div>
        </div>
    </div>
</div>
@endsection
