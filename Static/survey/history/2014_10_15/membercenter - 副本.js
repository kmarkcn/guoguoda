/**
 * Created by Administrator on 14-9-15.
 */

 
 
//日期插件的调用
J(function(){
	J('#cal1').calendar({ format:'yyyy年MM月dd日' });
	J('#cal2').calendar({ format:'yyyy年MM月dd日' });
	J('#cal3').calendar({ format:'yyyy年MM月dd日' });
	J('#cal4').calendar({ format:'yyyy年MM月dd日' });
});

$(function(){
	 //form input样式插件
	 //radio按钮插件
	 $('form').jqTransform({imgPath:'jqtransformplugin/img/'});

	//判断性别加载CSS
	/*
	var sss = $('.mc_user_sex').hasClass('mc_user_man'),
		skin_blue = $('<link href="css/skin_blue.css" rel="stylesheet">'),
		skin_purple = $('<link href="css/skin_purple.css" rel="stylesheet">');

	if(sss)
	{
		$('head').append(skin_blue);
		alert(1111);
	}
	else
	{
		$('head').append(skin_purple);
		alert(2222);
	}
	*/
	//头像宽度等于高度
	$('.mc_user_img').height($('.mc_user_img').width());
	
	//点击切换体质，信息，充值
	$('.mc_middle_li').click(function(){
		var index = $(this).index();
		$(this).removeClass('mc_li_shadow').addClass('mc_li_inset').siblings().removeClass('mc_li_inset').addClass('mc_li_shadow');
		$('.mc_foot').children()
					 .eq(index)
					 .show()
			         .siblings()
					 .hide();
	});

	//体质传值
	$('.mc_02_val').val($.cookie('p_scores'));
	/*
	alert($.cookie('p_scores'))
	//传值姓名和电话
	alert($.cookie('gg_user'));
	alert($.cookie('gg_phone'));
	*/
	
	var	p_val = parseInt($('.mc_02_val').val()),
		p_color = $('.mc_02_color'),
		p_p1 = $('.mc_02_p1'),
		p_p2 = $('.mc_02_p2'),
		p_one = '寒性',
		p_two = '平和',
		p_three = '热性',
		p_content_01 = '“寒体质”的人，产热能量较低，副交感神经兴奋，代谢率下降较快，由于体内产热量减少，怕冷，所以四肢较冷，容易乏力，天冷时发冷情况比较严重。脸色比一般人苍白，喜欢喝热饮，性格安静、温和。',
		p_content_02 = '[健康忠告]寒性体质的人体内阴气过盛，应当重点补阳气。中医认为肾主一身的阳气，脾主吸收营养，化生气血，是能量的源泉。所以改善体质应重点调补脾肾。多食用热量密度高、糖分高的温热性水果。这类水果可大量增加身体能量，达到温暖身体、活化身体生理机能的效果。',
		p_content_03 = '平和体质是一种以体态适中、面色红润、精力充沛、脏腑功能状态强健壮实为主要特征的一种体质状态。女性，年龄越大，平和体质的人越少。成因是先天的遗传条件良好，后天的饮食起居生活习惯适宜，即后天调养得当。',
		p_content_04 = '[健康忠告]平和体质者，平衡饮食是关键。应少吃高脂厚味及辛辣上火之物，多吃新鲜蔬菜瓜果。可根据自己的口味偏好，搭配选择寒、热性水果，以充分保证身体内营养的平衡。',
		p_content_05 = '“热体质”的人产热能量较高，交感神经较兴奋，身体较有热感，脸色红赤，怕热，喜欢喝冷饮，平时好动，心理比较急。如果体内营养物质不足，热性体质的人身体的滋养功能会减退，使身体处于“干燥”状态，出现如虚热、四肢温热、易口渴、头发、皮肤干枯起皱，尿少，便秘、情绪烦躁等特征。',
		p_content_06 = '[健康忠告]应该多补充寒凉性水果，这类水果热量密度低、富含纤维，但脂肪、糖分都很少，可以中和平衡人体内多余的热量，从而起到清凉调节的作用。';

	//添加默认显示平和体质，防止cookie传值错误
	p_color.text(p_two);
	p_p1.text(p_content_03);
	p_p2.text(p_content_04);

	function p_text(){

		switch(p_val)
		{
			case 0:
				p_color.text(p_one);
				p_p1.text(p_content_01);
				p_p2.text(p_content_02);
				break;

			case 1:
				p_color.text(p_two);
				p_p1.text(p_content_03);
				p_p2.text(p_content_04);
				break;

			case 2:
				p_color.text(p_three);
				p_p1.text(p_content_05);
				p_p2.text(p_content_06);
				break;

		}

	}
	p_text();

	//弹出遮罩层和修改界面
	var append_div = $('<div class="append_div"></div>'),
		body = $('body');

	body.append(append_div);
	//点击事件
	$('.modify_toggle').click(function(){
		//$(this).css({'position':'relative','z-index':'222'});
		var mc_modify = $('.mc_modify'),                            //
			animate_move = (body.width() - mc_modify.width()) / 2,  //动画移动的距离
			left_move = (body.width() + mc_modify.width()) / 2,     //动画向左移动的距离
			scroll_move = $(document).scrollTop(),                  //滚动条到顶部的垂直距离
			htmlbody = $('.htmlbody');

		var modify_height = window.innerHeight;
		mc_modify.css('min-height',modify_height +'px');
		append_div.css({
			'position':'absolute',
			'z-index':'99',
			'top':'0',
			'left':'0',
			'width': '100%',
			'height': '100%',
			'opacity':'.5',
			'background-color':'gray'
		});
		//判断修改页面的不显示
		if(mc_modify.css('display')== 'none')
		{
			htmlbody.addClass('htmlbody_bg');   //为html,body添加背景
			mc_modify.css                       //定义位置和移动的动画
			({
				'top': scroll_move + 'px',
				'left':left_move + 'px',
				'display': 'block'
			}).animate({left:animate_move},'400');
			append_div.show();
		}
		//判断修改页面的显示
		else
		{
			var this_class = $(this).hasClass('modify_btn_true');
			if(this_class)      //点击的是确定修改按钮
			{
			    var hhh =	$('.input_ts_father').css('display');
				if(hhh != 'block')
				{
					htmlbody.removeClass('htmlbody_bg');   //为html,body移除添加背景
					append_div.css('display','none');
					mc_modify.animate({left:left_move},'400',function(){
						$(this).hide();
					});
				}
			}
			else                //点击的是取消修改按钮
			{
				htmlbody.removeClass('htmlbody_bg');   //为html,body移除添加背景
				append_div.css('display','none');
				mc_modify.animate({left:left_move},'400',function(){
					$(this).hide();
				});
			}
		}

	});

	//点击事件
	$('.habitus_toggle').click(function(){
		//$(this).css({'position':'relative','z-index':'222'});
		var mc_habitus = $('.mc_habitus'),                            //
			animate_move = (body.width() - mc_habitus.width()) / 2,  //动画移动的距离
			left_move = (body.width() + mc_habitus.width()) / 2,     //动画向左移动的距离
			scroll_move = $(document).scrollTop(),                  //滚动条到顶部的垂直距离
			htmlbody = $('.htmlbody');

		var habitus_height = window.innerHeight;
		mc_habitus.css('min-height',habitus_height +'px');
		append_div.css({
			'position':'absolute',
			'z-index':'99',
			'top':'0',
			'left':'0',
			'width': '100%',
			'height': '100%',
			'opacity':'.5',
			'background-color':'gray'
		});
		//判断修改页面的不显示
		if(mc_habitus.css('display')== 'none')
		{
			htmlbody.addClass('htmlbody_bg');   //为html,body添加背景
			mc_habitus.css                       //定义位置和移动的动画
			({
				'top': scroll_move + 'px',
				'left':left_move + 'px',
				'display': 'block'
			}).animate({left:animate_move},'fast');
			append_div.show();
		}
		//判断修改页面的显示
		else
		{
			htmlbody.removeClass('htmlbody_bg');   //为html,body移除添加背景
			append_div.css('display','none');
			mc_habitus.animate({left:left_move},'fast',function(){
				$(this).hide();
			});
		}

	});

	/*
	//点击label选中按钮
	$('.modify_label').click(function(){
		$(this).children().checked();
	});
	*/
	//获取焦点
	$('.modify_input').focus(function(){
		$(this).removeClass('modify_border').siblings('.input_ts_father').remove();
	});
	//参数设置
	var user_ts = '亲，昵称不能为空哦！',
		email_ts = '亲，邮箱不能为空哦！',
		phone_ts = '亲，电话号码不能为空哦！',
		address_ts = '亲，地址不能为空哦！',
		phone_false = '亲，电话号码格式有误哦！',
		email_false = '亲，邮箱格式有误哦！';
	//验证input输入,table纵向添加判断
	$('.modify_input').blur(function(){
		var modify_input_val = $(this).val();
		var this_class = $(this),
			user_class = this_class.hasClass('input_user'),
			phone_class = this_class.hasClass('input_phone'),
			email_class = this_class.hasClass('input_email'),
			address_class = this_class.hasClass('input_address'),
			phone_val = $.trim($(".input_phone").val()),
			email_val = $.trim($(".input_email").val());

		//var down_ts = $('<tr><td class="down_ts" colspan="'+ td_number +'"></td></tr>');
		var up_ts = $('<div class="input_ts_father"><div class="input_ts"><div class="ts_content"><div class="ts_expression"></div><span class="ts_text">亲，有错误哦</span></div><br /><span class="ts_guide"></span></div></div>');
		$(this).addClass('modify_border').parent().append(up_ts);
		var ts_text = this_class.siblings('.input_ts_father').find('.ts_text');
		//首先判断是否为空
		if(modify_input_val == '')          //判断值为空
		{
			if(user_class)                  //昵称
			{
				ts_text.text(user_ts);
			}
			if(phone_class)                 //电话
			{
				ts_text.text(phone_ts);
			}
			if(email_class)                 //邮箱
			{
				ts_text.text(email_ts);
			}
			if(address_class)               //地址
			{
				ts_text.text(address_ts);
			}
		}
		else                                //值不为空
		{
			this_class.siblings('.input_ts_father').remove();
			$(this).removeClass('modify_border');
			var reg =  /^1[34589]\d{9}$/,       //电话号码验证
				filter  = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;    //邮箱验证
			if(phone_class)
			{
				if(!reg.test(phone_val))
				{
					$(this).addClass('modify_border').parent().append(up_ts);
					ts_text.text(phone_false);
				}
			}
			if(email_class)
			{
				if(!filter.test(email_val))
				{
					$(this).addClass('modify_border').parent().append(up_ts);
					ts_text.text(email_false);
				}
			}
		}

	});



	/*
	//禁止滚动条滚动
	var scrollFunc = function(e){
		e=e||window.event;
		if (e&&e.preventDefault){
			e.preventDefault();
			e.stopPropagation();
		}else{
			e.returnvalue=false;
			return false;
		}
	};

	var obj=document.getElementById("objDiv");
	if(obj.addEventListener&&!window.opera)
		obj.addEventListener('DOMMouseScroll',scrollFunc,false);
	else
		obj.onmousewheel=scrollFunc;
	*/
});

