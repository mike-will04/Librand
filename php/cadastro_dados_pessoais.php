<?php
include "conexao.php";

session_start();

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
$Deficiencia = $_POST["Deficiencia"];
$Laudo = isset($_POST["Laudo"]) ? $_POST["Laudo"] : null;
$Caracteristica = $_POST["Caracteristica"];
$RendaMensal = isset($_POST["RendaMensal"]) ? $_POST["RendaMensal"] : null;
$RendaFamiliar = isset($_POST["RendaFamiliar"]) ? $_POST["RendaFamiliar"] : null;
$CEP = $_POST["CEP"];
$Rua = $_POST["Rua"];
$Sobre = isset($_POST["Sobre"]) ? $_POST["Sobre"] : null;
$Video = isset($_POST["Video"]) ? $_POST["Video"] : null;
$id_usuario = $_SESSION['iduser'];

$check = $conn->prepare(
    'SELECT count(*) as count FROM dados pessoais WHERE id_usuario = :id_usuario'
);
$check -> execute(array(
    ':id_usuario' => $id_usuario,
));

foreach ($check as $linha) {
    try {
        if ($linha['count'] >= 1) {
            echo "<script>alert('Dados já cadastrados');history.go(-1);</script>";                
        }
        else {
            $cadastro = $conn->prepare('INSERT INTO dados pessoais (cargo_de_interesse, pretencao_salarial, id_usuario, id_usuario, id_usuario, cargo_de_interesse, pretencao_salarial, id_usuario, id_usuario, id_usuario, cargo_de_interesse, pretencao_salarial, id_usuario, id_usuario, id_usuario, cargo_de_interesse, pretencao_salarial, id_usuario, id_usuario, id_usuario, id_usuario) VALUES 
            (:cargo_de_interesse, :pretencao_salarial, :id_usuario, :id_usuario, :id_usuario, :cargo_de_interesse, :pretencao_salarial, :id_usuario, :id_usuario, :id_usuario, :cargo_de_interesse, :pretencao_salarial, :id_usuario, :id_usuario, :id_usuario, :cargo_de_interesse, :pretencao_salarial, :id_usuario, :id_usuario, :id_usuario, :id_usuario)');

            $cadastro->execute(array(
                ':cargo_de_interesse' => $CargoDeInteresse,
                ':pretencao_salarial' => $PretencaoSalarial,
                ':cargo_de_interesse' => $CargoDeInteresse,
                ':pretencao_salarial' => $PretencaoSalarial,
                ':cargo_de_interesse' => $CargoDeInteresse,
                ':cargo_de_interesse' => $CargoDeInteresse,
                ':pretencao_salarial' => $PretencaoSalarial,
                ':cargo_de_interesse' => $CargoDeInteresse,
                ':pretencao_salarial' => $PretencaoSalarial,
                ':cargo_de_interesse' => $CargoDeInteresse,
                ':cargo_de_interesse' => $CargoDeInteresse,
                ':pretencao_salarial' => $PretencaoSalarial,
                ':cargo_de_interesse' => $CargoDeInteresse,
                ':pretencao_salarial' => $PretencaoSalarial,
                ':cargo_de_interesse' => $CargoDeInteresse,
                ':cargo_de_interesse' => $CargoDeInteresse,
                ':pretencao_salarial' => $PretencaoSalarial,
                ':cargo_de_interesse' => $CargoDeInteresse,
                ':pretencao_salarial' => $PretencaoSalarial,
                ':cargo_de_interesse' => $CargoDeInteresse,
                ':id_usuario' => $id_usuario
            ));

            if ($cadastro->rowCount() == 1) {
                echo "<script>alert('Cadastro realizado com sucesso!!!');history.go(-1);</script>";
            } else {
                echo "<script>alert('Erro ao cadastrar');history.go(-1);</script>";
            }     
        }
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}
