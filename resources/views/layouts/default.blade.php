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
            <div class="my-top cf wp">
                <a href="/" class="logo l">MEA <strong>Building success</strong></a>
                <div class="r top-tool">
                    <form class="search ib" action="/search" method="get">
                        <input type="text" placeholder="search" name="s" value="">
                        <input type="submit" value="搜索"/>
                    </form>
                    <div class="web-sw-list ib">
                        <a class="ch active" href="#">简体中文</a>
                        <a class="en" href="#">英语</a>
                        <a class="de" href="#">德语</a>
                    </div>
                </div>
            </div>
            <nav class="my-menu">
                <div class="menu-wrap wp">
                    <div class="menu-item">
                        <a href="/" class="item-link"><span class="glyphicon glyphicon-home"></span></a>
                    </div>
                    @foreach($colhd as $ctp)
                    <div class="menu-item">
                        @if($ctp->id == 1 || $ctp->id == 3)
                            <a href="javascript:;" class="item-link">{{ $ctp->title }}</a>
                        @else
                            <a href="/{{ $ctp->path ? $ctp->path : $ctp->id }}" class="item-link">{{ $ctp->title }}</a>
                        @endif
                        @if(count($ctp->childColumns) > 0 && ($ctp->id == 1 || $ctp->id == 3))
                        <div class="menu-child">
                            <div class="menu-list">
                                @foreach($ctp->childColumns as $cld)
                                    <a href="/{{ $cld->path ? $cld->path : $cld->id }}" class="item-link">{{ $cld->title }}</a>
                                @endforeach
                            </div>
                            <div class="menu-brand">
                                <img src="{{ $ctp->pic }}" alt="">
                            </div>
                        </div>
                        @endif
                    </div>
                    @endforeach
                </div>
            </nav>
        </header>
        <script type="text/javascript">
            $(".menu-item").on("click",".item-link",function(e){
                e.stopPropagation();
                var $this = $(this);
                if($this.attr("href") == 'javascript:;'){
                    $this.closest(".my-menu").find(".menu-item").removeClass("show")
                    $this.closest(".menu-item").addClass("show")
                }
            })
            $("html,body").on("click",function(e){
                if(!$(e.target).closest(".menu-child").length){
                    $(".my-menu").find(".menu-item").removeClass("show");
                }
                console.log(e);
            })
            var $menu = $(".my-menu"),
                $header = $(".page-header"),
                menuOffset = $menu.offset();
            miya.fn.scroll(function(){
                var winData = miya.ui.getW();
                if(winData.innerWidth < 640 && $(document.body).height() - winData.innerHeight < 300){
                    return;
                }
                if(winData.scrollY > menuOffset.top){
                    $menu.addClass("fixed");
                    $header.css("padding-bottom",$menu.outerHeight() + 30);
                }else{
                    $menu.removeClass("fixed");
                    $header.css("padding-bottom",0);
                }
            },10);
            $(function(){
                miya.fn.responseWinSize();
                miya.fn.scrollResize(function(){
                    var winData = miya.ui.getW();
                    miya.fn.responseWinSize();
                },10,'resize');
            });
        </script>
        @yield('banner')
        @yield('intro')
        @if(isset($company) && $company->id > 0 || isset($key))
        <div class="page-bd wp">@yield('content')</div>
        @else
        <div class="page-bd wp cup">@yield('content')</div>
        @endif
        <footer class="page-ft">
            <div class="ft-nav">
                @foreach($colft as $cft)
                <a href="/{{ $cft->path ? $cft->path : $cft->id }}" class="nav-item ib">{{ $cft->title }}</a>
                @endforeach
            </div>
            <div class="ft-extra">
                <p><a href="http://www.meachina.com">www.meachina.com</a><a href="http://www.mea-group.com">www.mea-group.com</a></p>
                <p>
                    <span>米亚建筑材料 | 电话：86 512 5517 0567 </span>&nbsp;&nbsp;&nbsp; <span>传真：86 512 5511 3967 | 苏ICP备13019688号</span>
                </p>
            </div>
        </footer>
    </body>
</html>
