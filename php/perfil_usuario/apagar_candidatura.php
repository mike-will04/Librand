<?php
    include "../conexao.php";
    session_start();
    $id_vaga = $_GET["id"];
    $id_usuario = $_SESSION['iduser'];

    try {
        $excluir = $conn->prepare('DELETE FROM candidato_vaga where id_vaga = :id_vaga and id_usuario = :id_usuario');
        $excluir->execute(array(
            ':id_vaga' => $id_vaga,
            ':id_usuario' => $id_usuario
        ));
    
        if (($excluir->rowCount() == 0)) {
            $_SESSION['message'] = 'Dados não foram apagados.';
        } else {
            $_SESSION['message'] = 'Dados excluídos com sucesso!';
        }
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
    
    header("Location: perfil_usuario.php");
    exit();
?>