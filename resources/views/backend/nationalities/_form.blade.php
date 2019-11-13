<link rel="stylesheet" href="{{asset('css/icons.css')}}">
<br />
<div class="tab-content">
    <div class="tab-pane active">
        <div class="form-group" style="margin-bottom: 2px;">
            <label class="control-label">{{trans('backend.general.name')}}:</label>
            <div class="input">
                {!!Form::input('text', 'name', null,['class'=> 'form-control', 'data-validate' => 'required'])!!}
            </div>
            @include('backend._form_row_error', ['input' => 'name'])
        </div>
        <div class="form-group" style="margin-bottom: 2px;">
            <label class="control-label">الوصف:</label>
            <div class="input">
                {!!Form::input('text', 'description', null,['class'=> 'form-control', 'data-validate' => 'required'])!!}
            </div>
            @include('backend._form_row_error', ['input' => 'description'])
        </div>
        <br>
        <div class="form-group" style="margin-bottom: 2px;">
        <label class="control-label">{{trans('backend.general.photo')}}:</label>
        <br/>
        @if(isset($services) && $services->photo)
        <a class="delete-btn" href="{{route('services.delete_image',$services->id)}}">X</a>
        <img width="100" height="100" class="thumbnail-highlight"
        src="{{$services->photo}}"/>
        @endif

        <div class="input-group">
        {!!Form::input('file', 'photo', null,['class'=> 'form-control'])!!}
        </div>
        @include('backend._form_row_error', ['input' =>'photo'])
        </div>
        <br>
    </div>
</div>

<div class="form-group">
    <button type="submit" class="btn btn-success">{{trans('backend.general.save')}}</button>
    <button type="reset" class="btn">{{trans('backend.general.reset')}}</button>
</div>

{{--@section('footer')--}}
    {{--<script src="{{asset('backend/js/jquery.validate.min.js')}}"></script>--}}
    {{--<script src="{{asset('backend/js/validation/localization/messages_ar.js')}}"></script>--}}
{{--@stop--}}
