<?php 
add_action( 'activated_plugin', 'hhd_cvif_register_table', 10, 2 );
function hhd_cvif_register_table(){
    global $wpdb;
    $charsetCollate = $wpdb->get_charset_collate();
    $iframeTable = $wpdb->prefix . 'iframe';
    $createIframeTable = "CREATE TABLE IF NOT EXISTS `{$iframeTable}` (
        `ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
        `content` varchar(255) NOT NULL,
        `width` varchar(20) NOT NULL,
        `height` varchar(20) NOT NULL,
        PRIMARY KEY (`ID`)
    ) {$charsetCollate};";
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $createIframeTable );
}



