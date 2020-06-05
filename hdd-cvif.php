<?php
/*
 Plugin Name: Convert Iframe
Description:   Chuyển đổi iframe
Version: 1.0
Author: huynh duc dev
Author URI: https://facebook/hd7447
License: GPLv2 or later
*/

if( !defined('ABSPATH') ){ exit();}
if ( !function_exists( 'add_action' ) ) {
	echo "Hi!  Mot plugin chi nen lam dung nhiem vu cua no ma thoi";
	exit;
}
require_once( dirname( __FILE__ ) . '/admin/active.php' );
require_once( dirname( __FILE__ ) . '/admin/deactive.php' );
require_once( dirname( __FILE__ ) . '/admin/function.php' );
require_once( dirname( __FILE__ ) . '/admin/menu.php' );
// require_once( dirname( __FILE__ ) . '/admin/uninstall.php' );
// require_once( dirname( __FILE__ ) . '/admin/publish.php' );
// require_once( dirname( __FILE__ ) . '/admin/metabox.php' );

add_action('wp_ajax_delif', 'delete_iframe_by_catid');
add_action('wp_ajax_nopriv_delif', 'delete_iframe_by_catid');
function delete_iframe_by_catid() {
	global $wpdb;
	$id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
	echo ($id);
    $table = $wpdb->prefix . 'iframe';
    $delete = $wpdb->delete(
        $table,
        array( 'ID' => $id ),
        array( '%d' )
    );
}
?>

