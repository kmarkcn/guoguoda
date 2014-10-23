$.easing['jswing']=$.easing['swing'];$.extend($.easing,{def:'easeOutQuad',swing:function(x,t,b,c,d){return $.easing[$.easing.def](x,t,b,c,d)},easeInQuad:function(x,t,b,c,d){return c*(t/=d)*t+b},easeOutQuad:function(x,t,b,c,d){return-c*(t/=d)*(t-2)+b},easeInOutQuad:function(x,t,b,c,d){if((t/=d/2)<1) return c/2*t*t+b;return-c/2*((--t)*(t-2)-1)+b},easeInCubic:function(x,t,b,c,d){return c*(t/=d)*t*t+b},easeOutCubic:function(x,t,b,c,d){return c*((t=t/d-1)*t*t+1)+b},easeInOutCubic:function(x,t,b,c,d){if((t/=d/2)<1)return c/2*t*t*t+b;return c/2*((t-=2)*t*t+2)+b},easeInQuart:function(x,t,b,c,d){return c*(t/=d)*t*t*t+b},easeOutQuart:function(x,t,b,c,d){return-c*((t=t/d-1)*t*t*t-1)+b},easeInOutQuart:function(x,t,b,c,d){if((t/=d/2)<1)return c/2*t*t*t*t+b;return-c/2*((t-=2)*t*t*t-2)+b},easeInQuint:function(x,t,b,c,d){return c*(t/=d)*t*t*t*t+b},easeOutQuint:function(x,t,b,c,d){return c*((t=t/d-1)*t*t*t*t+1)+b},easeInOutQuint:function(x,t,b,c,d){if((t/=d/2)<1)return c/2*t*t*t*t*t+b;return c/2*((t-=2)*t*t*t*t+2)+b},easeInSine:function(x,t,b,c,d){return-c*Math.cos(t/d*(Math.PI/2))+c+b},easeOutSine:function(x,t,b,c,d){return c*Math.sin(t/d*(Math.PI/2))+b},easeInOutSine:function(x,t,b,c,d){return-c/2*(Math.cos(Math.PI*t/d)-1)+b},easeInExpo:function(x,t,b,c,d){return(t==0)?b:c*Math.pow(2,10*(t/d-1))+b},easeOutExpo:function(x,t,b,c,d){return(t==d)?b+c:c*(-Math.pow(2,-10*t/d)+1)+b},easeInOutExpo:function(x,t,b,c,d){if(t==0)return b;if(t==d)return b+c;if((t/=d/2)<1)return c/2*Math.pow(2,10*(t-1))+b;return c/2*(-Math.pow(2,-10*--t)+2)+b},easeInCirc:function(x,t,b,c,d){return-c*(Math.sqrt(1-(t/=d)*t)-1)+b},easeOutCirc:function(x,t,b,c,d){return c*Math.sqrt(1-(t=t/d-1)*t)+b},easeInOutCirc:function(x,t,b,c,d){if((t/=d/2)<1)return-c/2*(Math.sqrt(1-t*t)-1)+b;return c/2*(Math.sqrt(1-(t-=2)*t)+1)+b},easeInElastic:function(x,t,b,c,d){var s=1.70158;var p=0;var a=c;if(t==0) return b;if((t/=d)==1)return b+c;if(!p)p=d*.3;if(a<Math.abs(c)){a=c;var s=p/4}else var s=p/(2*Math.PI)*Math.asin(c/a);return-(a*Math.pow(2,10*(t-=1))*Math.sin((t*d-s)*(2*Math.PI)/p))+b},easeOutElastic:function(x,t,b,c,d){var s=1.70158;var p=0;var a=c;if(t==0)return b;if((t/=d)==1)return b+c;if(!p)p=d*.3;if(a<Math.abs(c)){a=c;var s=p/4}else var s=p/(2*Math.PI)*Math.asin(c/a);return a*Math.pow(2,-10*t)*Math.sin((t*d-s)*(2*Math.PI)/p)+c+b},easeInOutElastic:function(x,t,b,c,d){var s=1.70158;var p=0;var a=c;if(t==0)return b;if((t/=d/2)==2)return b+c;if(!p)p=d*(.3*1.5);if(a<Math.abs(c)){a=c;var s=p/4}else var s=p/(2*Math.PI)*Math.asin(c/a);if(t<1)return-.5*(a*Math.pow(2,10*(t-=1))*Math.sin((t*d-s)*(2*Math.PI)/p))+b;return a*Math.pow(2,-10*(t-=1))*Math.sin((t*d-s)*(2*Math.PI)/p)*.5+c+b},easeInBack:function(x,t,b,c,d,s){if(s==undefined)s=1.70158;return c*(t/=d)*t*((s+1)*t-s)+b},easeOutBack:function(x,t,b,c,d,s){if(s==undefined)s=1.70158;return c*((t=t/d-1)*t*((s+1)*t+s)+1)+b},easeInOutBack:function(x,t,b,c,d,s){if(s==undefined)s=1.70158;if((t/=d/2)<1)return c/2*(t*t*(((s*=(1.525))+1)*t-s))+b;return c/2*((t-=2)*t*(((s*=(1.525))+1)*t+s)+2)+b},easeInBounce:function(x,t,b,c,d){return c-$.easing.easeOutBounce(x,d-t,0,c,d)+b},easeOutBounce:function(x,t,b,c,d){if((t/=d)<(1/2.75)){return c*(7.5625*t*t)+b}else if(t<(2/2.75)){return c*(7.5625*(t-=(1.5/2.75))*t+.75)+b}else if(t<(2.5/2.75)){return c*(7.5625*(t-=(2.25/2.75))*t+.9375)+b}else{return c*(7.5625*(t-=(2.625/2.75))*t+.984375)+b}},easeInOutBounce:function(x,t,b,c,d){if(t<d/2)return $.easing.easeInBounce(x,t*2,0,c,d)*.5+b;return $.easing.easeOutBounce(x,t*2-d,0,c,d)*.5+c*.5+b}})
/*
** 变量值
*/

$(function(){    
	var Msize = $('.m-page').size(), 	//页面的数目
	page_n			= 1,			//初始页面位置
	initP			= null,			//初值控制值
	moveP			= null,			//每次获取到的值
	firstP			= null,			//第一次获取的值
	newM			= null,			//重新加载的浮层
	p_b				= null,			//方向控制值
	indexP			= null, 		//控制首页不能直接找转到最后一页
	move			= null,			//触摸能滑动页面
	start			= true, 		//控制动画开始
	startM			= null,			//开始移动
	position		= null,			//方向值
	DNmove			= false,		//其他操作不让页面切换
	mapS			= null,			//地图变量值
	canmove			= false,		//首页返回最后一页
	mousedown		= null,			//PC鼠标控制鼠标按下获取值
	textNode		= [],			//文本对象
	textInt			= 1,			//文本对象顺序
	playM_T			= "off";
	
  
 
  
/*
** 单页切换 各个元素fixed 控制body高度 
*/
	var v_h	= null;		//记录设备的高度
	
	function init_pageH(){
		var fn_h = function() {
			if(document.compatMode == 'BackCompat')
				var Node = document.body;
			else
				var Node = document.documentElement;
			 return Math.max(Node.scrollHeight,Node.clientHeight);
		}
		var page_h = fn_h();
		var m_h = $('.m-page').height();
		page_h >= m_h ? v_h = page_h : v_h = m_h ;
		
		//设置各种模块页面的高度，扩展到整个屏幕高度
		$('.m-page').height(v_h); 	
		$('.p-index').height(v_h);
		
	};
	init_pageH();

    
/*
**模版切换页面的效果
*/
	//绑定事件
	function changeOpen(e){
		$('.m-page').on('mousedown touchstart',page_touchstart);
		$('.m-page').on('mousemove touchmove',page_touchmove);
		$('.m-page').on('mouseup touchend mouseout',page_touchend);
	};
	
	//取消绑定事件
	function changeClose(e){
		$('.m-page').off('mousedown touchstart');
		$('.m-page').off('mousemove touchmove');
		$('.m-page').off('mouseup touchend mouseout');
	};
	
	//开启事件绑定滑动
	changeOpen();
	
	//触摸（鼠标按下）开始函数
	function page_touchstart(e){
		if (e.type == 'touchstart') {
			initP = window.event.touches[0].pageY;
		} else {
			initP = e.y || e.pageY;
			mousedown = true;
		}
		firstP = initP;	
		
	};
	//触摸移动（鼠标移动）开始函数
	function page_touchmove(e){
		e.preventDefault();
		e.stopPropagation();	
		//判断是否开始或者在移动中获取值
		if(start||startM){
			startM = true;
			if (e.type == 'touchmove') {
				moveP = window.event.touches[0].pageY;
			} else { 
				if(mousedown) moveP = e.y || e.pageY;
			}
			page_n == 1 ? indexP = false : indexP = true ;	//true 为不是第一页 false为第一页
		}

		//设置一个页面开始移动
		if(moveP&&startM){
			
			//判断方向并让一个页面出现开始移动
			if(!p_b){
				p_b = true;
				position = moveP - initP > 0 ? true : false;	//true 为向下滑动 false 为向上滑动
				if(position){

				//向下移动
					if(indexP){								
						newM = page_n - 1 ;
						$('.m-page').eq(newM-1).addClass('active').css('top',-v_h);
						move = true ;
					}else{
						if(canmove){
							move = true;
							newM = Msize;
							$('.m-page').eq(newM-1).addClass('active').css('top',-v_h);
						}
						else move = false;
					}
							
				}else{
				//向上移动
					if(page_n != Msize){
						newM = page_n + 1 ;
					}else{
						newM = 1 ;
					}
					$('.m-page').eq(newM-1).addClass('active').css('top',v_h);
					move = true ;
				} 
			}
			
			//根据移动设置页面的值
			if(!DNmove){
				//滑动带动页面滑动
				if(move){	
					//移动中设置页面的值（top）
					start = false;
					var topV = parseInt($('.m-page').eq(newM-1).css('top'));
					$('.m-page').eq(newM-1).css({'top':topV+moveP-initP});	
					initP = moveP;
				}else{
					moveP = null;	
				}
			}else{
				moveP = null;	
			}
		}
	};
	/*
	//点击后向下切页
	$('.div1').click(function(){
		
		var aaa = $(this).parents('.m-page').index() + 1;
		$(this).parents('.m-page').removeClass('show');
		$(this).parents('.p-index').children('.m-page').eq(aaa).removeClass('hide').addClass('show');
		alert(aaa)
	});
	*/
	//触摸结束（鼠标起来或者离开元素）开始函数
	function page_touchend(e){	
		//结束控制页面
		startM =null;
		p_b = false;
		//判断移动的方向
		var move_p;	
		position ? move_p = moveP - firstP > 100 : move_p = firstP - moveP > 100 ;
		if(move){
			//切画页面(移动成功)
			if( move_p && Math.abs(moveP) >5 ){	
				$('.m-page').eq(newM-1).animate({'top':0},300,'easeOutSine',function(){
					/*
					** 切换成功回调的函数
					*/
					success();
				})
			//返回页面(移动失败)
			}else if (Math.abs(moveP) >=5){	//页面退回去
				position ? $('.m-page').eq(newM-1).animate({'top':-v_h},100,'easeOutSine') : $('.m-page').eq(newM-1).animate({'top':v_h},100,'easeOutSine');
				$('.m-page').eq(newM-1).removeClass('active');
				start = true;
			}
		}
		/* 初始化值 */
		initP		= null,			//初值控制值
		moveP		= null,			//每次获取到的值
		firstP		= null,			//第一次获取的值
		mousedown	= null;			//取消鼠标按下的控制值
	};
    
/*
** 切换成功的函数
*/
	function success(){
		/*
		** 切换成功回调的函数
		*/							
		//设置页面的出现
		$('.m-page').eq(page_n-1).removeClass('show active').addClass('hide');
		$('.m-page').eq(newM-1).removeClass('active hide').addClass('show');
		//重新设置页面移动的控制值
		page_n = newM;
		start = true;
		$(".m-page.show .J_fTxt").show();
		$('.m-page0'+page_n).find('.J_fTxt').show();
		
		$('.m-page').each(function(k,v){
			if(k!==page_n-1){
				$(this).find('.J_fTxt').hide();
			}
		});
		if(page_n == Msize) {
			canmove = true;
		}
		playM="on";
		$(".player-tip").hide();
		
	}
    	

/*
** 页面加载初始化
*/
	function initPage(){
		//初始化一个页面
		$('.m-page').addClass('hide').eq(page_n-1).addClass('show').removeClass('hide');
		//PC端图片点击不产生拖拽
		$(document.body).find('img').on('mousedown',function(e){
			e.preventDefault();
		})	
		//调试图片的尺寸
		if(RegExp('iPhone').test(navigator.userAgent)||RegExp('iPod').test(navigator.userAgent)||RegExp('iPad').test(navigator.userAgent)) $('.m-page').css('height','101%');
	}(initPage());
});

/*
KISSY.use('node,dom,event,io,cookie,gallery/simple-mask/1.0/,gallery/kissy-mscroller/1.3/index,gallery/simple-mask/1.0/,gallery/datalazyload/1.0.1/index,gallery/musicPlayer/2.0/index',function(S,Node,DOM,Event,IO,Cookie,Mask,KSMscroller,Mask,DataLazyload,MusicPlayer){
	
	var $1 = Node.all;
// ---------- 播放器 ----------
	var xuanyan = new MusicPlayer({
		type:'auto',
		auto:'true',
       	volume:1,
       	mode:'single',
        musicList:[{"name":"背景音乐", "path":"song.ogg"}]
    });
	status_bool=false;
	$(".player-button-g").on("click",function(){
	 	if($(this).hasClass("player-button-stop-g")){
	 		$(this).removeClass('player-button-stop-g');
	 		xuanyan.play();
	 		$(".player-tip").hide();
	 	}else{
	 		$(this).addClass('player-button-stop-g');
	 		xuanyan.stop();
	 		$(".player-tip").hide();
	 	}
	});
	xuanyan.play();
    
   
//---------- 预加载 ----------
	_PreLoadImg(['Public/img/01-point.png',
	'Public/img/01-title.png',
	'Public/img/01-txt.png',
	'Public/img/02-point.png',
	'Public/img/02-txt.png',
	'Public/img/03-1-point.gif',
	'Public/img/03-1-txt.png',
	'Public/img/03-2-point.gif',
	'Public/img/03-2-txt.png',
	'Public/img/03-3-point.gif',
	'Public/img/03-3-txt.png',
	'Public/img/03-art.png',
	'Public/img/03-point.png',
	'Public/img/03-title.png',
	'Public/img/03-txt.png',
	'Public/img/04-point.png',
	'Public/img/04-txt.png',
	'Public/img/05-arrow.png',
	'Public/img/05-photo.png',
	'Public/img/05-photo-wall.png',
	'Public/img/05-title.png',
	'Public/img/05-txt.png',
	'Public/img/06-txt.png',
	'Public/img/07-button.png',
	'Public/img/07-photobox.png',
	'Public/img/07-title.png',
	'Public/img/08-txt.png',
	'Public/img/09-img.jpg',
	'Public/img/10-img.jpg',
	'Public/img/arrow.png',
	'Public/img/bg.jpg',
	'Public/img/common-logo.png',
	'Public/img/end-arrow.png',
	'Public/img/end-txt.png',
	'Public/img/gif-bg.png',
	'Public/img/index-button.png',
	'Public/img/index-logo.png',
	'Public/img/index-show.png',
	'Public/img/index-title.png'],function(){  
		$1('.loading').remove();
		$1("body.index").removeClass("start");
		$1('.p-index').show();
	});
});



var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F2802da2ec19e505015b78efa0060a3af' type='text/javascript'%3E%3C/script%3E"));
 */