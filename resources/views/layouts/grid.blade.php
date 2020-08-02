@extends('layouts.scaffold-backend')

@section('css')
<link rel="stylesheet" href="{{ asset('plugins/datatables/jquery.dataTables.css') }}">
<!-- <link rel="stylesheet" href="{{ asset('plugins/datatables/dataTables.semanticui.css') }}"> -->
<link rel="stylesheet" href="{{ asset('plugins/sweetalert/sweetalert2.css') }}">

<style type="text/css">
.ion-arrow-up-c{
  position: relative;

}

</style>
@append

@section('js')
<script src="{{ asset('plugins/datatables/jquery.dataTables.js') }}"></script>
<!-- <script src="{{ asset('plugins/datatables/dataTables.semanticui.js') }}"></script> -->
<script src="{{ asset('plugins/sweetalert/sweetalert2.js') }}"></script>
@append

@section('scripts')
<script type="text/javascript">
// global
var dt = "";
var formRules = [];
var initModal = function(){
  $('.selectpicker').selectpicker();


  function convertToRupiah(angka)
  {
    var rupiah = '';
    var angkarev = angka.toString().split('').reverse().join('');
    for(var i = 0; i < angkarev.length; i++) if(i%3 == 0) rupiah += angkarev.substr(i,3)+'.';
      return rupiah.split('',rupiah.length-1).reverse().join('');
  }

  function convertToAngka(rupiah)
  {
    return parseInt(rupiah.replace(/,.*|[^0-9]/g, ''), 10);
  }
  $(document).ready(function(){
    var uangs = $('.change-money-modals').val()
    var converts = convertToRupiah(convertToAngka(uangs));
    $('.change-money-modals').val(converts);
  });
  $(document).on('keyup','.change-money-modals',function(){
    var val = $(this).val();
    var convert = convertToRupiah(convertToAngka(val));
    $('.change-money-modals').val(convert);
  })
};

$.fn.form.settings.prompt = {
  empty                : '{name} cannot be empty',
  checked              : '{name} must choose',
  email                : '{name} not valid',
  url                  : '{name} not valid',
  regExp               : '{name} is not formatted correctly',
  integer              : '{name} must be an integer',
  decimal              : '{name} must be a decimal number',
  number               : '{name} only number',
  is                   : '{name} must be "{ruleValue}"',
  isExactly            : '{name} must be exactly "{ruleValue}"',
  not                  : '{name} cannot be set to "{ruleValue}"',
  notExactly           : '{name} cannot be set to exactly "{ruleValue}"',
  contain              : '{name} cannot contain "{ruleValue}"',
  containExactly       : '{name} cannot contain exactly "{ruleValue}"',
  doesntContain        : '{name} must contain  "{ruleValue}"',
  doesntContainExactly : '{name} must contain exactly "{ruleValue}"',
  minLength            : '{name} at least must have {ruleValue} characters',
  length               : '{name} must be at least {ruleValue} characters',
  exactLength          : '{name} must be exactly {ruleValue} characters',
  maxLength            : '{name} cannot more than {ruleValue} characters',
  match                : '{name} must match {ruleValue} field',
  different            : '{name} must have a different value than {ruleValue} field',
  creditCard           : '{name} must be a valid credit card number',
  minCount             : '{name} must have at least {ruleValue} choices',
  exactCount           : '{name} must have exactly {ruleValue} choices',
  maxCount             : '{name} must have {ruleValue} or less choices'
};

</script>
@yield('rules')
@yield('init-modal')

@include('layouts.scripts.datatable')
@include('layouts.scripts.action-bootstrap')
@append

@section('content')
<main role="main" class="outer-top">
  <div class="terms-conditions-page" style="z-index: -1px;">
      <div class="row" style="margin-top: 50px;">
          <div class="col-md-12 terms-conditions">
            <div class="breadcrumbs-container">
              <div class="container">
                <div class="row">
                  <div class="col-sm-6">
                    <h5>{!! $title or '-' !!}</h5>
                  </div>
                  <div class="col-sm-6">
                    <nav class="woocommerce-breadcrumb pull-right" style="position: relative;top: 8px;">

                      <?php $i=1; $last=count($breadcrumb);?>
                      @foreach ($breadcrumb as $name => $link)
                      @if($i++ != $last)
                      <a >{{ $name }}</a>
                      <i class="fa fa-angle-right"></i>
                      @else
                      <!-- <a >{{ $name }}</a> -->
                      @endif
                      @endforeach

                    </nav>
                  </div>
                </div>
              </div>
            </div>
            @section('content-body')
            <div class="container">
              <div class="page-title">
                <form class="form filter-form">
                  <div class="row">
                    <div class="col-md-8">
                      @section('filters')
                      <div class="btn-toolbar mb-3" role="toolbar" aria-label="Toolbar with button groups">
                        <div class="input-group">
                          <input type="text" name="filter[nama]" class="form-control" placeholder="Search" aria-label="" aria-describedby="">
                        </div>&nbsp;
                        <div class="btn-group">
                          <button type="button" class="btn btn-primary filter button"><i class="fa fa-search"></i> Search</button>
                          <button type="button" class="btn btn-danger reset button"><i class="fa fa-close"></i> Clear</button>
                        </div>
                      </div>
                      @show
                    </div>
                    <div class="col-md-4">
                      <div class="pull-right">
                        @section('toolbars')
                        <button type="button" class="btn btn-success add button"><i class="fa fa-plus"></i> Buat {!! $title or 'new' !!}</button>
                        @show
                      </div>
                    </div>
                  </div>

                </form>

                @section('head-others')
                
                @show

                @section('subcontent')
                  @if(isset($tableStruct))
                  <hr>
                  <div class="table-responsive" >
                    <table id="listTable" class="table ayokulakan table-bordered table-hover table-content" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                          @foreach ($tableStruct as $struct)
                          <th class="center aligned">{{ $struct['label'] or $struct['name'] }}</th>
                          @endforeach
                        </tr>
                      </thead>
                      <tbody>
                        @yield('tableBody')
                      </tbody>
                    </table>
                  </div>
                  @endif
                  @show
                @show
              </div>

            </div>
          </div>
      </div>
  </div>
</main>
@endsection

@section('modalss')
<div class="modal fade bd-example-modal-{{ $modalSize or 'sm' }}" tabindex="-1" role="dialog" aria-labelledby="formModals" aria-hidden="true" id="formModals">
  <div class="modal-dialog modal-dialog-centered modal-{{ $modalSize or 'sm' }}">
    <div class="modal-content" >
      <div class="modal-header">
        <h5 class="modal-title"> {{ $title or '-' }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div id="formData">

      </div>
    </div>
  </div>
</div>
@append
