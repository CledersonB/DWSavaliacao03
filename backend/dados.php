<?php
require_once '../session.php';

if (isset($_SESSION['username'])) {
   if ($_GET['tabela'] == 'veiculos') {
      require_once BASE_PATH . '/backend/db.php';
      $sql = "SELECT * FROM veiculos";
      $result = $connection->query($sql);
      echo json_encode($result->fetch_all());

   }
}
