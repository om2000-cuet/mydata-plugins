<?php
/*
Plugin Name: Mydata
Description: Mydata Information Creator
Version: 1.0
Author: Om Prakash Chowdhury
Text Domain: mydata
*/

if ( !defined( 'ABSPATH' ) ) {
    exit;
}

function mydata() {
    global $wpdb;
    $table_name = $wpdb->prefix .'mydata';
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
id mediumint(9) NOT NULL AUTO_INCREMENT,
name varchar(100) not null,
email varchar(100) not null,
age int(3) not null,
created_at datetime default current_timestamp,
primary key (id)
)$charset_collate;";
    require_once( ABSPATH.'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
}
register_activation_hook( __FILE__, 'mydata' );



function mydata_remove_table() {
    global $wpdb;
    $table_name = $wpdb->prefix.'mydata';
    $sql = "drop table if exists $table_name;";
    $wpdb->query( $sql );
}
register_deactivation_hook( __FILE__, 'mydata_remove_table' );
add_action('wp_ajax_mydata','mydata_handle');
add_action('wp_ajax_nopriv_mydata','mydata_handle');
function mydata_handle(){
    echo $_POST['name']." ". $_POST['age']." ". $_POST['email'];
 
}

function show_mydata(){
?>

<input name="name" type="text"/>
<input name="email" type="email"/>
<input name="age" type="text"/>
<input type="button" value="Submit"/>
<div id="showresult"></div>
<?php 
   return "Hi Om"; 
}

add_shortcode('mydata','show_mydata');

function mydata_scripts(){

wp_enqueue_script('jquery');
wp_enqueue_script('mydata-custom',
plugins_url('js/custom.js',__FILE__),
array('jquery'),
'1.0.0',
true
);

wp_localize_script(
'mydata-custom',
'mydataAjax',
array(
    'ajaxurl'=>admin_url('admin-ajax.php'),
    'nonce' => wp_create_nonce('mydata_nonce')
));



}

 add_action('wp_enqueue_scripts','mydata_scripts');