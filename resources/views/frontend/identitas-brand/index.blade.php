@extends('layouts.scaffold')

@section('js-filters')
d.nama = $("input[name='filter[name]']").val();
@endsection

@section('rules')
<script type="text/javascript">
formRules = {
    judul: ['empty'],
};
</script>
@endsection

@section('content-frontend')

<main class="outer-top"></main>
<div class="terms-conditions-page">
    <div class="row" style="margin: 50px 0 0">
        <div class="col-md-12 terms-conditions">
            <h2 class="heading-title">Identitas Brand</h2>
            <div class="">
                <p>
                {!! $record->deskripsi or '' !!}
                </p>
            </div>
        </div>
    </div>
</div>

@endsection
