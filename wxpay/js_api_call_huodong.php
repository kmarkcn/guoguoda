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
	include_once("./WxPayPubHelper1/WxPayPubHelper.php");
	
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
	$unifiedOrder->setParameter("body","果果哒水果定制");//商品描述
	//自定义订单号，此处仅作举例
	$timeStamp = time();
	$out_trade_no = WxPayConf_pub::APPID."$timeStamp";
	$unifiedOrder->setParameter("out_trade_no","$out_trade_no");//商户订单号 
	$unifiedOrder->setParameter("total_fee","990");//总金额
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
	<link rel="stylesheet" type="text/css" href="css/style.css">
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
		<!-- 
		<div class="bgpic99">
			<img src="images/bg_99.gif" alt="" style="margin:-10% 0 ;">
		</div>
		 -->
		<div class="bgpic99" style="margin:-10% 0 ;">
			<img src="images/bg_01.gif" style="width: 100%;float:left;" >
			<img src="images/bg_02.gif" style="width: 100%;float:left;" >
			<img src="images/bg_03.gif" style="width: 100%;float:left;" >
			<div style="clear: both;"></div>
		</div>
		<div class="bgbtn99 text-center">
			<img src="images/bg_btn99.gif" alt="" class="active_btn" onclick="check();" style="position:relative;top:5px;width:80%;">
			<input id="active_ts" type="hidden" value="1"/>
			
		</div>
		<div class="bgdes99">
			<h2><b>活动规则</b></h2>
			<div class="height_10"></div>
			<div>
				<p>1. 此次活动仅限高新区写字楼用户，其他用户暂不参与此次活动。</p>
				<p>2. 果果哒精品鲜果订制套餐单次9.9元包邮（送货上门）。购买此单次套餐的用户，可享次日订购半价5元。</p>
				<p>3. 没有微信的就可以给现金，有微信没有绑定银行卡的就必须关注果果哒微信填写用户信息才有资格购买。也可以微信支付。</p>
				<p>4. 每个微信ID限量购买一次，半价5元套餐仅限次日购买，逾期无效。</p>
				<p>5. 购买成功后次日配送，半价套餐隔日配送，且不得修改地址。</p>
			</div>
		</div>
	</div>
</div>
<script src="js/jquery-2.0.3.min.js"></script>


<script type="text/javascript">
		function check(){
			$.ajax({
	             type: "GET",
	             url: "http://www.kmark.cn/gogoda/index.php?s=addon/GuoGuoUser/Gguser/huodongCheck/",
	             dataType: "json",
	             success: function(data){
	            	 switch(parseInt(data))
		     			{
		     				case 1:
		     					callpay();
		     					break;
		     				case 2:
			     				$('.tu_font').text('亲，活动还没开始!');
			     				ab();setTimeout(abcd,2000);
			     				break;
		     				case 3:
			     				$('.tu_font').text('亲，活动过期!');
			     				ab();setTimeout(abcd,2000);
			     				break;
		     				case 4:
			     				$('.tu_font').text('亲，你参加过啦!');
			     				ab();setTimeout(abcd,2000);
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