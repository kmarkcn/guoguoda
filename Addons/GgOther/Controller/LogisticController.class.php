<?php
namespace Addons\GgOther\Controller;
use Home\Controller\AddonsController;
header("Content-type: text/html; charset=utf-8");
class LogisticController extends AddonsController{
	
	
	function desc1(){
		//改变物流表
		$logistic = M('gguser_logistics');
		$re = $logistic->select();
		foreach($re as $key=>$val){
			if($val['status']==1){
				$today = date("y-m-d",time());
				$start_date = date("y-m-d",$val['start_date']);
				if($today == $start_date){
					
					if($val['quantity']==0){
						$quantity = 0;
					}else{
						$quantity = $val['quantity']-1;
					}
					
					$data = array(
							'start_date'=>$val['start_date']+(3600*24),
							'quantity'=>$quantity,
							'isChange'=>0
					);
					$logistic->where("id = {$val['id']}")->save($data);
				}
			}
			unset($data);
		}
		header('location:http://www.kmark.cn/gogoda/index.php?s=addon/GgOther/GgOther/lists/');
	}
	
	
	
	 
	
}
