@extends('backend.layout')

@section('content')

    <h2> ادارة الخدمات - تعديل  </h2>
    <br />

    <div class="panel panel-primary">
        <div class="panel-body">
            {!! Form::model( $services, ['route' => ['services.update', $services->id], 'class' => 'validate', 'enctype' => "multipart/form-data"]) !!}
            @include('backend.services._form')
            {!! Form::close() !!}
        </div>
    </div>
@stop
