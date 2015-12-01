@extends('app')

@section('content')
    <div class="container">
        @foreach($contacts as $contact)
            <div class="row">
                <div class="col-md-12">
                    {{ $contact->email }}
                </div>
            </div>
        @endforeach
    </div>
@endsection