<?php 
add_action( 'admin_menu', 'sub_menu' );
     function sub_menu()
     {
       add_submenu_page( 'edit.php?post_type=hhd_owlcrs','Carousel Settings','Carousel Settings', 'manage_options','carousel-settings', 'fucasadasd');
     }
  function fucasadasd(){
    require( dirname( __FILE__ ) . '/setting.php' );
  }