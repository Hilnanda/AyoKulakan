@extends('layouts.scaffold-webview')

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

        <div class="terms-conditions-page">
            <div class="row">
                <div class="col-md-12 terms-conditions">
                    <h2 class="heading-title">Panduan Haji & Umroh</h2>
                    <div class="">
                        <p>
                        {!! $record->deskripsi or '' !!}
                        </p>
                    </div>
                </div>          
            </div>
        </div>
   
    
@endsection