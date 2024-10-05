<?php
session_start();
include "../conexao.php";
$id = $_GET["id"];

try {
    $excluir = $conn->prepare('DELETE FROM experiencia where id_experiencia = :id');
    $excluir->execute(array(
        ':id' => $id
    ));

    if ($excluir->rowCount() == 0) {
        $_SESSION['message'] = 'Dados não foram apagados.';
    } else {
        $_SESSION['message'] = 'Dados excluídos com sucesso!';
    }
} catch (PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}

header("Location: perfil_usuario.php");
exit();
