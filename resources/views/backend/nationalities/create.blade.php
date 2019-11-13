@extends('backend.layout')

@section('content')

    <h2> ادارة الخدمات - اضافة جديد </h2>
    <br />

    <div class="panel panel-primary">
        <div class="panel-body">
        {!! Form::open(['route' => 'services.store', 'class' => 'validate', 'enctype' => "multipart/form-data"]) !!}
            @include('backend.services._form')
        {!! Form::close() !!}
        </div>
    </div>
@stop

