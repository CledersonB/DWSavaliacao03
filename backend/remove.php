<?php 
require_once('../session.php');

$_POST = json_decode(file_get_contents('php://input'), true);

if(isset($_SESSION['username'])&& isset($_POST['id'])){
    require_once(BASE_PATH . '/backend/db.php');
    $sql = "DELETE FROM veiculos WHERE idveiculo = {$_POST['id']};";
    $result = $connection->query($sql);
    if($result){
        echo json_encode(array('mensagem' => 'ok'));
    }else{
        echo json_encode(array('mensagem' => 'erro'));
    }
}else{
    echo json_encode(array('mensagem' => 'Acesso Negado!'));
}
?>