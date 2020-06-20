<?php 

function hdd_view_shortcode_carousels($prop){
    $d=shortcode_atts(array(
        'bgid'=>'',
        'cat'=>''
    ),$prop);
    extract($d);
    ob_start();

    $bg_data = wp_get_attachment_image_src($bgid, 'full', true);
    $bg_url = $bg_data[0];

    $args = array(
		'post_status' => 'publish',
		'post_type' => 'hhd_owlcrs',
		'cat' => $cat,
    );
    ?>
<section class="carouselcnt loaded">
    <div class="container">
    <div class="hdd_bg">
        <picture>
            <source media="(min-width:600px)" srcset="<?php echo $bg_url ?>">
            <img src="<?php echo $bg_url ?>" alt=""> </picture>
    </div>
    <div class="owl-carousel owl-theme owl-thumb">
        <?php $getposts = new WP_query($args);
        global $wp_query; $wp_query->in_the_loop = true; global $post;
        while ($getposts->have_posts()) : $getposts->the_post();
        $tabId = get_post_meta( get_the_ID(), 'second_featured_img', true );
        $idimg = get_post_thumbnail_id($post->ID);
        $ibguser = wp_get_attachment_image_src($idimg,'full', true);
        ?>
            <div class="hhd_item" data-hash="t<?php echo $tabId; ?>">
                <div class="hhd_pic">
                    <picture>
                        <source media="(min-width:600px)" srcset="<?php echo $ibguser[0] ?>">
                        <img class="" data-src="<?php echo $ibguser[0] ?>" alt="" src="<?php echo $ibguser[0] ?>">
                    </picture>
                </div>
                <div class="hhd_info">
                    <div class="hdd_name">
                        <?php $hdd_name = get_post_meta( get_the_ID(), '_hhd_name', true ); echo $hdd_name ?> </div>
                    <div class="hdd_desc">
                        <?php $hhd_content = get_post_meta( get_the_ID(), '_hhd_content', true ); echo $hhd_content ?>
                    </div>
                    <div class="hdd_more"> <a
                            href="<?php $hdd_link = get_post_meta( get_the_ID(), '_hhd_linkimg', true ); echo $hdd_link ?>"
                            class="btn">Xem chi tiết</a></div>
                </div>
            </div>
        <?php endwhile; wp_reset_postdata(); ?>
    </div>
    <div class="tabimage">
        <?php
        $getposts = new WP_query($args);
        global $wp_query; $wp_query->in_the_loop = true; 
        while ($getposts->have_posts()) : $getposts->the_post();
            $tabId = get_post_meta( get_the_ID(), 'second_featured_img', true );
            $tab_url = wp_get_attachment_image_src($tabId, array(40,40), true);
            $tab_image = $tab_url[0]; ?>
        <a class="tab" href="#t<?php echo $tabId; ?>">
            <img class="lazy-loaded" data-src="<?php echo $tab_image ?>" alt="" src="<?php echo $tab_image ?>">
        </a>
        <?php endwhile; wp_reset_postdata(); ?>
    </div>
</div>
</section>
<?php
    $ct = ob_get_contents();
    ob_end_clean();
    return $ct;
}
add_shortcode( 'Hdd_carousels', 'hdd_view_shortcode_carousels' );