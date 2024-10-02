<?php
include "conexao.php";

session_start();

$Pais = $_POST["Pais"];
$Estado = isset($_POST["Estado"]) ? $_POST["Estado"] : null;
$Nivel = isset($_POST["Nivel"]) ? $_POST["Nivel"] : null;
$Instituicao = $_POST["Instituicao"];
$Curso = isset($_POST["Curso"]) ? $_POST["Curso"] : null;
$Status = isset($_POST["Status"]) ? $_POST["Status"] : null;
$Campus = isset($_POST["Campus"]) ? $_POST["Campus"] : null;
$InicioFormacao = $_POST["InicioFormacao"];
$FimFormacao = $_POST["FimFormacao"];
$Turno = isset($_POST["Turno"]) ? $_POST["Turno"] : null;
$id_usuario = $_SESSION['iduser'];

$check = $conn->prepare(
    'SELECT count(*) as count FROM formacao WHERE id_usuario = :id_usuario'
);
$check -> execute(array(
    ':id_usuario' => $id_usuario,
));

foreach ($check as $linha) {
    try {
        $cadastro = $conn->prepare('INSERT INTO formacao (pais, estado, nivel, instituicao, curso, status, campus, inicio, conclusao, turno, id_usuario) VALUES 
        (:pais, :estado, :nivel, :instituicao, :curso, :status, :campus, :inicio, :conclusao, :turno, :id_usuario)');
        $cadastro->execute(array(
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
            ':id_usuario' => $id_usuario
        ));
        if ($cadastro->rowCount() == 1) {
            echo "<script>alert('Cadastro realizado com sucesso!!!');history.go(-1)</script>";
        } else {
            echo "<script>alert('Erro ao cadastrar');history.go(-1)</script>";
        }     
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}
