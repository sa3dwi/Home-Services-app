@extends('backend.layout')

@section('content')

    <h2> ادارة العملاء - تعديل  </h2>
    <br />

    <div class="panel panel-primary">
        <div class="panel-body">
            {!! Form::model( $customers, ['route' => ['customers.update', $customers->id], 'class' => 'validate', 'enctype' => "multipart/form-data"]) !!}
            @include('backend.customers._form')
            {!! Form::close() !!}
        </div>
    </div>
@stop
