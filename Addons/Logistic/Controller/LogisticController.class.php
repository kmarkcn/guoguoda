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
			$re = LogisticModel::getUser($val['id']);
			$list_data['list_data'][$key]['name'] = $re['name'];
			$list_data['list_data'][$key]['start_date'] = date("Y-m-d",$val['start_date']);
			if($val['status']=='1'){
				$list_data['list_data'][$key]['status'] = '正常配送';
			}else{
				$list_data['list_data'][$key]['status'] = "<span style='color:red;'>暂停配送</span>";
			}
			if($val['payType']=='1'){
				$list_data['list_data'][$key]['payType'] = '微信支付';
			}else if($val['payType']=='2'){
				$list_data['list_data'][$key]['payType'] = "<span style='color:red;'>货到付款</span>";
			}else{
				$list_data['list_data'][$key]['payType'] = '免费赠送';
			}
			if($val['isChange']=='1'){
				$list_data['list_data'][$key]['isChange'] = "<span style='color:red;font-size:18px;'>*</span>";
			}else{
				$list_data['list_data'][$key]['isChange'] = '';
			}
			
			$list_data['list_data'][$key]['address'] = $re['address'];
			$list_data['list_data'][$key]['mobile'] = $re['mobile'];
			//这里去掉天数为0的用户
			if($val['quantity']=='0'){
				unset($list_data['list_data'][$key]);
			}
		}
		LogisticModel::printLogisticData($list_data);
		$this->assign ( $list_data );
		$this->display ( $model ['template_list'] );
	}
}
