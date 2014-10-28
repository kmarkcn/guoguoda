<?php
session_start();
/**
 * JS_API支付demo
 * ====================================================
 * 在微信浏览器里面打开H5网页中执行JS调起支付。接口输入输出数据格式为JSON。
 * 成功调起支付需要三个步骤：
 * 步骤1：网页授权获取用户openid
 * 步骤2：使用统一支付接口，获取prepay_id
 * 步骤3：使用jsapi调起支付
*/
	include_once("./WxPayPubHelper2/WxPayPubHelper.php");
	
	//使用jsapi接口
	$jsApi = new JsApi_pub();

	//=========步骤1：网页授权获取用户openid============
	//通过code获得openid
	if (!isset($_GET['code']))
	{
		//触发微信返回code码
		$url = $jsApi->createOauthUrlForCode(WxPayConf_pub::JS_API_CALL_URL);
		Header("Location: $url"); 
	}else
	{
		//获取code码，以获取openid
	    $code = $_GET['code'];
		$jsApi->setCode($code);
		$openid = $jsApi->getOpenId();
	}
	
	//=========步骤2：使用统一支付接口，获取prepay_id============
	//使用统一支付接口
	$unifiedOrder = new UnifiedOrder_pub();
	
	//设置统一支付接口参数
	//设置必填参数
	//appid已填,商户无需重复填写
	//mch_id已填,商户无需重复填写
	//noncestr已填,商户无需重复填写
	//spbill_create_ip已填,商户无需重复填写
	//sign已填,商户无需重复填写
	$unifiedOrder->setParameter("openid","$openid");//商品描述
	$unifiedOrder->setParameter("body","果果哒水果预定活动半价");//商品描述
	//自定义订单号，此处仅作举例
	$timeStamp = time();
	$out_trade_no = WxPayConf_pub::APPID."$timeStamp";
	$unifiedOrder->setParameter("out_trade_no","$out_trade_no");//商户订单号 
	$unifiedOrder->setParameter("total_fee","500");//总金额
	$unifiedOrder->setParameter("notify_url",WxPayConf_pub::NOTIFY_URL);//通知地址 
	$unifiedOrder->setParameter("trade_type","JSAPI");//交易类型
	//非必填参数，商户可根据实际情况选填
	//$unifiedOrder->setParameter("sub_mch_id","XXXX");//子商户号  
	//$unifiedOrder->setParameter("device_info","XXXX");//设备号 
	//$unifiedOrder->setParameter("attach","XXXX");//附加数据 
	//$unifiedOrder->setParameter("time_start","XXXX");//交易起始时间
	//$unifiedOrder->setParameter("time_expire","XXXX");//交易结束时间 
	//$unifiedOrder->setParameter("goods_tag","XXXX");//商品标记 
	//$unifiedOrder->setParameter("openid","XXXX");//用户标识
	//$unifiedOrder->setParameter("product_id","XXXX");//商品ID

	$prepay_id = $unifiedOrder->getPrepayId();
	//=========步骤3：使用jsapi调起支付============
	$jsApi->setPrepayId($prepay_id);

	$jsApiParameters = $jsApi->getParameters();
	//echo $jsApiParameters;
?>

<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<title>果果哒</title>
	<meta content="initial-scale=1,user-scalable=no,maximum-scale=1,width=device-width" name="viewport">
	<link rel="stylesheet" type="text/css" href="./css/style.css">
</head>
<body>
<!--以下是支付提示层-->
    <div class="touch_us">
        <div class="touch_us_01">
            <div class="tu_font">
             
               
            </div>
        </div>
    </div>
  <!--以上是支付提示层-->
<div class="web-main">
	<div class="web-content">
		<div class="web-header">
			<div class="top-back"></div>
			<div class="top-title">活动半价</div>
		</div>
		<div class="order-box">
			<form action="">
				<div class="identity">
					<p><span class="gray">续费账号：</span><span><?php echo($_SESSION['gguser_nickname']) ?></span></p>
					<p><span class="gray">当前身份：</span><span>VIP会员</span></p>
				</div>
				<div class="open-time clearfix">
					<p class="gray">开通时间：</p>
					<div class="height_8"></div>
					<span data-time="1" data-amount="49" class="time-b on">五折抢鲜<i class="hot">HOT</i></span>

					<input id="input-time" type="hidden" value="">
				</div>
				<div class="paly-amount gray">
					应付金额：<span class="amount">5</span> 元
					<input id="input-amount" type="hidden" value="">
				</div>
				<div class="btn-bar">
					<button class="open-btn" onclick="check();" type="button">立即抢购</button>
				</div>
			</form>
		</div>
	</div>
</div>
<script src="js/jquery-2.0.3.min.js"></script>


<script type="text/javascript">

function check(){
	$.ajax({
        type: "GET",
        url: "http://www.kmark.cn/gogoda/index.php?s=addon/GuoGuoUser/Gguser/huodongCheck2/",
        dataType: "json",
        success: function(data){
       	 switch(parseInt(data))
    			{
    				case 1:
    					callpay();
    					break;
    				case 2:
	     				$('.tu_font').text('亲，活动还没开始!');
	     				ab();setTimeout(abcd,4000);
	     				break;
    				case 3:
	     				$('.tu_font').text('亲，活动过期!');
	     				ab();setTimeout(abcd,4000);
	     				break;
    				case 4:
	     				$('.tu_font').text('亲，你参加过半价购买,不能重复参加哟...');
	     				ab();setTimeout(abcd,4000);
	     				break;
    				case 5:
	     				$('.tu_font').text('亲，你没有参加此活动，无法享用半价购买,请先去果果哒微信下参加精彩活动');
	     				ab();setTimeout(abcd,4000);
	     				break;
	     				
    		   }
        }
    })
}


function abcd(){
	$('.touch_us').hide();
	$('.append_div').hide();
}
function ab(){
	$('.touch_us').show();
	$('.append_div').show();
}
	


		//调用微信JS api 支付
		function jsApiCall()
		{
			WeixinJSBridge.invoke(
				'getBrandWCPayRequest',
				<?php echo $jsApiParameters; ?>,
				function(res){
					//WeixinJSBridge.log(res.err_msg);
					//alert(res.err_code+res.err_desc+res.err_msg);
					if(res.err_msg=='get_brand_wcpay_request:ok'){
						window.location="http://www.kmark.cn/gogoda/index.php?s=addon/GuoGuoUser/Gguser/payResult/result/2";
					}else{
						alert('系统繁忙,支付失败!');
						window.location="http://www.kmark.cn/gogoda/index.php?s=addon/GuoGuoUser/Gguser/membercenter/";
					}
				}
			);
		}

		function callpay()
		{
			if (typeof WeixinJSBridge == "undefined"){
			    if( document.addEventListener ){
			        document.addEventListener('WeixinJSBridgeReady', jsApiCall, false);
			    }else if (document.attachEvent){
			        document.attachEvent('WeixinJSBridgeReady', jsApiCall); 
			        document.attachEvent('onWeixinJSBridgeReady', jsApiCall);
			    }
			}else{
			    jsApiCall();
			}
		}
	</script>
</body>
</html>