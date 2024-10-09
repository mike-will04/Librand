<?php
session_start();
include "../conexao.php";

$Pais = $_POST["Pais"];
$Estado = $_POST["Estado"];
$Nivel = $_POST["Nivel"];
$Instituicao = isset($_POST["Instituicao"]) ? $_POST["Instituicao"] : null;
$Curso = isset($_POST["Curso"]) ? $_POST["Curso"] : null;
$Status = $_POST["Status"];
$Campus = isset($_POST["Campus"]) ? $_POST["Campus"] : null;
$InicioFormacao = $_POST["InicioFormacao"];
$FimFormacao = $_POST["FimFormacao"];
$Turno = isset($_POST["Turno"]) ? $_POST["Turno"] : null;
$id = $_POST["id"];

try{
    $alterar = $conn->prepare('UPDATE formacao SET pais = :pais, estado = :estado, nivel = :nivel, instituicao = :instituicao, curso = :curso, status = :status, campus = :campus, inicio = :inicio, conclusao = :conclusao, turno = :turno where id_formacao = :id');
    $alterar->execute(array(
    ':pais' => $Pais, 
    ':estado' => $Estado,
    ':nivel' => $Nivel, 
    ':instituicao' => $Instituicao,
    ':curso' => $Curso, 
    ':status' => $Status,
    ':campus' => $Campus,
    ':inicio' => $InicioFormacao,
    ':conclusao' => $FimFormacao,
    ':turno' => $Turno,
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
