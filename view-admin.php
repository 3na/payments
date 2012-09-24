<?php
/* 
    Plugin Name: PayPal Handler 
    Plugin URI: http://wacowla.com
    Description: Magazine Invoicer for WaCowLA
    Author: Ephramar Telog, CK
    Version: Trunk
    Author URI: http://clubkoncepto.com
*/

function pph_admin() {
	add_plugins_page( "PayPal Handler Option", "PayPal Handler", "manage_options", "pph_plugin", "pph_plugin_options" );
}
add_action( "admin_menu", "pph_admin" );

function pph_plugin_options() {

    if( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'Gather more stuff.' ) );
    }
    else {
		include('view.php');
		include('functions.php');
    }
}

?>