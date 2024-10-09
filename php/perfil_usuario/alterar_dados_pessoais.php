<?php
session_start();
include "../conexao.php";

$Nome = $_POST["Nome"];
$Sobrenome = $_POST["Sobrenome"];
$NomeSocial = isset($_POST["NomeSocial"]) ? $_POST["NomeSocial"] : null;
$Origem = $_POST["Origem"];
$CPF = $_POST["CPF"];
$Celular = $_POST["Celular"];
$Nascimemnto = $_POST["Nascimemnto"];
$Raca = isset($_POST["Raca"]) ? $_POST["Raca"] : null;
$EstadoCivil = isset($_POST["EstadoCivil"]) ? $_POST["EstadoCivil"] : null;
$Estrangeiro = $_POST["Estrangeiro"];
$PossuiDeficiencia = $_POST["PossuiDeficiencia"];
$Deficiencia = isset($_POST["Deficiencia"]) ? $_POST["Deficiencia"] : null;
$dir = '../../laudos/';
$tmpLaudo = isset($_FILES['Laudo']['tmp_name']) ? $_FILES['Laudo']['tmp_name'] : null;
$Laudo = isset($_FILES['Laudo']['name']) ? $_FILES['Laudo']['name'] : null;
$Caracteristica = isset($_POST["Caracteristica"]) ? $_POST["Caracteristica"] : null;
$RendaMensal = isset($_POST["RendaMensal"]) ? $_POST["RendaMensal"] : null;
$RendaFamiliar = isset($_POST["RendaFamiliar"]) ? $_POST["RendaFamiliar"] : null;
$CEP = $_POST["CEP"];
$Rua = $_POST["Rua"];
$Numero = isset($_POST["Numero"]) ? $_POST["Numero"] : null;
$Complemento = isset($_POST["Complemento"]) ? $_POST["Complemento"] : null;
$Bairro = isset($_POST["Bairro"]) ? $_POST["Bairro"] : null;
$Estado = $_POST["Estado"];
$Cidade = $_POST["Cidade"];
$Sobre = isset($_POST["Sobre"]) ? $_POST["Sobre"] : null;
$Video = isset($_POST["Video"]) ? $_POST["Video"] : null;
$id = $_POST["id"];

try {
    $alterar = $conn->prepare('UPDATE dados_pessoais SET nome = :nome, sobrenome = :sobrenome, nome_social = :nome_social, pais = :pais, cpf = :cpf, celular = :celular, data = :data, raca = :raca, estado_civil = :estado_civil, estrangeiro = :estrangeiro, possui_deficiencia = :possui_deficiencia, deficiencia = :deficiencia, laudo = :laudo, suporte = :suporte, renda_pessoal = :renda_pessoal, renda_familiar = :renda_familiar, cep = :cep, rua = :rua, numero = :numero, complemento = :complemento, bairro = :bairro, estado = :estado, cidade = :cidade, comentario = :comentario, video = :video where id_dados = :id');
    $alterar->execute(array(
        ':nome' => $Nome,
        ':sobrenome' => $Sobrenome,
        ':nome_social' => $NomeSocial,
        ':pais' => $Origem,
        ':cpf' => $CPF,
        ':celular' => $Celular,
        ':data' => $Nascimemnto,
        ':raca' => $Raca,
        ':estado_civil' => $EstadoCivil,
        ':estrangeiro' => $Estrangeiro,
        ':possui_deficiencia' => $PossuiDeficiencia,
        ':deficiencia' => $Deficiencia,
        ':laudo' => $Laudo,
        ':suporte' => $Caracteristica,
        ':renda_pessoal' => $RendaMensal,
        ':renda_familiar' => $RendaFamiliar,
        ':cep' => $CEP,
        ':rua' => $Rua,
        ':numero' => $Numero,
        ':complemento' => $Complemento,
        ':bairro' => $Bairro,
        ':estado' => $Estado,
        ':cidade' => $Cidade,
        ':comentario' => $Sobre,
        ':video' => $Video,
        ':id' => $id
    ));
    if ($alterar->rowCount() == 1) {
        $_SESSION['message'] = 'Dados alterados com sucesso!';
    } else {
        $_SESSION['message'] = 'Dados não foram alterados.';
    }
} catch (PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}

header("Location: perfil_usuario.php");
exit();
