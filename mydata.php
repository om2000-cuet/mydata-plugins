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


function show_mydata(){
?>

<script>
jQuery(document).ready(function(){

jQuery('input[type="button"]').bind('click',function(){
var mydata_name = jQuery('input[name="name"]').val();
var mydata_email = jQuery('input[name="email"]').val();
var mydata_age = jQuery('input[name="age"]').val();
alert("hi om 1");
console.log(mydata_name,mydata_email,mydata_age);

});

});


</script>    

<input name="name" type="text"/>
<input name="email" type="email"/>
<input name="age" type="text"/>
<input type="button" value="Submit"/>

<?php 
   return "Hi Om"; 
}

add_shortcode('mydata','show_mydata');
