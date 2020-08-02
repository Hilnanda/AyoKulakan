@extends('layouts.scaffold')

@section('styles')
<style>
    .outline-top {
        margin-top: 200px;
    }

    @media (max-width: 500px) {
        .outline-top {
            margin-top: 299px;
        }
    }
</style>
@endsection

@section('scripts')
<script src="{{ asset('js/vueapp.js') }}" defer></script>
@endsection

@section('content-frontend')
<div id="vueapp" class="outline-top">
    <booking-list></booking-list>
</div>

{{-- <div class="container" style="margin-top: 20px;">
    <div class="panel panel-default">
        <div class="panel-body">
            List Bookingan
        </div>
    </div>
</div> --}}

@endsection
