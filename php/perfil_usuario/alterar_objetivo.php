<?php
session_start();
include "../conexao.php";

$CargoDeInteresse = $_POST["CargoDeInteresse"];
$PretencaoSalarial = isset($_POST["PretencaoSalarial"]) ? $_POST["PretencaoSalarial"] : null;
$id = $_POST["id"];

try{
    $alterar = $conn->prepare('UPDATE objetivo SET cargo_de_interesse = :cargo_de_interesse, pretencao_salarial = :pretencao_salarial where id_objetivo = :id');
    $alterar->execute(array(
    ':cargo_de_interesse' => $CargoDeInteresse, 
    ':pretencao_salarial' => $PretencaoSalarial,
    ':id' => $id
    ));
    if ($alterar->rowCount()==1){
        $_SESSION['message'] = 'Dados alterados com sucesso!';
    } else {
        $_SESSION['message'] = 'Dados não foram alterados.';
    }
} catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}

header("Location: perfil_usuario.php");
exit();
