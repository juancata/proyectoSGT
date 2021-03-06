<?php

// Prueba de impresion
require('../../imprimir/fpdf/fpdf.php');

class PDF extends FPDF {

    //Tabla simple
    function BasicTable($header, $data) {
        // Cabecera
        $this->SetFont('Arial', 'B', 10);
        foreach ($header as $col)
            $this->Cell(40, 8, $col, 1);
        $this->Ln();
        //    Datos
        $this->SetFont('Arial', '', 10);
        foreach ($data as $row) {
            foreach ($row as $col) {
                $this->Cell(40, 8, utf8_decode($col), 1);
            }
            $this->Ln();
        }
    }

}

$header = array('Nombre', 'Activa');
$pdf = new PDF();
$pdf->AddPage();


include_once './../../fragmentos/_conectDb.php';
$db = conectaDb();
$c1 = 0;
foreach ($_GET as $n) {
    if ($c1 >= 0) {
        $c2 = 0;
        $consulta = 'Select nombre, activo from os where idos = "' . $n . '"';
        $res = $db->query($consulta);
        if ($res) {
            $arr = $res->fetch(PDO::FETCH_ASSOC);
            if ($arr['activo'] == '1')
                $arr['activo'] = "SI";
            else
                $arr['activo'] = "NO";
            $matriz [$c1] = ($arr);
        }
    }
    $c1++;
}
$pdf->SetFont('Arial', 'B', 15);
$pdf->Cell(40, 8, 'Obras Sociales', 0);
$pdf->Ln(20);
$pdf->BasicTable($header, $matriz);
$pdf->Output();
?>
