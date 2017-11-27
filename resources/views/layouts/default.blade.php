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
            <div class="my-top wp">
                <a href="/" class="logo">MEA <strong>Building success</strong></a>
                <div class="top-tool">
                    <form class="search ib" action="/search" method="get">
                        <input type="text" placeholder="search" name="s" value="">
                        <input type="submit" value="搜索"/>
                    </form>
                    <div class="web-sw-list ib">
                        <a class="ch active" href="http://www.meachina.com/">简体中文</a>
                        <a class="en" href="https://www.mea-group.com/en/">英语</a>
                        <a class="de" href="https://www.mea-group.com/de/">德语</a>
                    </div>
                </div>
            </div>
            <nav class="my-menu">
                <div class="menu-btn">
                    <span>菜单</span>
                    <button type="button" class="navbar-toggle">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="menu-wrap wp">
                    <div class="menu-item">
                        <a href="/" class="item-link {{ !isset($parent) ? 'active' : '' }}"><i class="glyphicon glyphicon-home"></i></a>
                    </div>
                    @foreach($colhd as $ctp)
                    <div class="menu-item">
                        <!-- 关于米亚1 产品型号3 栏目 -->
                        @if($ctp->id == 1 || $ctp->id == 3)
                            <a href="javascript:;" class="item-link {{ (isset($parent) && $parent->id == $ctp->id) ? 'active' : '' }}">{{ $ctp->title }} <i class="glyphicon glyphicon-triangle-bottom"></i></a>
                        @else
                            <!-- 案例应用 -->
                            @if($ctp->id == 4)
                                <a href="/{{ $ctp->childColumns()->orderBy('sort','asc')->first()->path ? $ctp->childColumns()->orderBy('sort','asc')->first()->path : $ctp->childColumns()->orderBy('sort','asc')->first()->id }}" class="item-link {{ isset($parent) && $parent->id == $ctp->id ? 'active' : '' }}">{{ $ctp->title }}</a>
                            @else
                                <a href="/{{ $ctp->path ? $ctp->path : $ctp->id }}" class="item-link {{ isset($parent) && $parent->id == $ctp->id ? 'active' : '' }}">{{ $ctp->title }}</a>
                            @endif
                        @endif
                        @if(count($ctp->childColumns) > 0 && ($ctp->id == 1 || $ctp->id == 3))
                        <div class="menu-child">
                            <div class="menu-list">
                                @foreach($ctp->childColumns()->orderBy("sort",'asc')->get() as $cld)
                                    <a href="/{{ $cld->path ? $cld->path : $cld->id }}" class="item-link {{ isset($column) && $column->id == $cld->id ? 'active' : '' }}">{{ $cld->title }}</a>
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
            $(".menu-item").on("touchstart click",".item-link",function(e){
                e.stopPropagation();
                var $this = $(this);
                if($this.attr("href") == 'javascript:;'){
                    $this.closest(".my-menu").find(".menu-item").removeClass("show")
                    $this.closest(".menu-item").addClass("show")
                }
            })
            $(".my-menu").on("touchstart",".menu-btn",function(e){
                e.stopPropagation();
                var $this = $(this),$menuWrap = $('.menu-wrap'),$menu= $(".my-menu");
                $menu.toggleClass('show');
            })
            $("html,body").on("touchstart click",function(e){
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
                <p class="contact">
                    <span>米亚建筑材料 | 电话：86 512 5517 0567 </span>&nbsp;&nbsp;&nbsp; <span>传真：86 512 5511 3967 | 苏ICP备13019688号</span>
                </p>
            </div>
        </footer>
    </body>
</html>
