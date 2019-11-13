@extends('backend.layout')

@section('content')

    <h2> ادارة الجنسيات - تعديل  </h2>
    <br />

    <div class="panel panel-primary">
        <div class="panel-body">
            {!! Form::model( $nationalities, ['route' => ['nationalities.update', $nationalities->id], 'class' => 'validate', 'enctype' => "multipart/form-data"]) !!}
            @include('backend.nationalities._form')
            {!! Form::close() !!}
        </div>
    </div>
@stop
