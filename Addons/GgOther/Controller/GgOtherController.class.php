<?php

namespace Addons\GgOther\Controller;
use Home\Controller\AddonsController;

class GgOtherController extends AddonsController{
	
	public function lists(){
		$this->display('index');
	}
	
	
	public function message(){
		//从活动中选取活动名字
		$activity = M('gg_activity');
		$re = $activity->select();
		$this->assign("activity",$re);
		$this->display();
	}
	
	public function logistic(){
		$this->display();
	}
	
	
}
