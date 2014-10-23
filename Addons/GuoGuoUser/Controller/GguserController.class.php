<?php
namespace Addons\GuoGuoUser\Controller;
use Home\Controller\AddonsController;
use Addons\GuoGuoUser\Model\GguserModel;



class GguserController extends AddonsController{
	
	
	/*
	 * 用户中心前台控制器 by terry
	 */
	
	function membercenter(){
		if(!GguserModel::checkOpenidExist()){
			GguserModel::likeSubscribe();
		}
		$userData = GguserModel::getMemberMsg();
		$this->assign('userData',$userData);
		$this->display();  
	}
	
	
	/*
	 * 2014-09-22 by terry @kmark
	* 调用问卷页面
	*/
	
	public function questionary(){
		if(!GguserModel::checkOpenidExist()){
			GguserModel::likeSubscribe();
		}
		$this->assign('ques',GguserModel::getQuestions());
		$this->display();
		 
	}
	
	
	/*
	 * 2014-09-22 by terry @kmark
	 * 实现客户的资料入库
	*/
	function physic(){
		//这里接收会员的体质值
		GguserModel::insertPhy($_GET);
		$this->display("habitus");
	}
	
	
	/*
	 * 2014-10-17 by terry
	 * 会员资料修改
	 */
	
	function update(){
		if(!GguserModel::checkOpenidExist()){
			GguserModel::likeSubscribe();
		}
		if(GguserModel::updateMember($_POST)){
			$userData = GguserModel::getMemberMsg();
			$this->assign('userData',$userData);
			$this->display("membercenter");
		}
	}
	
	
	/*
	 * 2014-10-17 by terry
	 * 修改用户配送状态
	 */
	function changeStatus(){
		$re = GguserModel::check_status();
		GguserModel::change_status($re);
		$userData = GguserModel::getMemberMsg();
		$this->assign('userData',$userData);
		$this->display("membercenter");
	}
	
	
	
	/*
	 * 2014-10-17 by terry
	 * 调用用户支付信息界面出发支付
	 */
	
	function payTrue(){
		session_start();
		$pay_money = $_POST['number']*$_POST['times']*100;
		$_SESSION['gguser_money'] = $pay_money;
		GguserModel::KeepPayData($_POST);
		header("location:http://www.kmark.cn/gogoda/wxpay/js_api_call.php");
	}
	
	
	/*
	 * 2014-10-20 by terry
	 * 支付返回处理函数
	 */
	function payResult(){
		if($_GET['result']==1){
			GguserModel::restorePayData();
			GguserModel::restoreLogistic();
		};
		$userData = GguserModel::getMemberMsg();
		$this->assign('userData',$userData);
		$this->display("membercenter");
	}
	
	
	
	
	
	
	
	
}