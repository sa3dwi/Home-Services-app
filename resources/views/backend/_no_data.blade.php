@if(Request::input('search'))
    <div class="alert alert-danger">{{trans('backend.general.search_no_data')}}</div>
@else
    <div class="alert alert-info">{{trans('backend.general.no_data')}}</div>
@endif