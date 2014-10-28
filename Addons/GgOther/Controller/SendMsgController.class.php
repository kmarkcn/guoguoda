<?php
namespace Addons\GgOther\Controller;
use Home\Controller\AddonsController;
header("Content-type: text/html; charset=utf-8");
class SendMsgController extends AddonsController{
	
	public $appid = "wx84ecbf099434ca1d";
	public $appsecret = "c32d31684c2c4baca8a936902611f578";
	
	public function messageDo(){
		$type=$_POST['type'];
		$ops = SendMsgController::getOpenids();
		foreach($ops as $val){
			$openid=$val;
			//$openid = "oMMDvslLBcuR_ZgLsRwv5pcLsb_o";
			$url="https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx84ecbf099434ca1d&redirect_uri=http%3A%2F%2Fwww.kmark.cn%2Foauth0.php&response_type=code&scope=snsapi_base&state=5#wechat_redirect";
			$first=$_POST['first'];
			$keyword1 = $_POST['keyword1'];
			$keyword2 = $_POST['syear'].'.'.$_POST['smonth'].'.'.$_POST['sday'].'-';
			$keyword2 .= $_POST['eyear'].'.'.$_POST['emonth'].'.'.$_POST['eday'];
			$remark = $_POST['remark'];
			$data = SendMsgController::produceJson($type,$openid,$url,$first,$keyword1,$keyword2,$remark);
			$access_token = SendMsgController::get_access_token($this->appid,$this->appsecret);
			$url = "https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=".$access_token;
			SendMsgController::post($url,$data);
			header('location:http://www.kmark.cn/gogoda/index.php?s=addon/GgOther/GgOther/lists/');
		}
	}
	
	public function getOpenids(){
		$huodong = M('gg_huodong');
		$weixin = M('gguser_weixin_relation');
		$re = $huodong->select();
		$opes = array();
		foreach($re as $key=>$val){
			$userid = $val['userid'];
			$rs = $weixin->where("userid = {$userid}")->select();
			$opes[] = $rs[0]['openid'];
		}
		return $opes;
	} 
	
	
	public function produceJson($type,$openid,$url,$first,$keyword1,$keyword2,$remark){
		if($type=='message1'){
			$data = array(
					"touser"=>"{$openid}",
					"template_id"=>"C2b2xdiOoOjSmaEIRYF0V_-_m0_plbo2b9ts1LnnjKY",
					"url"=>"{$url}",
					"topcolor"=>"#00FF00",
					"data"=>array(
							"first"=>array(
									"value"=>"{$first}",
									"color"=>"#173177"
							),
							"keyword1"=>array(
									"value"=>"{$keyword1}",
									"color"=>"#173177"
							),
							"keyword2"=>array(
									"value"=>"{$keyword2}",
									"color"=>"#173177"
							),
							"remark"=>array(
									"value"=>"{$remark}",
									"color"=>"#ff0000"
							)
					));
			$data = json_encode($data);
		}
		return $data;
	}

	function post($url, $jsonData){
		$ch = curl_init($url) ;
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_POSTFIELDS,$jsonData);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
		$result = curl_exec($ch) ;
		curl_close($ch) ;
		return $result;
	}
	
	function get_access_token($appid,$secret){
		$url="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$appid."&secret=".$secret;
		$json=SendMsgController::http_request_json($url);//这个地方不能用file_get_contents
		$data=json_decode($json,true);
		if($data['access_token']){
			return $data['access_token'];
		}else{
			return "获取access_token错误";
		}
	}
	
	//因为url是https 所有请求不能用file_get_contents,用curl请求json 数据
	function http_request_json($url){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$result = curl_exec($ch);
		curl_close($ch);
		return $result;
	}
	
	
	
	
	 
	
}
