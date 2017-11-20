<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title','后台管理')</title>
        <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
        <script type="text/javascript" src="{{ asset('js/bootstrap.js') }}"></script>
    </head>
    <body>
        <div id="wrapper">
            <!-- Sidebar -->
            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="/admin">MEA Admin</a>
                    <a class="navbar-brand" href="/">首页</a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav side-nav">
                        <li class="{{ isset($page) && $page == 'columns' ? 'active' : '' }}">
                            <a href="{{ route('columns.index') }}">栏目管理</a>
                        </li>
                        <li class="{{ isset($page) && $page == 'users' ? 'active' : '' }}"><a href="{{ route('users.index') }}">用户管理</a></li>
                        <li class="{{ isset($page) && $page == 'contents' ? 'active' : '' }}"><a href="{{ route('contents.index') }}">内容管理</a></li>
                        <li class="{{ isset($page) && $page == 'files' ? 'active' : '' }}"><a href="{{ route('files.index') }}">文件管理</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right navbar-user">
                        <li>
                            <a href="javascript:;">欢迎：{{ Auth::user()->name }}</a>
                        </li>
                        <li> <a href="{{ route('logout') }}"> 退出</a></li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </nav>
            <div id="page-wrapper">
                @yield('content')
            </div><!-- /#page-wrapper -->
        </div>
    </body>
</html>