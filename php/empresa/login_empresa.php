<?php
include "../conexao.php";
session_start();

$empresa = $_POST['empresa'];
$senha = $_POST['senha'];


$check = $conn->prepare(
    'SELECT count(*) as count FROM usuario WHERE usuario = :usuario or email = :usuario'
);
$check->execute(array(
    ':usuario' => $empresa,
));

$check1 = $conn->prepare(
    'SELECT * FROM usuario WHERE usuario = :usuario or email = :usuario'
);
$check1->execute(array(
    ':usuario' => $empresa,
));

foreach ($check as $linha) {
    if ($linha['count'] >= 1) {
        foreach ($check1 as $linha1) {
            if ($linha1['tipo'] == 'e') {
                if (password_verify($senha, $linha1['senha'])) {
                    $_SESSION['logado'] = true;
                    $_SESSION['iduser'] = $linha1['id_usuario'];
                    $_SESSION['tipo'] = "empresa";
                    echo "<script>alert('Logado com sucesso!!!');location = '../index_empresa.php' </script>";
                } else {
                    echo "<script>alert('Senha inválida');history.go(-1);</script>";
                }
            } else {
                echo "<script>alert('Dados de candidato identificado');history.go(-1);</script>";
            }
            }
    } else {
        echo "<script>alert('Nome da empresa ou email incorreto');history.go(-1);</script>";
    }
}
