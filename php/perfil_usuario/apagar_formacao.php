<?php 
include "../conexao.php";
$id = $_GET["id"];

try {
    $excluir = $conn->prepare('DELETE FROM formacao where id_formacao = :id');
    $excluir->execute(array(
        ':id' => $id
    ));
    
    if ($excluir->rowCount() == 0) {
        echo "<script>alert('Dados não foram apagados');history.go(-1);</script>";
    } else {
        echo "<script>alert('Dados excluidos com sucesso!!!');history.go(-1);</script>";
    }
} catch (PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}
