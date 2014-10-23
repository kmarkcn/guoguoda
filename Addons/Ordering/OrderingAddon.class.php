<?php

namespace Addons\Ordering;
use Common\Controller\Addon;

/**
 * 果果订单插件
 * @author terry
 */

    class OrderingAddon extends Addon{

        public $info = array(
            'name'=>'Ordering',
            'title'=>'果果订单',
            'description'=>'这是果果的订单',
            'status'=>1,
            'author'=>'terry',
            'version'=>'0.1',
            'has_adminlist'=>1,
            'type'=>1         
        );

	public function install() {
		$install_sql = './Addons/Ordering/install.sql';
		if (file_exists ( $install_sql )) {
			execute_sql_file ( $install_sql );
		}
		return true;
	}
	public function uninstall() {
		$uninstall_sql = './Addons/Ordering/uninstall.sql';
		if (file_exists ( $uninstall_sql )) {
			execute_sql_file ( $uninstall_sql );
		}
		return true;
	}

        //实现的weixin钩子方法
        public function weixin($param){

        }

    }