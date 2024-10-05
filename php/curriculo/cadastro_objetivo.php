<?php
include "../conexao.php";

session_start();

$CargoDeInteresse = $_POST["CargoDeInteresse"];
$PretencaoSalarial = isset($_POST["PretencaoSalarial"]) ? $_POST["PretencaoSalarial"] : null;
$id_usuario = $_SESSION['iduser'];
$redirectPage = $_POST['redirect'];

$check = $conn->prepare(
    'SELECT count(*) as count FROM objetivo WHERE id_usuario = :id_usuario'
);
$check->execute(array(
    ':id_usuario' => $id_usuario,
));

foreach ($check as $linha) {
    try {
        $cadastro = $conn->prepare('INSERT INTO objetivo (cargo_de_interesse, pretencao_salarial, id_usuario) VALUES 
            (:cargo_de_interesse, :pretencao_salarial, :id_usuario)');

        $cadastro->execute(array(
            ':cargo_de_interesse' => $CargoDeInteresse,
            ':pretencao_salarial' => $PretencaoSalarial,
            ':id_usuario' => $id_usuario
        ));

        if ($cadastro->rowCount() == 1) {
            $_SESSION['message'] = 'Objetivo adicionado com sucesso!';
        } else {
            echo "<script>alert('Erro ao cadastrar');history.go(-1);</script>";
        }
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}

header("Location: $redirectPage");
exit();
