<?php
    include "../conexao.php";

    if (isset($_GET['id_vaga'])) {
        $id_vaga = $_GET['id_vaga'];
    
        $candidatos = $conn->prepare(
            'SELECT u.usuario, u.id_usuario 
            FROM candidato_vaga cv 
            JOIN usuario u ON cv.id_usuario = u.id_usuario 
            WHERE cv.id_vaga = :id_vaga'
        );
        $candidatos->bindParam(':id_vaga', $id_vaga, PDO::PARAM_INT);
        $candidatos->execute();
    
        while ($linha = $candidatos->fetch(PDO::FETCH_ASSOC)) {
            echo '<div class="row div_curriculo shadow rounded p-4 mb-4">';
            echo '<div class="col-md-6"><p>' . htmlspecialchars($linha['usuario']) . '</p></div>';
            echo '<div class="col-md-6 d-flex justify-content-end">';
            echo '<a href="../perfil_usuario/perfil_usuario_publico.php?id=' . htmlspecialchars($linha['id_usuario']) . '">';
            echo '<button class="btn-empresa">Ver perfil</button></a></div></div>';
        }
    } else {
        echo "ID da vaga não especificado.";
    }    
?>