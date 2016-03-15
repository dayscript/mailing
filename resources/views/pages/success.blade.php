@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col col-md-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading"><h3 class="panel-title">Listo!!!</h3></div>
                    <div class="panel-body">
                        <h4>Campaña enviada.</h4>
                        <div>Contactos: {{$total}}</div>
                        @foreach($contacts as $contact)
                            <div>{{ $contact->email }}</div>
                        @endforeach
                    </div>
                    <div class="panel-footer">
                        <a href="{{ route('contact') }}" class="btn btn-primary btn-xs">Volver</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(Request::get('refresh',''))
    <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script>
        var timeoutId;
        $( document ).ready(function() {
            clearTimeout(timeoutId);
            timeoutId = setTimeout(function () {
                document.location.reload();
            }, 2000);
        });

    </script>
    @endif
@endsection