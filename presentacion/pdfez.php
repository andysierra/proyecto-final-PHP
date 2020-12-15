<?php
require_once 'logica/Paciente.php';

class pdfez
{
    private $paciente;
    
    function pdfez() {
        $this->paciente = new Paciente();
        foreach($paciente->consultarTodos() as $p) {
            echo ""+$p->getCedula();
        }
    }
}

