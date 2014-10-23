/**
 * Created by Administrator on 14-10-16.
 */
$(function(){
	//判断是否必填，弹出提示框
	$('.wd_btn_true').click(function(){
		var wd_ts_required = $('.wd_ts_required'),
			hgt1 = $(document).scrollTop(),                  //滚动条到顶部的垂直距离
			hgt2 = window.screen.height,                     //浏览器高度
			hgt3 = wd_ts_required.height(),
			hgt4 = (hgt2 - hgt3) / 2 + hgt1,                 //移动高度
			wid2 = $(document).width(),
			wid3 = wd_ts_required.width(),
			wid4 = (wid2 - wid3) / 2 ;                       //移动宽度
		//alert(hgt2);

		wd_ts_required.css({
			'position' : 'absolute'
			,'top' : hgt4
			,'left' : wid4
			,'display':'block'
		});
		$('.append_div').show();
		//$('.wd_page').hide();

	});
	//提示框点击确定按钮，关闭提示框
	$('.wd_btn_over').click(function(){
		$('.append_div').hide();
		$('.wd_ts_required').hide();
		//$('.wd_page').show();
	})

});