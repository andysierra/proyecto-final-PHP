<?php
$paciente = new Paciente($_GET['idPaciente'], "", "", "", "", "", $_GET['estado']);
$paciente->actualizarEstado();
$pacientes = $paciente->consultarTodos();
?>
<table class="table table-striped table-hover">
	<thead>
		<tr>
			<th scope="col">Id</th>
			<th scope="col">Nombre</th>
			<th scope="col">Apellido</th>
			<th scope="col">Correo</th>
			<th scope="col">Estado</th>
			<th scope="col">Telefono</th>
			<th scope="col">Direccion</th>
			<th scope="col">Foto</th>
			<th scope="col">Servicios</th>
		</tr>
	</thead>
	<tbody>
	<?php
    foreach ($pacientes as $p) {
        echo "<tr>";
        echo "<td>" . $p->getId() . "</td>";
        echo "<td>" . $p->getNombre() . "</td>";
        echo "<td>" . $p->getApellido() . "</td>";
        echo "<td>" . $p->getCorreo() . "</td>";
        echo "<td><span class='fas " . ($p->getEstado() == 0 ? "fa-times-circle" : "fa-check-circle") . "' data-toggle='tooltip' class='tooltipLink' data-placement='left' data-original-title='" . ($p->getEstado() == 0 ? "Inhabilitado" : "Habilitado") . "' ></span>" . "</td>";
        echo "<td>" . $p->getTelefono() . "</td>";
        echo "<td>" . $p->getDireccion() . "</td>";
        echo "<td>" . (($p->getFoto() != "") ? "<img src='/IPSUD/fotos/" . $p->getFoto() . "' height='50px'>" : "") . "</td>";
        echo "<td>" . "<a href='modalPaciente.php?idPaciente=" . $p->getId() . "' data-toggle='modal' data-target='#modalPaciente' ><span class='fas fa-eye' data-toggle='tooltip' class='tooltipLink' data-placement='left' data-original-title='Ver Detalles' ></span> </a>
                       <a class='fas fa-pencil-ruler' href='index.php?pid=" . base64_encode("presentacion/paciente/actualizarPaciente.php") . "&idPaciente=" . $p->getId() . "' data-toggle='tooltip' data-placement='left' title='Actualizar'> </a>
                       <a class='fas fa-camera' href='index.php?pid=" . base64_encode("presentacion/paciente/actualizarFotoPaciente.php") . "&idPaciente=" . $p->getId() . "' data-toggle='tooltip' data-placement='left' title='Actualizar Foto'> </a>
                       <a id='cambiarEstado' class='fas fa-power-off' href='#' data-toggle='tooltip' data-placement='left' title='" . ($p->getEstado() == 0 ? "Habilitar" : "Inhabilitar") . "'> </a>
              </td>";
        echo "</tr>";
    }
    echo "<tr><td colspan='9'>" . count($pacientes) . " registros encontrados</td></tr>"?>
	</tbody>
</table>
