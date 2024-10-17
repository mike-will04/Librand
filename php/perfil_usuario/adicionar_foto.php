<?php
include "../conexao.php";

session_start();

$dir = '../../img/foto perfil/';
$tmpName = $_FILES['image']['tmp_name']; 
$name = $_FILES['image']['name'];
$id_usuario = $_SESSION['iduser'];

$check = $conn->prepare(
    'SELECT count(*) as count FROM usuario WHERE id_usuario = :id_usuario'
);
$check->execute(array(
    ':id_usuario' => $id_usuario,
));

foreach ($check as $linha) {
    try {
        if (move_uploaded_file( $tmpName, $dir . $name )){
            $foto = $conn->prepare('UPDATE usuario set foto_perfil = :foto_perfil where id_usuario = :id_usuario');

            $foto->execute(array(
                ':foto_perfil' => $name,
                ':id_usuario' => $id_usuario
            ));

            if ($foto->rowCount() == 1) {
                echo "<script>alert('Cadastro realizado com sucesso!!!');history.go(-1)</script>";
            } else {
                echo "<script>alert('Erro ao cadastrar');history.go(-1)</script>";
            }
        } else {
                echo "<script>alert('Erro ao salvar a foto de perfil.');history.go(-1)</script>";
        } 
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}
