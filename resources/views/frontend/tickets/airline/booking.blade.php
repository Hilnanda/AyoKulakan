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

@endsection

@section('content-frontend')

<div class="container outline-top">
    <div class="panel panel-default">
        <div class="panel-body">
            {!! $booking->detail !!}
        </div>
    </div>
</div>

@endsection
