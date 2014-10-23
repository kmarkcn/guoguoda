<?php

namespace Addons\Ordering\Controller;
use Home\Controller\AddonsController;
use Addons\Ordering\Model\OrderingModel;

class OrderingController extends AddonsController{
	function _initialize(){
		parent::_initialize();
		$res ['title'] = '订单列表';
		$res ['url'] = addons_url ( 'Ordering://Ordering/lists');
		$res ['class'] = 'current';
		$nav [] = $res;
	}
	
	
	function lists(){
		//获取模型信息
		$model = $this->getModel ('gguser_order');
		$list_data = $this->_get_model_list ( $model );
		foreach($list_data['list_data'] as $key=>$val){
			$list_data['list_data'][$key]['start_date'] = date("Y-m-d",$val['start_date']);
			$list_data['list_data'][$key]['name'] = OrderingModel::getUserName($val['id']);
		}
		$this->assign ( $list_data );
		$this->display ( $model ['template_list'] );
	}
	
	
	function add(){
		 $this->display("add");
	}
	
	/* function edit(){
		$model = $this->getModel('gguser');
		parent::edit($model);
	}  */
	
	function del(){
		$model = $this->getModel('gguser_order');
		parent::del($model);
	}
	
	function adddo(){
		OrderingModel::insertOrdering($_POST);
		header('location:http://www.kmark.cn/gogoda/index.php?s=/addon/Ordering/Ordering/lists/');
	}
	
	
	
	
	
}
