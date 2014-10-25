<?php

namespace Addons\Logistic\Model;
use Think\Model;

/**
 * Logistic模型
 */
class LogisticModel extends Model{
	function getUserName($id){
		$order = M('gguser_logistics');
		$re = $order->where("id = $id")->select();
		$userid = $re[0]['userid'];
		$user = M('gguser');
		$re = $user->where("id = {$userid}")->select();
		return $re[0]['name'];
	}
	function getAddress($id){
		$order = M('gguser_logistics');
		$re = $order->where("id = $id")->select();
		$userid = $re[0]['userid'];
		$user = M('gguser');
		$re = $user->where("id = {$userid}")->select();
		return $re[0]['address'];
	}
}
