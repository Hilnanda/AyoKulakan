@extends('layouts.grid')

@section('js-filters')
  d.name = $("input[name='filter[name]']").val();
@endsection

@section('rules')
  <script type="text/javascript">
  formRules = {
    nama: ['empty'],
  };
</script>
@endsection
