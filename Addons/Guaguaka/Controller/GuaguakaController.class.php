<?php

namespace Addons\Guaguaka\Controller;
use Home\Controller\AddonsController;
use Addons\GuoGuoUser\Controller\GguserController;
use Addons\Guaguaka\GuaguakaAddon;

class GuaguakaController extends AddonsController{
	
//加载抽奖页面	
	function show(){
/*===========================================================================================*/		
		//先判断是否为微信关注用户
		$gguser_weixin = M('gguser_weixin_relation');
    	$openid = $_SESSION['gguser_openid'];
    	$res = $gguser_weixin->where("openid = '{$openid}'")->select();
    	//print_r($res);
    	if(count($res)==0){
    		$myPrize = 0;
    	}else{
	    	//是微信用户
	    	//判断今天是否已经抽奖	
    		$re = GuaguakaController::getPrize();
    		if(count($re)==1){
    			if($re[0]['isKill']==1){
    				$myPrize = 1;//今天你已经抽奖了
    			}else{
    				$myPrize = $re[0]['prize'];
    			}
    			
    		}else{ 
    			//满足抽奖的规则
    			//算出抽奖的概率
    			/*
    			 * 中奖说明:
    			 * 3日之类不可中奖
    			 * 1个月 	0.1%
    			 * 1个周 	10%
    			 * 1个天 	60%
    			 * 未中奖   29.9%
    			 */
    			 
    			//有过中奖记录的就不能中奖
    			$rrs = GuaguakaController::getPris();
    			$getPrize = 0;
    			foreach ($rrs as $key=>$val){
    				if($val['prize'] ==3 || $val['prize'] ==4 || $val['prize'] == 5){
    					$getPrize = 1;//证明已经中过奖了
    				}
    			}
    			if($getPrize){
    				$myPrize = 2;//未中奖
    			}else{
    				//这里是要中奖的结果
    				$rand1 = rand(0,9);
    				$rand2 = rand(0,9);
    				$rand3 = rand(0,9);
    				if($rand1==8 && $rand2==8 && $rand3==8){
    					$myPrize = 3;//1等奖
    				}else if($rand1==8 || $rand2 ==8 || $rand3 ==8){
    					$myPrize = 4;//2等奖
    				}else if($rand1==1 || $rand2 ==1 || $rand3 ==1 ){
    					$myPrize = 2;//未中奖
    				}else{
    					$myPrize = 5;//3等奖
    				}
    			}
    		}}  
    		//$myPrize = 2;
/*===========================================================================================*/
//写入数据库表
    if(count($re) == 0){
    	$prize = M('guaguaka');
    	$data = array(
    		'userid' =>	GuaguakaController::getUidByOpenid(),
    		'times'=> 1,
    		'date'=> date('y-m-d',time()),
    		'prize'=> $myPrize,
    		'isGet'=> 0,
    		'isKill'=> 0	
    	);
    	$prizeid = $prize->add($data);
    } 
    

//获取用户中奖记录
    
    $prizes = GuaguakaController::getPrizes();
    
//获取用户中奖并且没有领取记录

   // $prizen = GuaguaKaController::getPrizen();
    
/*===========================================================================================*/
    $this->assign("prizeid",$prizeid);
    $this->assign("myPrize",$myPrize);
    $this->assign("prizes",$prizes);
    $this->display();
    //print_r($prizes);
    
	}
	
	
	
	//改变用户抽奖isKill字段
	function changeKill(){
		$userid = GuaguakaController::getUidByOpenid();
		$prize = M('guaguaka');
		$data = array('isKill'=>1);
		$date = date('y-m-d',time());
		$prize->where("userid = {$userid} and date = '{$date}'")->save($data);
		echo 1;
	}
	
	
	function logistic(){
		$gguser = M('gguser');
		//先获取用户信息
		$userid = GuaguakaController::getUidByOpenid();
		$userData1 = $gguser->where("id = '{$userid}'")->select();
		$userData['name'] = $userData1[0]['name'];
		$userData['mobile'] = $userData1[0]['mobile'];
		$userData['address'] = $userData1[0]['address'];
		$this->assign('userData',$userData);
		$prizeid = $_GET['prizeid'];
		$this->assign("prizeid",$prizeid);
		//echo $prizeid;
		$this->display();
	}
	
	function logisticDo(){
		//更改用户信息
		$userid = GuaguakaController::getUidByOpenid();
		$data = array(
				'name'=>$_POST['name'],
				'mobile'=>$_POST['mobile'],
				'address'=>$_POST['address']
		);
		$user = M('gguser');
		$user->where("id = {$userid}")->save($data);
		
		//改变领奖状态
		$prizeId = $_POST['prizeid'];
		$prize = M('guaguaka');
		$data = array('isGet'=>1);
		$prize->where("id = {$prizeId}")->save($data);
		//改变物流
		
			//先判断物流是否存在
			$logistic = M('gguser_logistics');
			$re = $logistic->where("userid = {$userid}")->select();
			$pri = $prize->where("id = {$prizeId}")->select();
			$quantity  = $pri[0]['prize'];
			$quantity = GuaguakaController::logisticDay($quantity);
			if(count($re)>0){
				//物流存在
				$log = GuaguakaController::getLogisticData();
				if($log['quantity']==0){
					$data1 = array(
							'start_date' => GuaguakaController::timeChange(),
							'quantity'   => $quantity,
							'isChange'=>1
					);
					$logistic->where("userid = {$userid}")->save($data1);
				}else{
					$data1 = array(
							'quantity'   => $quantity + $log['quantity'],
							'isChange'=>1
					);
					$logistic->where("userid = {$userid}")->save($data1);
				}
			}else{
				//物流不存在
				$data1 = array(
						'userid'=>$userid,
						'start_date' => GuaguakaController::timeChange(),
						'quantity'   => $quantity,
						'isChange'=>1
				);
				$logistic->add($data1);
			}
			//跳到会员中心页面
			header("location:http://www.kmark.cn/gogoda/index.php?s=addon/GuoGuoUser/Gguser/membercenter/"); 
	}
	
	
	function getLogisticData(){
		$userid = GuaguakaController::getUidByOpenid();
		$logistic = M('gguser_logistics');
		$re = $logistic->where("userid = {$userid}")->select();
		return $re[0];
	}
	
	
	//根据奖品得到物流天数
	function logisticDay($quantity){
		switch ($quantity){
			case 3:
				return 21;
				break;
			case 4:
				return 5;
				break;
			case 5:
				return 2;
				break;
		}
	}
	
	
	
	
	//系统物流时间
	function timeChange(){
		if(date('w') == 6){
			return time()+(3600*48);
		}else if(date('w') == 5){
			return time()+(3600*72);
		}else{
			if(date('H')>=18){
				return time()+(3600*48);
			}else{
				return time()+(3600*24);
			}
		}
	}
	 
	
	//获取用户中奖记录
	function getPrizes(){
		$userid = GuaguakaController::getUidByOpenid();
		//$date = date('y-m-d',time());
		$prize = M('guaguaka');
		$res = $prize->where("userid = {$userid} and isKill = 1")->select();
		foreach($res as $key=>$val){
			if($val['prize']==0 || $val['prize']==2){
				unset($res[$key]);
			}
		}
		return $res;
	}
	
	//获取用户中奖记录并且未领取
	function getPrizen(){
		$userid = GuaguakaController::getUidByOpenid();
		//$date = date('y-m-d',time());
		$prize = M('guaguaka');
		$res = $prize->where("userid = {$userid}")->select();
		foreach($res as $key=>$val){
			if($val['prize']==0 || $val['isGet']==1){
				unset($res[$key]);
			}
		}
		return $res;
	}
	
	//获取用户id
	function getUidByOpenid(){
		session_start();
		$gguser_weixin = M('gguser_weixin_relation');
		$openid = $_SESSION['gguser_openid'];
		$res = $gguser_weixin->where("openid = '{$openid}'")->select();
		return $res[0]['userid'];
	}
	
	
	
	
	//从奖品表中获取今日数据
	function getPrize(){
		$userid = GuaguakaController::getUidByOpenid();
		$date = date('y-m-d',time());
		$prize = M('guaguaka');
		$re = $prize->where("userid = {$userid} and date = '{$date}'")->select();
		return $re;
	}
	
	
	//从奖品表中获取前一天数据
	function getPrize1(){
		$userid = GuaguakaController::getUidByOpenid();
		$date = date('y-m-d',(time()-3600*24));
		$prize = M('guaguaka');
		$re = $prize->where("userid = {$userid} and date = '{$date}'")->select();
		if($re[0]['prize'] != 0){
			return 1;
		}
	}
	
	//从奖品表中获取前二天数据
	function getPrize2(){
		$userid = GuaguakaController::getUidByOpenid();
		$date = date('y-m-d',(time()-3600*48));
		$prize = M('guaguaka');
		$re = $prize->where("userid = {$userid} and date = '{$date}'")->select();
		if($re[0]['prize'] != 0){
			return 1;
		}
	}
	
	//从奖品表中获取所有用户中奖数据
	
	function getPris(){
		$userid = GuaguakaController::getUidByOpenid();
		$prize = M('guaguaka');
		$re = $prize->where("userid = {$userid}")->select();
		return $re;
	}
	
}
