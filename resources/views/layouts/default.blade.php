<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" />
        <title>@yield('title','米亚') | 线性排水系统领导者</title>
        <meta name="keywords" content="米亚排水，MEA，米亚建筑，建筑材料，线性排水，成品排水沟，树脂混凝土，高效排水系统">
        <meta name="description" content="提供排水解决方案，树脂成品排水沟，德国品质，排水系统领导者，成品排水领导者，聚合物树脂混凝土排水产品">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('layer/css/layui.css') }}">
        <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
        <script type="text/javascript" src="{{ asset('layer/layui.js') }}"></script>
        <script>
            function gaTrackEvent(c,a){
                try{
                    _gat._getTracker("UA-36472620-1")._trackEvent(c,a);
                }catch(e){}
            }
            function gaTrackLink(link,category,action,newwindow){
                gaTrackEvent(category,action);
                if(newwindow)
                {
                    setTimeout('window.open(\"' + link.href + '\");',100);
                }
                else{
                    setTimeout('document.location=\"' + link.href + '\"',100);
                }
            }
            var _gaq=_gaq||[];_gaq.push(['_setAccount','UA-36472620-1']);_gaq.push(['_gat._anonymizeIp']);
            setTimeout('_gaq.push([\'_trackEvent\',\'NoBounce\',\'Over 5 seconds\'])',5000);
            _gaq.push(['_trackPageview']);
            (function(){
                var ga=document.createElement('script');
                ga.type='text/javascript';
                ga.async=true;
                ga.src=('https:'==document.location.protocol ? 'https://ssl': 'http://www') + '.google-analytics.com/ga.js';
                var s=document.getElementsByTagName('script')[0];
                s.parentNode.insertBefore(ga,s);
            })();
        </script>

    </head>
    <body>
        <script type="text/javascript">
        var _hmt = _hmt || [];
        (function() {
          var hm = document.createElement("script");
          hm.src = "https://hm.baidu.com/hm.js?5504151443a9b7e130126c73aa5e56c0";
          var s = document.getElementsByTagName("script")[0]; 
          s.parentNode.insertBefore(hm, s);
        })();
        </script>
        <header class="page-header">
            <div class="my-top wp">
                <a href="/" class="logo">MEA <strong>Building success</strong></a>
                <div class="top-tool">
                    <form class="search ib" action="/search" method="get">
                        <input type="text" placeholder="search" name="s" value="">
                        <input type="submit" value="搜索"/>
                    </form>
                    <div class="web-sw-list ib">
                        <a class="ch active" href="#">简体中文</a>
                        <a class="en" href="https://www.mea-group.com/en/" target="_blank">英语</a>
                        <a class="de" href="https://www.mea-group.com/de/" target="_blank">德语</a>
                        <a class="de" href="https://www.mea-group.com/fr/" target="_blank">法语</a>
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
            $(".my-menu").on("click",".item-link",function(e){
                e.stopPropagation();
                var $this = $(this);
                if($this.attr("href") == 'javascript:;'){
                    if($this.closest(".menu-item").hasClass('show')){
                        $this.closest(".my-menu").find(".menu-item").removeClass("show");
                    }else{
                        $this.closest(".my-menu").find(".menu-item").removeClass("show");
                        $this.closest(".menu-item").addClass("show");
                    }
                }
            })
            $(".my-menu").on("click",".menu-btn",function(e){
                e.stopPropagation();
                var $this = $(this),$menuWrap = $('.menu-wrap'),$menu= $(".my-menu");
                if($menu.hasClass('show')){
                    $menu.removeClass('show');
                    $menuWrap.css('height',0);
                }else{
                    $menu.addClass('show');
                    $menuWrap.animate({
                        height : '240px'
                    },300,function(){
                        $menuWrap.css('height','auto');
                    });
                }
            })
            $("html,body").on("touchstart click",function(e){
                if(!$(e.target).closest(".menu-child").length && !$(e.target).closest(".show").length && !$(e.target).hasClass("menu-btn")){
                    $(".my-menu").find(".menu-item").removeClass("show");
                }
                console.log(e);
            })
            var $menu = $(".my-menu"),
                $header = $(".page-header"),
                menuOffset = $menu.offset();
            miya.fn.scroll(function(){
                var winData = miya.ui.getW();
                if($(document.body).height() - winData.innerHeight < 300){
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
            <div class="ft-nav wp">
                @foreach($colft as $cft)
                <a href="/{{ $cft->path ? $cft->path : $cft->id }}" class="nav-item ib">{{ $cft->title }}</a>
                @endforeach
                <span class="nav-item code"><img src="../img/code.jpeg" alt="">扫码关注米亚公众号</span>
            </div>
            <div class="ft-extra">
                <p>
                    <a href="http://www.meachina.com" target="_blank">www.meachina.com</a>
                    <a href="http://www.mea-group.com" target="_blank">www.mea-group.com</a>
                </p>
                <p class="contact">
                    <span>米亚建筑材料 | 电话：86 512 5517 0567 </span>&nbsp;&nbsp;&nbsp; <span>传真：86 512 5511 3967 | 苏ICP备13019688号</span>
                </p>
            </div>
        </footer>
    </body>
</html>
