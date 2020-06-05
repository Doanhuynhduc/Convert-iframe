<?php 
if( !defined('ABSPATH') ){ exit();}
if(isset($_POST['btnUpdate'])){
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
        $id = $_POST['id'];
        $str = $_POST['content'];
        $replace = '';
        $find = '<iframe';
        $res1 = str_replace($find, $replace, $str);
        $res2 = explode ( '"' , $res1);
        $content = stripslashes($res2[5]);
        $width = $_POST['width'] ;
        $height = $_POST['height'];
        hhd_cvif_update_iframe($id, $content, $width, $height);
        hdd_cvif_success();
    }
}


function hhd_cvif_update_iframe($id, $ct, $w, $h){
    $data = array(
	    'content' => $ct,
	    'width' => $w,
	    'height' => $h,
	);
	global $wpdb;
	$id = $id;
	$table = $wpdb->prefix . 'iframe';
	$update = $wpdb->update(
        $table,
        $data,
        array('ID' => $id)
    );
}


?>

<div>
    <form method="post" name="xyz_fbap_logs_form">
        <fieldset style="width: 99%; border: 1px solid #F7F7F7; padding: 10px 0px;">
            <div style="text-align: left;padding-left: 7px;">
                <h3>Iframe Logs</h3>
            </div>
            <table class="widefat" style="width: 99%; margin: 0 auto; border-bottom:none;">
                <thead>
                    <tr class="xyz_fbap_log_tr">
                        <th scope="col" width="1%">&nbsp;</th>
                        <th scope="col" width="5%">Id</th>
                        <th scope="col" width="15%">Content </th>
                        <th scope="col" width="10%">Width</th>
                        <th scope="col" width="10%">Height</th>
                        <th scope="col" width="15%">Shortcode</th>
                        <th scope="col" width="10%">Control</th>
                    </tr>
                </thead>
                <?php
                     global $wpdb;
                     $table = $wpdb->prefix . 'iframe';
                     $data = $wpdb->get_results("SELECT * FROM {$table} ");
                    foreach ($data as $log){ ?>
                <tr>
                    <td>&nbsp;</td>
                    <td style="vertical-align: middle !important;padding: 5px;">
                        <?php echo $log->ID ?>
                    </td>
                    <td style="vertical-align: middle !important;padding: 5px;">
                        <?php echo $log->content ?>
                    </td>

                    <td style="vertical-align: middle !important;padding: 5px;">
                        <?php echo $log->width ?>
                    </td>

                    <td style="vertical-align: middle !important;padding: 5px;">
                        <?php echo $log->height;?>
                    </td>
                    <td ' style="vertical-align: middle !important;padding: 5px;">
                    <?php 
                    echo '[Hdd_cvif id="'.$log->ID.'" width="'.$log->width.'" height="'.$log->height.'"]';
                    ?>
                    </td>
                    <td  style="vertical-align: middle !important;padding: 5px;">
                    <a class="buttonUpdate" > Sửa</a> || 
                    <a class="buttonDel" data-id="<?php echo ($log->ID)?>" > Xóa</a>
                    
                    
                    <!-- The Modal -->
                    <div class="myModal modal">
                        <div class="modal-content">
                        <span class="close">&times;</span>
                            <form action="" method="post">
                                 <input name="id" type="text" value=" <?php echo $log->ID ?>" style="display: none;">
                                <label style="display: block;padding: 5px 0;">Content</label>
                                <input name="content" type="text" value="<?php echo $log->content ?>" size="90" aria-required="true">
                                <label style="display: block;padding: 5px 0;">Width</label>
                                <input type="number" id="width" name="width" value="<?php echo $log->width ?>">
                                <label style="display: block;padding: 5px 0;">Height</label>
                                <input type="number" id="height" name="height" value="<?php echo $log->height;?>">
                                <p>
                                    <input type="submit" name="btnUpdate" id="submit" class="button button-primary" value="Submit">
                                </p>
                            </form>
                        </div>
                    </div>
                    </td>
                </tr>
                <?php
                        }
                    ?>
            </table>
        </fieldset>
    </form>
</div>
<script type="text/javascript">
jQuery(document).ready(function(){
     jQuery('.buttonDel').click(function(){
        var id = jQuery(this).attr('data-id');
        jQuery.ajax({ 
        type : "post", 
        dataType : "html", 
        url : '<?php echo admin_url('admin-ajax.php');?>', 
        data : {
            action: "delif", 
            id: id, 
        },
        beforeSend: function(){
            
        },
        success: function(response) {
            alert('Đã xóa thành công!!!');
            location.reload(); 
        },
        error: function( jqXHR, textStatus, errorThrown ){
            console.log( 'The following error occured: ' + textStatus, errorThrown );
        }
        });
    })


    // Get the button that opens the modal
    jQuery('.buttonUpdate').click(function(){
        jQuery('.modal').css("display", "block");
    })

    jQuery('.close').click(function(){
        jQuery('.modal').css("display", "none");
    })




});

    
</script>

<style>
body {font-family: Arial, Helvetica, sans-serif;}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 75px;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
} 

/* Modal Content */
.modal-content {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
}

/* The Close Button */
.close {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}
</style>
<?php


