<?php
add_action( 'activated_plugin', 'hhd_carousel_register_table', 10, 2 );
function hhd_carousel_register_table(){
    global $wpdb;
    $charsetCollate = $wpdb->get_charset_collate();
    $carouselTable = $wpdb->prefix . 'carousel';
    $createCarouselTable = "CREATE TABLE IF NOT EXISTS `{$carouselTable}` (
        `ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
        `UserId` varchar(20) NOT NULL,
        `image_carousel` varchar(20) NOT NULL,
        `cat` varchar(50) NOT NULL,
        PRIMARY KEY (`ID`)
    ) {$charsetCollate};";
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $createCarouselTable );
}
