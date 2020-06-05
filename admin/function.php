<?php


function hdd_cvif_add_shortcode_video($args, $content) {
    global  $wpdb;
    if (isset($args['id']) && isset($args['width']) && isset($args['height'])) {
        $id = $args['id'];
        $width = $args['width'];
        $height = $args['height'];
    };
    $table  = $wpdb->prefix . 'iframe'; // Bảng cần lấy
    $sql    = "SELECT * FROM {$table} WHERE `ID` = %d"; //câu sql query
    $data   = $wpdb->get_row( $wpdb->prepare($sql, $id), ARRAY_A); 
    $dt = $data['content']; 
    $resulft = '<iframe id="'.$id.'" width="'.$width.'" height="'.$height.'" src="https:'.$dt.'" frameborder="0" allowfullscreen"></iframe>';
    return $resulft;
      
}
add_shortcode( 'Hdd_cvif', 'hdd_cvif_add_shortcode_video' );

