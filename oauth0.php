<?php
session_start();
if (isset($_GET['code'])){
   //得到code之后应该去得到opoenid
	$param="https://api.weixin.qq.com/sns/oauth2/access_token?appid=wx84ecbf099434ca1d&secret=c32d31684c2c4baca8a936902611f578&grant_type=authorization_code&code=";
	$param.=$_GET['code'];
	$op_st=file_get_contents($param);
	$op_arr=json_decode($op_st);
	$openid=$op_arr->openid;
	$param_1="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=wx84ecbf099434ca1d&secret=c32d31684c2c4baca8a936902611f578";
	$A_T=file_get_contents($param_1);
	$at_arr=json_decode($A_T);
	$at=$at_arr->access_token;
	$param_2="https://api.weixin.qq.com/cgi-bin/user/info?access_token=";
	$param_2.=$at;
	$param_2.="&openid=";
	$param_2.=$openid;
	$re=file_get_contents($param_2);
	$res=json_decode($re);
	//将得到的信息置于session下面
	//考虑到一个问题，这个session是否会有覆盖的可能�?
	$_SESSION['gguser_openid']=$openid;
	$_SESSION['gguser_head_img'] = $res->headimgurl;
	$_SESSION['gguser_nickname'] = $res->nickname;
	$_SERVER['gguser_sex'] = $res->sex;
	//$_SESSION['gguser_info']=$res;
	//页面跳转
	if($_GET['state']=='1'){
		header('location:http://www.kmark.cn/gogoda/index.php?s=addon/GuoGuoUser/Gguser/questionary/');
	}else if($_GET['state']=='2'){
		header('location:http://www.kmark.cn/gogoda/index.php?s=addon/GuoGuoUser/Gguser/buy/');
	}else if($_GET['state']=='3'){
		header('location:http://www.kmark.cn/gogoda/index.php?s=addon/GuoGuoUser/Gguser/membercenter/');
	}else if($_GET['state']=='4'){
		header("location:http://www.kmark.cn/gogoda/wxpay/js_api_call_huodong.php");
	}else if($_GET['state']=='5'){
		header("location:http://www.kmark.cn/gogoda/wxpay/js_api_call_huodong_banjia.php");
	}
	
	
}else{
    echo "error";
}
?>
