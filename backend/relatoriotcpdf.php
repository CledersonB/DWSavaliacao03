<?php
require_once '../session.php';
require 'tcpdf/tcpdf.php';

$rel = $_GET['rel'];
$valor = $_GET['valor'];

if (isset($_SESSION['username'])) {

    require_once BASE_PATH . '/backend/db.php';
    if ($valor == "<=2019") {
        $sql = "SELECT * FROM veiculos WHERE " . $rel . "< '2019' ";
    } else {
        $sql = "SELECT * FROM veiculos WHERE " . $rel . "= '$valor' ";
    }
    $result = $connection->query($sql);

    $dados = $result->fetch_all();

    if($dados == null){
        echo "<script>alert('Nenhum dado encontrado!');</script>";
        echo"<script>window.close();</script>";
    }

    $msg = "Relatorio de carros por " . $rel;

    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(true);

    $pdf->AddPage();

    $pdf->SetTitle('Relatorio de carros');
    $pdf->SetFont('dejavusans', 'B', 16, '', true);
    $pdf->Cell(190, 10, $msg, 0, 0, "C");
    $pdf->Ln();

    $pdf->SetFont('dejavusans', '', 14, '', true);

    $pdf->Cell(50, 7, "Modelo do Carro", 1, 0, "C");
    $pdf->Cell(35, 7, "Fabricacao.", 1, 0, "C");
    $pdf->Cell(35, 7, "Fabricante", 1, 0, "C");
    $pdf->Cell(30, 7, "Cor", 1, 0, "C");
    $pdf->Cell(40, 7, "Tipo do motor", 1, 0, "C");
    $pdf->Ln();

    foreach ($dados as $carros) {
        $pdf->SetFont('dejavusans', '', 12, '', true);
        $pdf->Cell(50, 7, $carros[1], 1, 0, "C");
        $pdf->Cell(35, 7, $carros[2], 1, 0, "C");
        $pdf->Cell(35, 7, $carros[4], 1, 0, "C");
        $pdf->Cell(30, 7, $carros[3], 1, 0, "C");
        $pdf->Cell(40, 7, $carros[5], 1, 0, "C");
        $pdf->Ln();
    }

    $pdf->Output('relatorio.pdf', 'I');
}
?>