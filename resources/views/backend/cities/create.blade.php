@extends('backend.layout')

@section('content')

    <h2> ادارة الجنسيات - اضافة جديد </h2>
    <br />

    <div class="panel panel-primary">
        <div class="panel-body">
        {!! Form::open(['route' => 'nationalities.store', 'class' => 'validate', 'enctype' => "multipart/form-data"]) !!}
            @include('backend.nationalities._form')
        {!! Form::close() !!}
        </div>
    </div>
@stop

