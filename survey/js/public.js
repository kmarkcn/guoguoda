// JavaScript Document
$(document).ready(function(){
	
	//获取content显示内容的高度
	var get_height = function get_height(){
		var hei = $(window).height(),
			hei1 = $('.public_head').height(),
			hei2 = $('.public_foot').height();
			
		var h = hei - hei1 - hei2;
		$('.content').height(h);
	};
	get_height();
	//一秒钟执行一次获content取高度
	setInterval(get_height,1000);
	
})


