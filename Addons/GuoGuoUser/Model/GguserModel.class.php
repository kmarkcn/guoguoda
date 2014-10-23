<?php
namespace Addons\GuoGuoUser\Model;
use Think\Model;
use Addons\Card\Model\WeixinAddonModel;


/*
 * 前台模型
 */
class GguserModel extends Model{
	
	/*
	 * 2014-10-18 by terry
	 * 体质调查
	 */
	
	function getQuestions(){
		$data = M('physique_question')->select();
		$ans = array();
		foreach ($data as $key=>$val){
			//echo($val['answer']);
			//首先将每个答案区分开
			$answer_array = explode('/',$val['answer']);
			foreach($answer_array as $va){
				$anw = array();
				$an = explode(':',$va);
				$anw = array();
				$anw['ggscore'] = $an[0];
				$anw['gganswer'] = $an[1];
				$ans[] = $anw;
			}
			$data[$key]['gogoda'] = $ans;
			$ans = array();
		}
		return $data;
	}
	
	/*
	 * 2014-10-18 by terry
	 * 用户体质入库
	 */
	
	function insertPhy($arr){
		if(GguserModel::isWeixinUser()){
			session_start();
			$userid = GguserModel::getUidByOpenid();
			$physic = M('gguser_physicque');
			$data = array(
					'physicque'=>$arr['gg_score'],
					'last_test'=>time()
			);
			$physic->where("userid = $userid")->save($data);
		}else{
			return 0;
		}
	}
	
	/*
	 * 2014-10-16 by terry
	 * 会员中心
	 */
	function getMemberMsg(){
		$gguser = M('gguser');
    	$physic = M('gguser_physicque');
    	$hobby  = M('gguser_hobby');
    	$logistic = M('gguser_logistics');
    	$order = M('gguser_order');
		
    	//先获取用户信息
		$userid = GguserModel::getUidByOpenid();
    	$userData1 = $gguser->where("id = '{$userid}'")->select();
    	$userData = $userData1[0];
    	$userData['gender1'] = GguserModel::gender_check($userData['gender']);
    	
    	
    	//然后获取用户体质
    	$physicque = $physic->where("userid = '{$userid}'")->select();
    	$userData['physic'] = $physicque[0]['physicque'];

    	
    	//获取用户喜好
    	$hobbys = $hobby->where("userid = '{$userid}'")->select();
    	$userData['like'] = $hobbys[0]['like'];
    	$userData['dislike'] = $hobbys[0]['dislike'];
    	 
    	//获取用户物流表
    	$logisticRe = $logistic->where("userid = '{$userid}'")->select();
    	$userData['logistic'] = $logisticRe[0]['quantity'];
    	$userData['status'] = $logisticRe[0]['status'];
    	
    	
    	//获取用户订单表
    	$orderRe = $order->where("userid = '{$userid}'")->select();
    	$userData['order'] = $orderRe;
    	$userData['orderCount'] = count($orderRe); 
    	
    	//针对订购时间的处理
    	foreach($userData['order'] as $key=>$val){
    		$userData['order'][$key]['start_date'] = date("Y-m-d",$val['start_date']);
    	}
    	return $userData;
    }
    
    
    /*
     * 2014-10-16 by terry
     * 根据openid获取userid
     */
	
    function getUidByOpenid(){
    	session_start();
    	$gguser_weixin = M('gguser_weixin_relation');
    	$openid = $_SESSION['gguser_openid'];
    	$res = $gguser_weixin->where("openid = '{$openid}'")->select();
    	return $res[0]['userid'];
    }
    
    
    
    /*
     * 2014-10-16 by terry 
     * 用户性别处理
     */
    function gender_check($gender){
    	/*
    	 * 1 男 2 女 orther 没有结果
    	*/
    	if($gender==1){
    		return '男';
    	}else if($gender==2){
    		return '女';
    	}else{
    		return '';
    	}
    }
    
    
    /*
     * 2014-10-16 by terry
     * 用户体质处理
     */
   
    function physicque_check($num){
    	// 1 寒性 2 平和 3 热性
    	switch ($num){
    		case 1:
    			return '寒性';break;
    		case 2:
    			return '平和';break;
    		case 3:
    			return '热性';break;
    		default:
    			return '未测试';break;
    	}
    }
    
    
    /*
     * 2014-10-17 by terry
     * 判断此openid是否已经存在
     */
    function checkOpenidExist(){
    	if(GguserModel::isWeixinUser()){
    		$gguser_weixin = M('gguser_weixin_relation');
    		$openid = $_SESSION['gguser_openid'];
    		$re = $gguser_weixin ->where("openid = '{$openid}'")->select();
    		if(empty($re)){
    			return 0;
    		}else{
    			return 1;
    		}
    	}else{
    		return 1;
    	}
    }
    
    
    /*
     * 2014-10-17 by terry
     * 这里是做和关注公众号相同的操作
     */
    function likeSubscribe(){
    	//增加用户表
    	$gguser = M('gguser');
    	$data1 = array(
    			'name' => '',
    			'gender'=>'',
    			'mobile'=>'',
    			'address'=>'',
    			'email'=>'',
    			'type'=>'2',
    			'status'=>'1'
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
    			'openid'=> $_SESSION['gguser_openid'],
    			'headimgurl'=>''
    	);
    	
    	$gguser_weixin->add($data2);
    	
    }
    
    
    /*
     * 2014-10-17 by terry
     * 修改用户信息
     */
    
    function updateMember($arr){
    	if(GguserModel::isWeixinUser()){
    		$userid = GguserModel::getUidByOpenid();
    		$gguser = M('gguser');
    		$data1 = array(
    				'name' => $arr['name'],
    				'gender'=>$arr['modify_sex'],
    				'mobile'=>$arr['mobile'],
    				'address'=>$arr['address'],
    				'email'=>'',
    				'type'=>'2',
    				'status'=>'1'
    		);
    		$gguser->where("id = {$userid}")->save($data1);
    		
    		
    		
    		
    		//修改喜好表
    		$hobby = M('gguser_hobby');
    		$data2 = array(
    				'like'=>$arr['like'],
    				'dislike'=>$arr['dislike']
    		);
    		$hobby->where("userid = '{$userid}'")->save($data2);
    		
    		return 1;
    	}else{
    		return 0;
    	}
    	
   }
    
   
   
   /*
    * 2014-10-17 by terry
    * 判断用户状态
    */
   function check_status(){
   		$logistic = M("gguser_logistics");
   		$userid = GguserModel::getUidByOpenid();
   		
   		$re = $logistic->where("userid = {$userid}")->select();
   		return $re[0];
   }
   
   
   /*
    * 2014-10-17 by terry
    * 更改用户配送状态
    */
   function change_status($arr){
   		if(GguserModel::isWeixinUser()){
   			$logistic = M("gguser_logistics");
   			if($arr['status'] == 1){
   				$data = array(
   						'status'=>"0"
   				);
   			}else if($arr['status'] == 0){
   				$data = array(
   						'status'=>"1"
   				);
   			}
   			 
   			$logistic->where("userid  = {$arr['userid']}")->save($data);
   		}else{
   			return 0;
   		}
   }
	
   
   /*
    * 2014-10-18 by terry
    * 这个是屏蔽非微信用户插入数据
    */
   
   function isWeixinUser(){
   		session_start();
   		if(isset($_SESSION['gguser_openid'])){
   			return 1;
   		}else{
   			//非微信用户
   			return 0;
   		}
   }
 
   
   
   /*
    * 2014-10-20 by terry
    * 将支付数据数据写入session
    */
   function KeepPayData($arr){
   		session_start();
   		$_SESSION['order_money'] = $arr['number'] * $arr['times'];
   		$arr = GguserModel::payDataCheck($arr);
   		$_SESSION['order_start_date'] = $arr['start_date'];
   		$_SESSION['order_quantity'] = $arr['number'] * $arr['times'];
   		 
   }
   
   
   /*
    * 2014-10-20 by terry
    * 得到支付数据
    */
   
   function getPayData(){
   		session_start();
   		$data = array(
   			'userid' => GguserModel::getUidByOpenid(),
   			'start_date'=>time(),
			'money'=>$_SESSION['order_money'],
   			'quantity'=>$_SESSION['order_quantity'],
   		);
   		return $data;
   }
   
   
   /*
    * 2014-10-20 by terry
    * 基于hairy前台传过来的数据进行处理
    */
   function payDataCheck($arr){
   		$arr['start_date'] = str_replace("年","-",$arr['start_date']);
   		$arr['start_date'] = str_replace("月","-",$arr['start_date']);
   		$arr['start_date'] = str_replace("日"," ",$arr['start_date']);
   		$arr['start_date'] = strtotime($arr['start_date']);
   		if($arr['times'] == 49){
   			$arr['times'] = 5;
   		}else if($arr['times'] == 199){
   			$arr['times'] = 22;
   		}
   		return $arr;
   }
   
   
   
   /*
    * 2014-10-21 by terry
    * 将订单写入数据库
    */
   
   function restorePayData(){
   			session_start();
   			$data = GguserModel::getPayData();
   			$order = M('gguser_order');
   			if(GguserModel::isWeixinUser()){
   				$data['lastupdate']  = time();
   				if(isset($_SESSION['order_start_date'])){
   					$order->add($data);
   					unset($_SESSION['order_start_date']);
   				}
   			}
   }
   
   
   
   
   /*
    *2014-10-21 by terry
    *判断物流的存在
    */
   function logisticExist(){
   		$userid = GguserModel::getUidByOpenid();
   		$logistic = M('gguser_logistics');
   		$re = $logistic->where("userid = {$userid}")->select();
   		if(count($re)>0){
   			if($re[0]['quantity']>=1){
   				return 1;
   			}else{
   				return 2;
   			}
   		}else{
   			return 0;
   		}
   }
   
   
   /*
    * 2014-10-21 by terry
    * 返回物流的数据集
    */
   function returnLogisticData(){
   		$userid = GguserModel::getUidByOpenid();
   		$logistic = M('gguser_logistics');
   		$re = $logistic->where("userid = {$userid}")->select();
   		return $re[0];
   }
   
   
   
   
   /*
    * 2014-10-21 by terry
    * 实质的修改物流表
    */
   function changeLogistic($type){
   		$data = GguserModel::getPayData();
   		$userid = GguserModel::getUidByOpenid();
   		$logistic = M('gguser_logistics');
   		if($type=='1'){
   			//物流表不为空并且剩余天数为0
   			$data1 = array(
   				'start_date' => GguserModel::timeChange(),
   				'quantity'   => $data['quantity']
   			);
   			$logistic->where("userid = {$userid}")->save($data1);
   		}else if($type=='2'){
   			//物流表不为空并且剩余天数不为0
   			$re = GguserModel::returnLogisticData();
   			$data1 = array(
   				'quantity'   => $data['quantity']+$re['quantity']
   			);
   			$logistic->where("userid = {$userid}")->save($data1);
   		}else if($type=='3'){
   			//数据为空
   			$data1 = array(
   				'userid'=>$userid,
   				'start_date' => GguserModel::timeChange(),
   				'quantity'   => $data['quantity']
   			);
   			$logistic->add($data1);
   		}
   }
   
   
   
   
   /*
    * 2014-10-21 by terry
    * 订单过后要处理物流表，完成物流系统
    */
   function restoreLogistic(){
   		if(GguserModel::logisticExist()){
   			//判断剩余天数是不是为0
   			if(GguserModel::logisticExist()== '2'){
   				//物流表不为空并且剩余天数为0
   				GguserModel::changeLogistic('1');
   			}else{
   				//物流表不为空并且剩余天数不为0
   				GguserModel::changeLogistic('2');
   			}
   		}else{
   			//物流不存在
   			GguserModel::changeLogistic('3');
   		}
   }
   
   
   
   /*
    * 2014-10-22 by terry
    * 这里是系统的时间处理函数(尚未处理节假日)
    */
   
   function timeChange(){
   		if(date('w') == 6){
   			return time()+(3600*48);
   		}else{
   			if(date('H')>=18){
   				return time()+(3600*48);
   			}else{
   				return time()+(3600*24);
   			}
   		}
   }
   
   
   
   
   
}