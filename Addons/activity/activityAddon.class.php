<?php

namespace Addons\activity;
use Common\Controller\Addon;

/**
 * 果果活动插件
 * @author terry
 */

    class activityAddon extends Addon{

        public $info = array(
            'name'=>'activity',
            'title'=>'果果活动',
            'description'=>'果果活动表',
            'status'=>1,
            'author'=>'terry',
            'version'=>'1.0',
            'has_adminlist'=>1,
            'type'=>1         
        );

	public function install() {
		$install_sql = './Addons/activity/install.sql';
		if (file_exists ( $install_sql )) {
			execute_sql_file ( $install_sql );
		}
		return true;
	}
	public function uninstall() {
		$uninstall_sql = './Addons/activity/uninstall.sql';
		if (file_exists ( $uninstall_sql )) {
			execute_sql_file ( $uninstall_sql );
		}
		return true;
	}

        //实现的weixin钩子方法
        public function weixin($param){

        }

    }