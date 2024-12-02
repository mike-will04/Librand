<?php
session_start();
include "../conexao.php";

$Idioma = $_POST["Idioma"];
$Proficiencia = $_POST["Proficiencia"];
$id = $_POST["id"];

try{
    $alterar = $conn->prepare('UPDATE idioma SET idioma = :idioma, proficiencia = :proficiencia where id_idioma = :id');
    $alterar->execute(array(
    ':idioma' => $Idioma, 
    ':proficiencia' => $Proficiencia,
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
