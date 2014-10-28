<?php

namespace Addons\GgOther;
use Common\Controller\Addon;

/**
 * 其它功能插件
 * @author 无名
 */

    class GgOtherAddon extends Addon{

        public $info = array(
            'name'=>'GgOther',
            'title'=>'其它功能',
            'description'=>'果果扩展功能',
            'status'=>1,
            'author'=>'无名',
            'version'=>'0.1',
            'has_adminlist'=>0,
            'type'=>1         
        );

	public function install() {
		$install_sql = './Addons/GgOther/install.sql';
		if (file_exists ( $install_sql )) {
			execute_sql_file ( $install_sql );
		}
		return true;
	}
	public function uninstall() {
		$uninstall_sql = './Addons/GgOther/uninstall.sql';
		if (file_exists ( $uninstall_sql )) {
			execute_sql_file ( $uninstall_sql );
		}
		return true;
	}

        //实现的weixin钩子方法
        public function weixin($param){

        }

    }