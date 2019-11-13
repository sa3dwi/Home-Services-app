
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
            <label class="control-label">البريد الالكترونى :</label>
            <div class="input">
                {!!Form::input('text', 'email', null,['class'=> 'form-control', 'data-validate' => 'required'])!!}
            </div>
            @include('backend._form_row_error', ['input' => 'email'])
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
            <label class="control-label">اللغة  :</label>
            <div class="input">
                {!!Form::select('lang', ['ar'=>'ar','en'=>'en','ur'=>'ur'], null, ['class' => 'form-control ', 'data-validate' =>  'required'])!!}
            </div>
            @include('backend._form_row_error', ['input' => 'lang'])
        </div>
        <br>
        <div class="form-group" style="margin-bottom: 2px;">
            <label class="control-label">النوع  :</label>
            <div class="input">
                {!!Form::select('gender', ['male'=>'male','female'=>'female'], null, ['class' => 'form-control ', 'data-validate' =>  'required'])!!}
            </div>
            @include('backend._form_row_error', ['input' => 'gender'])
        </div>
        <br>
        <div class="form-group" style="margin-bottom: 2px;">
            <label class="control-label">الجوال  :</label>
            <div class="input">
                {!!Form::input('text', 'mob', null,['class'=> 'form-control', 'data-validate' => 'required'])!!}
            </div>
            @include('backend._form_row_error', ['input' => 'mob'])
        </div>
        <br>
        <div class="form-group" style="margin-bottom: 2px;">
            <label class="control-label">عنوان المنزل:</label>
            <div class="input">
                {!!Form::input('text', 'address', null,['class'=> 'form-control', 'data-validate' => 'required'])!!}
            </div>
            @include('backend._form_row_error', ['input' => 'address'])
        </div>
        {{--<br>--}}
        {{--<div class="form-group" style="margin-bottom: 2px;">--}}
            {{--<label class="control-label">{{trans('backend.general.photo')}}:</label>--}}
            {{--<br/>--}}
            {{--@if(isset($customer) && $customer->photo)--}}
                {{--<a class="delete-btn" href="{{route('hotels.delete_image',$customer->id)}}">X</a>--}}
                {{--<img width="100" height="100" class="thumbnail-highlight"--}}
                     {{--src="{{$customer->profile_photo}}"/>--}}
            {{--@endif--}}

            {{--<div class="input-group">--}}
                {{--{!!Form::input('file', 'profile_photo', null,['class'=> 'form-control'])!!}--}}
            {{--</div>--}}
            {{--@include('backend._form_row_error', ['input' =>'profile_photo'])--}}
        {{--</div>--}}
        <br>
        <div class="form-group" style="margin-bottom: 2px;">
            <label class="control-label">الاحداثيات علي الخريطة: latitude</label>
            <span><i class="bicon-viewed"></i></span>
            <div class="input">
                {!!Form::input('text', 'map_location_lat', null,['class'=> 'form-control', 'data-validate' => 'required'])!!}
            </div>
            @include('backend._form_row_error', ['input' => 'map_location_lat'])
        </div>
        <br>
        <div class="form-group" style="margin-bottom: 2px;">
            <label class="control-label"> الاحداثيات علي الخريطة: longitude</label>
            <span><i class="bicon-viewed"></i></span>
            <div class="input">
                {!!Form::input('text', 'map_location_lon', null,['class'=> 'form-control', 'data-validate' => 'required'])!!}
            </div>
            @include('backend._form_row_error', ['input' => 'map_location_lon'])
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
