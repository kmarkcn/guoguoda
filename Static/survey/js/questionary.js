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

	//定义头部，时间轴，底部。
	var varswiper_slide =  $('.swiper-slide'),
		p_head = $('<div class="q-top"><img class="q-top-img" src="img/questionary/questionary_01.png"><a href="#"><img class="q-top-return" src="img/questionary/questionary_04.png"></a></div>'),
		p_time = $('<div class="q-time"><p>总题数</p><div class="q-time-top"></div><div class="q-time-body"></div><div class="q-time-bottom"></div></div>'),
		p_foot = $('<div class="q-foot"><img class="q-foot-img" src="img/questionary/questionary_02.png"></div>');


	varswiper_slide.children('.q-content').before(p_head);
	varswiper_slide.append(p_foot);
	varswiper_slide.parent().before(p_time);
	//这里必须要等前面的JS添加后才能再定义
	var t_top = $('.q-time-top'),					            //进度条顶部
		t_body = $('.q-time-body'),					            //进度条中间
		t_bottom = $('.q-time-bottom'),				            //进度条底部
		color_bg = 'white',										//背景颜色
		color_show = '#d30469';									//填充颜色

	$('.q-time').css('color','red');
	t_top.css('background-color',color_bg);
	t_body.css('background-color',color_bg);
	t_bottom.css('background', '-webkit-gradient(linear, 0 0, 0 100%,color-stop(0,white),color-stop(50%,white),color-stop(50%,'+ color_show +'),color-stop(100%,'+ color_show +'))');

	//遍历题数，显示进度条，进度条的显示基于CSS3。
	$('.q-ul').children('li').click(function(){
		var index = $('.q-ul').children('li').has('.q-li-bg').length,//遍历元素的索引
			//number = 12,
			number = $('.swiper-slide').length;                     //总题数
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

	//首先判断答题是否完成，再通过结果弹出
	function gg_count(){
		var arr_count = new Array(),                        //申明一个新数组
			index = $('.swiper-slide').length;				//获取总题数
		$('.q-ul').children('li').has('.q-li-bg').each(function(){          //判断存在条件并遍历值
			//判断取值
			//$(this).has('.q-li-bg');
			arr_count.push($(this).attr('ggscore'));        //将值添加到数组
		});

		if(arr_count.length == index)						//完成答题
		{
			var scores = 0;                                 //申明一个值为0的参数
			for(var i=0 ; i<arr_count.length;i++){          //循环取到数组值
				scores += parseInt(arr_count[i]);           //将数组值转化为整数，并取得总和
			}
			//判断体质类型
			if(scores<-5)									//寒性体质
			{
				$('.q_val').val(0);
			}
			if(-5<=scores&&scores<=5)                         //平和体质
			{
				$('.q_val').val(1);
			}
			if(scores>5)                                    //阳性体质
			{
				$('.q_val').val(2);
			}
			var p_scores = 'p_scores';                       //定义一个变量，给它赋值；赋的值没有限制，但一定要有值；
			$.cookie('p_scores',p_scores);                   //存储cookie名字
			//alert($.cookie("p_scores"));                   //弹出结果  curious------取得该cookie的name
			//alert($.cookie(p_scores));                     //这个，得到的是 null
			$.cookie(p_scores,$(".q_val").val());            //存储cookie数据
			function gogogo(){                               //跳转页面函数
				window.location="habitus.html"
			}
			setTimeout(gogogo,1000);   //延迟一秒跳转页面

		}
		else                                                 //为完成答题
		{
			var number = index - arr_count.length,			 //得到未作答的题数
				q_father = $('.swiper-wrapper');

			q_father.children('.swiper-slide').css({         //重置框架的其他元素位置
				'transform':'translate3d(0px, 0px, 0px)',
				'-webkit-transform':'translate3d(0px, -0px, 0px)',
				'transition-duration':'.8s'
			});
			
			$('.swiper-slide').addClass('q_select');        //答题页面添加标记类
			//答题后的页面移除标记类
			$('.q-ul').children('li').has('.q-li-bg').parents('.swiper-slide').removeClass('q_select');
			var q_number = new Array();
			q_father.children('.q_select').each(function(){ //遍历没有答题的页面
				q_number.push($(this).index());             //将没答题的页面index传入数组
			});
			var q_height = $('.swiper-slide').height() * q_number[0];  //定义并获取验证答题页面高度，通过每次查找数组的第一位

			//alert(q_number[0]);
			q_father.css({
				'transform':'translate3d(0px, -' + q_height + 'px, 0px)',
				'-webkit-transform':'translate3d(0px, -' + q_height + 'px, 0px)',
				'transition-duration':'.8s'
			});
		}
	}

	//答题选项添加事件
	$('.swiper-slide').find('li').click(function(){
		setTimeout(gg_count,300);   //延迟0.3秒执行判断方法
	});
});