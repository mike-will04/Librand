<?php
    include "../conexao.php";
    session_start();

    if (isset($_SESSION['iduser'])) {
        $id_usuario = $_SESSION['iduser'];
        $tipo = $_SESSION['tipo'];
    } else {
        $_SESSION['logado'] = false;
        echo "<script>alert('Faça Login para se candidatar a vaga');location = '../../html/login_usuario.html'</script>";
    }

    if ($tipo == "empresa"){
        echo "<script>alert('Entre como candidato para se candidatar a vaga');location = '../../html/login_usuario.html'</script>";
    }

    $id_usuario = $_SESSION['iduser'];
    $id_vaga = $_GET['id_vaga'];

    $check = $conn->prepare(
        'SELECT count(*) as count FROM candidato_vaga WHERE id_vaga = :id_vaga and id_usuario = :id_usuario'
    );
    $check->execute(array(
        ':id_vaga' => $id_vaga,
        ':id_usuario' => $id_usuario
    ));

    if ($tipo == "candidato") {
        foreach ($check as $linha) {
            try {
                if ($linha['count'] >= 1) {
                    echo "<script>alert('Usuário já se candidatou nessa vaga.');history.go(-1)</script>";
                } else {
                    $cadastro = $conn->prepare('INSERT INTO candidato_vaga (id_vaga, id_usuario) VALUES 
                    (:id_vaga, :id_usuario)');
        
                    $cadastro->execute(array(
                        ':id_vaga' => $id_vaga,
                        ':id_usuario' => $id_usuario
                    ));
        
                    if ($cadastro->rowCount() == 1) {
                        echo "<script>alert('Candidatou-se com sucesso!');history.go(-1)</script>";
                    } else {
                        echo "<script>alert('Erro ao se candidatar na vaga.');history.go(-1)</script>";
                    }
                }
            } catch (PDOException $e) {
                echo 'ERROR: ' . $e->getMessage();
            }
        }
    }
?>