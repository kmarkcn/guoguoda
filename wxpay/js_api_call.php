<?php
session_start();
$money = $_SESSION['gguser_money'];
$newMoney = $_SESSION['gguser_money']*100;
/**
 * JS_API支付demo
 * ====================================================
 * 在微信浏览器里面打开H5网页中执行JS调起支付。接口输入输出数据格式为JSON。
 * 成功调起支付需要三个步骤：
 * 步骤1：网页授权获取用户openid
 * 步骤2：使用统一支付接口，获取prepay_id
 * 步骤3：使用jsapi调起支付
*/
	include_once("./WxPayPubHelper/WxPayPubHelper.php");
	
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
	$_SESSION['out_trade_no'] = $out_trade_no;
	$unifiedOrder->setParameter("out_trade_no","$out_trade_no");//商户订单号 
	$unifiedOrder->setParameter("total_fee","{$newMoney}");//总金额
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


<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width,user-scalable=no, initial-scale=1">
	<link href="css/public.css"  rel="stylesheet" type="text/css" />
    <link href="css/pay_prompt.css"  rel="stylesheet" type="text/css" />
	<title>微信安全支付</title>
</head>
<body class="bn">
	<div class="web-header">
			<div class="top-back"><a href="http://www.kmark.cn/gogoda/index.php?s=addon/GuoGuoUser/Gguser/membercenter/"></a></div>
			<div class="top-title">果果哒订购</div>
	</div>
    <div class="pay_prompt">
        <div class="pp_head">
            <img class="pp_user_img" src="<?php echo($_SESSION['gguser_head_img']); ?>">
            <ul class="pp_ul">
                <li><span class="pp_user"><?php echo($_SESSION['gguser_nickname']); ?></span></li>
                
            </ul>
        </div>
        <div class="pp_body"></div>

        <div class="pp_content">
            <div class="pp_ts_top">
                支付确认
            </div>
            <div class="pp_ts_body">
                <p class="pp_ts_p">
                    本次交易金额:<br/>
                    <span class="pp_red"><?php echo($money); ?></span>元,是否确认支付?
                </p>
                <div class="pp_btn_pay" onclick="restorePayData();" style="background: url(./images/bg_top.png);padding:.5rem 3rem;">支付</div>
            </div>
        </div>

		<div style="margin-top:2.5rem;width:100%;text-align:center;font-size:.8rem;">
			<span><input type="checkbox" checked="checked" disabled="disabled" style="height:1.2rem;position:relative;top:-0.1rem;left:1.4rem;"></span>
			同意微信支付条款
		</div>	
			
        <div class="pp_right">
        <span>果果哒,最懂你的鲜果定制专家</span>
        </div>
    </div>
	<div style='display:none;'>
		<input type="hidden" id="out_trade_no" value="<?php  echo($out_trade_no); ?>">
	</div>

   


</body>
</html>

<script src="js/jquery-2.0.3.min.js"></script>
<script type="text/javascript">



		function restorePayData(){
				//var openid = $('#openid').val();
				var out_trade_no = $("#out_trade_no").val();
				$.ajax({
					type: "GET",
		            url: "http://www.kmark.cn/gogoda/index.php?s=addon/GuoGuoUser/Gguser/restorePayData/out_trade_no/",
		            dataType: "html",
		            data:'out_trade_no='+out_trade_no,
		            success: function(data){
							if(parseInt(data)==1){
								callpay();
							}else{
								alert('系统繁忙，稍后再试!');
							}
			        },
			        error:function(){
							alert('系统繁忙，稍后再试!');
				    }
					
				}) 
				//alert($('#out_trade_no').val());
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
						window.location="http://www.kmark.cn/gogoda/index.php?s=addon/GuoGuoUser/Gguser/payResult/result/1";
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




<style>
.web-header { position: relative; padding: 0 50px; height: 46px; background: url(./images/bg_top.png) #EAEAE8 no-repeat; background-size: 100%;}
.web-header .top-back { position: absolute; left: 0; top: 0; width: 50px; height: 46px; background: url(./images/icon_back.png) center center no-repeat; background-size: 11px; }
.web-header .top-back a { display: block; width: 100%; height: 100%}
.web-header .top-title { line-height: 46px; text-align: center; color: #fff;font-size:16px;}
</style>



























