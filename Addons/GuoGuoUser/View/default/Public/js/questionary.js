// JavaScript Document
$(function(){
/*
	//平台、设备和操作系统
	var system ={
		win : false,
		mac : false,
		xll : false
	};
	//检测平台
	var p = navigator.platform;
	system.win = p.indexOf("Win") == 0;
	system.mac = p.indexOf("Mac") == 0;
	system.x11 = (p == "X11") || (p.indexOf("Linux") == 0);
    //跳转语句
	if(system.win||system.mac||system.xll){

		alert("PC访问请使用微信登陆");
		//$('html').remove();

	}else{
		alert("非PC访问");
	}
*/


	$('.q-ul li').click(function(){
		var div = $('<div class="q-li-bg"></div>'),             //定义手印
			width = $('.swiper-slide').width() * 0.2,           //手印宽度
			height = width * 1.26;                              //手印高度
		$(this).append(div).siblings().children('.q-li-bg').remove();   //添加手印并移除同级元素的手印
		$('.q-li-bg').css({                                     //手印位置
			'width':width,
			'height':height,
			'margin':'-'+ height/2 + 'px -' + width/2 + 'px'
		});

	});

	
	
	//这里必须要等前面的JS添加后才能再定义
	var t_top = $('.q-time-top'),					            //进度条顶部
		t_body = $('.q-time-body'),					            //进度条中间
		t_bottom = $('.q-time-bottom'),				            //进度条底部
		color_bg = 'white',										//背景颜色
		color_show = '#44d5b1';									//填充颜色

	$('.q-time').css('color','red');
	t_top.css('background-color',color_bg);
	t_body.css('background-color',color_bg);
	t_bottom.css('background', '-webkit-gradient(linear, 0 0, 0 100%,color-stop(0,white),color-stop(50%,white),color-stop(50%,'+ color_show +'),color-stop(100%,'+ color_show +'))');

	//遍历题数，显示进度条，进度条的显示基于CSS3。
	$('.q-ul').children('li').click(function(){
		var index = $('.q-ul').children('li').has('.q-li-bg').length,//遍历元素的索引
			 number = $('.swiper-slide').length;  											    //总题数
			//获取进度条中间的百分比
			percent = (1 - index / (number - 1)) * 100 +'%';

		var z_index = index + 20;                                   //与进度条无关，定义z-index
		//$(this).css('z-index',z_index);                             //添加z-index
		//底部永远是有颜色的
		if(index==1)                                                //第一题
		{
			t_bottom.css('background',color_show);
		}
		if(1 < index && index < number)                           //中间
		{

			//基于CSS3的渐变达到效果
			t_top.css('background-color',color_bg);
			t_body.css({
				//这里存在一个问题： CSS3要写多套兼容浏览器，但是这里只能读取最后一套的效果
				'background': '-moz-linear-gradient(top, white 0, white '+ percent +','+ color_show +' ' + percent + ', '+ color_show +' 100%)',
				'background': '-webkit-gradient(linear, 0 0, 0 100%,color-stop(0,white),color-stop('+ percent +',white),color-stop('+ percent +','+ color_show +'),color-stop(100%,'+ color_show +'))'
			});
		}
		if(index == number)                                       //最后一题
		{
			t_top.css('background-color',color_show);
			t_body.css('background-color',color_show);
		}

	});

	

	//答题选项添加事件
	$('.swiper-slide').find('li').click(function(){
		setTimeout(gg_count,300);   //延迟0.3秒执行判断方法
	});
});