@extends('layouts.backend')

@section('scripts')
@include('layouts.scripts.action-bootstrap')
@include('layouts.scripts.frontend')

<script type="text/javascript">
	var initModal = function(){
  $('.selectpicker').selectpicker();
  $('.summernote').summernote({
    height: 50,
  });

  function convertToRupiah(angka)
  {
    var rupiah = '';
    var angkarev = angka.toString().split('').reverse().join('');
    for(var i = 0; i < angkarev.length; i++) if(i%3 == 0) rupiah += angkarev.substr(i,3)+'.';
      return rupiah.split('',rupiah.length-1).reverse().join('');
  }

  function convertToAngka(rupiah)
  {
  	if(rupiah){
    return parseInt(rupiah.replace(/,.*|[^0-9]/g, ''), 10);
  	}
  }
  $(document).ready(function(){

    var uangs = $('.change-money-modals').val()
    if(uangs){
    	var converts = convertToRupiah(convertToAngka(uangs));
	    $('.change-money-modals').val(converts);
    }
  });
  $(document).on('keyup','.change-money-modals',function(){
    var val = $(this).val();
    var convert = convertToRupiah(convertToAngka(val));
    $('.change-money-modals').val(convert);
  })
};
</script>
@endsection

@section('body')
@include('partials.backend.header')
<div class="body-content outer-top-xs" id="top-banner-and-menu" style="z-index: -1;">
      <div class="container">
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-3 sidebar">
            @include('partials.backend.partials-sidebar.left')
            @include('partials.backend.partial-content.content-sidebar-left-rental')
          </div>
          <div class="col-xs-12 col-sm-12 col-md-9 homebanner-holder" >
            @yield('content-frontend-right')
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12" >
            @yield('content-frontend')
          </div>
        </div>
      </div>
    </div>
  @include('partials.backend.footer')


@endsection

@yield('init-modal')
@section('modalss')
<div class="modal fade bd-example-modal-{{ $modalSize or 'sm' }}" tabindex="-1" role="dialog" aria-labelledby="formModals" aria-hidden="true" id="formModals">
  <div class="modal-dialog modal-dialog-centered modal-{{ $modalSize or 'sm' }}">
    <div class="modal-content" >
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" style="position: relative;top:-8px;"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      </div>
      <div id="formData">

      </div>
    </div>
  </div>
</div>
@append
