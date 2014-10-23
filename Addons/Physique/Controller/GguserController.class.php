<?php

namespace Addons\Physique\Controller;
use Home\Controller\AddonsController;

class GguserController extends AddonsController{
    
    function _initialize(){
        parent::_initialize();
        $res ['title'] = '问题列表';
        $res ['url'] = addons_url ( 'Physique://physique/lists');
        $res ['class'] = 'current';
        $nav [] = $res;
    
        /* $res ['title'] = '数据管理';
        $res ['url'] = addons_url ( 'Physique://gguser/lists');
        $res ['class'] = '';
        $nav [] = $res;
        //把标题栏加载到页面
        $this->assign ( 'nav', $nav ); */
    }
    
    
    function lists(){
        // 获取模型信息
        $model = $this->getModel ('gguserold');
        $list_data = $this->_get_model_list ( $model );
        foreach($list_data['list_data'] as $key=>$val){
        	if($val['score']==0){
        		$list_data['list_data'][$key]['score'] = '寒性'.'('.$val['score'].')';
        	}else if($val['score']==1){
        	    $list_data['list_data'][$key]['score'] = '平和'.'('.$val['score'].')';
        	}else{
        	    $list_data['list_data'][$key]['score'] = '热性'.'('.$val['score'].')';
        	}
        }
        //print_r($list_data['list_data']);
        $this->assign ( $list_data );
        $this->display ( $model ['template_list'] );
    }
    
    /*
     * 2014-09-22 by terry @kmark 数据列表的删除操作 easy
    */
    function del(){
        $this->model = $this->getModel('gguserold');
        parent::common_del($this->model);
    }

}
