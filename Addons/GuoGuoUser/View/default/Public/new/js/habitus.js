// JavaScript Document

$(function(){
	alert(1)
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
		h_img = $('.h_img');
	//添加默认显示平和体质，防止cookie传值错误
	p_color.text(p_two);


	function p_text(){

		switch(p_val)
		{
			case 1:
				p_color.text(p_one);
				h_img.attr('src','images/h_img_01.png');
				break;
			case 2:
				p_color.text(p_two);
				h_img.attr('src','images/h_img_02.png');
				break;
			case 3:
				p_color.text(p_three);
				h_img.attr('src','images/h_img_03.png');
				break;

		}

	}
	p_text();
	
});