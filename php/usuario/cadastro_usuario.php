<?php
include "../conexao.php";

$usuario = $_POST["usuario"];
$email = $_POST["email"];
$senha = $_POST["senha"];
$termos = isset($_POST["termos"]) ? 1 : 0;
$receber_email = isset($_POST["receber_email"]) ? 1 : 0;

$check = $conn->prepare(
    'SELECT count(*) as count FROM usuario WHERE usuario = :usuario or email = :email'
);
$check->execute(array(
    ':usuario' => $usuario,
    ':email' => $email
));

$senhahash = password_hash($senha, PASSWORD_DEFAULT);

foreach ($check as $linha) {
    try {
        if ($linha['count'] >= 1) {
            echo "<script>alert('Nome de usuário ou email já cadastrado');history.go(-1)</script>";
        } else {
            $cadastro = $conn->prepare('INSERT INTO usuario (usuario, senha, email, termos, receber_email, tipo) VALUES 
            (:usuario, :senha, :email, :termos, :receber_email , "c")');

            $cadastro->execute(array(
                ':usuario' => $usuario,
                ':senha' => $senhahash,
                ':email' => $email,
                ':termos' => $termos,
                ':receber_email' => $receber_email
            ));

            if ($cadastro->rowCount() == 1) {
                echo "<script>alert('Cadastro realizado com sucesso!!!');location = '../../html/login_usuario.html'</script>";
            } else {
                echo "<script>alert('Erro ao cadastrar');history.go(-1)</script>";
            }
        }
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}
