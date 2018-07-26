<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>权限管理系统 - @yield('title')</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="/favicon.ico">
    <link href="{{asset('vendor/hplus/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('vendor/hplus/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('vendor/hplus/css/animate.css')}}" rel="stylesheet">
    @yield('css')
    <link href="{{asset('vendor/hplus/css/style.css')}}" rel="stylesheet">
</head>

<body class="fixed-sidebar full-height-layout gray-bg" style="overflow:hidden">
<div id="wrapper">
    <!--左侧导航开始-->
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="nav-close"><i class="fa fa-times-circle"></i>
        </div>
        <div class="sidebar-collapse">
            <ul class="nav" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element">
                        <span>
                            <img alt="image" class="img-circle" src="/vendor/hplus/img/profile_small.jpg"/></span>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="clear">
                               <span class="block m-t-xs"><strong class="font-bold">{{Auth::user()->name}}</strong></span>
                                <span class="text-muted text-xs block">超级管理员</span>
                                </span>
                        </a>
                        {{--<ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li><a class="J_menuItem" href="form_avatar.html">修改头像</a>
                            </li>
                            <li><a class="J_menuItem" href="profile.html">个人资料</a>
                            </li>
                            <li><a class="J_menuItem" href="contacts.html">联系我们</a>
                            </li>
                            <li class="divider"></li>
                            </li>
                        </ul>--}}
                    </div>
                    <div class="logo-element">Artisan
                    </div>
                </li>
                @include("layouts.admin.partials._sidebar")
            </ul>
        </div>
    </nav>
    <!--左侧导航结束-->
    <!--右侧部分开始-->
    <div id="page-wrapper" class="gray-bg dashbard-1">
        <div class="row border-bottom">
            <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header"><a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i
                                class="fa fa-bars"></i> </a>
                    <form role="search" class="navbar-form-custom" method="post" action="search_results.html">
                        <div class="form-group">
                            <input type="text" placeholder="请输入您需要查找的内容 …" class="form-control" name="top-search"
                                   id="top-search">
                        </div>
                    </form>
                </div>
                <ul class="nav navbar-top-links navbar-right">
                    <li class="dropdown">
                        <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                            <i class="fa fa-envelope"></i> <span class="label label-warning">16</span>
                        </a>
                        <ul class="dropdown-menu dropdown-messages">
                            <li class="m-t-xs">
                                <div class="dropdown-messages-box">
                                    <a href="#" class="pull-left">
                                        <img alt="image" class="img-circle" src="/vendor/hplus/img/a7.jpg">
                                    </a>
                                    <div class="media-body">
                                        <small class="pull-right">46小时前</small>
                                        <strong>小四</strong> 这个在日本投降书上签字的军官，建国后一定是个不小的干部吧？
                                        <br>
                                        <small class="text-muted">3天前 2016.11.8</small>
                                    </div>
                                </div>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <div class="dropdown-messages-box">
                                    <a href="#" class="pull-left">
                                        <img alt="image" class="img-circle" src="/vendor/hplus/img/a4.jpg">
                                    </a>
                                    <div class="media-body ">
                                        <small class="pull-right text-navy">25小时前</small>
                                        <strong>国民岳父</strong> 如何看待“男子不满自己爱犬被称为狗，刺伤路人”？——这人比犬还凶
                                        <br>
                                        <small class="text-muted">昨天</small>
                                    </div>
                                </div>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <div class="text-center link-block">
                                    <a class="J_menuItem" href="#">
                                        <i class="fa fa-envelope"></i> <strong> 查看所有消息</strong>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                            <i class="fa fa-bell"></i> <span class="label label-primary">8</span>
                        </a>
                        <ul class="dropdown-menu dropdown-alerts">
                            <li>
                                <a href="#">
                                    <div>
                                        <i class="fa fa-envelope fa-fw"></i> 您有16条未读消息
                                        <span class="pull-right text-muted small">4分钟前</span>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="profile.html">
                                    <div>
                                        <i class="fa fa-qq fa-fw"></i> 3条新回复
                                        <span class="pull-right text-muted small">12分钟钱</span>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <div class="text-center link-block">
                                    <a class="J_menuItem" href="#">
                                        <strong>查看所有 </strong>
                                        <i class="fa fa-angle-right"></i>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown hidden-xs">
                        <a class="right-sidebar-toggle" aria-expanded="false">
                            <i class="fa fa-tasks"></i> 主题
                        </a>
                    </li>

                    <li class="hidden-xs">
                        <a aria-expanded="false" role="button" href="#" class="dropdown-toggle"
                           data-toggle="dropdown"> 系统 <span class="caret"></span></a>
                        <ul role="menu" class="dropdown-menu">
                            <li>
                                <a href=""><i class="fa fa-tasks"></i>&nbsp;&nbsp;修改密码</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="fa fa-tasks"></i>&nbsp;&nbsp;退出登录</a>
                                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
                            </li>
                        </ul>
                    </li>

                </ul>
            </nav>
        </div>
        <div class="row J_mainContent" id="content-main">
            <div class="row wrapper border-bottom white-bg page-heading" style="margin-right: 0px;">
                <div class="col-sm-4">
                    <ol class="breadcrumb">
                        <li>
                            <a href="{{route('admin.index.index')}}">首页</a>
                        </li>
                        <li class="active">
                            <strong>@yield('title')</strong>
                        </li>
                    </ol>
                </div>
            </div>
            @yield('content')
        </div>
       @include("layouts.admin.partials._footer")
    </div>

    <!--右侧部分结束-->
    <!--右侧边栏开始-->
    <div id="right-sidebar">
        <div class="sidebar-container">

            <ul class="nav nav-tabs navs-3">

                <li class="active">
                    <a data-toggle="tab" href="#tab-1">
                        <i class="fa fa-gear"></i> 主题
                    </a>
                </li>
                {{--<li class=""><a data-toggle="tab" href="#tab-2">
                        通知
                    </a>
                </li>
                <li><a data-toggle="tab" href="#tab-3">
                        项目进度
                    </a>
                </li>--}}
            </ul>

            <div class="tab-content">
                <div id="tab-1" class="tab-pane active">
                    <div class="skin-setttings">
                        <div class="title">主题设置</div>
                        <div class="setings-item">
                            <span>收起左侧菜单</span>
                            <div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox" name="collapsemenu" class="onoffswitch-checkbox"
                                           id="collapsemenu">
                                    <label class="onoffswitch-label" for="collapsemenu">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="setings-item">
                            <span>固定顶部</span>

                            <div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox" name="fixednavbar" class="onoffswitch-checkbox"
                                           id="fixednavbar">
                                    <label class="onoffswitch-label" for="fixednavbar">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="setings-item">
                                <span>
                        固定宽度
                    </span>

                            <div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox" name="boxedlayout" class="onoffswitch-checkbox"
                                           id="boxedlayout">
                                    <label class="onoffswitch-label" for="boxedlayout">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="title">皮肤选择</div>
                        <div class="setings-item default-skin nb">
                                <span class="skin-name ">
                         <a href="#" class="s-skin-0">
                             默认皮肤
                         </a>
                    </span>
                        </div>
                        <div class="setings-item blue-skin nb">
                                <span class="skin-name ">
                        <a href="#" class="s-skin-1">
                            蓝色主题
                        </a>
                    </span>
                        </div>
                        <div class="setings-item yellow-skin nb">
                                <span class="skin-name ">
                        <a href="#" class="s-skin-3">
                            黄色/紫色主题
                        </a>
                    </span>
                        </div>
                    </div>
                </div>
                <div id="tab-2" class="tab-pane">

                    <div class="sidebar-title">
                        <h3><i class="fa fa-comments-o"></i> 最新通知</h3>
                        <small><i class="fa fa-tim"></i> 您当前有10条未读信息</small>
                    </div>

                    <div>

                        <div class="sidebar-message">
                            <a href="#">
                                <div class="pull-left text-center">
                                    <img alt="image" class="img-circle message-avatar" src="/vendor/hplus/img/a1.jpg">

                                    <div class="m-t-xs">
                                        <i class="fa fa-star text-warning"></i>
                                        <i class="fa fa-star text-warning"></i>
                                    </div>
                                </div>
                                <div class="media-body">

                                    据天津日报报道：瑞海公司董事长于学伟，副董事长董社轩等10人在13日上午已被控制。
                                    <br>
                                    <small class="text-muted">今天 4:21</small>
                                </div>
                            </a>
                        </div>
                    </div>

                </div>
                <div id="tab-3" class="tab-pane">

                    <div class="sidebar-title">
                        <h3><i class="fa fa-cube"></i> 最新任务</h3>
                        <small><i class="fa fa-tim"></i> 您当前有14个任务，10个已完成</small>
                    </div>

                    <ul class="sidebar-list">
                        <li>
                            <a href="#">
                                <div class="small pull-right m-t-xs">9小时以后</div>
                                <h4>市场调研</h4> 按要求接收教材；

                                <div class="small">已完成： 22%</div>
                                <div class="progress progress-mini">
                                    <div style="width: 22%;" class="progress-bar progress-bar-warning"></div>
                                </div>
                                <div class="small text-muted m-t-xs">项目截止： 4:00 - 2015.10.01</div>
                            </a>
                        </li>

                        <li>
                            <a href="#">
                                <span class="label label-primary pull-right">NEW</span>
                                <h4>设计阶段</h4>
                                <!--<div class="small pull-right m-t-xs">9小时以后</div>-->
                                项目进度报告(Project Progress Report)
                                <div class="small">已完成： 22%</div>
                                <div class="small text-muted m-t-xs">项目截止： 4:00 - 2015.10.01</div>
                            </a>
                        </li>
                    </ul>

                </div>
            </div>

        </div>
    </div>
    <!--右侧边栏结束-->

{{--<!--mini聊天窗口开始-->
<div class="small-chat-box fadeInRight animated">

    <div class="heading" draggable="true">
        <small class="chat-date pull-right">
            2015.9.1
        </small> 与 Beau-zihan 聊天中
    </div>

    <div class="content">

        <div class="left">
            <div class="author-name">
                Beau-zihan <small class="chat-date">
                    10:02
                </small>
            </div>
            <div class="chat-message active">
                你好
            </div>

        </div>
        <div class="right">
            <div class="author-name">
                游客
                <small class="chat-date">
                    11:24
                </small>
            </div>
            <div class="chat-message">
                你好，请问hplus有帮助文档吗？
            </div>
        </div>
        <div class="left">
            <div class="author-name">
                Beau-zihan
                <small class="chat-date">
                    08:45
                </small>
            </div>
            <div class="chat-message active">
                有，购买的hplus源码包中有帮助文档，位于docs文件夹下
            </div>
        </div>
        <div class="right">
            <div class="author-name">
                游客
                <small class="chat-date">
                    11:24
                </small>
            </div>
            <div class="chat-message">
                那除了帮助文档还提供什么样的服务？
            </div>
        </div>
        <div class="left">
            <div class="author-name">
                Beau-zihan
                <small class="chat-date">
                    08:45
                </small>
            </div>
            <div class="chat-message active">
                1.所有源码(未压缩、带注释版本)；
                <br> 2.说明文档；
                <br> 3.终身免费升级服务；
                <br> 4.必要的技术支持；
                <br> 5.付费二次开发服务；
                <br> 6.授权许可；
                <br> ……
                <br>
            </div>
        </div>


    </div>
    <div class="form-chat">
        <div class="input-group input-group-sm">
            <input type="text" class="form-control"> <span class="input-group-btn"> <button
                        class="btn btn-primary" type="button">发送
            </button> </span>
        </div>
    </div>

</div>
<div id="small-chat">
    <span class="badge badge-warning pull-right">5</span>
    <a class="open-small-chat">
        <i class="fa fa-comments"></i>

    </a>
</div>--}}
<!--mini聊天窗口结束-->
</div>

<!-- 全局js -->
<script src="{{asset('vendor/hplus/js/jquery.min.js')}}"></script>
<script src="{{asset('vendor/hplus/js/bootstrap.min.js')}}"></script>
<script src="{{asset('vendor/hplus/js/plugins/metisMenu/jquery.metisMenu.js')}}"></script>
<script src="{{asset('vendor/hplus/js/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>
<script src="{{asset('vendor/layui/layui.js')}}"></script>
<script src="{{asset('vendor/layer/layer.js')}}"></script>
<!-- 自定义js -->
<script src="{{asset('vendor/hplus/js/hplus.js')}}"></script>
<script src="{{asset('admins/js/admin.js')}}"></script>
<script type="text/javascript" src="{{asset('vendor/hplus/js/contabs.js')}}"></script>
<!-- 第三方插件 -->
<script src="{{asset('vendor/hplus/js/plugins/pace/pace.min.js')}}"></script>

<!-- Peity -->
<script src="/vendor/hplus/js/plugins/peity/jquery.peity.min.js"></script>
<script src="/vendor/hplus/js/demo/peity-demo.js"></script>
<script>
    function ajaxDate(url,type,data,load,error) {
        $.ajax({
            url: url,
            type: type,
            dataType: 'json',
            data: data,
            error: function (data) {
                load === true ? layer.close(error) : '';
                errors = data.responseJSON.errors;
                for (key in errors) {
                    layer.alert(errors[key][0], {icon: 5});
                    return false;
                }
            },
            success: function (data) {
                if (data.status == 1) {
                    layer.msg(data.message, {icon: 2, time:800},function () {
                        window.location.reload();
                    });
                } else {
                    load === true ? layer.close(error) : '';
                    layer.alert(data.message, {icon: 5});
                }
            }
        });
    }
</script>
@yield('js')

</body>

</html>