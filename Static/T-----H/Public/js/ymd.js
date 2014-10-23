/**
 * Created by Administrator on 14-10-8.
 */
$(function(){

//生成日期函数
function zzq_time_ymd() {

	//模拟假期数据
	var datedata = {
			"201410":{"01":"2","02":"2","03":"2","04":"1","05":"1","06":"1","07":"1","12":"1","18":"1","19":"1","25":"1","26":"1"}
			,"201411":{"01":"1","02":"1","08":"1","09":"1","15":"1","16":"1","22":"1","23":"1","29":"1","30":"1"}
			,"201412":{"06":"1","07":"1","13":"1","14":"1","20":"1","21":"1","27":"1","28":"1"}
	};


	
	var m_aMonHead = new Array(12);         //定义阳历中每个月的最大天数
	m_aMonHead[0] = 31; m_aMonHead[1] = 28; m_aMonHead[2] = 31; m_aMonHead[3] = 30; m_aMonHead[4]  = 31; m_aMonHead[5]  = 30;
	m_aMonHead[6] = 31; m_aMonHead[7] = 31; m_aMonHead[8] = 30; m_aMonHead[9] = 31; m_aMonHead[10] = 30; m_aMonHead[11] = 31;

	//判断某年是否为闰年
	function isPinYear(year){
		var bolRet = false;
		if (0==year%4&&((year%100!=0)||(year%400==0))) {
			bolRet = true;
		}
		return bolRet;
	}
	//得到一个月的天数，闰年为29天
	function getMonthCount(year,month){
		var c = m_aMonHead[month-1];
		if((month==2)&&isPinYear(year)) c++;
		return c;
	}
	getMonthCount();
	//alert(m_aMonHead);


	//获取当前时间
	var zzq_date = new Date(),                      //定义新数组
		now_year = zzq_date.getYear() + 1900,       //定义当前年数
		//now_year = getFullYear(),
		now_month = zzq_date.getMonth() + 1,        //定义当前月数 month=6表示7月
		now_date = zzq_date.getDate(),              //定义当前号数
		now_day = zzq_date.getDay(),                //定义当前是星期几，显示为（0，1，2，3，4，5，6）
		now_week = new Array("星期日", "星期一", "星期二", "星期三", "星期四", "星期五", "星期六")[zzq_date.getDay()],    //定义显示星期几
		now_time = now_year + '年' + now_month + '月' + now_date + '日' + now_week,    //定义当前日期
		now_time_ymd = $('.now_time_ymd'),                                            //
		zzq_time_click = '<span class="zzq_font_10">配送</span>';

	now_time_ymd.text(now_time);
	//alert( now_time);

	//遍历日期
	$('.zzq_time_date').each(function(){
		var date_index = $(this).index(),           //定义当前遍历UL的index
			date_month = now_month + date_index,    //定义日期月数
			first_year = now_year;                  //定义日期年数

		if(date_month<13)       //判断月数
		{
			//显示月数
			//$(this).children('.zzq_time_ym').text(first_year + '年' + date_month + '月');
			$(this).children('.zzq_time_ym').html('<span class="zzq_time_y">' +first_year + '</span>年' + '<span class="zzq_time_m">'+  date_month + '</span>月');

		}
		else                    //判断月数
		{
			date_month = date_month - 12;           //修改日期月数
			first_year = now_year + 1;              //修改日期年数
			//显示月数
			$(this).children('.zzq_time_ym').html('<span class="zzq_time_y">' +first_year + '</span>年' + '<span class="zzq_time_m">'+  date_month + '</span>月');
		}
		var  first_month = date_month -1,           //month=6表示7月
			 first_date = 1;                        //定义日期号数为1
		var dt = new Date(first_year, first_month, first_date);         //传值获取每月一号的星期数
		//添加填充项
		for(var a = 0; a < dt.getDay(); a++)
		{
			var date_a = $('<li></li>');
			$(this).children('.zzq_time_ul_02').append(date_a);
		}
		//添加号数
		for(var i = 1; i <= m_aMonHead[date_month-1];i++)
		{
			var date_i= $('<li class="zzq_time_valid"><span class="zzq_time_number">' + i +'</span></li>');
			$(this).children('.zzq_time_ul_02').append(date_i);
		}
		//alert(m_aMonHead[date_month-1]);

		//添加节假日判断
		if(date_month < 10)
		{
			date_month = '0' + date_month;
		}
		var time_ym = first_year + '' + date_month;
		var ym = time_ym;
		var bb = $(this).index();


		function date_date(datedata){

			var obj = datedata[time_ym];
			var abc =  new Array();
			for(name in obj){
				abc.push(parseInt(name));
				//console.log(parseInt(name));
			}
			for(var i = 0;i<abc.length; i++)
			{
				var cc = abc[i] + a - 1;
				$('.zzq_time_date').eq(bb).children('.zzq_time_ul_02').children().eq(cc).addClass('zzq_time_week');
			}
			//console.log(data[time_ym]);


		}
		date_date(datedata);


		/*
		//AJXA通过PHP获取节假日接口
		$.ajax({
			url: "http://192.168.1.52/gogoda/Static/survey/js/getVacation.php",
			type: "GET",
			data: "ym=" + ym,
			dataType: "JSON",
			success: function(data)
			{


				console.log(data);
				var obj = data[time_ym];
				var abc =  new Array();
				for(name in obj){
					abc.push(parseInt(name));
					//console.log(parseInt(name));
				}
				for(var i = 0;i<abc.length; i++)
				{
					var cc = abc[i] + a - 1;
					$('.zzq_time_date').eq(bb).children('.zzq_time_ul_02').children().eq(cc).addClass('zzq_time_week');
				}
				//console.log(data[time_ym]);

				//若配送日期刚好为节假日，则延后至正常工作日
				//$('.zzq_time_click').hasClass('zzq_time_week').removeClass('zzq_time_click').next('.zzq_time_valid').addClass('zzq_time_click');
				$('.zzq_time_week').each(function(){
					if($(this).hasClass('zzq_time_click'))
					{
						$(this).removeClass('zzq_time_click').html('<span class="zzq_time_number">' + $(this).children('.zzq_time_number').text() + '</span>')
							   .next('.zzq_time_valid').addClass('zzq_time_click').html('<span class="zzq_time_number">' + $('.zzq_time_click').children('.zzq_time_number').text() + '</span><br>' + zzq_time_click);
					}
				});
				//定义开始的时间,通过日期表生成开始的时间
				var st_ymd =$('.zzq_time_click').parent().siblings('.zzq_time_ym').text() + $('.zzq_time_click').children('.zzq_time_number').text();
				$('.start_time').html(st_ymd + '日');
			}
		});
		*/

	});




	$('.start_time').html( '日');
	//$('.start_time').html( '2014年10月18日');

	//处理默认配送日期（延迟3天）
	var	defer_day = 3 ,														//定义延迟3天配送
		ul_01 = $('.zzq_time_date').eq(0).children('ul').children('li'),    //第一月ul的li
		ul_02 = $('.zzq_time_date').eq(1).children('ul').children('li');    //第二月ul的li
	var wwww = ul_01.length,				                                //定义第一月li总长度
		qqqq = ul_02.length,				                                //定义第二月li总长度
		cccc = now_date + defer_day, 										//日期延后几天配送
		aaaa = m_aMonHead[now_month-1],										//第一月天数,1月index为0
		yyyy = wwww - aaaa,                                                 //第一月1号是星期几
		bbbb = yyyy + cccc - 1,										        //配送的li的eq(index),第一月li总长度-本月天数=本月第一天是星期几,本月第一天是星期几+然后3天配送,eq(0)表示第一个
		eeee = ul_01.eq(bbbb).html(),	                                    //定义第一月的号数
		dddd = m_aMonHead[now_month],		                                //第二月天数
		rrrr = qqqq - dddd, 				                                //第二月1号是星期几
		tttt = qqqq - bbbb  + rrrr,                                         //定义第二月配送的eq(index)
		ffff = ul_02.eq(tttt).html();                                       //定义第二月的号数

	//判断延迟几天为当月
	if((wwww-cccc) > defer_day)
	{
		//$('.zzq_time_ul_02').eq(0).children('li').eq(bbbb).addClass('zzq_time_click').html( eeee +'</br>' + zzq_time_click );
		ul_01.eq(bbbb).addClass('zzq_time_click').html( eeee +'</br>' + zzq_time_click );
	}
	//判断延迟几天为下一月
	else
	{
		ul_02.eq(tttt).addClass('zzq_time_click').html( ffff +'</br>' + zzq_time_click );
	}

	//若配送日期刚好为节假日，则延后至正常工作日
	//$('.zzq_time_click').hasClass('zzq_time_week').removeClass('zzq_time_click').next('.zzq_time_valid').addClass('zzq_time_click');
	$('.zzq_time_week').each(function(){
		//alert($(this).attr('class'));
		if($(this).hasClass('zzq_time_click'))
		{
			$(this).removeClass('zzq_time_click').html('<span class="zzq_time_number">' + $(this).children('.zzq_time_number').text() + '</span>')
				.next('.zzq_time_valid').addClass('zzq_time_click').html('<span class="zzq_time_number">' + $('.zzq_time_click').children('.zzq_time_number').text() + '</span><br>' + zzq_time_click);
		}

	});
	//定义开始的时间,通过日期表生成开始的时间
	var st_ymd =$('.zzq_time_click').parent().siblings('.zzq_time_ym').text() + $('.zzq_time_click').children('.zzq_time_number').text();
	$('.start_time').html(st_ymd + '日');

	//判断显示的第一月不能点击的日期变色
	$('.zzq_time_date').eq(0).children('ul').children('li').each(function(){
		var bb = $(this).children('.zzq_time_number').text(),
			dd = $(this).html(),
			cc = now_date + defer_day;  //日期延后几天配送
			
		//不能点击的日期
		if(bb < cc)
		{
			$(this).addClass('zzq_time_invalid');
		}
	});

	//日期表和遮罩层显现切换
	function ss(){
		$('.zzq_time_ymd').toggle();
		$('.append_div').toggle();
		$('.bn_father ').show();
		$('.mc').show();
	}

	//点击可配送的日期，添加配送文字，点击返回选中的日期
	$('.zzq_time_valid').click(function(){
		var sss = $(this).attr('class'),
			dd = $(this).html();
		//判断是否可配送
		if(sss == 'zzq_time_valid' || sss == 'zzq_time_valid zzq_time_click' )
		{
				$(this).addClass('zzq_time_click').html( dd+'</br>' + zzq_time_click );
				//移除同级元素的样式
				$(this).siblings('li').each(function(){
					var vv = $(this).children('.zzq_time_number').text();
					$(this).removeClass('zzq_time_click').html('<span class="zzq_time_number">'+ vv +'</span>');
				});
				//移除非同级元素的样式
				$(this).parents('.zzq_time_date').siblings('.zzq_time_date').children('.zzq_time_ul_02').children().each(function(){
					var vv = $(this).children('.zzq_time_number').text();
					$(this).removeClass('zzq_time_click').html('<span class="zzq_time_number">'+ vv +'</span>');
				});

				//传值生成日期
				var st_d = $(this).children('.zzq_time_number').text(),
					st_m = $(this).parent().siblings('.zzq_time_ym').text();
				$('.start_time').html(st_m + st_d + '日');
				setTimeout(ss,300);


		}
		if(sss == 'zzq_time_valid zzq_time_click')
		{

		}
		//判断是否是节假日
		if(sss == 'zzq_time_valid zzq_time_week')
		{
			alert('亲,节假日请休息哦！');
		}
	});


	//点击日期的返回按钮日期隐藏
	$('.zzq_time_return').click(function(){
		$('.zzq_time_ymd').hide();
		$('.append_div').hide();
		$('.bn_father ').show();
		$('.mc').show();
	});

	/*
	var hgt1 = $(document).height(),
		hgt2 = $('.zzq_time_head').height();
	$('.zzq_time_body').height(hgt1-hgt2);
	alert(hgt1);
	*/
	//点击返回页面
	/*
	$('.zzq_time_valid').each(function(){
		var sss = $(this).attr('class');
		//判断添加是否可返回
		if(sss == 'zzq_time_valid' || sss == 'zzq_time_valid zzq_time_click' )
		{
			$(this).addClass('zzq_time_toggle');
		}
	})
	*/



}


//页面加载生成日期
zzq_time_ymd();

});