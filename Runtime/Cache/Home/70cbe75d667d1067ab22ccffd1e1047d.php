<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<head>
	<meta charset="UTF-8">
	<title>果果哒</title>
	<meta content="initial-scale=1,user-scalable=no,maximum-scale=1,width=device-width" name="viewport">
	<link rel="stylesheet" type="text/css" href="<?php echo ADDON_PUBLIC_PATH;?>/css/scratch.css">
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
	<form action="http://www.kmark.cn/gogoda/index.php?s=addon/Guaguaka/Guaguaka/logisticDo/" method="post">
		<div class="web-header">
			<div class="top-title">配送信息</div>
		</div>
		<div class="height_10"></div>
		<div class="b-box form">
			
			<div class="form-item">
					<input type="hidden" name="prizeid" value="<?php echo ($prizeid); ?>">
					<label for="input-name" class="input-label dark fl">姓名</label>
					<input type="text" class="text-right gray logistic" id="name" name='name' value="<?php echo ($userData["name"]); ?>" style="display:block;box-shadow:0;">
				
			</div>
			<div class="form-item">
					<label for="" class="input-label dark fl">电话</label>
					<input type="text" class="text-right gray logistic" name='mobile' id="mobile" value="<?php echo ($userData["mobile"]); ?>" style="display:block;">
			</div>
			<div class="form-item no-border">
					<label for="input-name" class="input-label dark fl">地址</label>
					<textarea class="text-right gray " name='address' id="address"  style="display:block; width:90%; line-height:20px; height:60px; text-align:left; border:1px solid #ccc;border-radius:0;" placeholder="亲,我们目前只支持高新区的配送,如有疑问,致电028-83389832"><?php echo ($userData["address"]); ?></textarea>
					
			</div>
		</div>
		<div class="button-bar">
			<button class="b-button" type="submit" onclick="return check();">确 定</button>
		</div>
		</form>
	</div>
</div>

</body>
</html>
<script src="<?php echo ADDON_PUBLIC_PATH;?>/js/jquery.min.js"></script>
<script>
function check(){
	var reg =  /^1[34589]\d{9}$/;
	var name = $('#name').val();
	var mobile = $('#mobile').val();
	var address= $('#address').val();
	if(name == ''){
		$('.tu_font').text('亲,用户名不能为空...');
		//alert(1)
		ab();setTimeout(abcd,2000);
		return false;
	}else{
		if(mobile==''){
			$('.tu_font').text('亲,手机号码不能为空...');
			//alert(1)
			ab();setTimeout(abcd,2000);
			return false;
		}else{
			if(!reg.test(mobile)){
				$('.tu_font').text('亲,手机号码格式不对...');
				//alert(1)
				ab();setTimeout(abcd,2000);
				return false;
			}else{
				if(address == ''){
					$('.tu_font').text('亲,地址不能为空...');
					//alert(1)
					ab();setTimeout(abcd,2000);
					return false;
				}else{
					if(address.indexOf('高新')>=0 ||address.indexOf('高薪')>=0||address.indexOf('高兴')>=0){
						return true;
					}else{
						$('.tu_font').text('亲,我们目前只支持高新区的配送,如有疑问,致电02883389832');
						//alert(1)
						ab();setTimeout(abcd,5000);
						return false;
					}
				}
			}
		}
	}
	
	
}

function abcd(){
	$('.touch_us').hide();
	$('.append_div').hide();
	return true;
}
function ab(){
	$('.touch_us').show();
	$('.append_div').show();
}
</script>