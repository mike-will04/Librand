<!DOCTYPE html>
<html lang="pt-br">
<?php
include "../conexao.php";
session_start();

if (isset($_SESSION['iduser'])) {
    $id = $_SESSION['iduser'];
    $tipo = $_SESSION['tipo'];
    $check = $conn->prepare(
        'SELECT * FROM usuario WHERE id_usuario = :id'
    );
    $check->execute(array(
        ':id' => $id
    ));
} else {
    $_SESSION['logado'] = false;
    echo "<script>alert('Faça login para acessar suas vagas');location = '../../html/login_empresa.html'</script>";
}

if ($tipo == "candidato") {
    echo "<script>alert('Entre como candidato para acessar suas vagas');location = '../../html/login_empresa.html'</script>";
}

$dados = $conn->prepare(
    'SELECT
        se.nome_fantasia, 
        v.* 
    FROM 
        vaga v
    INNER JOIN 
        usuario u ON v.id_usuario = u.id_usuario
    INNER JOIN 
        sobre_empresa se ON u.id_usuario = se.id_usuario
    WHERE 
        v.id_usuario = :id_usuario'
);
$dados->execute(array(
    ':id_usuario' => $id
));

$count = $conn->prepare(
    'SELECT count(*) as count FROM vaga where id_usuario = :id_usuario;'
);
$count->execute(array(
    ':id_usuario' => $id
));

if (isset($_SESSION['message'])) {
    echo "<script>alert('{$_SESSION['message']}');</script>";
    unset($_SESSION['message']);
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Librand</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="shortcut icon" type="imagex/png" href="../../img/Logotipo_Libras_Inclusão_Azul-removebg-preview.png">
    <link rel="stylesheet" href="../../css/vagas_ativas.css">
    <link rel="stylesheet" href="../../css/header.css">
</head>

<body class="d-flex flex-column min-vh-100">
    <nav class="navbar navbar-expand-sm" style="background-color: #2259BC;">
        <div class="container-fluid">
            <a href="../index.php" class="navbar-brand d-flex">
                <img src="../../img/Logotipo Librand.png" alt="Logo Librand" style="width: 100px;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="menuNavbar">
                <div class="navbar-nav ms-auto align-items-center" style='text-align: center;'>
                    <?php
                    if (isset($tipo) and $tipo == "empresa") {
                        echo "
                            <a href='vagas_ativas.php' class='nav-link' >
                                Vagas Ativas
                            </a>
                            <a href='../vaga/formulario_vaga.php' class='nav-link'>
                                Anunciar Vaga
                            </a>  
                            <a href='../index_empresa.php' class='nav-link'>
                                Empresas
                            </a>
                        ";
                    }
                    if ((isset($_SESSION['logado']) and $_SESSION['logado'] == true) and (isset($tipo) and $tipo == "empresa")) {
                        foreach ($check as $linha) {
                            if ($linha['foto_perfil'] == null) {
                                echo "
                                    <div class='d-inline-flex align-items-center' style='margin-right: 10px; margin-left: 10px; cursor: pointer;'  onclick='perfil()'>
                                    <img src='../../img/foto perfil/user.png' alt='Foto Perfil' id='btn-perfil' style='width: 50px; height: 50px;'/><p style='color: white; margin-bottom: 0; margin-right: 5px; margin-left: 5px;'>" . $linha['usuario'] . "</p><i class='bi bi-chevron-down' style='color: white'></i></div>";
                                echo "<div class='card' id='carde' style='display: none;'>
                                        <a href='../empresa/info_empresa.php' style='display: block;'>Completar cadastro empresa</a>
                                        <a href='../perfil_empresa/perfil_empresa.php' style='display: block;'>Perfil</a>
                                        <a href='../sair.php' style='display: block;' class='card1'>Sair</a>
                                    </div>
                                    ";
                            } else {
                                echo "
                                    <div class='d-inline-flex align-items-center' style='margin-right: 10px; margin-left: 10px; cursor: pointer;'  onclick='perfil()'>
                                    <img src='../../img/foto perfil/" . $linha['foto_perfil'] .  "' alt='Foto Perfil' id='btn-perfil' style='width: 50px; height: 50px; border: 1px solid white; border-radius: 50%;'/><p style='color: white; margin-bottom: 0; margin-right: 5px; margin-left: 5px;'>" . $linha['usuario'] . "</p><i class='bi bi-chevron-down' style='color: white'></i></div>";
                                echo "<div class='card' id='carde' style='display: none;'>
                                        <a href='../empresa/info_empresa.php' style='display: block;'>Completar Cadastro Empresa</a>
                                        <a href='../perfil_empresa/perfil_empresa.php' style='display: block;'>Perfil</a>
                                        <a href='../sair.php' style='display: block;' class='card1'>Sair</a>
                                    </div>
                                    ";
                            }
                        }
                    } else {
                        echo "
                                <a href='../../html/login_empresa.html' class='nav-link'>
                                    Login
                                </a>
                                <a href='../../html/cadastro_empresa.html'>
                                    <button class='btn-header' style='margin: 0px 10px 0px 10px;'>
                                        Cadastrar-se
                                    </button>
                                </a>
                            ";
                    }
                    ?>
                </div>
            </div>
        </div>
    </nav>

    <main class="flex-grow-1">
        <?php
        if ((isset($_SESSION['logado']) and $_SESSION['logado'] == true)) {
            // Tabelas que precisam ser verificadas
            $tabelas = ['dados_pessoais', 'experiencia', 'formacao', 'objetivo', 'idioma', 'especializacoes'];

            $mostrarHTML = false;

            // Verificar número de registros na tabela
            try {
                $sql = "SELECT COUNT(*) as total FROM sobre_empresa WHERE id_usuario = :id_usuario";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':id_usuario', $id, PDO::PARAM_INT);
                $stmt->execute();
                $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($resultado['total'] == 0) {
                    $mostrarHTML = true;
                }
            } catch (PDOException $e) {
                echo "Erro ao consultar a tabela sobre_empresa: " . $e->getMessage() . "<br>";
            }

            // Exibir o HTML se necessário
            if ($mostrarHTML) {
                echo '
                    <div class="container-fluid">
                        <div class="row p-2">
                            <div class="col-12 d-inline-flex align-items-center justify-content-center">
                                <h5 style="color: #2259BC; font-weight: bold;" class="mx-2">Vamos concluir o seu perfil da sua empresa?</h5>
                                <a href="../empresa/info_empresa.php">
                                    <button class="btn-notificacao">Clique aqui</button>
                                </a>
                            </div>
                        </div>
                    </div>';
            }
        }
        ?>

        <div class="container-fluid p-5">
            <div class="row mb-2">
                <div class="col-md-12">
                    <?php
                    foreach ($count as $linha) {
                        echo "<h1>Vaga Ativas(" . $linha['count'] . ")</h1>";
                    }
                    ?>
                </div>
            </div>
            <div class="col-md-12 mb-4" id="resultados-vagas">
                <?php
                $setor = ["Administração", "Agricultura, Pecuária, Veterinária", "Alimentação / Gastronomia", "Arquitetura, Decoração, Design", "Artes", "Auditoria", "Ciências", "Comercial", "Comunicação", "Construção", "Contábil", "Cultura", "Educação", "Engenharia", "Industrial", "Informática", "Jurídica", "Logística", "Marketing", "Moda", "Qualidade", "Recursos Humanos", "Saúde", "Segurança", "Serviço Social e Comunitário", "Serviços Gerais", "Telemarketing", "Transportes"];
                $senioridade = ["Estagiário", "Operacional", "Auxiliar", "Assistente", "Treinee", "Analista", "Encarregado", "Supervisor", "Consultor", "Especialista", "Coordenador", "Gerente", "Diretor"];
                $contrato = ["CLT", "Autônomo", "Prestador de Serviço (PJ)", "Cooperado", "Jovem Aprendiz", "Estágio", "Temporário", "Trainee", "Outros"];
                $modalidade = ["Presencial", "Home Office", "Híbrido"];
                $periodo = ["Período Integral", "Parcial Manhãs", "Parcial Tardes", "Parcial Noites", "Noturno"];

                if ($dados->rowCount() > 0) {
                    foreach ($dados as $linha) {
                ?>
                        <div class="col-md-12 div_curriculo shadow rounded p-4 mb-4">
                            <div class="row">
                                <?php
                                echo "<h4>" . $linha['cargo'] . "</h4>"
                                ?>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <?php
                                    echo "<b>" . $linha['nome_fantasia'] . "</b><br>";
                                    echo "<b>" . $linha['localizacao'] . "</b><br>";
                                    echo "<b>" . $linha['modalidade'] . "</b>";
                                    ?>
                                </div>
                                <div class="col-md-6">
                                    <?php
                                    echo "<p>" . $linha['salario'] . "</p>";
                                    ?>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <?php
                                echo "<p style='text-align: justify;'>" . $linha['descricao'] . "</p>";
                                ?>
                            </div>
                            <div class="row">
                                <div class="col-md-2 d-flex justify-content-center">
                                    <button class='btn-empresa' data-bs-toggle="modal" data-bs-target="#modaleditar<?php echo $linha['id_vaga']; ?>">Editar</button>
                                </div>
                                <div class="col-md-2 d-flex justify-content-center">
                                    <button class='btn-empresa' data-bs-toggle="modal" data-bs-target="#modalcandidatos" data-id-vaga="<?php echo $linha['id_vaga']; ?>">Candidaturas</button>
                                </div>
                                <div class="col-md-2 d-flex justify-content-center">
                                    <button class='btn-empresa' onclick="deletarVaga(<?php echo $linha['id_vaga']; ?>)">Excluir</button>
                                </div>
                            </div>
                            <!-- The Modal -->
                            <div class="modal fade" id="modaleditar<?php echo $linha['id_vaga']; ?>" tabindex="-1" aria-labelledby="modaleditarLabel" aria-hidden="true">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">Editar Vaga</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>

                                        <!-- Modal body -->
                                        <div class="modal-body">
                                            <form action="alterar_vaga.php" method="post">
                                                <input type="hidden" name="id" value="<?php echo $linha['id_vaga'] ?>">
                                                <!-- Titulo da Vaga -->
                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <label for="Título da Vaga" class="form-label">* Título da Vaga:</label>
                                                        <input type="text" class="form-control" placeholder="Título da Vaga" name="Titulo_Vaga" value="<?php echo $linha['titulo'] ?>" required>
                                                    </div>
                                                </div>
                                                <hr>
                                                <h5>Informações basicas</h5>
                                                <!-- Área,  Cargo -->
                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <label for="Area" class="form-label">* Área:</label>
                                                        <select name="Area" id="Area" class="form-select" required>
                                                            <option value="" disabled selected>Selecione</option>
                                                            <?php
                                                            for ($cont = 0; $cont < 28; $cont++)
                                                                if ($linha['area'] == $setor[$cont]) {
                                                                    echo "<option value='$setor[$cont]' selected> $setor[$cont]</option>";
                                                                } else {
                                                                    echo "<option value='$setor[$cont]'> $setor[$cont]</option>";
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="Cargo" class="form-label">* Cargo:</label>
                                                        <input type="text" class="form-control" placeholder="Cargo" name="Cargo" value="<?php echo $linha['cargo'] ?>" required>
                                                    </div>
                                                </div>
                                                <!-- Especialização, Senioridade -->
                                                <div class="row mt-3">
                                                    <div class="form-group col-md-6">
                                                        <label for="Especializacao" class="form-label">* Especialização:</label>
                                                        <input type="text" class="form-control" placeholder="Especialização" name="Especializacao" value="<?php echo $linha['especializacao'] ?>" required>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="Senioridade" class="form-label">* Senioridade:</label>
                                                        <select name="Senioridade" class="form-select" required>
                                                            <option value="" disabled selected>Selecione</option>
                                                            <?php
                                                            for ($cont = 0; $cont < 13; $cont++)
                                                                if ($linha['senioridade'] == $senioridade[$cont]) {
                                                                    echo "<option value='$senioridade[$cont]' selected> $senioridade[$cont]</option>";
                                                                } else {
                                                                    echo "<option value='$senioridade[$cont]'> $senioridade[$cont]</option>";
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <!-- Quantidade de Vaga -->
                                                <div class="row mt-3">
                                                    <div class="form-group col-md-2 mt-3">
                                                        <label for="Quantidade_Vagas" class="form-label">*Quantidade de Vagas:</label>
                                                    </div>
                                                    <div class="form-group col-md-3 mt-3">
                                                        <input type="number" class="form-control" placeholder="Quantidade de Vagas" name="Quantidade_Vagas" value="<?php echo $linha['numero_vagas'] ?>" required>
                                                    </div>
                                                </div>
                                                <!-- Contrato, Modalidade -->
                                                <div class="row mt-3">
                                                    <div class="form-group col-md-6">
                                                        <label for="Contrato" class="form-label">* Contrato:</label>
                                                        <select name="Contrato" class="form-select" required>
                                                            <option value="" disabled selected>Selecione</option>
                                                            <?php
                                                            for ($cont = 0; $cont < 9; $cont++)
                                                                if ($linha['contrato'] == $contrato[$cont]) {
                                                                    echo "<option value='$contrato[$cont]' selected> $contrato[$cont]</option>";
                                                                } else {
                                                                    echo "<option value='$contrato[$cont]'> $contrato[$cont]</option>";
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="Modalidade" class="form-label">* Modalidade:</label>
                                                        <select name="Modalidade" class="form-select" required>
                                                            <option value="" disabled selected>Selecione</option>
                                                            <?php
                                                            for ($cont = 0; $cont < 3; $cont++)
                                                                if ($linha['modalidade'] == $modalidade[$cont]) {
                                                                    echo "<option value='$modalidade[$cont]' selected> $modalidade[$cont]</option>";
                                                                } else {
                                                                    echo "<option value='$modalidade[$cont]'> $modalidade[$cont]</option>";
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <!-- Período, Faixa Salarial -->
                                                <div class="row mt-3">
                                                    <div class="form-group col-md-6">
                                                        <label for="Período" class="form-label">* Período:</label>
                                                        <select name="Periodo" class="form-select" required>
                                                            <option value="" disabled selected>Selecione</option>
                                                            <?php
                                                            for ($cont = 0; $cont < 5; $cont++)
                                                                if ($linha['periodo'] == $periodo[$cont]) {
                                                                    echo "<option value='$periodo[$cont]' selected> $periodo[$cont]</option>";
                                                                } else {
                                                                    echo "<option value='$periodo[$cont]'> $periodo[$cont]</option>";
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <!-- Período, Faixa Salarial -->
                                                    <div class="form-group col-md-6 mt-3">
                                                        <label for="Salario" class="form-label">* Faixa Salarial:</label>
                                                        <input type="text" class="form-control" id="salario_<?php echo $linha['id_vaga']; ?>"
                                                            placeholder="Faixa Salarial"
                                                            name="Salario"
                                                            value="<?php echo $linha['combinar'] == 1 ? 'Salário a combinar' : $linha['salario']; ?>"
                                                            <?php echo $linha['combinar'] == 1 ? 'disabled' : ''; ?> required>
                                                        <label for="Combinar" class="form-label">A combinar:</label>
                                                        <input type="checkbox" class="form-check-input" id="combinar_<?php echo $linha['id_vaga']; ?>"
                                                            name="Combinar"
                                                            <?php echo $linha['combinar'] == 1 ? 'checked' : ''; ?>>
                                                    </div>

                                                    <script>
                                                        // Função para verificar e ajustar os campos ao abrir o modal
                                                        document.addEventListener('DOMContentLoaded', function() {
                                                            const modals = document.querySelectorAll('.modal');

                                                            modals.forEach((modal) => {
                                                                modal.addEventListener('show.bs.modal', function(e) {
                                                                    const idVaga = e.target.getAttribute('id').replace('modaleditar', ''); // Extrai o ID da vaga
                                                                    const checkbox = document.getElementById(`combinar_${idVaga}`);
                                                                    const inputSalario = document.getElementById(`salario_${idVaga}`);

                                                                    // Atualiza o estado dos campos baseado no checkbox
                                                                    if (checkbox.checked) {
                                                                        inputSalario.value = 'Salário a combinar';
                                                                        inputSalario.disabled = true;
                                                                    } else {
                                                                        inputSalario.disabled = false;
                                                                        inputSalario.value = "<?php echo $linha['salario']; ?>";
                                                                    }

                                                                    // Adiciona o listener para alterações no checkbox
                                                                    checkbox.addEventListener('change', function() {
                                                                        if (this.checked) {
                                                                            inputSalario.value = 'Salário a combinar';
                                                                            inputSalario.disabled = true;
                                                                        } else {
                                                                            inputSalario.value = "<?php echo $linha['salario']; ?>";
                                                                            inputSalario.disabled = false;
                                                                        }
                                                                    });
                                                                });
                                                            });
                                                        });
                                                    </script>

                                                </div>
                                                <!-- Escolaridade Necessária, Localização -->
                                                <div class="row mt-1">
                                                    <div class="form-group col-md-6">
                                                        <label for="Escolaridade" class="form-label">* Escolaridade Necessária:</label>
                                                        <input type="text" class="form-control" placeholder="Escolaridade Necessária" name="Escolaridade" value="<?php echo $linha['escolaridade'] ?>" required>
                                                    </div>
                                                </div>
                                                <!-- Celular para Contato, email, Página Web -->
                                                <div class="row mt-3">
                                                    <div class="form-group col-md-6">
                                                        <label for="Localizacao" class="form-label">* Localização:</label>
                                                        <input type="text" class="form-control" placeholder="Localização" name="Localizacao" value="<?php echo $linha['localizacao'] ?>" required>
                                                    </div>
                                                </div>
                                                <hr>
                                                <!-- Descrição da Vaga -->
                                                <div class="row mt-3">
                                                    <div class="form-group col-md-12">
                                                        <h5>Descrição da Vaga:</h5>
                                                        <textarea class="form-control" rows="5" name="Descricao" required><?php echo $linha['descricao'] ?></textarea>
                                                    </div>
                                                </div>
                                        </div>

                                        <!-- Modal footer -->
                                        <div class="modal-footer">
                                            <input type="submit" class="btn_curriculo_salvar" value="Salvar">
                                        </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- The Modal -->
                            <div class="modal fade" id="modalcandidatos" tabindex="-1" aria-labelledby="modalcandidatosLabel" aria-hidden="true">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">Candidatos</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>

                                        <!-- Modal body -->
                                        <div class="modal-body">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                } else {
                    ?>
                    <div class="col-md-12 div_curriculo shadow rounded p-4 mb-4">
                        <p>Nenhuma vaga encontrada!</p>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </main>
    <footer class="p-5 fixed-botton text-center text-light" style="background-color: #2259BC;">
        Site desenvolvido por:
        <br>
        Enzo Jesael Brandão Cardeal Ortiz, Felipe de Assis Vieira e Mike Will Bento do Rego
        <br>
        3B
        <br>
        &copy; 2024 Librand - Todos direitos reservados.
    </footer>

</body>

</html>

<script src="../../js/btnPerfil.js"></script>
<script src="../../js/filtro_vaga.js"></script>
<script src="../../js/delete_perfil_usuario.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modalCandidatos = document.getElementById('modalcandidatos');

        modalCandidatos.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget; // Botão que disparou o modal
            const idVaga = button.getAttribute('data-id-vaga'); // Capturar o ID da vaga

            if (!idVaga) {
                console.error("ID da vaga não encontrado.");
                modalCandidatos.querySelector('.modal-body').innerHTML = "Erro: ID da vaga não encontrado.";
                return;
            }

            // Realiza a requisição para o PHP
            fetch(`get_candidatos.php?id_vaga=${idVaga}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error("Erro na requisição: " + response.statusText);
                    }
                    return response.text();
                })
                .then(html => {
                    modalCandidatos.querySelector('.modal-body').innerHTML = html; // Atualiza a modal
                })
                .catch(error => {
                    console.error("Erro ao carregar candidatos:", error);
                    modalCandidatos.querySelector('.modal-body').innerHTML = "Erro ao carregar os candidatos.";
                });
        });
    });
</script>