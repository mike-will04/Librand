<?php
session_start();
include "../conexao.php";

$Pais = $_POST["Pais"];
$Categoria = isset($_POST["Categoria"]) ? $_POST["Categoria"] : null;
$Organizacao = $_POST["Organizacao"];
$InicioExperiencia = $_POST["InicioExperiencia"];
$FimExperiencia = $_POST["FimExperiencia"];
$ResponsabilidadesExperiencia = $_POST["ResponsabilidadesExperiencia"];
$id = $_POST["id"];

try{
    $alterar = $conn->prepare('UPDATE especializacoes SET pais = :pais, categoria = :categoria, organizacao = :organizacao, inicio = :inicio, final = :final, responsabilidades = :responsabilidades where id_especializacoes = :id');
    $alterar->execute(array(
    ':pais' => $Pais, 
    ':categoria' => $Categoria,
    ':organizacao' => $Organizacao, 
    ':inicio' => $InicioExperiencia,
    ':final' => $FimExperiencia, 
    ':responsabilidades' => $ResponsabilidadesExperiencia,
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
