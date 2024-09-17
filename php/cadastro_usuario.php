<?php
include "conexao.php";

$usuario = $_POST["usuario"];
$email = $_POST["email"];
$senha = $_POST["senha"];

$check = $conn->prepare(
    'SELECT count(*) as count FROM usuario WHERE usuario = :usuario or email = :email'
);
$check -> execute(array(
    ':usuario' => $usuario,
    ':email' => $email
));

$senhahash = password_hash($senha,PASSWORD_DEFAULT);

if (($usuario == "") || ($email == "") || ($senha == "")) {
    echo "<script>alert('Campos nao podem ser vazios!!!');history.go(-1);</script>";
} else {
    foreach ($check as $linha) {
        try {
            if ($linha['count'] >= 1) {
                echo "<script>alert('Nome de usuário ou email já cadastrado');history.go(-1)</script>";                
            }
            else {
                $cadastro = $conn->prepare('INSERT INTO usuario (usuario, senha, email) VALUES 
                (:usuario, :senha, :email)');
    
                $cadastro->execute(array(
                    ':usuario' => $usuario,
                    ':senha' => $senhahash,
                    ':email' => $email
                ));
    
                if ($cadastro->rowCount() == 1) {
                    echo "<script>alert('Cadastro realizado com sucesso!!!');location = '../html/login.html' </script>";
                } else {
                    echo "<script>alert('Erro ao cadastrar');history.go(-1)</script>";
                }     
            }
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }
}
