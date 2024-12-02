<?php
include "../conexao.php";
session_start();

// Receber os dados do filtro
$data = json_decode(file_get_contents("php://input"), true);
$setores = $data['setores'] ?? [];
$senioridades = $data['senioridades'] ?? [];
$contratos = $data['contratos'] ?? [];
$modalidades = $data['modalidades'] ?? [];
$periodos = $data['periodos'] ?? [];


// Montar a query dinâmica
$query = "SELECT 
    se.nome_fantasia,
    v.*,
    u.foto_perfil
    FROM 
        sobre_empresa se
    INNER JOIN 
        vaga v ON se.id_usuario = v.id_usuario
    INNER JOIN 
        usuario u ON v.id_usuario = u.id_usuario WHERE 1=1";

$params = [];

// Adicionar condições para setor
if (!empty($setores)) {
    $placeholders = implode(',', array_fill(0, count($setores), '?'));
    $query .= " AND v.area IN ($placeholders)";
    $params = array_merge($params, $setores);
}

// Adicionar condições para senioridade
if (!empty($senioridades)) {
    $placeholders = implode(',', array_fill(0, count($senioridades), '?'));
    $query .= " AND v.senioridade IN ($placeholders)";
    $params = array_merge($params, $senioridades);
}

// Adicionar condições para contrato
if (!empty($contratos)) {
    $placeholders = implode(',', array_fill(0, count($contratos), '?'));
    $query .= " AND v.contrato IN ($placeholders)";
    $params = array_merge($params, $contratos);
}

// Adicionar condições para modalidade
if (!empty($modalidades)) {
    $placeholders = implode(',', array_fill(0, count($modalidades), '?'));
    $query .= " AND v.modalidade IN ($placeholders)";
    $params = array_merge($params, $modalidades);
}

// Adicionar condições para periodo
if (!empty($periodos)) {
    $placeholders = implode(',', array_fill(0, count($periodos), '?'));
    $query .= " AND v.periodo IN ($placeholders)";
    $params = array_merge($params, $periodos);
}

$stmt = $conn->prepare($query);
$stmt->execute($params);

// Gerar o HTML dos resultados
if ($stmt->rowCount() > 0) {
    foreach ($stmt as $linha) {
        echo "
        <div class='col-md-12 div_curriculo shadow rounded p-4 mb-4'>
                                <div class='row'>
                                    <h4>" . $linha['cargo'] . "</h4>
                                </div>
                                <div class='row'>
                                    <div class='col-md-6'>
                                        <b>" . $linha['nome_fantasia'] . "</b><br>
                                        <b>" . $linha['localizacao'] . "</b><br>
                                        <b>" . $linha['modalidade'] . "</b>
                                    </div>
                                    <div class='col-md-6'>
                                        <p>" . $linha['salario'] . "</p>
                                    </div>
                                </div>
                                <div class='row mt-2'>
                                        <p style='text-align: justify;'>" . $linha['descricao'] . "</p>
                                </div>
                                <div class='row'>
                                    <button class='btn-empresa' data-bs-toggle='modal' data-bs-target='#modalIdioma" . $linha['id_vaga'] . "'>Ver mais</button>
                                </div>
                                <!-- The Modal -->
                                <div class='modal fad' id='modalIdioma" . $linha['id_vaga'] . "' tabindex='-1' aria-labelledby='modalIdiomaLabel' aria-hidden='true'>
                                    <div class='modal-dialog modal-lg'>
                                        <div class='modal-content'>
                                            <!-- Modal Header -->
                                            <div class='modal-header'>
                                                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                            </div>

                                            <!-- Modal body -->
                                            <div class='modal-body p-5'>
                                                <div class='row'>
                                                    <div class='col-md-6'>
                                                        <h3>" . $linha['titulo'] . "</h3>
                                                        <h5>" . $linha['localizacao'] . "</h5>
                                                        <h5>" . $linha['salario'] . "</h5>
                                                        <div class='d-flex justify-content-center align-items-center'>
                                                            <button class='btn-vaga'>Candidatar-se</button>
                                                        </div>
                                                    </div>
                                                    <div class='col-md-6 d-flex justify-content-center'>
                                                        <img src='../../img/foto perfil/" . $linha['foto_perfil'] . "' alt='Logo Empresa' height='200px'>
                                                    </div>
                                                    <hr class='mt-4 mb-4'>
                                                </div>
                                                <div class='row'>
                                                    <div class='col-md-12'>
                                                        <p><b>Cargo:</b> " . $linha['cargo'] . "</p>
                                                        <p><b>Especialização:</b> " . $linha['especializacao'] . "</p>
                                                        <p><b>Senioridade:</b> " . $linha['senioridade'] . "</p>
                                                        <p><b>Quantidade de Vagas:</b> " . $linha['numero_vagas'] . "</p>
                                                        <p><b>Contrato:</b> " . $linha['contrato'] . "</p>
                                                        <p><b>Modalidade:</b> " . $linha['modalidade'] . "</p>
                                                        <p><b>Período:</b> " . $linha['periodo'] . "</p>
                                                        <p><b>Escolaridade Necessária:</b> " . $linha['escolaridade'] . "</p>
                                                        <p><b>Setor:</b> " . $linha['area'] . "</p>
                                                        <p style='text-align: justify;'><b>Descrição da Vaga:</b> " . $linha['descricao'] . "</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
        ";
    }
} else {
    echo "
    <div class='col-md-12 div_curriculo shadow rounded p-4 mb-4'>
        <p>Nenhuma vaga encontrada!</p>
    </div>";
}
