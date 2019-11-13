<?php
/*
  @if(!Request::input('search')) data-collapsed="1" @endif
  */
?>
<div class="panel panel-primary">
    <div class="panel-heading">
        <div class="panel-title">
        <a data-rel="collapse" href="#">
            {{trans('backend.general.search_title')}}
        </a>
        </div>
        <div class="panel-options">
            <a href="#" data-rel="collapse">
                <i class="entypo-down-open"></i>
            </a>
        </div>
    </div>
    <div class="panel-body" id="panel-body">
        {!!Form::open(['route' => $index, 'method' => 'get', 'class' =>'form-horizontal form-groups-bordered', 'role' => 'form'])!!}
        {!!Form::input('hidden', 'search', 1)!!}
        @if(!isset($disable_keywords) || $disable_keywords != true)
            <div class="form-group">
                {!!Form::label('keywords', trans('backend.general.search_keywords'), ['class' => 'col-sm-3 control-label'])!!}
                <div class="col-sm-7">
                    {!!Form::input('text', 'keywords', @Request::input('keywords'), ['class' => 'form-control'])!!}
                </div>
            </div>
        @endif
        @if(isset($folder))
        @include('backend.' . $folder . '._search')
        @endif
        <br>

        <div class="form-actions">
            <div class="col-sm-3"></div>
            <div class="col-lg-7">
                <button type="submit" class="btn btn-info btn-icon">
                    {{trans('backend.general.search_btn')}}
                    <i class="entypo-search"></i>
                </button>
                <a href="{{is_array($index) ? route(array_shift($index), $index) : route($index)}}" class="btn btn-gold btn-icon">
                    {{trans('backend.general.cancel_search')}}
                    <i class="entypo-cancel"></i>
                </a>
            </div>
        </div>
        {!!Form::close()!!}
    </div>
</div>