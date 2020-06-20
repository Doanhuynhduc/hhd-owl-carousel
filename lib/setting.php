<?php
if(isset($_POST['btnSubmitReason'])){
    // Required field names
    $required = array('_set_featured_img', 'cat');
    $error = false;
    foreach($required as $field) {
        if (empty($_POST[$field])) {
            $error = true;
        }
    }

    if ($error) {
        hdd_cvif_error();
    } else {
        $refimg = $_POST['_set_featured_img'];
        $cat = $_POST['cat'];
        $id = get_current_user_id();
        hdd_crs_add_item($id, $refimg, $cat);
        hdd_cvif_success();
    }
}

function hdd_crs_add_item($id, $idim, $c){
    $data = array(
        'UserId' => $id,
        'image_carousel' => $idim,
	    'cat' => $c,
	);
	global $wpdb;
	$table = $wpdb->prefix . 'carousel';
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

<h1>Carousel managerment</h1>
<div id="col-container" class="wp-clearfix wrap">
    <div class="col">
        <h3>Carousels setting</h3>
        <form action="" method="post">
            <label style="display: block;padding: 5px 0;">Background Image</label>
            <?php 
            $meta_key = '_set_featured_img';
	        echo misha_image_uploader_field1( $meta_key, get_post_meta($post->ID, $meta_key, true) );
            ?>
            <label style="display: block;padding: 5px 0;">Category</label>
            <input type="text" id="width" name="cat" value="">
            <p>
                <input type="submit" name="btnSubmitReason" id="submit" class="button button-primary" value="Submit">
            </p>
        </form>
    </div>
</div>


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
                        <th scope="col" width="15%">Background Id </th>
                        <th scope="col" width="10%">Category</th>
                        <th scope="col" width="15%">Shortcode</th>
                        <th scope="col" width="10%">Control</th>
                    </tr>
                </thead>
                <?php
                    //check role admin
                    if(is_user_logged_in()){
                        $user = wp_get_current_user();
                        $userID = $user->ID;
                        $adminUser = $user->caps['administrator'];
                        if($adminUser == 1 ){
                            global $wpdb;
                            $table = $wpdb->prefix . 'carousel';
                            $data = $wpdb->get_results("SELECT * FROM {$table}");
                            foreach ($data as $log){ ?>
                <tr>
                    <td>&nbsp;</td>
                    <td style="vertical-align: middle !important;padding: 5px;">
                        <?php echo $log->ID; ?>
                    </td>
                    <td style="vertical-align: middle !important;padding: 5px;">
                        <?php echo $log->image_carousel; ?>
                    </td>
                    <td style="vertical-align: middle !important;padding: 5px;">
                        <?php echo $log->cat; ?>
                    </td>
                    <td style="vertical-align: middle !important;padding: 5px;">
                        <?php 
                                        echo '[Hdd_carousels bgid="'.$log->image_carousel.'" cat="'.$log->cat.'"]';
                                    ?>
                    </td>
                    <td style="vertical-align: middle !important;padding: 5px;">
                        <a class="buttonDel" data-id="<?php echo ($log->ID)?>"> Xóa</a>
                    </td>
                </tr>
                <?php }
                    }
                    };
                ?>
            </table>
        </fieldset>
    </form>
</div>

<script type="text/javascript">
    (function($){
        jQuery(document).ready(function(){
            jQuery('.buttonDel').click(function(){
                var id = jQuery(this).attr('data-id');
                jQuery.ajax({
                    type : "post", 
                    dataType : "html", 
                    url : '<?php echo admin_url('admin-ajax.php');?>', //Đường dẫn chứa hàm xử lý dữ liệu. Mặc định của WP như vậy
                    data : {
                        action: "delif", 
                        id : id,
                    },
                    context: this,
                    beforeSend: function(){
                        //Làm gì đó trước khi gửi dữ liệu vào xử lý
                    },
                    success: function(response) {
                            alert('Đã xóa thành công!!!');
                            location.reload(); 
                    },
                    error: function( jqXHR, textStatus, errorThrown ){
                        //Làm gì đó khi có lỗi xảy ra
                        console.log( 'The following error occured: ' + textStatus, errorThrown );
                    }
                })
                return false;
            })
        })
    })(jQuery)
</script>

