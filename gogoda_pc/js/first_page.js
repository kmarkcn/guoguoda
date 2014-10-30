/**
 * Created by Administrator on 14-10-22.
 */
function loadjscssfile(filename,filetype){

	if(filetype == "js"){
		var fileref = document.createElement('script');
		fileref.setAttribute("type","text/javascript");
		fileref.setAttribute("src",filename);
	}else if(filetype == "css"){

		var fileref = document.createElement('link');
		fileref.setAttribute("rel","stylesheet");
		fileref.setAttribute("type","text/css");
		fileref.setAttribute("href",filename);
	}
	if(typeof fileref != "undefined"){
		document.getElementsByTagName("head")[0].appendChild(fileref);
	}

	//loadjscssfile("do.js","js");
	//loadjscssfile("test.css","css");
}
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
//加载CSS
if(system.win||system.mac||system.xll){

	loadjscssfile("css/pc/pc_first_page.css","css");

	//alert("PC访问请使用微信登陆");

}else{
	//alert("非PC访问");
}


window.onload = function(){
	$('.fp_nav').children('li').eq(0).addClass('fp_nav_click').next('li').addClass('fp_nav_next');
	var fp_hgt1 = $(window).height(),
		fp_hgt2 =  fp_hgt1 - $('#fp_img_13').height() - 10;     //中间的空白高度

	$('.fp_b_top').height(fp_hgt2);
	//加载图片

};
$(function(){
	alert(111);
	if(system.win||system.mac||system.xll){

		 document.getElementById('fp_img_02').src='img/first_page/pc_first_page_03.png';
		 document.getElementById('fp_img_04').src='img/first_page/pc_first_page_04.png';
		 document.getElementById('fp_img_05').src='img/first_page/pc_first_page_05.png';
		 document.getElementById('fp_img_06').src='img/first_page/pc_first_page_06.png';
		 document.getElementById('fp_img_07').src='img/first_page/pc_first_page_07.png';
		//alert("PC访问请使用微信登陆");

	}else{
		document.getElementById('fp_img_02').src='img/first_page/m_first_page_02.png';
		document.getElementById('fp_img_04').src='img/first_page/m_first_page_04.png';
		document.getElementById('fp_img_05').src='img/first_page/m_first_page_05.png';
		document.getElementById('fp_img_06').src='img/first_page/m_first_page_06.png';
		document.getElementById('fp_img_07').src='img/first_page/m_first_page_07.png';
		document.getElementById('fp_img_09').src='img/first_page/m_first_page_09.png';
		document.getElementById('fp_img_10').src='img/first_page/m_first_page_10.png';
		document.getElementById('fp_img_11').src='img/first_page/m_first_page_11.png';
		document.getElementById('fp_img_12').src='img/first_page/m_first_page_12.png';
		document.getElementById('fp_img_13').src='img/first_page/m_first_page_13.png';
		//alert("非PC访问");
	}


});
