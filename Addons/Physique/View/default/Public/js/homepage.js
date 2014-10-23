// JavaScript Document

//等待图片加载完成后再执行坐标定位
window.onload = function(){ 
	var wid = $('.h_img').width(),
	    hei = $('.h_img').height(),
		x =	wid/540,			
		y = hei/848;
	var a = $('.homepage').height();
	//alert(wid +','+ hei);	
	//alert(x+','+y);
	//公司介绍坐标
	$('.h_gsjj').attr('coords',0 + ',' + 0 +
							  ',' + 540*x + ',' + 0*y +
							  ',' + 540*x + ',' + 170*y +
							  ',' + 0*x + ',' + 121*y 
					 );
	//产品介绍坐标
	$('.h_cpjs').attr('coords',0*x + ',' + 121*y +
							  ',' + 540*x + ',' + 170*y +
							  ',' + 540*x + ',' + 290*y +
							  ',' + 0*x + ',' + 343*y 
					 );
	//怎样找到我们坐标
	$('.h_zyzdwm').attr('coords',0*x + ',' + 343*y +
							  ',' + 540*x + ',' + 290*y +
							  ',' + 540*x + ',' + 530*y +
							  ',' + 0*x + ',' + 457*y 
					 );	
	//var zb = $('.h_gsjj').attr('coords');		  
	//alert(zb)	

 }
