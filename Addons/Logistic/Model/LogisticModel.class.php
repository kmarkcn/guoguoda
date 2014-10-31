<?php

namespace Addons\Logistic\Model;
use Think\Model;

/**
 * Logistic模型
 */
class LogisticModel extends Model{
	function getUser($id){
		$order = M('gguser_logistics');
		$re = $order->where("id = $id")->select();
		$userid = $re[0]['userid'];
		$user = M('gguser');
		$re = $user->where("id = {$userid}")->select();
		return $re[0];
	}



/*==============================
 *2014-10-30 by terry
 *打印物流信息
 ==============================*/
	function printLogisticData($data){
		$str = "";
		foreach($data['list_data'] as $key=>$val){
			$str .= $val['name'];
			$str .='           '; 
			$str .= $val['mobile'];
			$str .='           ';
			$str .= $val['start_date'];
			$str .='           ';
			$str .= $val['quantity'];
			$str .='           ';
			$str .= $val['status'];
			$str .='           ';
			$str .= $val['address'];
			$str .= '\n';
		}
		$fi = './logistic.txt';
		fopen($fi,'a');
		$fp = fwrite($fi, $str);
		fclose($fp);
	}


}