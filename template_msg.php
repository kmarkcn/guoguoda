<?php
$appid = "wx84ecbf099434ca1d";
$appsecret = "c32d31684c2c4baca8a936902611f578";
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
        $json=http_request_json($url);//这个地方不能用file_get_contents
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

$access_token = get_access_token($appid,$appsecret);

$url = "https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=".$access_token;
$data = 
'{
	"touser":"oMMDvslLBcuR_ZgLsRwv5pcLsb_o",
	"template_id":"C2b2xdiOoOjSmaEIRYF0V_-_m0_plbo2b9ts1LnnjKY",
	"url":"http://www.baidu.com",
	"topcolor":"#00FF00",
	"data":{
		"first": {
			"value":"您好,你已经成功参加果果哒鲜果定制包邮9.9活动",
			"color":"#173177"
		},
		"keyword1":{
			"value":"精品鲜果定制9.9包邮",
			"color":"#173177"
		},
		"keyword2":{
			"value":"2014-10-27至2014-10-31",
			"color":"#173177"
		},
		"remark":{
			"value":"参加活动的用户,次日可享受半价5元订购哟,快去吧...",
			"color":"#ff0000"
		}
	}
}';
echo post($url,$data);
?>