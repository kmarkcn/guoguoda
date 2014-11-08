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
					
					if(date('w') == 6){
						$startDate =  time()+(3600*48);
					}else if(date('w') == 5){
						$startDate = time()+(3600*72);
					}else{
						$startDate = time()+(3600*24);
					}
				
					
					$data = array(
							'start_date'=>$startDate,
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
