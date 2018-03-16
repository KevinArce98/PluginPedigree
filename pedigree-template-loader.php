<?php

if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'Pedigree_Template_Loader' ) )  {

	class Pedigree_Template_Loader {

		function __construct() {
	
    	}
    	function create_template_add_pedigree($listMadres,$listPadres)
    	{ ?>
    		<br>
			<h2 class="text-center text-primary">Genética</h2>
			<div class="container">
				<?php global $errors;
				if ($errors['showError'] !== "hide" && count($errors) > 0) {?>
					<div class="alert alert-danger" role="alert">
					  <?php if ($errors['errorInfo'] == 1){ unset($errors['errorInfo'])?>
					  	<?php foreach ($errors as $error) {?>
					  		+ <?php echo $error;?><br>
					  	<?php } ?>
					  <?php } ?>
					</div>
					<?php
				}elseif($errors['showError'] === "hide") { ?>
					<div class="alert alert-success" role="alert">
					  Se guardó el registro correctamente
					</div>
				<?php } ?>
				<div class="row">
						Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.<br>
						<div class="col-md-12 mt-3 mb-3 text-center">
							
							<a href="?page=add_new_pedigree_padre&type=long" class="btn btn-danger ">Agregar padre y madre</a>
						</div>
				</div>
			
				<form action="" method="post" accept-charset="utf-8">
				<input type="hidden" value="<?php echo $nonceGlobal ?>" name="nonce">
				<div class="row">
				  	<div class="form-group col-md-6">
					  <label for="idMadre">Madre:</label> <a class="btn btn-sm btn-info mb-1" href="?page=add_new_pedigree_madre">Agregar solo madre</a>
					  <select class="form-control" id="idMadre" name="idMadre" required>
					  	<?php foreach ($listMadres as $item) { ?>
					  		<option value="<?php echo $item->id; ?>"><?php echo $item->madre; ?></option>
					  	<?php } ?>
					  </select>
					</div>
					<div class="form-group col-md-6  text-right">
					  <label for="idPadre">Padre:</label> <a class="btn btn-sm btn-info mb-1" href="?page=add_new_pedigree_padre">Agregar solo padre</a>
					  <select class="form-control" id="idPadre" name="idPadre" required>
					  	<?php foreach ($listPadres as $item) { ?>
					  		<option value="<?php echo $item->id; ?>"><?php echo $item->padre; ?></option>
					  	<?php } ?>
					  </select>
					</div>
					<div class="form-group col-md-12">
					    <label for="name">Nombre Pedigree</label>
					    <input type="text" class="form-control" id="name" name="name" required>
					    <p style="color: #6B6B6B;">¡Ingrese un nombre que sea descriptivo para que pueda identificar el pedigree más adelante!</p>
				  	</div>
				 </div>
				<button type="submit" class="btn btn-success">Guardar</button>
			</form>
			</div>
			<?php
    	}

    	function create_template_pedigree($id){
    		require_once('pedigree-model.php');
    		$pedigree = pedigree_get_with_mothers_fathers($id)[0];
		$htmlText = "<div id='wrapper' class=''><span class='label'>Animal</span>
		  <div class='branch lv1'>
		    <div class='entry'><span class='label labelP'><a href='".$pedigree->urlPadre."'>".$pedigree->padre."</a> <br>".$pedigree->registroPadre."</span>
		      <div class='branch lv2'>
		        <div class='entry'><span class='label labelP'><a href='".$pedigree->urlAbuelo."'>".$pedigree->abuelo."</a><br>".$pedigree->registroAbuelo."</span>
		       
		        </div>
		        <div class='space'></div>
		        <div class='entry'><span class='label labelM'><a href='".$pedigree->urlAbuela."'>".$pedigree->Abuela."</a></span>
		        </div>
		        
		      </div>
		    </div>
		    <div class='entry'><span class='label labelM'><a href='".$pedigree->urlMadre."'>".$pedigree->madre."</a></span>
		      <div class='branch lv2'>
		        <div class='entry'><span class='label labelP'><a href='".$pedigree->urlAbuelo2."'>".$pedigree->abuelo2."</a></span>
					
		        </div>
		        <div class='space'></div>
		        <div class='entry'><span class='label labelM'><a href='".$pedigree->urlAbuela2."'>".$pedigree->Abuela2."</a></span>
		          
		        </div>
		      </div>
		    </div>
		  </div>
		</div>";
		return $htmlText;
    	}

    	function create_template_add_parents($type, $nonce)
    	{
  			$titleParent = ($type === "madre") ? 'Madre' : 'Padre';
    		$parent = ($type === "madre") ? 'madre' : 'padre';
    		$numMadre = ($type === "madre") ? '2' : '';
    		?><br>
			<h2 class="text-center text-primary"><?php echo ($type === "madre") ? 'Rama Madre' : 'Rama Padre' ?></h2>
			<div class="container">
				<?php global $errors;
				if ($errors['showError'] !== "hide" && count($errors) > 0) {?>
					<div class="alert alert-danger" role="alert">
					  <?php if ($errors['errorInfo'] == 1){ unset($errors['errorInfo'])?>
					  	<?php foreach ($errors as $error) {?>
					  		+ <?php echo $error;?><br>
					  	<?php } ?>
					  <?php } ?>
					</div>
					<?php
				}elseif($errors['showError'] === "hide") { ?>
					<div class="alert alert-success" role="alert">
					  Se guardó el registro correctamente
					</div>
				<?php } ?>
				<form action="" method="post" accept-charset="utf-8">
				<input type="hidden" value="<?php echo $nonce ?>" name="nonce" required>
				<div class="row">
					<div class="form-group col-md-6">
					    <label for="<?php echo $parent; ?>">
					    	<?php echo $titleParent; ?>
					  	</label>
					    <input type="text" class="form-control" id="<?php echo $parent; ?>" name="<?php echo $parent; ?>" required>
				  	</div>
				  	<div class="form-group col-md-3">
					    <label for="Registro">Registro</label>
					    <input type="text" class="form-control" id="Registro" name="registro<?php echo $titleParent ?>">
				  	</div>
				  	<div class="form-group col-md-3">
					    <label for="Url">Url <?php echo $titleParent ?></label>
					    <input type="text" class="form-control" id="Url" name="url<?php echo $titleParent ?>" >
				  	</div>
					<div class="col-md-12">
						<h4>Abuelos</h4>
						<hr>

					</div>
				  	<div class="form-group col-md-6">
					    <label for="Abuelo">Abuelo</label>
					    <input type="text" class="form-control" id="Abuelo" name="abuelo<?php echo $numMadre ?>" required>
				  	</div>
				  	<div class="form-group col-md-3">
					    <label for="RegistroAbuelo">Registro Abuelo</label>
					    <input type="text" class="form-control" id="RegistroAbuelo" name="registroAbuelo<?php echo $numMadre ?>" >
				  	</div>
				  	<div class="form-group col-md-3">
					    <label for="UrlAbuelo">Url del Abuelo</label>
					    <input type="text" class="form-control" id="UrlAbuelo" name="urlAbuelo<?php echo $numMadre ?>" >
					</div>
						<div class="form-group col-md-6">
					    <label for="Abuela">Abuela</label>
					    <input type="text" class="form-control" id="Abuela" name="Abuela<?php echo $numMadre ?>" required>
				  	</div>
				  	<div class="form-group col-md-3">
					    <label for="RegistroAbuela">Registro Abuela</label>
					    <input type="text" class="form-control" id="RegistroAbuela" name="registroAbuela<?php echo $numMadre ?>">
				  	</div>
				  	<div class="form-group col-md-3">
					    <label for="UrlAbuela">Url del Abuela</label>
					    <input type="text" class="form-control" id="UrlAbuela" name="urlAbuela<?php echo $numMadre ?>" >
					</div>
					<div class="col-md-12">
						<h4>Bisabuelos Paternos</h4>
						<hr>

					</div>
					<div class="form-group col-md-6">
					    <label for="PadreAbuelo">Padre Abuelo</label>
					    <input type="text" class="form-control" id="PadreAbuelo" name="padreAbuelo<?php echo $numMadre ?>" required>
				  	</div>
				  	<div class="form-group col-md-3">
					    <label for="RegistroPadreAbuelo">Registro Padre del Abuelo</label>
					    <input type="text" class="form-control" id="RegistroPadreAbuelo" name="registroPadreAbuelo<?php echo $numMadre ?>" >
				  	</div>
				  	<div class="form-group col-md-3">
					    <label for="UrlPadreAbuelo">Url del Padre del Abuelo</label>
					    <input type="text" class="form-control" id="UrlPadreAbuelo" name="urlPadreAbuelo<?php echo $numMadre ?>" >
					</div>

					<div class="form-group col-md-6">
					    <label for="MadreAbuelo">Madre Abuelo</label>
					    <input type="text" class="form-control" id="MadreAbuelo" name="madreAbuelo<?php echo $numMadre ?>" required>
				  	</div>
				  	<div class="form-group col-md-3">
					    <label for="RegistroMadreAbuelo">Registro Madre del Abuelo</label>
					    <input type="text" class="form-control" id="RegistroMadreAbuelo" name="registroMadreAbuelo<?php echo $numMadre ?>" >
				  	</div>
				  	<div class="form-group col-md-3">
					    <label for="UrlMadreAbuelo">Url del Madre del Abuelo</label>
					    <input type="text" class="form-control" id="UrlMadreAbuelo" name="urlMadreAbuelo<?php echo $numMadre ?>" >
					</div>

					<div class="form-group col-md-6">
					    <label for="PadreAbuela">Padre Abuela</label>
					    <input type="text" class="form-control" id="PadreAbuela" name="padreAbuela<?php echo $numMadre ?>" required>
				  	</div>
				  	<div class="form-group col-md-3">
					    <label for="RegistroPadreAbuela">Registro Padre del Abuela</label>
					    <input type="text" class="form-control" id="RegistroPadreAbuela" name="registroPadreAbuela<?php echo $numMadre ?>" >
				  	</div>
				  	<div class="form-group col-md-3">
					    <label for="UrlPadreAbuela">Url del Padre del Abuela</label>
					    <input type="text" class="form-control" id="UrlPadreAbuela" name="urlPadreAbuela<?php echo $numMadre ?>" >
					</div>

					<div class="form-group col-md-6">
					    <label for="MadreAbuela">Madre Abuela</label>
					    <input type="text" class="form-control" id="MadreAbuela" name="madreAbuela<?php echo $numMadre ?>" required>
				  	</div>
				  	<div class="form-group col-md-3">
					    <label for="RegistroMadreAbuela">Registro Madre del Abuela</label>
					    <input type="text" class="form-control" id="RegistroMadreAbuela" name="registroMadreAbuela<?php echo $numMadre ?>">
				  	</div>
				  	<div class="form-group col-md-3">
					    <label for="UrlMadreAbuela">Url del Madre del Abuela</label>
					    <input type="text" class="form-control" id="UrlMadreAbuela" name="urlMadreAbuela<?php echo $numMadre ?>">
					</div>
				</div>		  			 
				<button type="submit" class="btn btn-success">Agregar <?php echo $titleParent; ?></button>
			</form>
			</div>
			<?php
    	}
	}
}
