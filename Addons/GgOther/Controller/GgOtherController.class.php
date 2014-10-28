<?php

namespace Addons\GgOther\Controller;
use Home\Controller\AddonsController;

class GgOtherController extends AddonsController{
	
	public function lists(){
		$this->display('index');
	}
	
	
	public function message(){
		$this->display();
	}
	
	public function logistic(){
		$this->display();
	}
	
	
}
