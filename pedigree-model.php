<?php
require_once('pedigree-validations.php');
/**
* Devuelve todos los registros de la tabla madres
* @return 
*/
function pedigree_get_registros_madre() {
	global $wpdb;
	$table_name = $wpdb->prefix . "mothers_uniko";
	$total = $wpdb->get_results( "SELECT * FROM $table_name" );
	return $total;
}
/**
* Devuelve todos los registros de la tabla padres
* @return 
*/
function pedigree_get_registros_padre() {
	global $wpdb;
	$table_name = $wpdb->prefix . "fathers_uniko";
	$total = $wpdb->get_results( "SELECT * FROM $table_name" );
	return $total;
}
/**
* Devuelve un join con las tablas madres y padres
* @return 
*/
function pedigree_get_with_mothers_fathers($id)
{
	global $wpdb;
	$table_main = $wpdb->prefix . "pedigree_uniko";
	$table_name_fathers = $wpdb->prefix . "fathers_uniko";
	$table_name_mothers = $wpdb->prefix . "mothers_uniko";
	$sql = "SELECT pu.*, fu.*, mu.* ".
									  "FROM ".$table_main." pu ". 
									  "LEFT JOIN ".$table_name_mothers." mu ON pu.idMadre = mu.id ".
									  "LEFT JOIN ".$table_name_fathers." fu ON pu.idPadre = fu.id ".
									  "WHERE pu.id = ".$id.";";
	$results = $wpdb->get_results($sql, OBJECT );
	return $results;
}
/**
* Inserta los datos en la tabla padres
* @return 
*/
function insertFather()
{
	global $errors;
	$result = 0;
	verifyInformation($_POST, 'padre');
	if ($errors['errorInfo'] != 1) {
		global $wpdb;
		$table_name_fathers = $wpdb->prefix . "fathers_uniko";
		unset($_POST['nonce']);
		$result = insert($table_name_fathers, $_POST);
		if ($result == 0) {
			$errors['database'] = "Error al ingresar la información a la base de datos";
			return -1;
		}
	}else{
		return -1;
	}
	
	$errors['showError'] = "hide";
	return $result;	
}

function insertMother()
{
	global $errors;
	$result = 0;
	verifyInformation($_POST, 'madre');
	if ($errors['errorInfo'] != 1) {
		global $wpdb;
		$table_name_mothers = $wpdb->prefix . "mothers_uniko";
		unset($_POST['nonce']);
		$result = insert($table_name_mothers, $_POST);
		if ($result == 0) {
			$errors['database'] = "Error al ingresar la información a la base de datos";
			return -1;
		}
	}else{
		return -1;
	}
	$errors['showError'] = "hide";
	return $result;
}
function insertPedigree()
{
	global $errors;
	verifyInfoPedigree($_POST);
	if ($errors['errorInfo'] != 1) {
		global $wpdb;
		$table_name_pedigree = $wpdb->prefix . "pedigree_uniko";
		unset($_POST['nonce']);
		$listPedigree = array('name' => $_POST['name'], 
			'idMadre' => $_POST['idMadre'],
			'idPadre' => $_POST['idPadre'],
			'shortcode' => "[shortcode]");
		$rsult = $wpdb->insert($table_name_pedigree, $listPedigree, array(
							'%s',
							'%d',
							'%d',
							'%s'
						));

		if ($rsult == 1) {
			$last_id = $wpdb->insert_id;
		}else{
			$errors['database'] = "Error al ingresar la información a la base de datos";
			return -1;
		}
		$array = generateShortcode($last_id, $_POST['name']);
		$rsult = $wpdb->update($table_name_pedigree, $array, array('id' => $last_id));
		if ($rsult == 0) {
			$errors['Shortcode'] = "Error al ingresar el shortcode a la base de datos";
			return -1;
		}
	}else{
		return -1;
	}
	$errors['showError'] = "hide";
	return $last_id;
}
function insert($tableName, $list)
{
	global $wpdb;
	$rsult = $wpdb->insert($tableName, $list);
	if ($rsult == 1) {
		$last_id = $wpdb->insert_id;
	}else{
		$errors['database'] = "Error al ingresar la información a la base de datos";
		$last_id = -1;
	}
	return $last_id;
}

function generateShortcode($id, $name)
{
	$short = "[pedigree id=".$id." name=".$name."]";
	$data = array('shortcode' => $short);
	return $data;
}