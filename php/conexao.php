<?php
$servidor = 'localhost';
$db = "librand";
$user = 'root';
$pass = '';
try {

  $conn = new PDO('mysql:host=' . $servidor . ';dbname=' . $db,  $user, $pass);
  //echo 'Conectado com sucesso';
} catch (PDOException $e) {
  echo 'Erro número : ' . $e->getMessage();
}
