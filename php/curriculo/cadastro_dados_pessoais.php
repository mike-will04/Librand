<?php
include "../conexao.php";

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
$redirectPage = $_POST['redirect'];
$id_usuario = $_SESSION['iduser'];

$check = $conn->prepare(
    'SELECT count(*) as count FROM dados_pessoais WHERE id_usuario = :id_usuario'
);
$check->execute(array(
    ':id_usuario' => $id_usuario,
));

foreach ($check as $linha) {
    try {
        if ($linha['count'] >= 1) {
            echo "<script>alert('Dados já cadastrados');history.go(-1)</script>";
        } else {
            $cadastro = $conn->prepare('INSERT INTO dados_pessoais (nome, sobrenome, nome_social, pais, cpf, celular, data, raca, estado_civil, estrangeiro, possui_deficiencia, deficiencia, laudo, suporte, renda_pessoal, renda_familiar, cep, rua, numero, complemento, bairro, estado, cidade, comentario, video, id_usuario) VALUES 
            (:nome, :sobrenome, :nome_social, :pais, :cpf, :celular, :data, :raca, :estado_civil, :estrangeiro, :possui_deficiencia, :deficiencia, :laudo, :suporte, :renda_pessoal, :renda_familiar, :cep, :rua, :numero, :complemento, :bairro, :estado, :cidade, :comentario, :video, :id_usuario)');

            $cadastro->execute(array(
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
                ':id_usuario' => $id_usuario
            ));

            if ($cadastro->rowCount() == 1) {
                $_SESSION['message'] = 'Dados pessoais adicionado com sucesso!';
            } else {
                echo "<script>alert('Erro ao adicionar dados pessoais.');history.go(-1)</script>";
            }
        }
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}

header("Location: $redirectPage");
exit();
