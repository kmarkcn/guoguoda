<?php

namespace Addons\Ordering\Model;
use Think\Model;
use Addons\GuoGuoUser\Model\GguserModel;

/**
 * Ordering模型
 */
class OrderingModel extends Model{
	
	function getUserName($id){
		$order = M('gguser_order');
		$re = $order->where("id = $id")->select();
		$userid = $re[0]['userid'];
		$user = M('gguser');
		$re = $user->where("id = {$userid}")->select();
		return $re[0]['name'];
	}
	
	
	
	
	
	/*
	 * 2014-10-23 by terry
	 * 判断用户是否存在
	 */
	
	function userExist($name){
		$gguser = M('gguser');
		$re=$gguser->where("name = '{$name}'")->select();
		if(count($re)>0){
			return $re[0];
		}else{
			return 0;
		}
	}
	
	
	
	
	
	/*
	 * 2014-10-23 by terry
	 * 做相关的插入订单数据处理
	 */
	
	function insertOrdering($arr){
		if(OrderingModel::userExist($arr['name'])){
			$re = OrderingModel::userExist($arr['name']);
			$userid = $re['id'];
			$order = M('gguser_order');
			$data = array(
				'userid' => $userid,
				'start_date'=>strtotime($arr['orderTime']),
				'quantity'=>$arr['quantity']
			);
			$order->add($data);
			if(OrderingModel::logisticExist($userid)){
				//echo 1;
				OrderingModel::insertLogistic('2',$userid,$arr['quantity']);
			}else{
				//print_r($re);
				//echo 2;
				OrderingModel::insertLogistic('1',$userid,$arr['quantity']);
			} 
		}else{
			$gguser = M('gguser');
    		$data1 = array(
    			'name' => $arr['name'],
    			'gender'=>'',
    			'mobile'=>'',
    			'address'=>'',
    			'email'=>'',
    			'type'=>'3',
    			'status'=>'1'
    		);
    		$userid = $gguser->add($data1);
    		$data = array(
    			'userid' => $userid,
    			'start_date'=>strtotime($arr['orderTime']),
    			'quantity'=>$arr['quantity']
    		);
    		$order->add($data);
    		OrderingModel::insertLogistic('1',$userid,$arr['quantity']);
		}
	}
	
	
	/*
	*2014-10-23 by terry
	*判断物流的存在
	*/
	function logisticExist($userid){
		$logistic = M('gguser_logistics');
		$re = $logistic->where("userid = {$userid}")->select();
		if(count($re)>0){
			return $re[0];
		}else{
			return 0;
		}
	}
	
	/*
	 * 2014-10-23 by terry
	 * 做物流信息的相关处理
	 */
	
	function insertLogistic($type,$userid,$quantity){
		$logistic = M('gguser_logistics');
		if($type=='1'){
			$data = array(
				'userid'=>$userid,
				'start_date' => OrderingModel::timeChange(),
				'quantity'   => $quantity
			);
			//print_r($data);
			$logistic->add($data); 
		}else if($type=='2'){
			$re = OrderingModel::logisticExist($userid);
			$data = array(
					'start_date' => OrderingModel::timeChange(),
					'quantity'   => $re['quantity']+$quantity
			);
			$logistic->where("userid = {$userid}")->save($data);
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
