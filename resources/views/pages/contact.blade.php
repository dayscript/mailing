@extends('layouts.master')

@section('title', 'Page Title')

@section('sidebar')
    @parent
    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
    <div class="container">
           <div class="row">
                   <div class="col col-md-6 col-md-offset-3"   >
                           <div class="panel panel-default">
                                 <div class="panel-heading"><h3 class="panel-title">Formulario de contacto</h3></div>
                                 <div class="panel-body">
                                       {!! Form::open(['route' => 'send', 'method' => 'post']) !!}
                                         <div class="form-group">
                                                 {!! Form::label('email', 'E-Mail') !!}
                                                 {!! Form::email('email', null, ['class' => 'form-control' ]) !!}
                                             </div>
                                         <div class="form-group">
                                                 {!! Form::label('subject', 'Asunto') !!}
                                                 {!! Form::text('subject', null, ['class' => 'form-control' ]) !!}
                                             </div>
                                         <div class="form-group">
                                                 {!! Form::label('body', 'Mensaje') !!}
                                                 {!! Form::textarea('body', null, ['class' => 'form-control' ]) !!}
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