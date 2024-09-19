<?php
include "conexao.php";
session_start();

$usuario = $_POST['usuario'];
$email = $_POST['email'];
$senha = $_POST['senha'];


$check = $conn->prepare(
    'SELECT count(*) as count FROM usuario WHERE usuario = :usuario and email = :email'
);
$check->execute(array(
    ':usuario' => $usuario,
    ':email' => $email
));

$check1 = $conn->prepare(
    'SELECT * FROM usuario WHERE usuario = :usuario and email = :email'
);
$check1->execute(array(
    ':usuario' => $usuario,
    ':email' => $email
));

if (($usuario == "") || ($senha == "") || ($email = "")) {
    echo "<script>alert('Campos nao podem ser vazios!!!');history.go(-1);</script>";
} else {
    foreach ($check as $linha) {
        if ($linha['count'] >= 1) {
            foreach ($check1 as $linha1) {
                if (password_verify($senha, $linha1['senha'])) {
                    $_SESSION['logado'] = true;
                    $_SESSION['iduser'] = $linha1['id_usuario'];
                    echo "<script>alert('Logado com sucesso!!!');location = 'index.php' </script>";
                } else {
                    echo "<script>alert('Senha inválida');history.go(-1);</script>";
                }
            }
        } else {
            echo "<script>alert('Usuário ou email incorreto');history.go(-1);</script>";
        }
    }
}
