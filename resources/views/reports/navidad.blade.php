@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            {{count($events)}}
        </div>
    </div>
@endsection