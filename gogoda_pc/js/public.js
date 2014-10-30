$(function(){
	var fp_nav=$('<ul class="fp_nav" id="fp_nav"><li class="fp_nav_li_01"><a href="index.html">主页</a></li><li><a href="about_us.html">关于我们</a></li><li><a href="vx_reserve.html">微信预定</a></li><li><a href="contact_way.html">联系方式</a></li><li><a href="wait.html">招聘职位</a></li><div class="clear"></div></ul>');
		
	$('.fp_foot').append(fp_nav);		//添加菜单栏
	//菜单栏hover效果
	$('.fp_nav').children('li').hover(
		function(){
			$(this).addClass('fp_nav_hover').next('li').addClass('fp_nav_border');
		},
		function(){
			$(this).removeClass('fp_nav_hover').next('li').removeClass('fp_nav_border');
		}
	);
	var bbb = new Array();
	//for循环为数组添加数据
	for(var a = 0; a < $('.fp_nav').children('li').length; a++)
	{
		 var b =$('.fp_nav').children('li').eq(a).width();
		 bbb.push(b);
	}
	//得到li的总长度=求数组总和
	var bbb_length = eval(bbb.join('+'));
	
	var nav_left = ($('.fp_nav').parent().width() - bbb_length) /2;
	
	$('.fp_nav').css('left',nav_left);
	//alert(nav_left);
		
})