<?php
include "../conexao.php";
session_start();

// Receber os dados do filtro
$data = json_decode(file_get_contents("php://input"), true);
$localizacoes = $data['localizacoes'] ?? [];
$setores = $data['setores'] ?? [];
$portes = $data['portes'] ?? [];

// Montar a query dinâmica
$query = "SELECT s.*, u.foto_perfil FROM sobre_empresa s 
          JOIN usuario u ON s.id_usuario = u.id_usuario WHERE 1=1";

$params = [];

// Adicionar condições para localização
if (!empty($localizacoes)) {
    $placeholders = implode(',', array_fill(0, count($localizacoes), '?'));
    $query .= " AND s.estado IN ($placeholders)";
    $params = array_merge($params, $localizacoes);
}

// Adicionar condições para setor
if (!empty($setores)) {
    $placeholders = implode(',', array_fill(0, count($setores), '?'));
    $query .= " AND s.setor IN ($placeholders)";
    $params = array_merge($params, $setores);
}

// Adicionar condições para setor
if (!empty($portes)) {
    $placeholders = implode(',', array_fill(0, count($portes), '?'));
    $query .= " AND s.porte IN ($placeholders)";
    $params = array_merge($params, $portes);
}

$stmt = $conn->prepare($query);
$stmt->execute($params);

// Gerar o HTML dos resultados
if ($stmt->rowCount() > 0) {
    foreach ($stmt as $linha) {
        echo "
            <div class='col-md-12 div_curriculo shadow rounded p-4 mb-4'>
                <div class='row'>
                    <div class='col-md-2 d-flex justify-content-center align-items-center'>
                        <img src='../../img/foto perfil/" . $linha['foto_perfil'] . "' alt='logo empresa' height='100px'>
                    </div>
                    <div class='col-md-10 align-items-center'>
                        <h4>" . $linha['nome_fantasia'] . "</h4>
                        <p class='mt-1'>" . $linha['setor'] . "</p>
                        <p class='mt-1' style='text-align: justify;'>" . $linha['descricao'] . "</p>
                    </div>
                </div>
                <div class='row'>
                    <div class='d-flex justify-content-end'>
                        <a href='../perfil_empresa/perfil_empresa_publico.php?id=" . $linha['id_usuario'] . "'>
                            <button class='btn-empresa'>Acessar</button>
                        </a>
                    </div>
                </div>
            </div>
        ";
    }
} else {
    echo "
    <div class='col-md-12 div_curriculo shadow rounded p-4 mb-4'>
        <p>Nenhuma empresa encontrada!</p>
    </div>";
}
?>
