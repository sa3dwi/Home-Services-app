@extends('backend.layout')

@section('content')

<h3> ادارة بيانات العملاء </h3>

<a href="{{route('customers.create')}}" class="btn btn-primary">
    <i class="entypo-plus"></i>
    {{trans('backend.general.add_new')}}
</a>
<br /><br />
<table class="table table-bordered table-striped datatable" id="table-2">
    <thead>
    <tr>
        <th>#</th>
        <th>{{trans('backend.general.name')}}</th>
        <th> اسم الدخول </th>
        <th>{{trans('backend.general.mobile')}}</th>
        <th>{{trans('backend.general.address')}}</th>
        {{--<th> الخصائص </th>--}}
        <th>{{trans('backend.general.created_at')}}</th>
        <th>{{trans('backend.general.updated_at')}}</th>
        <th>{{trans('backend.general.actions')}}</th>
    </tr>
    </thead>

    <tbody>
    @forelse($roomscategories as $roomscategory)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$roomscategory->name}}</td>
            <td>{{$roomscategory->username}}</td>
            <td>{{$roomscategory->tele}}</td>
            <td>{{$roomscategory->address}}</td>
            {{--<td>{{$roomscategory->wifi}}</td>--}}
            <td style="direction: ltr;text-align: center;">{{$roomscategory->created_at}}</td>
            <td style="direction: ltr;text-align: center;">{{$roomscategory->updated_at}}</td>
            <td>
            @include('backend._list_actions', ['edit' => 'customers.edit', 'destroy' => 'customers.destroy', 'pk' => $roomscategory->id])
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
@include('backend._pagination', ['rows' => $roomscategories])
@stop