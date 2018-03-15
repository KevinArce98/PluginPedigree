<?php

function verifyInformation($list, $type)
{
	global $errors;
	$bandera = false;
	$listRequired = createListRequired($type);
	$listNamesRequired = createNameListRequired($type);
	foreach ($listRequired as $key => $item) {
	 	if ($list[$item] == "") {
	 		$errors[$item] = "El campo $listNamesRequired[$key] es requerido";
	 		if ($bandera == false) {
	 			$errors['errorInfo'] = 1;
	 			$bandera = true;		 		
	 		}
	 	}
	 }
	return 1;
}
function createListRequired($type)
{
	if ($type === 'padre') {
		return ['padre', 'abuelo', 'Abuela', 'padreAbuelo', 'madreAbuelo', 'padreAbuela', 'madreAbuela'];
	}else{
		return ['madre', 'abuelo2', 'Abuela2', 'padreAbuelo2', 'madreAbuelo2', 'padreAbuela2', 'madreAbuela2'];
	}
}
function createNameListRequired($type)
{
	if ($type === 'padre') {
		return ['Padre', 'Abuelo', 'Abuela', 'Padre del Abuelo', 'Madre del Abuelo', 'Padre de la Abuela', 'Madre de la Abuela'];
	}else{
		 return ['Madre', 'Abuelo', 'Abuela', 'Padre del Abuelo', 'Madre del Abuelo', 'Padre de la Abuela', 'Madre de la Abuela'];
	}
}

function verifyInfoPedigree($list)
{
	global $errors;

	if (empty(trim($list['name']))) {
		$errors['name'] = "El campo nombre es requerido";
		$errors['errorInfo'] = 1;
	}
	if (empty($list['idMadre'])) {
		$errors['idMadre'] = "La rama Madre es requerida";
		$errors['errorInfo'] = 1;
	}
	if (empty($list['idPadre'])) {
		$errors['idPadre'] = "La rama Padre es requerida";
		$errors['errorInfo'] = 1;
	}

	return 1;
}