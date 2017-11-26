
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
window.miya = {
    ui : {
        throttle: function(fn, delay, immediate, debounce) {
			var curr = +new Date(), //当前事件
				last_call = 0,
				last_exec = 0,
				timer = null,
				diff, //时间差
				context, //上下文
				args,
				exec = function() {
					last_exec = curr;
					fn.apply(context, args);
				};
			return function() {
				curr = +new Date();
				context = this,
				args = arguments,
				diff = curr - (debounce ? last_call : last_exec) - delay;
				clearTimeout(timer);
				if (debounce) {
					if (immediate) {
						timer = setTimeout(exec, delay);
					} else if (diff >= 0) {
						exec();
					}
				} else {
					if (diff >= 0) {
						exec();
					} else if (immediate) {
						timer = setTimeout(exec, -diff);
					}
				}
				last_call = curr;
			};
		},
		debounce: function(fn, delay, immediate) {
			return miya.ui.throttle(fn, delay, immediate, true);
		},
        getW: function() { //获取当前窗口所有数据； 意向如此-以后按需补充
			var $w = $(window);
			return {
				screenWidth : window.screen.width,
				screenHeight : window.screen.height,
				innerWidth: $w.width(),
				innerHeight: $w.height(),
				scrollY: $w.scrollTop(),
				scrollX: $w.scrollLeft()
			};
		}
    },
    fn : {
    	scrollToElement: function(selector, time, verticalOffset,cb,scrollElement) {
			time = typeof(time) != 'undefined' ? time : 500;
			verticalOffset = typeof(verticalOffset) != 'undefined' ? verticalOffset : 0;
			var offset = 0;
			if(typeof selector == 'object' || typeof selector == 'string'){
				offset = $(selector).offset();
			}else if(typeof selector == 'number'){
				offset = selector;
			}
			var offsetTop = offset.top + verticalOffset;
			if(!scrollElement) scrollElement = 'html,body';
			$(scrollElement).animate({
				scrollTop: offsetTop
			}, time,function(){
				if(typeof cb == 'function') cb();
			});
		},
        scroll : function(callback,time,element){
			var $scroll;
			if(element && typeof element == 'string'){
				$scroll = $(element);
			}else if(element && element.length){
				$scroll = element;
			}else{
				$scroll = $(window);
			}
			$scroll.on('scroll',miya.ui.debounce(function() {
				if (callback && typeof callback == 'function') callback(window.scrollX,window.scrollY);
			},time || 0));
		},
        scrollResize: function(callback,time,type) { //页面变化 滚动 或 尺寸
			if(type){
				$(window).on(type,miya.ui.debounce(function() {
					if (callback && typeof callback == 'function') callback();
				},time || 0));
			}
			else{
				$(window).on('resize',miya.ui.debounce(function() {
					if (callback && typeof callback == 'function') callback();
				},time || 0));
				$(window).on('scroll',miya.ui.debounce(function() {
					if (callback && typeof callback == 'function') callback();
				},time || 0));
			}
		},
        exchange : function(a,b){
            if(window.$){
                var n = a.next(), p = b.prev();
                b.insertBefore(n);
                a.insertAfter(p);
            }
        },
        responseWinSize : function(cb){
            var winData = miya.ui.getW(),
                $bd = $('.page-bd'),
                $main = $('.page-main'),
                $aside = $('.page-aside');
            console.log(winData);
            if(winData.innerWidth < 640 && $main.next(".page-aside").length){
                // miya.fn.exchange($main,$aside);
                $main.insertAfter($aside);
            }else if($aside.next(".page-main").length){
                $main.insertBefore($aside);
            }
            if(typeof cb == 'function') cb(winData);
        }
    }
};

// window.Vue = require('vue');

// require('../sass/app.scss');

// *
//  * Next, we will create a fresh Vue application instance and attach it to
//  * the page. Then, you may begin adding components to this application
//  * or customize the JavaScript scaffolding to fit your unique needs.


// Vue.component('example', require('./components/Example.vue'));
//
// const app = new Vue({
//     el: '#app'
// });
