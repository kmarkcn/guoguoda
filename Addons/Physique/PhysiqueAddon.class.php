<?php

namespace Addons\Physique;
use Common\Controller\Addon;

/**
 * 体质测试插件
 * @author terry@kmark
 */

    class PhysiqueAddon extends Addon{

        public $info = array(
            'name'=>'Physique',
            'title'=>'体质测试',
            'description'=>'果果达体质测试',
            'status'=>1,
            'author'=>'terry@kmark',
            'version'=>'0.1',
            'has_adminlist'=>1,
            'type'=>1         
        );

	public function install() {
		$install_sql = './Addons/Physique/install.sql';
		if (file_exists ( $install_sql )) {
			execute_sql_file ( $install_sql );
		}
		return true;
	}
	public function uninstall() {
		$uninstall_sql = './Addons/Physique/uninstall.sql';
		if (file_exists ( $uninstall_sql )) {
			execute_sql_file ( $uninstall_sql );
		}
		return true;
	}

    //实现的weixin钩子方法
    public function weixin($param){

    }

    }