<?php
if(isset($_POST['btnSubmitReason'])){
    // Required field names
    $required = array('content', 'width', 'height');

    $error = false;
    foreach($required as $field) {
    if (empty($_POST[$field])) {
        $error = true;
    }
    }

    if ($error) {
        hdd_cvif_error();
    } else {
        $str = $_POST['content'];
        $replace = '';
        $find = '<iframe';
        $res1 = str_replace($find, $replace, $str);
        $res2 = explode ( '"' , $res1);
        $content = stripslashes($res2[5]);
        $width = $_POST['width'] ;
        $height = $_POST['height'];
        hhd_cvif_add_iframe($content, $width, $height);
        hdd_cvif_success();
    }
}


function hhd_cvif_add_iframe($ct, $w, $h){
    $data = array(
	    'content' => $ct,
	    'width' => $w,
	    'height' => $h,
	);
	global $wpdb;
	$table = $wpdb->prefix . 'iframe';
	$wpdb->insert(
	    $table,
	    $data
	);
	$contact = $wpdb->insert_id;
}

function hdd_cvif_success(){
    $message = "Đã thêm thành công!!!";
    echo "<script type='text/javascript'>alert('$message');</script>";
}


function hdd_cvif_error(){
    $message = "Điền đủ thông tin!!!";
    echo "<script type='text/javascript'>alert('$message');</script>";
}



?>
<h1>Convert Iframe</h1>
<div id="col-container" class="wp-clearfix wrap">
    <div class="col">
        <h3>Conver iframe setting</h3>
        <form action="" method="post">
            <label style="display: block;padding: 5px 0;">Content</label>
            <input name="content" type="text" value="" size="90" aria-required="true">
            <label style="display: block;padding: 5px 0;">Width</label>
            <input type="number" id="width" name="width" value="700">
            <label style="display: block;padding: 5px 0;">Height</label>
            <input type="number" id="height" name="height" value="600">
            <p>
                <input type="submit" name="btnSubmitReason" id="submit" class="button button-primary" value="Submit">
            </p>
        </form>
    </div>
</div>