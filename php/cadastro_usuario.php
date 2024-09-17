<?php
include "conexao.php";

$usuario = $_POST["usuario"];
$email = $_POST["email"];
$senha = $_POST["senha"];
$termos = $_POST["termos"];
$receber_email = $_POST["receber_email"];

$check = $conn->prepare(
    'SELECT count(*) as count FROM usuario WHERE usuario = :usuario or email = :email'
);
$check -> execute(array(
    ':usuario' => $usuario,
    ':email' => $email
));

$senhahash = password_hash($senha,PASSWORD_DEFAULT);

if (($usuario == "") || ($email == "") || ($senha == "") || ($termos == "")) {
    echo "<script>alert('Campos nao podem ser vazios!!!');history.go(-1);</script>";
} else {
    foreach ($check as $linha) {
        try {
            if ($linha['count'] >= 1) {
                echo "<script>alert('Nome de usuário ou email já cadastrado');history.go(-1)</script>";                
            }
            else {
                $cadastro = $conn->prepare('INSERT INTO usuario (usuario, senha, email, termos, receber_email) VALUES 
                (:usuario, :senha, :email, :termos, :receber_email)');
    
                $cadastro->execute(array(
                    ':usuario' => $usuario,
                    ':senha' => $senhahash,
                    ':email' => $email,
                    ':termos' => $termos,
                    ':receber_email' => $receber_email
                ));
    
                if ($cadastro->rowCount() == 1) {
                    echo "<script>alert('Cadastro realizado com sucesso!!!');location = '../login_usuario.html' </script>";
                } else {
                    echo "<script>alert('Erro ao cadastrar');history.go(-1)</script>";
                }     
            }
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }
}
