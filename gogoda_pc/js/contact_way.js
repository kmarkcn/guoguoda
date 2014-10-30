/**
 * Created by Administrator on 14-10-27.
 */
$(function(){
	$('.fp_nav').children('li').eq(3).addClass('fp_nav_click').next('li').addClass('fp_nav_next');
	
	$('.cw_btn_submit').on('click',function(){
		var cw_input_tel = $('.cw_input_tel'),
			cw_input_content = $('.cw_input_content'),
			reg =  /^1[34589]\d{9}$/,       //电话号码验证
			ts_text = $('.cw_ts_text');
		if(cw_input_tel.val() =='')
		{
			cw_input_tel.addClass('input_false');
			ts_text.text('亲，电话号码不能为空哦。').addClass('cw_ts_false');
			return false;
		}
		else
		{
			if(!reg.test(cw_input_tel.val()))
			{
				cw_input_tel.addClass('input_false');
				ts_text.text('亲，电话号码格式错误哦。').addClass('cw_ts_false');
				return false;
			}
			else
			{
				cw_input_tel.removeClass('input_false');
				if(cw_input_content.val() == '')
				{
					cw_input_content.addClass('input_false');
					ts_text.text('亲，内容不能为空哦。').addClass('cw_ts_false');
					return false;
				}
				else
				{
					ts_text.text('亲，感谢您的支持。').addClass('cw_ts_true');
					cw_input_content.removeClass('input_false');
					setTimeout(submit_success,2000);
					return false;
				}
			}
		}

	});
	//提交完成函数
	function submit_success(){
		$('.cw_input_tel').val('');
		$('.cw_input_content').val('');
		$('.cw_ts_text').text('').removeClass('cw_ts_false').removeClass('cw_ts_true');
	}

});