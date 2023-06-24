<?php
require_once('../session.php');
$_POST = json_decode(file_get_contents('php://input'), true);

if (
    isset($_SESSION['username'])
    && isset($_POST['modelo'])
    && isset($_POST['ano'])
    && isset($_POST['cor'])
    && isset($_POST['fabricante'])
    && isset($_POST['tipoMotor'])

) {

    require_once(BASE_PATH . '/backend/db.php');
    $modelo = $_POST['modelo'];
    $ano = $_POST['ano'];
    $fabricante = $_POST['fabricante'];
    $cor = $_POST['cor'];
    $tipo_motor = $_POST['tipoMotor'];

    if (!empty($_POST['id'])) {
        $msg = $_POST['id'];
        $sql = "UPDATE veiculos SET modelo='$modelo', ano='$ano', cor = '$cor', fabricante = '$fabricante', tipo_motor = '$tipo_motor' WHERE idveiculo=$_POST[id]";
    } else {
        $sql = "INSERT INTO veiculos (modelo, ano, cor, fabricante, tipo_motor) VALUES ('$modelo', '$ano', '$cor', '$fabricante', '$tipo_motor')";
    }

    $result = $connection->query($sql);
    

    if ($result) {
        echo json_encode(array('mensagem' => 'ok'));
    } else {
        echo json_encode(array('mensagem' => 'erro'));
    }
} else {
    echo json_encode(array('mensagem' => 'Acesso Negado!'));
}
?>

