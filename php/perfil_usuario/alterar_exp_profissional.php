<?php
session_start();
include "../conexao.php";

$Empresa = $_POST["Empresa"];
$Responsabilidades = $_POST["Responsabilidades"];
$Cargo = $_POST["Cargo"];
$Nivel = isset($_POST["Nivel"]) ? $_POST["Nivel"] : null;
$Area = $_POST["Area"];
$InicioEmprego = $_POST["InicioEmprego"];
$FimEmprego = $_POST["FimEmprego"];
$Atual = isset($_POST["Atual"]) ? 1 : 0;
$id = $_POST["id"];

try{
    $alterar = $conn->prepare('UPDATE experiencia SET empresa = :empresa, responsabilidades = :responsabilidades, cargo = :cargo, nivel = :nivel, area = :area, inicio_emprego = :inicio_emprego, fim_emprego = :fim_emprego, atual = :atual where id_experiencia = :id');
    $alterar->execute(array(
    ':empresa' => $Empresa, 
    ':responsabilidades' => $Responsabilidades,
    ':cargo' => $Cargo, 
    ':nivel' => $Nivel,
    ':area' => $Area, 
    ':inicio_emprego' => $InicioEmprego,
    ':fim_emprego' => $FimEmprego,
    ':atual' => $Atual,
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
