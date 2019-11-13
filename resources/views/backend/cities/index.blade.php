@extends('backend.layout')

@section('content')

<h3> ادارة الجنسيات </h3>

<a href="{{route('nationalities.create')}}" class="btn btn-primary">
    <i class="entypo-plus"></i>
    {{trans('backend.general.add_new')}}
</a>
<br /><br />
<table class="table table-bordered table-striped datatable" id="table-2">
    <thead>
    <tr>
        <th>#</th>
        <th>id</th>
        <th>{{trans('backend.general.name')}}</th>
        <th>{{trans('backend.general.created_at')}}</th>
        <th>{{trans('backend.general.updated_at')}}</th>
        <th>{{trans('backend.general.actions')}}</th>
    </tr>
    </thead>

    <tbody>
    @forelse($nationalities as $nationality)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$nationality->id}}</td>
            <td>{{$nationality->name}}</td>
            <td style="direction: ltr;text-align: right;">{{$nationality->created_at}}</td>
            <td style="direction: ltr;text-align: right;">{{$nationality->updated_at}}</td>
            <td>
            @include('backend._list_actions', ['edit' => 'nationalities.edit', 'destroy' => 'nationalities.destroy', 'pk' => $nationality->id])
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="9">
                @include('backend._no_data')
            </td>
        </tr>
    @endforelse
    </tbody>
</table>
@include('backend._pagination', ['rows' => $nationalities])
@stop