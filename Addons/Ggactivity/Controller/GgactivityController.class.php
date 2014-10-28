<?php

namespace Addons\Ggactivity\Controller;
use Home\Controller\AddonsController;

class GgactivityController extends AddonsController{
	function lists(){
		// 获取模型信息
		$model = $this->getModel ('gg_activity');
		$list_data = $this->_get_model_list ( $model );
		$this->assign($list_data);
		$this->display ( $model ['template_list'] );
	}
	
	
	function del(){
	 	$model = $this->getModel('gg_activity');
		parent::common_del($model);
	} 
	function add(){
		//$this->assign ( 'normal_tips', GuoGuoUserModel::gguser_instruction());
		$model = $this->getModel('gg_activity');
		parent::common_add($model);
	}
	function edit(){
		//$this->assign ( 'normal_tips', GuoGuoUserModel::gguser_instruction());
		$model = $this->getModel('gg_activity');
		parent::edit($model);
	}
}
