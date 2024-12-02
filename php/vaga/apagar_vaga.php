<?php
session_start();
include "../conexao.php";
$id = $_GET["id"];

try {
    $excluir2 = $conn->prepare('DELETE FROM candidato_vaga where id_vaga = :id');
    $excluir2->execute(array(
        ':id' => $id
    ));

    $excluir = $conn->prepare('DELETE FROM vaga where id_vaga = :id');
    $excluir->execute(array(
        ':id' => $id
    ));

    if (($excluir->rowCount() == 0) and ($excluir2->rowCount() == 0)) {
        $_SESSION['message'] = 'Dados não foram apagados.';
    } else {
        $_SESSION['message'] = 'Dados excluídos com sucesso!';
    }
} catch (PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}

header("Location: vagas_ativas.php");
exit();
