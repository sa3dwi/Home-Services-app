
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        {{--<div class="user-panel">--}}
            {{--<div class="pull-left image">--}}
                {{--<img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image" />--}}
            {{--</div>--}}
            {{--<div class="pull-left info">--}}
                {{--<p>Alexander Pierce</p>--}}
                {{--<a href="#"><i class="fa fa-circle text-success"></i> Online</a>--}}
            {{--</div>--}}
        {{--</div>--}}
        <!-- search form -->
        {{--<form action="#" method="get" class="sidebar-form">--}}
            {{--<div class="input-group">--}}
                {{--<input type="text" name="q" class="form-control" placeholder="Search..."/>--}}
                {{--<span class="input-group-btn">--}}
                {{--<button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>--}}
                {{--</span>--}}
            {{--</div>--}}
        {{--</form>--}}
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="active treeview">
                <a href="{{ route('backend') }}">
                    <i class="fa fa-dashboard"></i> <span>الرئيسية</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                {{--<ul class="treeview-menu">--}}
                    {{--<li class="active"><a href="index.html"><i class="fa fa-circle-o"></i> Dashboard v1</a></li>--}}
                    {{--<li><a href="index2.html"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>--}}
                {{--</ul>--}}
            </li>
            <li class="treeview">
                <a href="{{ route('pages') }}">
                    <i class="fa fa-files-o"></i>
                    <span>الصفحات</span>
                    {{--<span class="label label-primary pull-right">4</span>--}}
                </a>
            </li>
            <li>
                <a href="{{ route('hotels') }}">
                    <i class="fa fa-th"></i> <span>الفنادق</span>
                </a>
            </li>
            <li class="treeview">
                <a href="{{ route('roomscategories') }}">
                    <i class="fa fa-table"></i> <span> انواع وخصائص الغرف </span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
            </li>
            <li class="treeview">
                <a href="{{ route('rooms') }}">
                    <i class="fa fa-circle-o"></i>
                    <span>الغرف</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
            </li>
            <li class="treeview">
                <a href="{{ route('coupons') }}">
                    <i class="fa fa-laptop"></i>
                    <span>العروض</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
            </li>
            <li class="treeview">
                <a href="{{ route('booking') }}">
                    <i class="fa fa-edit"></i> <span>الحجوزات</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
            </li>
            {{--<li>--}}
                {{--<a href="{{ route('pages') }}">--}}
                    {{--<i class="fa fa-share"></i> <span>بيانات العملاء</span>--}}
                {{--</a>--}}
            {{--</li>--}}
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>