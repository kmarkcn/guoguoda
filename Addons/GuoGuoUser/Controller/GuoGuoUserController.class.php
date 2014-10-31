<?php

namespace Addons\GuoGuoUser\Controller;
use Home\Controller\AddonsController;
use Addons\GuoGuoUser\Model\GuoGuoUserModel;


class GuoGuoUserController extends AddonsController{
/*
 * 2014-10-11 by terry
 * 菜单栏目配置
 */
	function _initialize(){
		parent::_initialize();
		$nav[] = array('title'=>'用户中心',
					 'url'=>addons_url ( 'GuoGuoUser://GuoGuoUser/lists'),
					 'class'=>'current'	
					);
		$this->assign ( 'nav', $nav ); 
	}
	
/*
 * 2014-10-11 by terry
 * 加载用户列表页面
 */
	function lists(){
        // 获取模型信息
        $model = $this->getModel ('gguser');
        $list_data = $this->_get_model_list ( $model );
        $data = GuoGuoUserModel::gguser_handle($list_data);
        $this->assign ( GuoGuoUserModel::gguser_handle($list_data) );
        $this->assign("nodel","1");
        $this->display ( $model ['template_list'] );   
    } 

    
/*
 * 2014-10-11 by terry
 * 实现用户表基本操作
 */
    
   /*  function del(){
    	$model = $this->getModel('gguser');
    	parent::common_del($model);
    } */
     function add(){
    	$this->assign ( 'normal_tips', GuoGuoUserModel::gguser_instruction());
    	$model = $this->getModel('gguser');
    	parent::common_add($model);
    } 
    function edit(){
    	$this->assign ( 'normal_tips', GuoGuoUserModel::gguser_instruction());
    	$model = $this->getModel('gguser');
    	parent::edit($model);
    }
    

/*
 * 2014-10-13 by terry
 * 用户体质爱好查看方法
 */
    function physic_hobby(){
        $this->assign('userid',$_GET['userid']);
    	$this->assign ( 'data',GuoGuoUserModel::gguser_physic_hobby_relation($_GET['userid']));
        $this->display ( "physic_hobby"); 
 	}
    
    
/*
 * 2014-10-13 by terry
 * 加载编辑用户体质爱好信息 编辑数据
 */
    function edit_hobby(){
    	if($_GET['type']=='show'){
    		$this->assign('userid',$_GET['userid']);
    		$data = GuoGuoUserModel::gguser_physic_hobby_relation($_GET['userid']);
    		$data['physic'] = GuoGuoUserModel::check_physicque($data['physic']);
    		$this->assign ('data',$data);
    		$this->display ( "edit_hobby");
    	}else if($_GET['type']=='edit'){
    		//业务处理
    		 if(GuoGuoUserModel::edit_physic_hobby($_POST)){
    			$this->assign('userid',$_POST['userid']);
    			$this->assign ( 'data',GuoGuoUserModel::gguser_physic_hobby_relation($_POST['userid']));
    			$this->display ( "physic_hobby");
    		} 
    		
    	}
    	
    }

    
/*
 * 2014-10-14 by terry
 * 用户购买记录查看方法
 */
	function order(){
		$data = GuoGuoUserModel::gguser_order_relation($_GET['userid']);
		$this->assign('data',$data);
		$this->display("ordering");
	}

/*
 * 2014-10-14 by terry
 * 更改状态用户
 */	
	function change_status(){
		if(GuoGuoUserModel::gguser_status_change($_GET)){
			$model = $this->getModel ('gguser');
        	$list_data = $this->_get_model_list ( $model );
        	$this->assign ( GuoGuoUserModel::gguser_handle($list_data) );
        	$this->assign("nodel","1");
        	$this->display ( "lists" ); 
		}
	}
	
	
	
	

	
	

	
    
}
