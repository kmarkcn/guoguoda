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
		var div = $('<div class="q-li-bg"></div>');
		//$(this).parent().addClass('q-li-bg').siblings('li').removeClass('q-li-bg');
		$(this).append(div).siblings().children('.q-li-bg').remove();

	})
	//定义头部，时间轴，底部。
	var m_img =  $('.m-img'),
	    p_head = $('<div class="q-top"><img class="q-top-img" src="img/questionary/questionary_01.png"><a href="#"><img class="q-top-return" src="img/questionary/questionary_04.png"></a></div>')
		p_time = $('<div class="q-time"><p>总题数</p><div class="q-time-top"></div><div class="q-time-body"></div><div class="q-time-bottom"></div></div>'),
	    p_foot = $('<div class="q-foot"><img class="q-foot-img" src="img/questionary/questionary_02.png"></div>');

	m_img.children('.q-content').before(p_head);
	m_img.append(p_time).append(p_foot);

	 //遍历题数，显示进度条，进度条的显示基于CSS3。
	$('.m-img').parent().each(function(){
		var index = $(this).index(),								//遍历元素的索引
			number = 5,											    //总题数
																	//获取进度条中间的百分比
			percent = (1 - index / (number - 2)) * 100 +'%',
			color_bg = 'white',										//背景颜色
			color_show = '#d30469',									//填充颜色
			t_top = $(this).find('.q-time-top'),					//进度条顶部
			t_body = $(this).find('.q-time-body'),					//进度条中间
			t_bottom = $(this).find('.q-time-bottom');				//进度条底部

		//底部永远是有颜色的；
		t_bottom.css('background-color',color_show);
		if(index==0)
		{

			t_top.css('background-color',color_bg);
			t_body.css('background-color',color_bg);

		}
		if(0 < index && index < number-1)
		{
			//基于CSS3的渐变达到效果
			t_top.css('background-color',color_bg);
			t_body.css({
						//这里存在一个问题： CSS3要写多套兼容浏览器，但是这里只能读取最后一套的效果
						'background': '-moz-linear-gradient(top, white 0, white '+ percent +','+ color_show +' ' + percent + ', '+ color_show +' 100%)',
						'background': '-webkit-gradient(linear, 0 0, 0 100%,color-stop(0,white),color-stop('+ percent +',white),color-stop('+ percent +','+ color_show +'),color-stop(100%,'+ color_show +'))'
				//'background':'-webkit-gradient(linear, 0 0, 100% 0,color-stop(0,white),color-stop(45%,white),color-stop(45%,red),color-stop(55%,red),color-stop(55%,white),color-stop(100%,white))'
			});
		}
		if(index == number-1)
		{
			t_top.css('background-color',color_show);
			t_body.css('background-color',color_show);
		}

	})

	//获取总分
	function gg_count(){
		var arr_count = new Array();                        //申明一个新数组
		$('.q-ul').children('li').has('.q-li-bg').each(function(){          //判断存在条件并遍历值
			//判断取值
			//$(this).has('.q-li-bg');
			arr_count.push($(this).attr('ggscore'));        //将值添加到数组
		});
		var scores = 0;                                     //申明一个值为0的参数
		for(var i=0 ; i<arr_count.length;i++){              //循环取到数组值
			scores += parseInt(arr_count[i]);               //将数组值转化为整数，并取得总和


		}
		alert(scores)


	}
	$('.q-foot').click(function(){

		gg_count();
	})


})