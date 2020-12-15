<?php
$p = new Paciente($_GET['idPaciente'], "", "", "", "", "", $_GET['estado']);
echo "<a id='cambiarEstado" . $p->getId() . "' class='fas fa-power-off' href='#' data-toggle='tooltip' data-placement='left' title='" . ($p->getEstado()==0?"Habilitar":"Inhabilitar") . "'> </a>";