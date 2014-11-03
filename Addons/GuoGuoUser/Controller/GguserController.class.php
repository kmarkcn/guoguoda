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
		$this->display();
	}
	 
	
	function membermsg(){
		$userData = GguserModel::getMemberMsg();
		$this->assign('userData',$userData);
		$this->display();
	}
	
	
	function logistic(){
		$userData = GguserModel::getMemberMsg();
		$this->assign('userData',$userData);
		$this->display();
	}
	
	function buy(){
		$userData = GguserModel::getMemberMsg();
		$this->assign('userData',$userData);
		$this->display();
	}
	
	function name(){
		$userData = GguserModel::getMemberMsg();
		$this->assign('userData',$userData);
		$this->display();
	}
	
	
	function nameDo(){
		if(GguserModel::checkOpenidExist()){
			$userid = GguserModel::getUidByOpenid();
			$data = array(
				'name'=>$_POST['name']
			);
			$user = M('gguser');
			$user->where("id = $userid")->save($data);
		}
		header("location:http://www.kmark.cn/gogoda/index.php?s=addon/GuoGuoUser/Gguser/membermsg/");
	}
	
	function gender(){
		$userData = GguserModel::getMemberMsg();
		$this->assign('userData',$userData);
		$this->display();
	}
	function genderDo(){
		if(GguserModel::checkOpenidExist()){
			$userid = GguserModel::getUidByOpenid();
			$data = array(
					'gender'=>$_POST['gender']
			);
			$user = M('gguser');
			$user->where("id = $userid")->save($data);
		}
		header("location:http://www.kmark.cn/gogoda/index.php?s=addon/GuoGuoUser/Gguser/membermsg/");
	}
	function mobile(){
		$userData = GguserModel::getMemberMsg();
		$this->assign('userData',$userData);
		$this->display();
	}
	function mobileDo(){
		if(GguserModel::checkOpenidExist()){
			$userid = GguserModel::getUidByOpenid();
			$data = array(
					'mobile'=>$_POST['mobile']
			);
			$user = M('gguser');
			$user->where("id = $userid")->save($data);
		}
		header("location:http://www.kmark.cn/gogoda/index.php?s=addon/GuoGuoUser/Gguser/membermsg/");
	}
	
	function address(){
		$userData = GguserModel::getMemberMsg();
		$this->assign('userData',$userData);
		$this->display();
	}
	function addressDo(){
		if(GguserModel::checkOpenidExist()){
			$userid = GguserModel::getUidByOpenid();
			$data = array(
					'address'=>$_POST['address']
			);
			$user = M('gguser');
			$user->where("id = $userid")->save($data);
		}
		header("location:http://www.kmark.cn/gogoda/index.php?s=addon/GuoGuoUser/Gguser/membermsg/");
	}
	function dislike(){
		$userData = GguserModel::getMemberMsg();
		$this->assign('userData',$userData);
		$this->display();
	}
	function dislikeDo(){
		$str = '';
		foreach($_POST['dislike'] as $key =>$val){
			if($key<count($_POST['dislike'])-1){
				$str .=$val;
				$str .='/';
			}else{
				$str .=$val;
			}
		}
		if(!empty($_POST['dislikeOther'])){
			$str .='+';
			$str .=$_POST['dislikeOther'];
		}
		if(GguserModel::checkOpenidExist()){
			$userid = GguserModel::getUidByOpenid();
			$data = array(
					'dislike'=>$str
			);
			$user = M('gguser_hobby');
			$user->where("userid = $userid")->save($data);
		}
		header("location:http://www.kmark.cn/gogoda/index.php?s=addon/GuoGuoUser/Gguser/membermsg/");
	}
	
	function like(){
		$userData = GguserModel::getMemberMsg();
		$this->assign('userData',$userData);
		$this->display();
	}
	function likeDo(){
		$str = '';
		foreach($_POST['like'] as $key =>$val){
			if($key<count($_POST['like'])-1){
				$str .=$val;
				$str .='/';
			}else{
				$str .=$val;
			}
		}
		if(!empty($_POST['likeOther'])){
			$str .='+';
			$str .=$_POST['likeOther'];
		}
		if(GguserModel::checkOpenidExist()){
			$userid = GguserModel::getUidByOpenid();
			$data = array(
					'like'=>$str
			);
			$user = M('gguser_hobby');
			$user->where("userid = $userid")->save($data);
		}
		header("location:http://www.kmark.cn/gogoda/index.php?s=addon/GuoGuoUser/Gguser/membermsg/");
	}
	
	
	
	
	/*
	 * 2014-10-23 by terry
	* 调用用户支付信息界面出发支付
	*/
	
	function buyDo(){
		session_start();
		$pay_money = $_POST['money'];
		$_SESSION['gguser_money'] = $pay_money;
		GguserModel::KeepPayData($_POST);
		if($_POST['payWay']=='onLine'){
			header("location:http://www.kmark.cn/gogoda/wxpay/js_api_call.php");
		}else if($_POST['payWay']=='offLine'){
			//完成线下支付流程
			//GguserController::offLine();
			$userData = GguserModel::getMemberMsg();
			$this->assign('userData',$userData);
			$this->display("logisticOffline");	
		}
	}
	
	
	/*
	 * 线下支付流程
	 * by terry 2014-11-03
	 */
	function offLine(){
		GguserModel::restorePayData("","","offLine");
		GguserModel::restoreLogistic("","","offLine");
		GguserModel::changeType();
	}
	
	/*
	* 2014-10-20 by terry
	* 支付返回处理函数
	*/
	function payResult($yb=null,$payWay=null){
		if(empty($yb)){
			if($_GET['result']==1){
				GguserModel::restorePayData("","","");
				GguserModel::restoreLogistic("","");
			};
			if($_GET['result']==2){
				if(!GguserModel::checkOpenidExist()){
					GguserModel::likeSubscribe();
				}
				GguserModel::restorePayData("huodong","","");
				GguserModel::restoreLogistic("huodong","");
				GguserModel::restoreHuodong();
			};
			//改变用户type
			GguserModel::changeType();
			
			//调出物流信息页面
			$userData = GguserModel::getMemberMsg();
			$this->assign('userData',$userData);
			$userData = GguserModel::getMemberMsg();
			$this->assign('userData',$userData);
			$this->display("logisticmsg");
		}else{
			//这里是异步的支付处理
			//addWeixinLog("支付的异步处理",$yb);
			GguserModel::restorePayData("",$yb,"");
			GguserModel::restoreLogistic("",$yb);
			GguserModel::changeType($yb);
		}
	}
	
	
	function logisticDo(){
		$userid = GguserModel::getUidByOpenid();
		$data = array(
			'name'=>$_POST['name'],
			'mobile'=>$_POST['mobile'],
			'address'=>$_POST['address']
		);
		$user = M('gguser');
		$user->where("id = {$userid}")->save($data);
		$this->display('membercenter');
	}
	
	
	function logisticDoOff(){
		$userid = GguserModel::getUidByOpenid();
		$data = array(
				'name'=>$_POST['name'],
				'mobile'=>$_POST['mobile'],
				'address'=>$_POST['address']
		);
		$user = M('gguser');
		$user->where("id = {$userid}")->save($data);
		GguserController::offLine();
		$this->display('membercenter');
	}
	
	
	
	function huodongCheck(){
		$time1 = strtotime("2014-10-27 00:00:00");
		$time2 = strtotime("2014-12-30 24:00:00");
		if(time()>=$time1 && time()<$time2){
			$huodong = M('gg_huodong');
			$userid = GguserModel::getUidByOpenid();
			$re = $huodong->where("userid = {$userid}")->select();
			if(empty($re)){
				echo 1;//可以参加
			}else{
				echo 4;//你已经参加
			}
		}else if(time()<$time1){
			echo 2;//活动还未开始
		}else{
			echo 3;//活动过期
		}
	}
	
	function huodongCheck2(){
		$time1 = strtotime("2014-10-27 00:00:00");
		$time2 = strtotime("2014-12-30 24:00:00");
		if(time()>=$time1 && time()<$time2){
			$huodong = M('gg_huodong');
			$userid = GguserModel::getUidByOpenid();
			$re = $huodong->where("userid = {$userid}")->select();
			if(empty($re)){
				echo 5;//亲，你没有参加此活动，无法享用半价购买,请关注果果哒精彩活动
			}else{
				if($re[0]['times']==1){
					echo 1;//可以参加
				}else{
					echo 4;//你已经参加了半价活动，不能第二次购买哟.
				}
			}
		}else if(time()<$time1){
			echo 2;//活动还未开始
		}else{
			echo 3;//活动过期
		} 
	}
	
	
	
/*=======================================================================================================
 * 支付bug解决
 * 2014-10-29 by terry
 *======================================================================================================*/	
	function  restorePayData(){
		$gg_paydata = M('gg_paydata');
		$userid = GguserModel::getUidByOpenid();
		$out_trade_no = $_GET['out_trade_no'];
		$data = array(
			'userid'=>$userid,
			'out_trade_no'=>$out_trade_no
		);
		if($gg_paydata->add($data)){
			echo 1;
		}else{
			echo 0;
		}
	}
	
	
	
	function payResults(){
		//查询订单是否已经
		$out_trade_no = $_GET['out_trade_no'];
		$order = M('gguser_order');
		$re = $order->where("out_trade_no = '{$out_trade_no}'")->select();
		if(count($re)){
			//addWeixinLog("支付未异步处理","by terry");
			echo 1;
		}else{
			//addWeixinLog("支付异步处理","by terry");
			GguserController::payResult($_GET);
			echo 1;
		}
	}
	

	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
/*=====================================================================================================
 * 下面是老版本
 *=====================================================================================================
 */	
	
	
	
	
	
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
		if(!GguserModel::checkOpenidExist()){
			GguserModel::likeSubscribe();
		}
		$this->display("habitus");
	}
	
	function habitus(){
		$this->display();
	}
	
	
	
}