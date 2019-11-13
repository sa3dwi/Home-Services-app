@extends('backend.layout')

@section('content')

    <h2> ادارة العملاء - اضافة جديد </h2>
    <br />

    <div class="panel panel-primary">
        <div class="panel-body">
        {!! Form::open(['route' => 'customers.store', 'class' => 'validate', 'enctype' => "multipart/form-data"]) !!}
            @include('backend.customers._form')
        {!! Form::close() !!}
        </div>
    </div>
@stop

