<?php 
function hhd_cvif_uninstall_table(){
    global $wpdb;
    $crsTable = $wpdb->prefix . 'carousel';
    $sql = "DROP TABLE IF EXISTS $crsTable";
    $wpdb->query($sql);
}
add_action( 'deactivated_plugin', 'hhd_cvif_uninstall_table', 10, 2 );