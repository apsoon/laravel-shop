<!-- inner sidebar -->
<section class="sidebar">
    <!-- sidebar menu -->
    <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li>
            <a href="{{ url("/index") }}">
                <i class="fa fa-dashboard"></i>
                <span>系统首页</span>
            </a>
        </li>
        <li class="treeview active menu-open">
            <a href="#">
                <i class="fa fa-inbox"></i>
                <span>商品管理</span>
                <span class="pull-right-container">
                   <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li class="active"><a href="{{ url("goods/list") }}"><i class="fa fa-circle-o"></i>商品列表</a></li>
                <li><a href="{{ url("category/list") }}"><i class="fa fa-circle-o"></i>商品分类</a></li>
                <li><a href="{{ url("brand/list") }}"><i class="fa fa-circle-o"></i>品牌管理</a></li>
                <li><a href="{{ url("specification/list") }}"><i class="fa fa-circle-o"></i>商品规格</a></li>
                <li><a href="{{ url("attribute/list") }}"><i class="fa fa-circle-o"></i>商品属性</a></li>
            </ul>
        </li>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-database"></i>
                <span>交易管理</span>
                <span class="pull-right-container">
                   <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="#"><i class="fa fa-circle-o"></i>订单管理</a></li>
                {{--<li><a href="#">退款管理</a></li>--}}
                {{--<li><a href="#">物流管理</a></li>--}}
            </ul>
        </li>
        <li class="treeview">
            <a href="#">
                <span>优惠券管理</span>
                <span class="pull-right-container">
                   <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="#"><i class="fa fa-circle-o"></i>优惠券列表</a></li>
            </ul>
        </li>
        <li class="treeview">
            <a>
                <span>广告管理</span>
                <span class="pull-right-container">
                   <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="{{url("ad/list")}}"><i class="fa fa-circle-o"></i>广告列表</a></li>
                <li><a href="{{url("adPosition/list")}}"><i class="fa fa-circle-o"></i>广告位置</a></li>
            </ul>
        </li>
        <li class="treeview">
            <a href="#">
                <span>用户管理</span>
                <span class="pull-right-container">
                   <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="#"><i class="fa fa-circle-o"></i>用户列表</a></li>
            </ul>
        </li>
        <li class="treeview">
            <a href="#">
                <span>管理员</span>
                <span class="pull-right-container">
                   <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="#"><i class="fa fa-circle-o"></i>管理员列表</a></li>
                {{--<li><a href="#">权限设置</a></li>--}}
                {{--<li><a href="#">系统日志</a></li>--}}
            </ul>
        </li>
        <li><a href="{{ url("/help") }}"><span>帮助文档</span></a></li>
    </ul>
    <!-- /.sidebar-menu -->
</section>
