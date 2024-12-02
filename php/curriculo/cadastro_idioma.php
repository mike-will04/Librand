<?php
include "../conexao.php";

session_start();

$Idioma = isset($_POST["Idioma"]) ? $_POST["Idioma"] : null;
$Proficiencia = isset($_POST["Proficiencia"]) ? $_POST["Proficiencia"] : null;
$id_usuario = $_SESSION['iduser'];
$redirectPage = $_POST['redirect'];

$check = $conn->prepare(
    'SELECT count(*) as count FROM idioma WHERE id_usuario = :id_usuario'
);
$check->execute(array(
    ':id_usuario' => $id_usuario,
));

foreach ($check as $linha) {
    try {
        $cadastro = $conn->prepare('INSERT INTO idioma (idioma, proficiencia, id_usuario) VALUES 
        (:idioma, :proficiencia, :id_usuario)');
        $cadastro->execute(array(
            ':idioma' => $Idioma,
            ':proficiencia' => $Proficiencia,
            ':id_usuario' => $id_usuario
        ));
        if ($cadastro->rowCount() == 1) {
            $_SESSION['message'] = 'Idioma adicionado com sucesso!';
        } else {
            $_SESSION['message'] = 'Erro ao adicionar idioma.';
            echo "<script>alert('Erro ao adicionar idioma.');history.go(-1)</script>";
        }
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}

header("Location: $redirectPage");
exit();
