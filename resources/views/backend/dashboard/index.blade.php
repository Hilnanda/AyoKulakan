@extends('layouts.grid')

@section('js')
<script src="{{ asset('ayokulakan/lumine/js/jquery-1.11.1.min.js') }}"></script>
<script src="{{ asset('ayokulakan/lumine/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('ayokulakan/lumine/js/chart.min.js') }}"></script>
<script src="{{ asset('ayokulakan/lumine/js/chart-data.js') }}"></script>
<script src="{{ asset('ayokulakan/lumine/js/easypiechart.js') }}"></script>
<script src="{{ asset('ayokulakan/lumine/js/easypiechart-data.js') }}"></script>
<script src="{{ asset('ayokulakan/lumine/js/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('ayokulakan/lumine/js/custom.js') }}"></script>
@endsection

@section('css')

@endsection


@section('js-filters')
d.nama = $("input[name='filter[nama]']").val();
@endsection

@section('rules')
<script type="text/javascript">
formRules = {
 judul: ['empty'],
};
</script>
@endsection

@section('filters')
@endsection

@section('toolbars')

@endsection
@section('subcontent')
<div class="col-lg-12 main">

  <div class="panel panel-container">
    <div class="row">
      <div class="col-xs-6 col-md-3 col-lg-6">
        <div class="border-right">
            <center><i class="fa fa-shopping-cart fa-lg color-blue"></i></center><br>
        </div>
      </div>
      <div class="col-xs-6 col-md-3 col-lg-6">
            <center><i class="fa fa-shopping-cart fa-lg color-blue"></i></center><br>
      </div>
    </div>
    <br>
    <div class="row">
      <div class="col-xs-6 col-md-3 col-lg-6">
        <div class="border-right">
            <center><i class="fa fa-shopping-cart fa-lg color-blue"></i></center><br>
        </div>
      </div>
      <div class="col-xs-6 col-md-3 col-lg-6">
            <center><i class="fa fa-shopping-cart fa-lg color-blue"></i></center><br>
      </div>
    </div><!--/.row-->
  </div>


</div>
@endsection