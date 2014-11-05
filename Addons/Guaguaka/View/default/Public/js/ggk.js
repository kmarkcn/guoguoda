
//jqueryDOM操作

 function check1(){
        $('.tu_font').text('亲,你还没关注我们,暂时不能参加此活动哟...');
        //alert(1)
        ab();setTimeout(abcd,3000);

    }
    function  check2(){
        $('.tu_font').text('亲,你今天已经抽奖了,明天再来哟...');
        //alert(1)
        ab();setTimeout(abcd,3000);
    }

    function  prize2(){
        $('.tu_font').html("亲,运气真好,你中了二等奖,免费体验果果哒水果一周体验哟！&nbsp;&nbsp;<a href='http://www.baidu.com'>前去领奖</a></br><button onclick='ggk_close()' class='ggk_btn_close ggk_btn'>暂不领奖</button>");
        //alert(1)
        ab();//setTimeout(abcd,3000);
    }
    function  prize1(){
        $('.tu_font').html("亲,运气真好,你中了一等奖,免费体验果果哒水果一个月体验哟!&nbsp;&nbsp;<a href='http://www.baidu.com'>前去领奖</a></br><button onclick='ggk_close()' class='ggk_btn_close ggk_btn'>暂不领奖</button>");
        //alert(1)
        ab();//setTimeout(abcd,3000);
    }
    function  prize3(){
        $('.tu_font').html("亲,运气真好,你中了三等奖,免费体验果果哒水果一天体验哟!&nbsp;&nbsp;<a href='http://www.baidu.com'>前去领奖</a></br><button onclick='ggk_close()' class='ggk_btn_close ggk_btn'>暂不领奖</button>");
        //alert(1)
        ab();//setTimeout(abcd,3000);
    }
    function  prize0(){
        $('.tu_font').html("亲,还差一点,再接再厉,明天再来吧!<br/>");
        //alert(1)
        ab();
        setTimeout(abcd,3000);
    }
    function abcd(){
        $('.touch_us').hide();
        $('.append_div').hide();
    }
    function ab(){
        $('.touch_us').show();
        $('.append_div').show();
    }
	function ggk_close(){
		abcd();
	}

/*$(function(){
	$('.ggk_btn_close').bind('click',function(){
		alert(111);
	});
});*/
