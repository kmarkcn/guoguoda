<?php
        	
namespace Addons\GuoGuoUser\Model;
use Home\Model\WeixinModel;
use Addons\Card\Model\WeixinAddonModel;
        	
/**
 * GuoGuoUser的微信模型
 */
class WeixinAddonModel extends WeixinModel{
	function reply($dataArr, $keywordArr = array()) {
		/* $param ['token'] = get_token ();
	    $param ['openid'] = get_openid ();
	    $url = addons_url ( 'Physique://Physique/gotoquestionary', $param );
	    
	    // 组装微信需要的图文数据，格式是固定的
	    $articles [0] = array (
	        'Title' => '体质测试',
	        'Description' => '点击测试',
	        'Url' => $url
	    );
	    
	    $res = $this->replyNews($articles );  */
		

	} 

	// 关注公众号事件
	public function subscribe($dataArr) {
		/*
		 * 2014-10-15 by terry 
		 * 微信用户关注公众号事件
		 */
		
		addWeixinLog("这里是微信关注事件的操作","by terry");
		//增加用户表
		$gguser = M('gguser');
    	$data1 = array(
    			'name' =>'',
    			'gender'=>'',
    			'mobile'=>'',
    			'address'=>'',
    			'type'=>'2',
    			'status'=>'1',
    			'lastupdate'=>time()
    	);
    	$userid = $gguser->add($data1);
    	
    	
    	 //增加体制表
    	$physic = M('gguser_physicque');
    	$data3 = array(
    			'userid'=>$userid,
    			'physicque'=>'4',
    			'last_test'=>''
    	);
    	$physic->add($data3);
    	
    	
    	//增加喜好表
    	$hobby = M('gguser_hobby');
    	$data4 = array(
    			'userid'=>$userid,
    			'like'=>'',
    			'dislike'=>''
    	);
    	$hobby->add($data4);
    	
    	
    	//增加微信用户关联表(包括头像)
    	$gguser_weixin = M('gguser_weixin_relation');
    	$data2 = array(
    			'userid'=>$userid,
    			'openid'=> $dataArr['FromUserName'],
    			'headimgurl'=>''
    	);
    	
    	$gguser_weixin->add($data2); 
		 
		
	}
	
	
	/*
	 * 根据openid获取昵称
	 */
	
	// 取消关注公众号事件
	public function unsubscribe() {
		return true;
	}
	
	// 扫描带参数二维码事件
	public function scan() {
		return true;
	}
	
	// 上报地理位置事件
	public function location() {
		return true;
	}
	
	// 自定义菜单事件
	public function click($dataArr) {
		session_start();
		$_SESSION['gguser_openid'] = $dataArr['FromUserName'];
	}	
	
	
	// 自定义菜单事件
	public function view($dataArr) {
		session_start();
		$_SESSION['gguser_openid'] = $dataArr['FromUserName'];
	}
	
	
	/* function getNameByopenid($openid){
		//获取全局access token然后去获取用户头像
		$param_1="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&";
		$param_1.="appid=wx84ecbf099434ca1d&secret=c32d31684c2c4baca8a936902611f578";
		$A_T=file_get_contents($param_1);
		$at_arr=json_decode($A_T);
		$at=$at_arr->access_token;
		$param_2="https://api.weixin.qq.com/cgi-bin/user/info?access_token=";
		$param_2.=$at;
		$param_2.="&openid=";
		$param_2.=$openid;
		$re=file_get_contents($param_2);
		$res=json_decode($re);
		//return $res->headimgurl;
		return $res->nickname;
	
	} */
	
	
	/*
	 * 2014-10-16 by terry 
	 * 获取用户头像
	 */
	/* public function getImgSrc($openid){
		//获取全局access token然后去获取用户头像
		$param_1="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&";
		$param_1.="appid=wx84ecbf099434ca1d&secret=c32d31684c2c4baca8a936902611f578";
		$A_T=file_get_contents($param_1);
		$at_arr=json_decode($A_T);
		$at=$at_arr->access_token;
		$param_2="https://api.weixin.qq.com/cgi-bin/user/info?access_token=";
		$param_2.=$at;
		$param_2.="&openid=";
		$param_2.=$openid;
		$re=file_get_contents($param_2);
		$res=json_decode($re);
		return $res->headimgurl;
	} */
	
	
}
        	