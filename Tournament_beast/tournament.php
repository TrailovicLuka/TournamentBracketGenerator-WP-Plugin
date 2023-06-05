<?php
/**
 * Plugin Name:       Tournament Beast Plugin
 * Description:       This plugin for generating tournament draws in various sports.
 * Version:           1.0v
 * Requires PHP:      7.2
 * Author:            Luka Trailovic
 * Text Domain:       tournament-plugin

 */

 if(!defined('WPINC')){
    die;
}

 use Tournament\Model\Config\Config;

include (dirname(__FILE__) . '/app/config/configuration.php');

include (dirname(__FILE__) . '/app/model/db.php');

include (dirname(__FILE__) . '/app/controller/controllerInit.php');

include (dirname(__FILE__).'/inc/enqueue.php');

include (dirname(__FILE__).'/app/shortcode/shortCodes.php');

include (dirname(__FILE__)).'/app/view/Admin/config.php';


register_uninstall_hook(__FILE__, 'uninstall');

function uninstall() {

    global $wpdb;
    $wpdb->query( "DROP TABLE IF EXISTS {$wpdb->prefix}tournament_beast" );

}
?>
