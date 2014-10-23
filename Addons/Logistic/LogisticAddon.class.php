<?php

namespace Addons\Logistic;
use Common\Controller\Addon;

/**
 * 果果物流插件
 * @author terry
 */

    class LogisticAddon extends Addon{

        public $info = array(
            'name'=>'Logistic',
            'title'=>'果果物流',
            'description'=>'这里是果果的物流数据',
            'status'=>1,
            'author'=>'terry',
            'version'=>'0.1',
            'has_adminlist'=>1,
            'type'=>1         
        );

	public function install() {
		$install_sql = './Addons/Logistic/install.sql';
		if (file_exists ( $install_sql )) {
			execute_sql_file ( $install_sql );
		}
		return true;
	}
	public function uninstall() {
		$uninstall_sql = './Addons/Logistic/uninstall.sql';
		if (file_exists ( $uninstall_sql )) {
			execute_sql_file ( $uninstall_sql );
		}
		return true;
	}

        //实现的weixin钩子方法
        public function weixin($param){

        }

    }