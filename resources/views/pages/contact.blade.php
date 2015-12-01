@extends('app')

@section('title', 'Contacto')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col col-md-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading"><h3 class="panel-title">Enviar campaña Navidad</h3></div>
                    <div class="panel-body">
                        {!! Form::open(['route' => 'dotacion', 'method' => 'post']) !!}
                        <div class="form-group">
                            {!! Form::label('limit', 'Cantidad') !!}
                            {!! Form::text('limit', 20, ['class' => 'form-control' ]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::submit('Enviar', ['class' => 'btn btn-success ' ] ) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection