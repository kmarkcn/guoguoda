<?php

namespace Addons\activity\Controller;
use Home\Controller\AddonsController;

class activityController extends AddonsController{
	
	function _initialize(){
		parent::_initialize();
		$nav[] = array('title'=>'活动中心',
				'url'=>addons_url ( 'activity://activity/lists'),
				'class'=>'current'
		);
		$this->assign ( 'nav', $nav );
	}
	
	
	function lists(){
		// 获取模型信息
		$model = $this->getModel ('gg_activity');
		$list_data = $this->_get_model_list ( $model );
		$this->display ( $model ['template_list'] );
	} 
	
	
	/*
	 * 2014-10-11 by terry
	* 实现用户表基本操作
	*/
	
	function del(){
	 	$model = $this->getModel('gg_activity');
		parent::common_del($model);
	} 
	function add(){
		$model = $this->getModel('gg_activity');
		parent::common_add($model);
	}
	function edit(){
		$model = $this->getModel('gg_activity');
		parent::edit($model);
	}
	
	
}
