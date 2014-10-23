<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<meta name="viewport" content="width=device-width,height=device-height,inital-scale=1.0,maximum-scale=1.0,user-scalable=no;">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="format-detection" content="telephone=no">
<meta name="description" content="">
<title></title>
<link href="/weiphp/Public/Home/css/mobile_module.css?v=<?php echo SITE_VERSION;?>" rel="stylesheet" type="text/css">
<link href="<?php echo ADDON_PUBLIC_PATH;?>/vote.css?v=<?php echo SITE_VERSION;?>" rel="stylesheet" type="text/css">
<script type="text/javascript" src="/weiphp/Public/static/jquery-2.0.3.min.js"></script>
<script type="text/javascript">
var cknums = <?php echo (intval($info["cknums"])); ?>;
var type = "<?php echo (intval($info["type"])); ?>";
function checkForm(){
	return true;
	
	if(type=='0') return true;
	
	var content = '';
	var msg = 0;
	$("input[type='checkbox']:checked").each(function(){ msg += 1; });
	//console.log(msg);
	//return false;
	if(msg>cknums){
		$('#errorInfo').html('该投票最多可同时选择'+cknums+'项').show();
		return false;
	}

	return true;
}
</script>
</head>
<body>
<div class="container body">
	<div class="vote_wrap">
  <article>
  	<div class="img_wrap">
        
        <?php if(!empty($info['picurl'])) { ?>
        	<img width="100%" src="<?php echo (get_cover_url($info["picurl"])); ?>">
        	<h2><?php echo ($info["title"]); ?></h2>
        <?php }else{ ?>
        
        	<h2 style="position:static"><?php echo ($info["title"]); ?></h2>
        <?php } ?>
    </div>
    <div class="vote_info mb"><?php echo (htmlspecialchars_decode($info["description"])); ?></div>
    <p class="time">投票截止日期：<?php echo (time_format($info["end_date"])); ?></p>
  </article>
  <p class="vote_type">
      本次投票为<?php if($info['type']==0) { $type='radio';$style_cls='regular-radio';echo '单选投票<br>';}else{ $type='checkbox';$style_cls='regular-checkbox';echo '多选投票<br>';} ?>
      
      <?php if($canJoin) { ?>
      
      <?php if($info['result_display']==0) { ?>
      <span class="gray">已经有<?php echo (intval($info["vote_count"])); ?>人投票，赶紧投下你宝贵的一票吧 :)</span>
      <?php } ?>
      
      <?php }else{ ?>
      <span class="gray">投票已过期或你已经投过票 :)</span>
      <?php } ?>
      
    </p>
    
  <form id="form1" name="form1" method="post" action="<?php echo U( 'join' );?>" onSubmit="return checkForm();">
    <div class="clearfix choice_list">
      <ul>
        <?php if(is_array($opts)): $k = 0; $__LIST__ = $opts;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$opt): $mod = ($k % 2 );++$k;?><li>
            <?php if($info['is_img'] && !empty($opt['image'])) { ?>
            <p class="mb" ><img src="<?php echo (get_cover_url($opt["image"])); ?>" /></p>
            <?php } ?>
            <p class="list"> <input type="<?php echo ($type); ?>" class="<?php echo ($style_cls); ?>" id="check_<?php echo ($opt["id"]); ?>" name="optArr[]" value="<?php echo ($opt["id"]); ?>"           
              <?php if(in_array($opt[id], $joinData)) echo 'checked="checked" '; if(!$canJoin) echo ' disabled'; ?>
              ><label for="check_<?php echo ($opt["id"]); ?>"></label><?php echo ($opt["name"]); ?>
            </p>
            <div class="clearfix tb">
              <div class="databar">
                <div class="actual_data vote-per-<?php echo ($k-1); ?>" style="width:0%"></div>
              </div>
              <p class="count">
                <?php if($info['result_display']) { echo $opt[percent].'%'; } else { echo $opt[opt_count]; } ?> 票
              </p>
            </div>
          </li><?php endforeach; endif; else: echo "" ;endif; ?>
      </ul>
    </div>
    
    <div class="warning" id="errorInfo"></div>
    <input type="hidden" value="<?php echo I('token');?>" name="token" />
    <input type="hidden" value="<?php echo I('wecha_id');?>" name="wecha_id" />
    <input type="hidden" value="<?php echo ($info["id"]); ?>" name="vote_id" />
    <?php if($canJoin) { ?>
    <div class="tb"><input type="submit" class="btn m_10 flex_1" value="确认提交" /></div>
    <?php }else if(!empty($info['next_id'])) { $next_url = U('Vote/show','id='.$info['next_id'].'&token='.I('token').'&wecha_id='.I('wecha_id')); ?>
    <div class="tb"><input type="button" class="btn m_10 flex_1" onClick="window.location.href='<?php echo ($next_url); ?>'" value="继续投票" /></div>
    <?php } ?>
    <?php if(!$canJoin && !empty($event_url)) { ?>
     <div class="tb"><a href="<?php echo ($event_url); ?>" class="btn m_10 flex_1" style="background-color:#f36637">参加抽奖活动</a></div>
     <?php } ?>
  </form>
  </div>
</div>
</body>
</html>
<script>
$(function(){
<?php foreach($opts as $k=>$v){ echo '$(".vote-per-'.$k.'").animate( { width: "'.$v['percent'].'%"}, 5000);'; } ?>
$(".list").live("click", function () {
     if ($(this).hasClass("bgBlue")) {
         $(this).removeClass("bgBlue").find("input").attr("checked", true);
     } else {
         $(this).addClass("bgBlue").find("input").attr("checked", false);
     }
 });
});
</script>