<?php
$exito = "";
$administrador = new Administrador($_SESSION['id']);
$administrador->consultar();
$paciente = new Paciente($_GET["idPaciente"]);
$paciente->consultar();
if (isset($_POST["actualizar"])) {
    // recibimos los datos de la imagen
    $nombre_foto = $_FILES['foto']['name'];
    $tipo_foto = $_FILES['foto']['type'];
    $tam_foto = $_FILES['foto']['size'];
    if ($tam_foto <= 300000) {
        if (strlen($nombre_foto) <= 45) {
            if ($tipo_foto == "image/png" || $tipo_foto == "image/jpeg" || $tipo_foto == "image/jpg") {
                if ($paciente->getFoto()) {
                    unlink("C:/xampp/htdocs/IPSUD/fotos/" . $paciente->getFoto());
                }
                // ruta de la carpeta destino en el servidor
                $carpeta_destino = $_SERVER['DOCUMENT_ROOT'] . '/IPSUD/fotos/';
                // movemos la imagen de la carpeta temporal al directorio escogido
                move_uploaded_file($_FILES['foto']['tmp_name'], $carpeta_destino . $nombre_foto);

                $paciente = new Paciente($_GET["idPaciente"], "", "", "", "", "", "", "", "", $nombre_foto); // Crear el atributo foto en Paciente
                $paciente->actualizarFoto();
            } else {
                $exito = "El tipo de la foto solo puede ser png,jpeg y jpg";
            }
        } else {
            $exito = "El nombre de de la
						foto es muy largo.";
        }
    } else {
        $exito = "El tamano de la
						foto es muy grande.";
    }
}
include 'presentacion/menuAdministrador.php';
?>
<div class="container">
	<div class="row">
		<div class="col-3"></div>
		<div class="col-6">

			<div class="card">

				<div class="card-header bg-primary text-white">Actualizar Foto
					Paciente</div>
				<div class="card-img-top">
					<img src="/IPSUD/fotos/<?php echo $paciente->getFoto()?>" height="200px" />
					<div class="card-body">
						<p class="card-text">foto del paciente</p>
					</div>
				</div>
				<div class="card-body">
				
						<?php
    if (isset($_POST["actualizar"])) {
        ?>
        	<?php if($exito!=""){?>
        	<div class="alert alert-danger" role="alert"><?php echo $exito ?></div>
        	    
        	<?php }else{?>
        	    <div class="alert alert-success" role="alert">foto
						actualizada</div>
        	<?php }?>		
						<?php } ?>
						
					<form
						action=<?php echo "index.php?pid=" . base64_encode("presentacion/paciente/actualizarFotoPaciente.php")."&idPaciente=".$_GET["idPaciente"] ?>
						method="post" enctype="multipart/form-data">
						<div class="form-group">
							<input type="file" name="foto" size="30" class="form-control"
								placeholder="Foto" required="required">
						</div>
						<button type="submit" name="actualizar" class="btn btn-primary">Actualizar</button>
					</form>
				</div>
			</div>
		</div>

	</div>

</div>




