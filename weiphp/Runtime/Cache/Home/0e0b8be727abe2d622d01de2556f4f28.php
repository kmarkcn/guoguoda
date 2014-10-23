<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="/weiphp/Public/Home/css/font-awesome.css?v=<?php echo SITE_VERSION;?>" media="all">
	<link rel="stylesheet" type="text/css" href="/weiphp/Public/Home/css/mobile_module.css?v=<?php echo SITE_VERSION;?>" media="all">
    <script type="text/javascript" src="/weiphp/Public/static/jquery-2.0.3.min.js"></script>
    <script type="text/javascript" src="/weiphp/Public/Home/js/prefixfree.min.js"></script>
    <script type="text/javascript" src="/weiphp/Public/Home/js/m/dialog.js?v=<?php echo SITE_VERSION;?>"></script>
    <script type="text/javascript" src="/weiphp/Public/Home/js/m/flipsnap.min.js"></script>
    <script type="text/javascript" src="/weiphp/Public/Home/js/m/mobile_module.js?v=<?php echo SITE_VERSION;?>"></script>
    <script type="text/javascript" src="/weiphp/Public/Home/js/admin_common.js?v=<?php echo SITE_VERSION;?>"></script>
	<title><?php echo empty($page_title) ? C('WEB_SITE_TITLE') : $page_title; ?></title>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
	<meta content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
    <meta content="application/xhtml+xml;charset=UTF-8" http-equiv="Content-Type">
    <meta content="no-cache,must-revalidate" http-equiv="Cache-Control">
    <meta content="no-cache" http-equiv="pragma">
    <meta content="0" http-equiv="expires">
    <meta content="telephone=no, address=no" name="format-detection">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <link rel="shortcut icon" href="<?php echo SITE_URL;?>/favicon.ico">
</head>
<link href="<?php echo ADDON_PUBLIC_PATH;?>/scratch.css?v=<?php echo SITE_VERSION;?>" rel="stylesheet" type="text/css">
<body id="scratch">
	<div class="container body">
    	<div class="scr_top">
        	<img src="<?php echo ADDON_PUBLIC_PATH;?>/top.jpg"/>
    		<div class="area">
            	<img src="<?php echo ADDON_PUBLIC_PATH;?>/area.jpg"/>
                <div class="scratch_area">
                
                  <?php if ($error) { ?>
                	<div class="prize_text" style="font-size:16px; line-height:22px;"><?php echo ($error); ?></div>   
                    <canvas style="display:none" /> 
                  <?php } else { ?>
                        <!-- 抽奖信息 -->
                        <div class="prize_text" style="display:none"><?php echo ($prize["title"]); ?></div>
                        <canvas />             
                 <?php } ?> 
                </div>
            </div>
        </div>
        <div class="block_out">
        	<div class="block_inner">
            	<h6>活动说明</h6>
                <p><?php echo ($data["intro"]); ?></p>
            </div>
        </div>
        <!--奖项 -->
        <div class="block_out">
        	<div class="block_inner">
            	<h6>活动奖项</h6>
                <ul class="gift_list">
                <?php if(is_array($prizes)): $i = 0; $__LIST__ = $prizes;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
                    	<p><?php echo ($vo["title"]); ?>:(<?php echo (intval($vo["num"])); ?>名)</p>
                        <?php echo (get_img_html($vo["img"])); ?>
     					<span><?php echo ($vo["name"]); ?></span>                   
                    </li><?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                </div>
            </div>
            <!--中将记录 -->
            <div class="block_out">
        		<div class="block_inner">
                    <h6>我的中奖记录</h6>
                    <?php if($prize['count'] > 0): ?><p class="repeat_tips"><?php if(!empty($data["max_num"])): ?>您还有<?php echo ($prize["count"]); ?>次抽奖机会，<?php endif; ?><a href="<?php echo addons_url('Scratch://Scratch/show',array('id'=>$data[id]));?>">再刮一次</a></p><?php endif; ?>
                    <?php if(empty($my_prizes)): ?><p class="empty-tips">您目前还没有中过奖</p>
                    <?php else: ?>
                    <ul class="gift_history" id="my_gift_history">
                    <?php if(!empty($prize["id"])): ?><li id="now_my_prize" style="display:none">
                                <span class="col_1">刚刚</span>
                                <span class="col_2"><?php echo ($prize["title"]); ?></span>
                            </li><?php endif; ?>                      
                      	<?php if(is_array($my_prizes)): $i = 0; $__LIST__ = $my_prizes;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
                                <span class="col_1"><?php echo (time_format($vo["cTime"])); ?></span>
                                <span class="col_2"><?php echo ($vo["prize_title"]); ?></span>
                            </li><?php endforeach; endif; else: echo "" ;endif; ?>
                     </ul><?php endif; ?>
                </div>
            </div>
            <!--最新中将记录 -->
            <div class="block_out">
        		<div class="block_inner">
                    <h6>最新中奖记录</h6>
                    <?php if(empty($my_prizes)): ?><p class="empty-tips">暂还没有中奖记录</p>
                    <?php else: ?>
                    <ul class="gift_history">
                      <?php if(is_array($new_prizes)): $i = 0; $__LIST__ = $new_prizes;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
                          	<span class="col_1"><?php echo (time_format($vo["cTime"])); ?></span>
                            <span class="col_2"><?php echo (get_nickname($vo["uid"])); ?></span>
                            <span class="col_3"><?php echo ($vo["prize_title"]); ?></span>
                        </li><?php endforeach; endif; else: echo "" ;endif; ?>
                     </ul><?php endif; ?>
                </div>
            </div>
            <p class="copyright"><?php echo ($system_copy_right); ?></p>
        </div>
    </div>
<script type="text/javascript">  
$(function(){
	//try{ 
		initCanvas(document.body.style);
	//}catch(e){ 
		//alert('您的手机不支持刮刮卡效果哦~!'+e); 
	//} 
	
	})   
var is_set = 0;
function initCanvas(bodyStyle){ 
	var u = navigator.userAgent;
	var mobile = ''; 
	if(u.indexOf('iPhone') > -1 || u.indexOf('iPod') > -1 || u.indexOf('iPad') > -1) mobile = 'iphone'; 
	if(u.indexOf('Android') > -1 || u.indexOf('Linux') > -1 || u.indexOf('windows') > -1) mobile = 'Android';         
	bodyStyle.mozUserSelect = 'none';         
	bodyStyle.webkitUserSelect = 'none';           
	var img = new Image();         
	var canvas = $('canvas');         
	canvas.css({'background-color':'transparent'}); 
	var w = $('.container').width()/2; 
	var h =  w/2;      
	$('.prize_text').css({'width':w,'height':h,'margin-left':-w/2,'line-height':h+'px'});
	$('.scratch_area').css({'width':w,'height':h,'margin-left':-w/2}); 
	
	$('canvas').css({'margin-left':-w/2});
	//alert($('.container').width()+"="+w+"=="+h);
	canvas[0].width = w;
	canvas[0].height = h;  
	img.addEventListener('load',function(e){  
		var ctx;
		///var w = img.width, h = img.height;             
		var offsetX = canvas.offset().left, offsetY =  canvas.offset().top;             
		var mousedown = false;               
		function layer(ctx){                 
			ctx.fillStyle = 'gray';                 
			ctx.fillRect(0, 0, w, h);             
		}   
		function eventDown(e){                 
			e.preventDefault();                 
			mousedown=true;             
		}   
		function eventUp(e){                 
			e.preventDefault();                 
			mousedown = false;
			var data=ctx.getImageData(0,0,w,h).data;
			for(var i=0,j=0;i<data.length;i+=4){
				if(data[i] && data[i+1] && data[i+2] && data[i+3]){
					j++;
				}
			}
			//console.log(j+"=="+(w*h*0.7));
			if(j<=w*h*0.8 && is_set==0){
				set_sn_code(); //刮开记录中奖情况
				var prize_id = <?php echo (intval($prize["id"])); ?>;
				if(prize_id>0){
					//中奖
					openSuccessDialog();
					$('#now_my_prize').show();
				}else{
					openErrorDialog();
				}
				
				is_set = 1; //只能更新一次
			}             
		}    
		function eventMove(e){                 
			e.preventDefault();                 
			if(mousedown){       
				if(e.changedTouches){           
					e=e.changedTouches[e.changedTouches.length-1];                     
				}                     
				 
					var x = e.pageX - offsetX; 
					var y = e.pageY - offsetY; 
				
				//alert(x+"=="+y);
				with(ctx){  
					beginPath();
					arc(x, y, 5, 0, Math.PI * 2);   
					fill();     
					//var radius=20;
					//ctx.clearRect(x, y, radius, radius);
					$('canvas').css("opacity",0.99);  
					setTimeout(function(){
						$('canvas').css("opacity",1);  
						},5);
					             
				}                
			}             
		}               
		canvas.width=w;             
		canvas.height=h;    
		                
		ctx=canvas[0].getContext('2d');             
		ctx.fillStyle='transparent';             
		ctx.fillRect(0, 0, w, h);    
		layer(ctx);               
		ctx.globalCompositeOperation = 'destination-out';               
		canvas[0].addEventListener('touchstart', eventDown);             
		canvas[0].addEventListener('touchend', eventUp);             
		canvas[0].addEventListener('touchmove', eventMove);             
		canvas[0].addEventListener('mousedown', eventDown);             
		canvas[0].addEventListener('mouseup', eventUp);             
		canvas[0].addEventListener('mousemove', eventMove);    
		$('.prize_text').show();
		canvas.css({'background-image':'url('+img.src+')'});
		
	});
	
	img.src = '<?php echo ADDON_PUBLIC_PATH;?>/text_bg.png';

};    
function openSuccessDialog(){
	var successHtml = "<div class='common_dialog lqcg'>"
		+"<h6>你的运气太好了！</h6><p class='p_10'>你获得了<?php echo ($prize["title"]); ?>,奖品是<?php echo ($prize["name"]); ?>，请联系客服领取。</p>"
		+"<div class='tb'><a class='btn m_15 flex_1' href='###' onClick='$.Dialog.close();'>去领取</a></div>"
		+"</div>"
		$.Dialog.open(successHtml);
	}
function openErrorDialog(){
	var successHtml = "<div class='common_dialog lqcg'>"
		+"<h6>很抱歉！没有中奖，还需继续努力</h6><?php if(!empty($data["max_num"])): ?><p class='p_10'>你还有<?php echo (intval($prize["count"])); ?>次机会。</p><?php endif; ?>"
		+"<div class='tb'><a class='btn m_15 flex_1' href='###' onClick='$.Dialog.close();'>确 定</a></div>"
		+"</div>"
		$.Dialog.open(successHtml);
	}
function set_sn_code(){
	var url = "<?php echo addons_url('Scratch://Scratch/set_sn_code');?>";
	var id = "<?php echo ($data["id"]); ?>";
	var prize_id = "<?php echo (intval($prize["id"])); ?>";
	$.post(url, {id:id, prize_id:prize_id});	
}
</script>	
</body>
</html>