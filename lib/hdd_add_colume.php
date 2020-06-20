<?php

add_filter('manage_edit-hhd_owlcrs_columns', 'add_new_hhd_owlcrs_columns');
function add_new_hhd_owlcrs_columns($gallery_columns) {
    $new_columns['cb'] = '<input type="checkbox" />';
     
    $new_columns['title'] = _x('Gallery Name', 'column name');
    $new_columns['images'] = __('Images');
    $new_columns['tab'] = __('Tab Images');
    $new_columns['carousel_cat'] = __('Categories');
    $new_columns['link'] = __('Links');
    $new_columns['author'] = __('Author');
    $new_columns['date'] = _x('Date', 'column name');
 
    return $new_columns;
}

add_action('manage_hhd_owlcrs_posts_custom_column', 'manage_hhd_owlcrs_columns', 10, 2);
function get_hhd_owlcrs($post_ID)
{
    $tccarouse_id = get_post_thumbnail_id($post_ID);
    return $tccarouse_url = wp_get_attachment_image_src($tccarouse_id, array(40,40), true);
}
function manage_hhd_owlcrs_columns( $column,$post_ID) {
  $tccarouse= get_hhd_owlcrs($post_ID);
    switch ( $column ) {
    case 'images' :
      global $post;
      $slug = '' ;
      $slug = $post->ID;
      $featured_image ='<img src="' . $tccarouse[0] . '" width="90px"/>';
      echo $featured_image;
      break;
      case 'tab' :
        $tabId = get_post_meta( get_the_ID(), 'second_featured_img', true );
        $tab_url = wp_get_attachment_image_src($tabId, array(40,40), true);
        $tab_image ='<img src="' . $tab_url[0] . '" width="90px"/>';
        echo $tab_image;
      break;
    case 'carousel_cat' :
    $carousel_cats = wp_get_post_terms($post_ID, 'hhd_carousel_category', array("fields" => "names"));
      foreach ( $carousel_cats as $carousel_cat ) {
            echo $carousel_cat.'<br>';

    }
      break;
      case 'link' :
      $tcImages_url = get_post_meta( get_the_ID(), '_hhd_linkimg', true );
    echo $tcImages_url;
      // echo 'www';
      }
}


 ?>