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
        <th>id</th>
        <th>{{trans('backend.general.name')}}</th>
        <th>{{trans('backend.general.mobile')}}</th>
        <th>{{trans('backend.general.address')}}</th>
        <th>{{trans('backend.general.created_at')}}</th>
        <th>{{trans('backend.general.updated_at')}}</th>
        <th>{{trans('backend.general.actions')}}</th>
    </tr>
    </thead>

    <tbody>
    @forelse($customers as $customer)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$customer->id}}</td>
            <td>{{$customer->name}}</td>
            <td>{{$customer->username}}</td>
            <td>{{$customer->mob}}</td>
            <td>{{$customer->address}}</td>
            {{--<td>{{$customer->wifi}}</td>--}}
            <td style="direction: ltr;text-align: center;">{{$customer->created_at}}</td>
            <td style="direction: ltr;text-align: center;">{{$customer->updated_at}}</td>
            <td>
            @include('backend._list_actions', ['edit' => 'customers.edit', 'destroy' => 'customers.destroy', 'pk' => $customer->id])
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
@include('backend._pagination', ['rows' => $customers])
@stop