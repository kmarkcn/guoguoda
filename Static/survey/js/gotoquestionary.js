// JavaScript Document

$(function(){
	//输入框获取焦点
	$('.goto_input').focus(function(){
		//$(this).val('').css('color','#666');
		$(this).val('').css({
			'color':'#666',
			'border':'1px solid #007eff'
		});
		
	});
	var goto_user = $('.gg_user'),
		goto_phone = $('.gg_phone'),
		goto_ts = $('.goto_ts'),
		user_ts = '亲，如何称呼呀',
		phone_ts = '亲，如何回访呀';
	goto_user.attr('value',user_ts);
	goto_phone.attr('value',phone_ts);
	//goto_user.val(user_ts);
	//goto_phone.val(phone_ts);
	//失去焦点获取事件，不可调整其位置
	$('.goto_input').blur(function(){
		if($(this).val()==''){
			$(this).val(this.defaultValue).css('color','#ccc');
		}
	});
	//点击按钮前判断姓名和密码
	$('.goto_btn_q').click(function(){
		$(this).animate({opacity: '.3'}, "fast");
		setTimeout($(this).animate({opacity: '1'}, "fast"),300);

		var  phone = $.trim($(".gg_phone").val()),
			 user = $(".gg_user").val(),
			 ts_01 =  "亲，姓名不能为空哦！",
			 ts_02 =  "亲，手机号码不能为空哦！",
			 ts_03 = "亲，姓名和手机号码不能为空哦！",
			 ts_04 = "亲，手机号码格式不对哦！",
			 ts_05 = "亲，感谢您的支持！",
			 ts_color = '#d4036a';




		if(user=='' || user==user_ts || phone=="" || phone==phone_ts)
		{


			if(user=='' || user==user_ts)
			{
				goto_ts.addClass('goto_ts_02').text(ts_01);
				goto_user.css('border','1px solid' + ts_color);

			}
			if(phone=="" || phone==phone_ts)
			{
				goto_ts.addClass('goto_ts_02').text(ts_02);
				goto_phone.css('border','1px solid' + ts_color);
			}
			if((user=='' || user==user_ts) && (phone=="" || phone==phone_ts))
			{
				goto_ts.addClass('goto_ts_01').text(ts_03);
				goto_user.css('border','1px solid' + ts_color);
				goto_phone.css('border','1px solid' + ts_color);
			}
			return false;

		}
		if(user!='' && user!=user_ts && phone!="")
		{

				//验证手机号11位，且1开头，并判断第二位；
				var reg =  /^1[34589]\d{9}$/;
				if(!reg.test(phone))
				{
					goto_ts.addClass('goto_ts_03').text(ts_04);
					goto_phone.css('border','1px solid' + ts_color);
					return false;
				}
				else
				{
					goto_ts.addClass('goto_ts_04').text(ts_05).css('color','#666');
					goto_phone.css('border','1px solid #ccc');
					window.location="questionary.html";
				}

		}

		var gg_user = 'gg_user',                       //定义一个变量，给它赋值；赋的值没有限制，但一定要有值；
			gg_phone = 'gg_phone';

			$.cookie('gg_phone',gg_phone); 
			$.cookie('gg_user',gg_user);                   //存储cookie名字
			//alert($.cookie("p_scores"));                   //弹出结果  curious------取得该cookie的name
			//alert($.cookie(p_scores));                     //这个，得到的是 null
			$.cookie(gg_phone,$(".gg_phone").val());
			$.cookie(gg_user,$(".gg_user").val());            //存储cookie数据
			 
		 
		
	})
	

	
});