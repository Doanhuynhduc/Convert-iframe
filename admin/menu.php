<?php 
if( !defined('ABSPATH') ){ exit();}
function hdd_cvif_add_menu(){
    add_menu_page( 'Convert Iframe', 'Convert Iframe', 'manage_options', 'hhd-cvif', 'hdd_cvif', '' );
    add_submenu_page( 'hhd-cvif' ,'Convert Iframe - logs', 'Logs', 'manage_options', 'hhd-cvif-log-page','hdd_cvif_log');
}
add_action('admin_menu', 'hdd_cvif_add_menu');

function hdd_cvif(){
    require( dirname( __FILE__ ) . '/setting.php' );
}

function hdd_cvif_log(){
    require( dirname( __FILE__ ) . '/log.php' );
}