<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title','米亚')</title>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('layer/css/layui.css') }}">
        <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
        <script type="text/javascript" src="{{ asset('layer/layui.js') }}"></script>
    </head>
    <body>
        <header class="page-header">
            <div class="my-top cf">
                <a href="/" class="logo l">MEA <strong>Building success</strong></a>
                <div class="r top-tool">
                    <div class="search ib">
                        <input type="text" placeholder="search" name="" value="">
                        <input type="submit" value="搜索"/>
                    </div>
                    <div class="web-sw-list ib">
                        <a class="ch active" href="#">简体中文</a>
                        <a class="en" href="#">英语</a>
                        <a class="de" href="#">德语</a>
                    </div>
                </div>
            </div>
            <nav class="my-menu">
                @foreach($colhd as $ctp)
                <div class="menu-item {{ $ctp->id==2 ? 'float' : '' }}">
                    @if($ctp->id == 1 || $ctp->id == 3)
                        <a href="javascript:;" class="item-link">{{ $ctp->title }}</a>
                    @else
                        <a href="/{{ $ctp->path ? $ctp->path : $ctp->id }}" class="item-link">{{ $ctp->title }}</a>
                    @endif
                    @if(count($ctp->childColumns) > 0 && ($ctp->id == 1 || $ctp->id == 3))
                    <div class="menu-child">
                        <div class="menu-list">
                            @foreach($ctp->childColumns as $cld)
                                <a href="/{{ $cld->path ? $cld->path : $cld->id }}" class="item-link {{ $cld->id==2 ? 'float' : '' }}">{{ $cld->title }}</a>
                            @endforeach
                        </div>
                        <div class="menu-brand">
                            <img src="{{ $ctp->pic }}" alt="">
                        </div>
                    </div>
                    @endif
                </div>
                @endforeach
            </nav>
        </header>
        <script type="text/javascript">
            $(".menu-item").on("click",".item-link",function(e){
                var $this = $(this);
                if($this.attr("href") == 'javascript:;'){
                    $this.closest(".my-menu").find(".menu-item").removeClass("show")
                    $this.closest(".menu-item").addClass("show")
                }
            })
        </script>
        @yield('banner')
        <div class="page-bd">@yield('content')</div>
        <footer class="page-ft">
            <div class="ft-nav">
                @foreach($colft as $cft)
                <a href="/{{ $cft->path ? $cft->path : $cft->id }}" class="nav-item ib">{{ $cft->title }}</a>
                @endforeach
            </div>
            <div class="ft-extra">
                <p><a href="http://www.meachina.com">www.meachina.com</a><a href="http://www.mea-group.com">www.mea-group.com</a></p>
                <p>
                    米亚建筑材料 | 电话：86 512 5517 0567 | 传真：86 512 5511 3967 | 苏ICP备13019688号
                </p>
            </div>
        </footer>
    </body>
</html>
