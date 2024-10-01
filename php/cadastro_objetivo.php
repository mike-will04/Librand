<?php
include "conexao.php";

session_start();

$CargoDeInteresse = $_POST["CargoDeInteresse"];
$PretencaoSalarial = $_POST["PretencaoSalarial"];
$id_usuario = $_SESSION['iduser'];

$check = $conn->prepare(
    'SELECT count(*) as count FROM objetivo WHERE id_usuario = :id_usuario'
);
$check -> execute(array(
    ':id_usuario' => $id_usuario,
));

echo $id_usuario;

if (($CargoDeInteresse == "") || ($PretencaoSalarial == "")) {
    echo "<script>alert('Campos nao podem ser vazios!!!');history.go(-1);</script>";
} else {
    foreach ($check as $linha) {
        try {
            if ($linha['count'] >= 1) {
                echo "<script>alert('Objetivo já cadastrado');history.go(-1);</script>";                
            }
            else {
                $cadastro = $conn->prepare('INSERT INTO objetivo (cargo_de_interesse, pretencao_salarial, id_usuario) VALUES 
                (:cargo_de_interesse, :pretencao_salarial, :id_usuario)');
    
                $cadastro->execute(array(
                    ':cargo_de_interesse' => $CargoDeInteresse,
                    ':pretencao_salarial' => $PretencaoSalarial,
                    ':id_usuario' => $id_usuario
                ));
    
                if ($cadastro->rowCount() == 1) {
                    echo "<script>alert('Cadastro realizado com sucesso!!!');history.go(-1);</script>";
                } else {
                    echo "<script>alert('Erro ao cadastrar');history.go(-1);</script>";
                }     
            }
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }
}
