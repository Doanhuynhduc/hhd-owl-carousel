<?php 
/**
 * Adds a box to the main column on the Post and Page edit screens.
 */
function hhd_ocw_carousel_add_meta_box() {

    add_meta_box(
        'hhd_ocw_carousel_sectionid',
        __( "Add Meta Data Carousels", 'text_domain' ),
        'hhd_ocw_carousel_meta_box_callback',
        'hhd_owlcrs' // name of the post type

    );

}
add_action( 'add_meta_boxes', 'hhd_ocw_carousel_add_meta_box' );


function hhd_ocw_carousel_meta_box_callback( $post ){
    $hhd_name = get_post_meta( $post->ID, '_hhd_name', true );
    $hhd_content = get_post_meta( $post->ID, '_hhd_content', true );
    $hhd_linkimg = get_post_meta( $post->ID, '_hhd_linkimg', true );
    $hhd_imgtab = get_post_meta( $post->ID, '_hhd_imgtab', true );
    wp_nonce_field( 'hhd_name', 'thongtin_name_nonce' );
    wp_nonce_field( 'hhd_content', 'thongtin_content_nonce' );
    wp_nonce_field( 'hhd_linkimg', 'thongtin_linking_nonce' );
    wp_nonce_field( 'hhd_imgtab', 'thongtin_imgtab_nonce' );
    // Tạo trường Link Download
    echo ( '<label for="hhd_name" style="width: 100px; display: inline-block">Name: </label>' );
    echo ('<input type="text" id="hhd_name" name="hhd_name" value="'.esc_attr( $hhd_name ).'" /></br></br>');
    echo ( '<label for="hhd_content" style="width: 100px; display: inline-block">Content: </label>' );
    echo ( '<textarea id="hhd_content" name="hhd_content" rows="4" cols="50">'.esc_attr( $hhd_content ).'</textarea></br></br>');
    echo ( '<label for="hhd_linkimg" style="width: 100px; display: inline-block">Link images: </label>' );
    echo ('<input type="text" id="hhd_linkimg" name="hhd_linkimg" size="50" value="'.esc_attr( $hhd_linkimg ).'" /></br></br>');
    echo ( '<label for="hhd_imgtab" style="width: 100px; display: inline-block">Image tab: </label>' );
    $meta_key = 'second_featured_img';
	echo misha_image_uploader_field( $meta_key, get_post_meta($post->ID, $meta_key, true) );
}



/**
 Lưu dữ liệu meta box khi nhập vào
 @param post_id là ID của post hiện tại
**/
function hhd_ocw_carousel_meta_box__save( $post_id )
{
    $thongtin_name_nonce = $_POST['thongtin_name_nonce'];
    $thongtin_content_nonce = $_POST['thongtin_content_nonce'];
    $thongtin_linking_nonce = $_POST['thongtin_linking_nonce'];
    $thongtin_imgtab_nonce = $_POST['thongtin_imgtab_nonce'];
 // Kiểm tra nếu nonce chưa được gán giá trị
 if( !isset( $thongtin_name_nonce ) && !isset( $thongtin_content_nonce ) && !isset( $thongtin_linking_nonce ) ) {
  return;
 }
 // Kiểm tra nếu giá trị nonce không trùng khớp
 if( !wp_verify_nonce( $thongtin_name_nonce, 'hhd_name' ) && !wp_verify_nonce( $thongtin_content_nonce, 'hhd_content' ) && !wp_verify_nonce( $thongtin_linking_nonce, 'hhd_linkimg' )) {
  return;
 }

 

 $hhd_name = sanitize_text_field( $_POST['hhd_name'] );
 update_post_meta( $post_id, '_hhd_name', $hhd_name );

 $hhd_content = sanitize_text_field( $_POST['hhd_content'] );
 update_post_meta( $post_id, '_hhd_content', $hhd_content );

 $hhd_linkimg = sanitize_text_field( $_POST['hhd_linkimg'] );
 update_post_meta( $post_id, '_hhd_linkimg', $hhd_linkimg );
 if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) 
 return $post_id;

$meta_key = 'second_featured_img';

update_post_meta( $post_id, $meta_key, sanitize_text_field( $_POST[$meta_key] ) );

// if you would like to attach the uploaded image to this post, uncomment the line:
wp_update_post( array( 'ID' => $_POST[$meta_key], 'post_parent' => $post_id ) );

return $post_id;

}
add_action( 'save_post', 'hhd_ocw_carousel_meta_box__save' );


