<?php 

function initCreateTableUniko()
{
	global $wpdb;
 	
 	$table_name_main = $wpdb->prefix . "pedigree_uniko"; 
 	$table_name_fathers = $wpdb->prefix . "fathers_uniko"; 
 	$table_name_mothers = $wpdb->prefix . "mothers_uniko"; 
	$charset_collate = $wpdb->get_charset_collate();

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	

	$sql = "CREATE TABLE $table_name_fathers (
	  id mediumint(9) NOT NULL AUTO_INCREMENT,
	  padre varchar(100) NOT NULL,
	  registroPadre varchar(100) NOT NULL,
	  urlPadre varchar(100) NOT NULL,

	  abuelo varchar(100) NOT NULL,
	  registroAbuelo varchar(100) NOT NULL,
	  urlAbuelo varchar(100) NOT NULL,
	  Abuela varchar(100) NOT NULL,
	  registroAbuela varchar(100) NOT NULL,
	  urlAbuela varchar(100) NOT NULL,

	  padreAbuela varchar(100) NOT NULL,
	  registroPadreAbuela varchar(100) NOT NULL,
	  urlPadreAbuela varchar(100) NOT NULL,
	  madreAbuela varchar(100) NOT NULL,
	  registroMadreAbuela varchar(100) NOT NULL,
	  urlMadreAbuela varchar(100) NOT NULL,

	  madreAbuelo varchar(100) NOT NULL,
	  registroMadreAbuelo varchar(100) NOT NULL,
	  urlMadreAbuelo varchar(100) NOT NULL,
	  padreAbuelo varchar(100) NOT NULL,
	  registroPadreAbuelo varchar(100) NOT NULL,
	  urlPadreAbuelo varchar(100) NOT NULL,
	  PRIMARY KEY  (id)
	) $charset_collate;";


	dbDelta( $sql );


	$sql = "CREATE TABLE $table_name_mothers (
	  id mediumint(9) NOT NULL AUTO_INCREMENT,
	  madre varchar(100) NOT NULL,
	  registroMadre varchar(100) NOT NULL,
	  urlMadre varchar(100) NOT NULL,
	  
	  abuelo2 varchar(100) NOT NULL,
	  registroAbuelo2 varchar(100) NOT NULL,
	  urlAbuelo2 varchar(100) NOT NULL,
	  Abuela2 varchar(100) NOT NULL,
	  registroAbuela2 varchar(100) NOT NULL,
	  urlAbuela2 varchar(100) NOT NULL,

	  padreAbuela2 varchar(100) NOT NULL,
	  registroPadreAbuela2 varchar(100) NOT NULL,
	  urlPadreAbuela2 varchar(100) NOT NULL,
	  madreAbuela2 varchar(100) NOT NULL,
	  registroMadreAbuela2 varchar(100) NOT NULL,
	  urlMadreAbuela2 varchar(100) NOT NULL,

	  madreAbuelo2 varchar(100) NOT NULL,
	  registroMadreAbuelo2 varchar(100) NOT NULL,
	  urlMadreAbuelo2 varchar(100) NOT NULL,
	  padreAbuelo2 varchar(100) NOT NULL,
	  registroPadreAbuelo2 varchar(100) NOT NULL,
	  urlPadreAbuelo2 varchar(100) NOT NULL,
	  PRIMARY KEY  (id)
	) $charset_collate;";


	dbDelta( $sql );

	$sql = "CREATE TABLE $table_name_main (
	  id mediumint(9) NOT NULL AUTO_INCREMENT,
	  name varchar(55) NOT NULL,
	  idMadre INT NOT NULL,
	  idPadre INT NOT NULL,
	  shortcode varchar(100) NOT NULL,
	  PRIMARY KEY  (id)
	) $charset_collate;";
	dbDelta( $sql );
}

function desctivation_pedigree_plugin()
{
	global $wpdb;
	$table_name_main = $wpdb->prefix . "pedigree_uniko"; 
 	$table_name_fathers = $wpdb->prefix . "fathers_uniko"; 
 	$table_name_mothers = $wpdb->prefix . "mothers_uniko"; 
    $wpdb->query( "DROP TABLE IF EXISTS $table_name_main" );
    $wpdb->query( "DROP TABLE IF EXISTS $table_name_fathers" );
    $wpdb->query( "DROP TABLE IF EXISTS $table_name_mothers" );
    delete_option("pedigree_uniko");
/*
	wp_deregister_style( $handle );
	wp_deregister_script()*/
}