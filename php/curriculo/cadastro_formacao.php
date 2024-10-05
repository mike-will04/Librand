<?php
include "../conexao.php";

session_start();

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
$id_usuario = $_SESSION['iduser'];
$redirectPage = $_POST['redirect'];

$check = $conn->prepare(
    'SELECT count(*) as count FROM formacao WHERE id_usuario = :id_usuario'
);
$check->execute(array(
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
            $_SESSION['message'] = 'Formação adicionada com sucesso!';
        } else {
            echo "<script>alert('Erro ao adicionar formação.');history.go(-1)</script>";
        }
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}

header("Location: $redirectPage");
exit();
