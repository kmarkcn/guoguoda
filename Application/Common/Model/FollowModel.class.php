<?php

namespace Common\Model;

use Think\Model;
use User\Api\UserApi;

/**
 * 粉丝操作
 */
class FollowModel extends Model {
	function init_follow($openid) {
		$data ['token'] = get_token ();
		$data ['openid'] = $openid;
		
		$info = $this->where ( $data )->find ();

		if ($info) {
			$save ['subscribe_time'] = $info ['subscribe_time'] = time ();
			$res = $this->where ( $data )->save ( $save );
		} else {
			$data ['subscribe_time'] = time ();
			$uid = $this->get_uid_by_ucenter ( $data ['openid'], $data ['token'] );
			if ($uid > 0) {
				$data ['id'] = $uid;
				$res = $this->add ( $data );
			}
			
			$info = $data;
		}
		return $info;
	}
	// 自动初始化微信用户
	function get_uid_by_ucenter($openid, $token) {
		$info ['openid'] = $openid;
		$info ['token'] = $token;
		$res = M ( 'ucenter_member' )->where ( $info )->find ();
		
		if ($res)
			return $res ['id'];
		
		$email = time () . '@weiphp.cn';
		$nickname = uniqid().rand(01,99);
		
		/* 调用注册接口注册用户 */
		$User = new UserApi ();
		$uid = $User->register ( $nickname, '123456', $email, '', $openid, $token );
		
		return $uid;
	}
	
	/**
	 * 获取粉丝全部信息
	 */
	public function getFollowInfo($id) {
		static $_followInfo;
		if (isset ( $_followInfo [$id] )) {
			return $_followInfo [$id];
		}
		
		$_followInfo [$id] = $this->find ( $id );
		return $_followInfo [$id];
	}
	
	
	/*
	 $m = M("follow");
	$dao = $this->getWeixinUserInfo($param ['openid'],$param ['token']); 
	$m->where ( $param )->save($dao);
		
 
 
        // 通过openid获取微信用户基本信息,此功能只有认证的服务号才能用
    function getWeixinUserInfo($openid, $token) {
    //    $param ['appid'] = $GLOBALS ['user'] ['appid'];
    //    $param ['secret'] = $GLOBALS ['user'] ['secret'];
        $param ['appid'] = "wxf7f38b4a13482c18";
        $param ['secret'] = "dd6aa3a6618ea6472a6abc1d42020e0d";
        $param ['grant_type'] = 'client_credential';
        $url = 'https://api.weixin.qq.com/cgi-bin/token?' . http_build_query ( $param );
        $content = file_get_contents ( $url );
        $content = json_decode ( $content, true );
        
        $param2 ['access_token'] = $content ['access_token'];
        $param2 ['openid'] = $openid;
        $param2 ['lang'] = 'zh_CN';
        
        $url = 'https://api.weixin.qq.com/cgi-bin/user/info?' . http_build_query ( $param2 );
        $content = file_get_contents ( $url );
        $content = json_decode ( $content, true );
        return $content;
    }
	
2.把微信用户的头像转换成本地路径
http://www.cnblogs.com/txw1958/p/weixin77-download-picture.html  参考网址
//直接放微信图片的地址   这里的URL就是上面的$dao ['headimgurl']
function downloadImageFromQzone($url)
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HEADER, 0);    
    curl_setopt($ch, CURLOPT_NOBODY, 0);    //只取body头
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $package = curl_exec($ch);
    $httpinfo = curl_getinfo($ch);
    
    curl_close($ch);
    $imageAll = array_merge(array('imgBody' => $package), $httpinfo); 
    $filename = time ();
    $object = './Uploads/User/'.$filename.'.jpg';
	$local_file = fopen($object, 'w');
	if (false !== $local_file){
	    if (false !== fwrite($local_file, $imageAll["imgBody"])) {
	        fclose($local_file);
	    }
	}
	
	//因为weiphp里面的图片都是已ID的形式存在其他的表的  这里就需要在picture 表里面加一条记录 然后把当前返回的ID 替换 根据OPENID 返回的详细信息 的图片
		$Ming = M("picture");
        
        $Madd['path'] = substr($row['headimgurl'],1);
        $Madd['status'] = 1;
        $Madd['md5'] =  md5($Madd['path']);
        $Madd['sha1'] =  md5($Madd['path']);
        $Madd['create_time'] = time();
        $Ming->add($Madd);
        $headimgurl = $Ming->getLastInsID();
	
	
	return  $headimgurl;
}	
 
3.在微信列表上显示图片 
Application/Common/Common/function.php   首先在这个文件里面加一个函数  
//获取对应的图片
 
function get_cover_url_img($cover_id){
    $img = get_cover_url($cover_id);   //因为该文件自带get_cover_url函数  这个函数可以根据图片的id  获取图片的url
    $str = "<img width='50' height='50' src='".$img."'   />";
    return $str;
}
	 
	 
	 
	 */
}
?>
