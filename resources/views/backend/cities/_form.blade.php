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
