<?php

if ( ! defined( 'ABSPATH' ) ) exit;

function showShortcode($attr_new)
{
	require_once('pedigree-template-loader.php');
	$attr_default = [
		'id'=> 0,
		'name' => 'Pedigree Uniko'
	];
	$attr_new = array_change_key_case( (array)$attr_new);
	extract(shortcode_atts($attr_default, $attr_new), EXTR_OVERWRITE);
	$loader = new Pedigree_Template_Loader();
	$html  = $loader->create_template_pedigree($id);
	return $html;
}	



