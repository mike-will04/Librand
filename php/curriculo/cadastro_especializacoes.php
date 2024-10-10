<?php
include "../conexao.php";

session_start();

$Pais = $_POST["Pais"];
$Categoria = isset($_POST["Categoria"]) ? $_POST["Categoria"] : null;
$Organizacao = $_POST["Organizacao"];
$InicioExperiencia = $_POST["InicioExperiencia"];
$FimExperiencia = $_POST["FimExperiencia"];
$ResponsabilidadesExperiencia = $_POST["ResponsabilidadesExperiencia"];
$id_usuario = $_SESSION['iduser'];
$redirectPage = $_POST['redirect'];

$check = $conn->prepare(
    'SELECT count(*) as count FROM especializacoes WHERE id_usuario = :id_usuario'
);
$check->execute(array(
    ':id_usuario' => $id_usuario,
));

foreach ($check as $linha) {
    try {
        $cadastro = $conn->prepare('INSERT INTO especializacoes (pais, categoria, organizacao, inicio, final, responsabilidades, id_usuario) VALUES 
        (:pais, :categoria, :organizacao, :inicio, :final, :responsabilidades, :id_usuario)');
        $cadastro->execute(array(
            ':pais' => $Pais,
            ':categoria' => $Categoria,
            ':organizacao' => $Organizacao,
            ':inicio' => $InicioExperiencia,
            ':final' => $FimExperiencia,
            ':responsabilidades' => $ResponsabilidadesExperiencia,
            ':id_usuario' => $id_usuario
        ));
        if ($cadastro->rowCount() == 1) {
            $_SESSION['message'] = 'Especialização adicionada com sucesso!';
        } else {
            echo "<script>alert('Erro ao adicionar especialização.');history.go(-1)</script>";
        }
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}

header("Location: $redirectPage");
exit();
