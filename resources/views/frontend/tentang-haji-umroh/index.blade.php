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
   <div class="terms-conditions-page container">
    <a href="{{ url('/') }}" style="font-size:30px; color:orange !important"><i class="glyphicon glyphicon-arrow-left"></i></a>
        <div class="row" style="padding: 20px">
            <div class="col-md-12 terms-conditions">
                <h2 class="heading-title">TENTANG HAJI & UMROH.</h2>
                <div class="contact-page-map">
                  <div class="container-fluid">
                    <div class="banner_h2__left_image">
                        <img alt="" class="img-responsive" src="http://3.bp.blogspot.com/-RkvloTb6gco/VSDwgrcj16I/AAAAAAAAcA4/g5jwa61YPLA/s1600/kaaba.JPG">
                    </div>
                    <div class="wpb_wrapper">
                        <p>{!! $record->deskripsi or '' !!}</p>
                    </div>
                  </div>
              </div>
            </div>
        </div>
    </div>

@endsection
