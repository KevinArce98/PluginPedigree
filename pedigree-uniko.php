<?php
/**
* Plugin Name: Pedigree Uniko
* Plugin URI: https://www.unikomarcas.com/
* Description: A plugin about pedigree
* Version: 1.0
* License: GPL
* License URI: http://www.gnu.org/licenses/gpl-2.0.html
* Author: Kevin Arias
* Author URI: #
**/
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
require_once(ABSPATH . 'wp-content/plugins/pedigree-uniko/pedigree-shortcode.php');
require_once('pedigree-model.php');
require_once(ABSPATH . 'wp-content/plugins/pedigree-uniko/connection.php' );
require_once('pedigree-template-loader.php');
$errors = [];
add_action('admin_menu', 'pedigree_uniko_options');
add_action('admin_init', 'config_init');
register_activation_hook( __FILE__, 'initCreateTableUniko' );
register_deactivation_hook( __FILE__, 'desctivation_pedigree_plugin' );
add_shortcode('pedigree', 'showShortcode');

function cssPedigree() {
 echo '<link rel="stylesheet" type="text/css" href="'.plugins_url('/css/pedigree-new.css',__FILE__ ).'">';
}

add_action('wp_head', 'cssPedigree');
if (! function_exists('config_init')) {
	function config_init()
	{
		wp_register_style('bootstrap', plugins_url('/css/bootstrap.css',__FILE__ ));
		wp_enqueue_style('bootstrap');
		wp_register_style('admin', plugins_url('/css/admin.css',__FILE__ ));
		wp_enqueue_style('admin');
	    wp_register_script( 'bootstrap-js', plugins_url('/js/bootstrap.min.js',__FILE__ ));
	    wp_enqueue_script('bootstrap-js');
	}
	add_action('admin_footer', 'my_admin_add_js');
	function my_admin_add_js() {
		echo '<script src="'.plugins_url('/js/admin.js',__FILE__ ).'"></script>';
	}
}

if (! function_exists('pedigree_uniko_options')) {
	function pedigree_uniko_options()
	{
		add_menu_page(
			'Pedigree Uniko', // page title
			'Pedigree Uniko', // menu title
			'manage_options', // capability
			'pedigree_uniko', // slug
			'pedigree_uniko_page_display', // callable funtion
			'dashicons-networking', // icon
			15 //position location menu
		);

		add_submenu_page(
			'pedigree_uniko', //parent slug
			'Agregar Pedigree',//page title
			'Agregar Pedigree',//menu title
			'manage_options',//capability
			'add_new_pedigree',//menu_slug
			'add_new_display_page_pedigree'//callable funtion
		);
		add_submenu_page(
			'pedigree_uniko',
			'Agregar Nuevo Padre', 
			'Agregar Nuevo Padre', 
			'manage_options', 
			'add_new_pedigree_padre', 
			'add_new_display_page_padre'
		);
	
		add_submenu_page(
			'pedigree_uniko', //parent slug
			'Agregar Nueva Madre',//page title
			'Agregar Nueva Madre',//menu title
			'manage_options',//capability
			'add_new_pedigree_madre',//menu_slug
			'add_new_display_page_madre'//callable funtion
		);
	}
}

if (! function_exists('pedigree_uniko_page_display')) {
	function pedigree_uniko_page_display()
	{
		if (current_user_can('edit_others_posts')) {
			 
			 $nonceGlobal = wp_create_nonce('mi_token_de_seguridad');

			if (isset($_POST['nonce']) && !empty($_POST['nonce'])) {
				if (wp_verify_nonce($_POST['nonce'], 'mi_token_de_seguridad')) {
					echo "se ha verificado corectamente";
				}else{
					echo "el nonce no es correcto";
				}
			}

			require_once( 'class-pedigree-list-table.php' );
		     $wp_list_table = new Pedigree_List_Table();?>
			<div class="container">
		      <?php

		      if( isset( $_POST['s'] ) ){
		          $wp_list_table->prepare_items( $_POST['s'] );

		      } else {

		          $wp_list_table->prepare_items();

		      } 
		      echo "<br><a href='?page=add_new_pedigree' class='btn btn-primary'>Crear Nuevo</a>";
		      $wp_list_table->display();?>
			</div>
		      <?php
		}
	}
}
if ( !function_exists('add_new_display_page_pedigree')) {
	function add_new_display_page_pedigree()
	{
		if (current_user_can('edit_others_posts')) {
			$nonceGlobal = wp_create_nonce('mi_token_de_seguridad');
			
			$listMadres = pedigree_get_registros_madre();
			$listPadres = pedigree_get_registros_padre();

			$loader = new Pedigree_Template_Loader();
			$loader->create_template_add_pedigree($listMadres, $listPadres);
		}
	}
}
if (! function_exists('add_new_display_page_padre')) {
	function add_new_display_page_padre()
	{
		if (current_user_can('edit_others_posts')) {
			$nonceGlobal = wp_create_nonce('mi_token_de_seguridad');
			$loader = new Pedigree_Template_Loader();
			$loader->create_template_add_parents("padre", $nonceGlobal);
		}
	}
}

if (isset($_POST['name'])) {
	$retorno = insertPedigree();
	if ($retorno !== -1) {
		echo "<script type='text/javascript'>location.href = '?page=pedigree_uniko';</script>";
	}
}

if (isset($_POST['padre'])) {
	$retorno = insertFather();
	if ($retorno !== -1) {
		if (isset($_REQUEST['type'])) {
			echo "<script type='text/javascript'>location.href = '?page=add_new_pedigree_madre&type=long';</script>";
		}else{
			echo "<script type='text/javascript'>location.href = '?page=add_new_pedigree';</script>";
		}
	}
}

if (! function_exists('add_new_display_page_madre')) {
	function add_new_display_page_madre()
	{
		if (current_user_can('edit_others_posts')) {
			$nonceGlobal = wp_create_nonce('mi_token_de_seguridad');
			$loader = new Pedigree_Template_Loader();
			$loader->create_template_add_parents("madre", $nonceGlobal);
		}
	}
}


if (isset($_POST['madre'])) {
	$retorno = insertMother();
	if ($retorno !== -1) {
		echo "<script type='text/javascript'>location.href = '?page=add_new_pedigree';</script>";
	}
}
