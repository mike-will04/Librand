<?php
$servidor = 'localhost';
$db = "librand";
$user = 'root';
$pass = '';
try {

  $conn = new PDO('mysql:host=' . $servidor . ';dbname=' . $db,  $user, $pass);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo 'Erro número : ' . $e->getMessage();
}
