<?php
session_start();
include "../conexao.php";

$Responsavel_Contato = $_POST["Responsavel_Contato"];
$Cargo_Responsavel = $_POST["Cargo_Responsavel"];
$Celular_Contato = $_POST["Celular_Contato"];
$email = $_POST["email"];
$Pagina_Web = $_POST["Pagina_Web"];
$id = $_POST["id"];

try{
    $alterar = $conn->prepare('UPDATE sobre_empresa SET responsavel_contato = :responsavel_contato, cargo_responsavel = :cargo_responsavel, celular_contato = :celular_contato, email = :email, pagina_web = :pagina_web where id_sobre = :id');
    $alterar->execute(array(
    ':responsavel_contato' => $Responsavel_Contato, 
    ':cargo_responsavel' => $Cargo_Responsavel,
    ':celular_contato' => $Celular_Contato, 
    ':email' => $email,
    ':pagina_web' => $Pagina_Web, 
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

header("Location: perfil_empresa.php");
exit();
