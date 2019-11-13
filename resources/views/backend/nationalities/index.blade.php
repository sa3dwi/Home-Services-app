@extends('backend.layout')

@section('content')

<h3> ادارة الخدمات </h3>

<a href="{{route('services.create')}}" class="btn btn-primary">
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
    @forelse($services as $service)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$service->id}}</td>
            <td>{{$service->name}}</td>
            {{--<td>{{$service->wifi}}</td>--}}
            <td style="direction: ltr;text-align: center;">{{$service->created_at}}</td>
            <td style="direction: ltr;text-align: center;">{{$service->updated_at}}</td>
            <td>
            @include('backend._list_actions', ['edit' => 'services.edit', 'destroy' => 'services.destroy', 'pk' => $service->id])
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
@include('backend._pagination', ['rows' => $services])
@stop