/**
 * Created by Administrator on 14-11-3.
 */

//confirm("你是否暂停？");
$(function(){
	//弹出遮罩层和修改界面
	var append_div = $('<div class="append_div"></div>'),
		body = $('body');

	body.append(append_div);

	//点击加载暂停，开始按钮界面
	$('.ps_status').click(function(){
		var reminder = $('#send_status_val').val();
		//alert(reminder)
		if(reminder == '2'){
			//break;
		}else{
			if(reminder == 1){
				$('.mc_send_p').text('亲，你正在暂停配送操作,我们会根据配送说明给你配送，确定暂停配送吗？');
			}else if(reminder == 0){
				$('.mc_send_p').text('亲，你正在恢复配送操作,我们会根据配送说明给你配送，确定恢复配送吗？');
			}
			
			//定义高度和宽度
			$('.mc_send_father').height($(document).height()).width($(document).width());

			var mc_habitus = $('.mc_send_father'),                            //
				animate_move = (body.width() - mc_habitus.width()) / 2,  //动画移动的距离
				left_move = (body.width() + mc_habitus.width()) / 2,     //动画向左移动的距离
				scroll_move = $(document).scrollTop(),                  //滚动条到顶部的垂直距离
				htmlbody = $('.htmlbody');
			var habitus_height = window.innerHeight;
			$('.mc_send_body').css('height',habitus_height);
			//判断修改页面的不显示
			if(mc_habitus.css('display')== 'none')
			{
				htmlbody.addClass('htmlbody_bg');   //为html,body添加背景
				append_div.show();
				mc_habitus.css                       //定义位置和移动的动画
				({
					'top': scroll_move + 'px',
					'left':left_move + 'px',
					'display': 'block'
				}).animate({left:animate_move},'fast');

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
			/**/
		}
		

	});
	
});