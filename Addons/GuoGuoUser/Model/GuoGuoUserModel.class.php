<?php

namespace Addons\GuoGuoUser\Model;
use Think\Model;
use Think\Template\Driver\Mobile;
use Addons\GuoGuoUser\Controller\GuoGuoUserController;

/**
 * 后台模型
 */
class GuoGuoUserModel extends Model{

/*
 * 2014-10-13 by terry
 * 用户数据处理模型
 */		
	function gguser_handle($list_data){	
			foreach($list_data['list_data'] as $key=>$val){
				//性别处理
				/*
				 * 1 男
				 * 2 女
				 */
				if($val['gender']==1){
					$list_data['list_data'][$key]['gender']='男';
				}else if($val['gender']==2){
					$list_data['list_data'][$key]['gender']='女';
				}else{
					$list_data['list_data'][$key]['gender']='';
				}
				//用户类型处理
				/*
				 * 1 VIP会员
				 * 2  普通会员
				 * 3  线下用户
				 */
				if($val['type']==1){
					$list_data['list_data'][$key]['type']='VIP会员';
				}else if($val['type']==2){
					$list_data['list_data'][$key]['type']='普通会员';
				}else if($val['type']==3){
					$list_data['list_data'][$key]['type']='线下用户';
				}
				//用户过滤
				/*
				 * 1 正常状态 保留 0 非正常状态 过滤
				 */
				if($val['status']=='0'){
					unset($list_data['list_data'][$key]);
				}else{
					$list_data['list_data'][$key]['status']='正常';
				}
				
			}
			
			
			return $list_data;
	}
	
/*
* 2014-10-13 by terry
* 模型数据指导说明
*/
	
	function gguser_instruction(){
		 return $normal_tips = '<br/>性别栏:1    男，2   女<br/>类型栏:1 VIP会员, 2 普通会员,  3 线下用户';
	}
	
/*
 * 2014-10-13 by terry
 * 关联体质模型，口味模型数据
 */
	
	function gguser_physic_hobby_relation($userid){
		$gguser = M('gguser');
    	$physic = M('gguser_physicque');
    	$hobby = M('gguser_hobby');
    	
    	//关联数据
    	$user= $gguser->where("id={$userid}")->select();
    	$phy = $physic->where("userid={$userid}")->select();
    	$hob = $hobby->where("userid={$userid}")->select();
    	$data['name'] = $user[0]['name'];
    	$data['physic'] = self::physicque_check($phy[0]['physicque']);
    	$data['like'] = $hob[0]['like'];
    	$data['dislike'] = $hob[0]['dislike'];
    	return $data; 
    	
	}
	
	
/*
 * 2014-10-13 by terry
 * 体质匹配
 */
	function physicque_check($num){
		// 1 寒性 2 平和 3 热性
		switch ($num){
			case 1:
				return '寒性';break;
			case 2:
				return '平和';break;
			case 3:
				return '热性';break;
			default:
				return '未测试';break;
		}
	}
	
/*
 * 2014-10-14 by terry
 * 体质逆转
 */
	
	function check_physicque($phy){
		switch($phy){
			case "寒性":
				return 1;break;
			case "平和":
				return 2;break;
			case "热性":
				return 3;break;
			default:
				return 4;break;
		}
	}
	
/*
 * 2014-10-14 by terry
 * 编辑体质爱好模型
 */
	
	function edit_physic_hobby($arr){
		 if(!empty($arr['userid'])){
			$physic = M('gguser_physicque');
			$hobby = M('gguser_hobby');
			
			//先判断数据是否存在
			if($physic->where("userid = {$arr['userid']}")->select()){
				//先修改体质表
				$data1 = array(
						'physicque'=>$arr['physic']
				);
				$physic->where("userid = {$arr['userid']}")->save($data1);
					
			}else{
				//先修改体质表
				$data1 = array(
						'userid'=>$arr['userid'],
						'physicque'=>$arr['physic'],
						'last_test'=>time()
				);
				$physic->add($data1);
			}
			if($hobby->where("userid = {$arr['userid']}")->select()){
				//修改喜好表
				$data2 = array(
						'like'=>$arr['like'],
						'dislike'=>$arr['dislike']
				);
				$hobby->where("userid = {$arr['userid']}")->save($data2);
				return 1;
			}else{
				//修改喜好表
				$data2 = array(
						'userid'=>$arr['userid'],
						'like'=>$arr['like'],
						'dislike'=>$arr['dislike']
				);
				$hobby->add($data2);
				return 1;
			}
		}else{
			return 0;
		} 
		
	}
	
	
/*
 * 2014-10-14 by terry
 * 关联用户购买记录
 */
	
	function gguser_order_relation($userid){
		$gguser = M('gguser');
		$order = M('gguser_order');
		 
		//关联数据
		$user = $gguser->where("id={$userid}")->select();
		$order = $order->where("userid={$userid}")->select();
		
		//数据处理
		foreach($order as $key => $val){
			$order[$key]['start_date'] = date("Y-m-d H:i:s",$val['start_date']);
		}
		$data['name'] = $user[0]['name'];
		$data['list_data'] = $order;
		
		return $data;
	}
	
	
/*
 * 2014-10-14 by terry
 * 更改用户状态
 */	
	function gguser_status_change($arr){
		$gguser = M('gguser');
		if(!empty($arr['userid'])){
			//修改数据
			$data = array(
				'status' => '0'
			);
			$gguser->where("id = {$arr['userid']}")->save($data);
			return 1;
		}else{
			return 0;
		}
	}
	

	
}
