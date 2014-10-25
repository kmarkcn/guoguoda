<?php

namespace Addons\Logistic\Controller;
use Home\Controller\AddonsController;
use Addons\Logistic\Model\LogisticModel;

class LogisticController extends AddonsController{
	function lists(){
		//获取模型信息
		$model = $this->getModel ('gguser_logistics');
		$list_data = $this->_get_model_list ( $model );
		foreach($list_data['list_data'] as $key=>$val){
			$list_data['list_data'][$key]['name'] = LogisticModel::getUserName($val['id']);
			$list_data['list_data'][$key]['start_date'] = date("Y-m-d",$val['start_date']);
			if($val['status']=='1'){
				$list_data['list_data'][$key]['status'] = '正常配送';
			}else{
				$list_data['list_data'][$key]['status'] = '暂停配送';
			}
			$list_data['list_data'][$key]['address'] = LogisticModel::getAddress($val['id']);
		}
		$this->assign ( $list_data );
		$this->display ( $model ['template_list'] );
	}
}
