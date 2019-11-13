@extends('backend.layout')

@section('content')

 <h4> {{ $dateNow  }}</h4>

    <div class="row">
        <div class="col-sm-3 col-xs-6">

            <div class="tile-stats tile-red">
                <div class="icon"><i class="entypo-users"></i></div>
                <div class="num" data-start="0" data-end="{{$usersPlays}}" data-postfix="" data-duration="1500" data-delay="0">0</div>

                <h3>{{trans('backend.general.registered_users_cnt')}}</h3>
                {{--<p>so far in our blog, and our website.</p>--}}
            </div>

        </div>

        <div class="col-sm-3 col-xs-6">

            <div class="tile-stats tile-blue">
                <div class="icon"><i class="entypo-rss"></i></div>
                <div class="num" data-start="0" data-end="{{$quranPlays}}" data-postfix="" data-duration="1500" data-delay="600">0</div>

                <h3>{{trans('backend.general.quran_plays_cnt')}}</h3>
                {{--<p>this is the average value.</p>--}}
            </div>

        </div>

        <div class="col-sm-3 col-xs-6">

            <div class="tile-stats tile-blue">
                <div class="icon"><i class="entypo-rss"></i></div>
                <div class="num" data-start="0" data-end="{{$songPlays}}" data-postfix="" data-duration="1500" data-delay="600">0</div>

                <h3>{{trans('backend.general.songs_plays_cnt')}}</h3>
                {{--<p>this is the average value.</p>--}}
            </div>

        </div>

        <div class="col-sm-3 col-xs-6">

            <div class="tile-stats tile-blue">
                <div class="icon"><i class="entypo-rss"></i></div>
                <div class="num" data-start="0" data-end="{{$lessonPlays}}" data-postfix="" data-duration="1500" data-delay="600">0</div>

                <h3>{{trans('backend.general.lessons_plays_cnt')}}</h3>
                {{--<p>this is the average value.</p>--}}
            </div>

        </div>

    </div>


    <div class="row">
        <div class="col-sm-3 col-xs-6">

            <div class="tile-stats tile-green">
                <div class="icon"><i class="entypo-chart-bar"></i></div>
                <div class="num" data-start="0" data-end="{{$mushafCnt}}" data-postfix="" data-duration="1500" data-delay="0">0</div>

                <h3>{{trans('backend.general.quran_cnt')}}</h3>
                {{--<p>so far in our blog, and our website.</p>--}}
            </div>

        </div>

        <div class="col-sm-3 col-xs-6">

            <div class="tile-stats tile-green">
                <div class="icon"><i class="entypo-chart-bar"></i></div>
                <div class="num" data-start="0" data-end="{{$telawaCnt}}" data-postfix="" data-duration="1500" data-delay="600">0</div>

                <h3>{{trans('backend.general.telawa_cnt')}}</h3>
                {{--<p>this is the average value.</p>--}}
            </div>

        </div>

        <div class="col-sm-3 col-xs-6">

            <div class="tile-stats tile-green">
                <div class="icon"><i class="entypo-chart-bar"></i></div>
                <div class="num" data-start="0" data-end="{{$lessonCnt}}" data-postfix="" data-duration="1500" data-delay="600">0</div>

                <h3>{{trans('backend.general.lesson_cnt')}}</h3>
                {{--<p>this is the average value.</p>--}}
            </div>

        </div>

        <div class="col-sm-3 col-xs-6">

            <div class="tile-stats tile-green">
                <div class="icon"><i class="entypo-chart-bar"></i></div>
                <div class="num" data-start="0" data-end="{{$songCnt}}" data-postfix="" data-duration="1500" data-delay="600">0</div>

                <h3>{{trans('backend.general.song_cnt')}}</h3>
                {{--<p>this is the average value.</p>--}}
            </div>

        </div>

    </div>
@stop