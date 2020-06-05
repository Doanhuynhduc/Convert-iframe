<?php 
function hhd_cvif_uninstall_table(){
    global $wpdb;
    $iframeTable = $wpdb->prefix . 'iframe';
    $sql = "DROP TABLE IF EXISTS $iframeTable";
    $wpdb->query($sql);
}
add_action( 'deactivated_plugin', 'hhd_cvif_uninstall_table', 10, 2 );