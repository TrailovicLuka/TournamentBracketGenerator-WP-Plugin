<?php

namespace Tournament\Model\Config;


if(!defined('WPINC')){
    die;
}

class Config {
	public function __construct() {
		//Plugin root
		define ("PLUGIN_ROOT", plugin_dir_path(dirname(dirname(__FILE__))));

		//Current directory
		define ("PLUGIN_CUR_DIR", plugin_dir_path( __FILE__ ));

	}

}

new Config();













?>