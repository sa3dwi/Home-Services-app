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
        <div class="form-group" style="margin-bottom: 2px;">
            <label class="control-label"> المدينة:</label>
            <div class="form-group" style="margin-bottom: 2px;">
                {!!Form::select('city_id', [], null, ['class' => 'form-control ', 'data-validate' =>  'required'])!!}
            </div>
            @include('backend._form_row_error', ['input' =>'city_id'])
        </div>
        <br>
        <div class="form-group" style="margin-bottom: 2px;">
            <label class="control-label">اسم الدخول:</label>
            <div class="input">
                {!!Form::input('text', 'username', null,['class'=> 'form-control', 'data-validate' => 'required'])!!}
            </div>
            @include('backend._form_row_error', ['input' => 'username'])
        </div>
        <br>
        <div class="form-group" style="margin-bottom: 2px;">
            <label class="control-label">كلمة المرور :</label>
            <div class="input">
                {!!Form::input('text', 'password', null,['class'=> 'form-control', 'data-validate' => 'required'])!!}
            </div>
            @include('backend._form_row_error', ['input' => 'password'])
        </div>
        <br>
        <div class="form-group" style="margin-bottom: 2px;">
            <label class="control-label">الجوال  :</label>
            <div class="input">
                {!!Form::input('text', 'tele', null,['class'=> 'form-control', 'data-validate' => 'required'])!!}
            </div>
            @include('backend._form_row_error', ['input' => 'tele'])
        </div>
        <br>
        <div class="form-group" style="margin-bottom: 2px;">
            <label class="control-label">عنوان المنزل:</label>
            <div class="input">
                {!!Form::input('text', 'address', null,['class'=> 'form-control', 'data-validate' => 'required'])!!}
            </div>
            @include('backend._form_row_error', ['input' => 'address'])
        </div>
        <br>
        <div class="form-group" style="margin-bottom: 2px;">
            <label class="control-label">الاحداثيات علي الخريطة:</label>
            <span><i class="bicon-viewed"></i></span>
            <div class="input">
                {!!Form::input('text', 'map_location', null,['class'=> 'form-control', 'data-validate' => 'required'])!!}
            </div>
            @include('backend._form_row_error', ['input' => 'map_location'])
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
