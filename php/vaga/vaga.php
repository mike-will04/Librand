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
}


// Captura o termo de pesquisa enviado pela index.php ou pela própria página vagas.php
$pesquisa = isset($_GET['pesquisa']) ? trim($_GET['pesquisa']) : '';

// Consulta ao banco de dados
$query = "SELECT 
            se.nome_fantasia, 
            v.*, 
            u.foto_perfil 
          FROM 
            sobre_empresa se
          INNER JOIN 
            vaga v ON se.id_usuario = v.id_usuario
          INNER JOIN 
            usuario u ON v.id_usuario = u.id_usuario";

// Se houver um termo de pesquisa, adiciona o filtro
if (!empty($pesquisa)) {
    $query .= " WHERE v.titulo LIKE :pesquisa 
                OR v.cargo LIKE :pesquisa 
                OR se.nome_fantasia LIKE :pesquisa";
}

// Prepara e executa a consulta
$stmt = $conn->prepare($query);

if (!empty($pesquisa)) {
    $stmt->bindValue(':pesquisa', '%' . $pesquisa . '%');
}

$stmt->execute();
$dados = $stmt;
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Librand</title>
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <script src="../../bootstrap/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../../bootstrap-icons/font/bootstrap-icons.min.css">
    <link id="favicon" rel="shortcut icon" type="imagex/png" href="../../img/Maozinha_branca.png">
    <script src="../js/favicon_dentro.js"></script>
    <link rel="stylesheet" href="../../css/vagas.css">
    <link rel="stylesheet" href="../../css/header.css">
</head>

<body class="d-flex flex-column min-vh-100">
    <div vw class="enabled">
        <div vw-access-button class="active"></div>
        <div vw-plugin-wrapper>
            <div class="vw-plugin-top-wrapper"></div>
        </div>
    </div>
    <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
    <script>
        new window.VLibras.Widget('https://vlibras.gov.br/app');
    </script>
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
                            <a href='formulario_vaga.php' class='nav-link'>
                                Anunciar Vaga
                            </a>  
                            <a href='../index_empresa.php' class='nav-link'>
                                Empresas
                            </a>
                        ";
                    } elseif (isset($tipo) and $tipo == "candidato") {
                        echo "
                            <a href='vaga.php' class='nav-link'>
                                Vagas
                            </a>
                            <a href='../empresa/empresas.php' class='nav-link'>
                                Empresas Cadastradas
                            </a>
                        ";
                    } else {
                        echo "
                            <a href='vaga.php' class='nav-link'>
                                Vagas
                            </a>
                            <a href='../empresa/empresas.php' class='nav-link'>
                                Empresas Cadastradas
                            </a>
                            <a href='formulario_vaga.php' class='nav-link'>
                                Anunciar Vaga
                            </a>
                            <a href='../index_empresa.php' class='nav-link'>
                                Empresas
                            </a>  
                        ";
                    }
                    if ((isset($_SESSION['logado']) and $_SESSION['logado'] == true) and (isset($tipo) and $tipo == "candidato")) {
                        foreach ($check as $linha) {
                            if ($linha['foto_perfil'] == null) {
                                echo "
                                    <div class='d-inline-flex align-items-center' style='margin-right: 10px; margin-left: 10px; cursor: pointer;'  onclick='perfil()'>
                                    <img src='../../img/foto perfil/user.png' alt='Foto Perfil' id='btn-perfil' style='width: 50px; height: 50px;'/><p style='color: white; margin-bottom: 0; margin-right: 5px; margin-left: 5px;'>" . $linha['usuario'] . "</p><i class='bi bi-chevron-down' style='color: white'></i></div>";
                                echo "<div class='card' id='carde' style='display: none;'>
                                        <a href='../curriculo/cadastro_curriculo.php' style='display: block;'>Cadastrar currículo</a>
                                        <a href='../perfil_usuario/perfil_usuario.php' style='display: block;'>Perfil</a>
                                        <a href='../sair.php' style='display: block;' class='card1'>Sair</a>
                                    </div>
                                    ";
                            } else {
                                echo "
                                    <div class='d-inline-flex align-items-center' style='margin-right: 10px; margin-left: 10px; cursor: pointer;'  onclick='perfil()'>
                                    <img src='../../img/foto perfil/" . $linha['foto_perfil'] .  "' alt='Foto Perfil' id='btn-perfil' style='width: 50px; height: 50px; border: 1px solid white; border-radius: 50%;'/><p style='color: white; margin-bottom: 0; margin-right: 5px; margin-left: 5px;'>" . $linha['usuario'] . "</p><i class='bi bi-chevron-down' style='color: white'></i></div>";
                                echo "<div class='card' id='carde' style='display: none;'>
                                        <a href='../curriculo/cadastro_curriculo.php' style='display: block;'>Cadastrar currículo</a>
                                        <a href='../perfil_usuario/perfil_usuario.php' style='display: block;'>Perfil</a>
                                        <a href='../sair.php' style='display: block;' class='card1'>Sair</a>
                                    </div>
                                    ";
                            }
                        }
                    } elseif ((isset($_SESSION['logado']) and $_SESSION['logado'] == true) and (isset($tipo) and $tipo == "empresa")) {
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
                                <a href='../../html/login_usuario.html' class='nav-link'>
                                    Login
                                </a>
                                <a href='../../html/cadastro_usuario.html'>
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
            if ($tipo == "candidato") {
                // Tabelas que precisam ser verificadas
                $tabelas = ['dados_pessoais', 'experiencia', 'formacao', 'objetivo', 'idioma', 'especializacoes'];

                $mostrarHTML = false;

                // Verificar número de registros em cada tabela
                foreach ($tabelas as $tabela) {
                    try {
                        $sql = "SELECT COUNT(*) as total FROM $tabela WHERE id_usuario = :id_usuario";
                        $stmt = $conn->prepare($sql);
                        $stmt->bindParam(':id_usuario', $id, PDO::PARAM_INT);
                        $stmt->execute();
                        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

                        if ($resultado['total'] == 0) {
                            $mostrarHTML = true;
                            break; // Se encontrar uma tabela vazia, não precisa verificar as outras
                        }
                    } catch (PDOException $e) {
                        echo "Erro ao consultar a tabela $tabela: " . $e->getMessage() . "<br>";
                    }
                }

                // Exibir o HTML se necessário
                if ($mostrarHTML) {
                    echo '
                        <div class="container-fluid">
                            <div class="row p-2">
                                <div class="col-12 d-inline-flex align-items-center justify-content-center">
                                    <h5 style="color: #2259BC; font-weight: bold;" class="mx-2">Vamos concluir o seu perfil?</h5>
                                    <a href="../curriculo/cadastro_curriculo.php">
                                        <button class="btn-notificacao">Clique aqui</button>
                                    </a>
                                </div>
                            </div>
                        </div>';
                }
            } else {
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
        }

        ?>

        <div class="container-fluid fundo-pesquisa" style="background-color: #5E87DE;">
            <form id="form-pesquisa" action="vaga.php" method="GET">
                <div class="input-group justify-content-center">
                    <input
                        type="text"
                        id="campo-pesquisa"
                        name="pesquisa"
                        class="input-pesquisa"
                        placeholder="  Procurar vagas "
                        value="<?php echo isset($_GET['pesquisa']) ? htmlspecialchars($_GET['pesquisa']) : ''; ?>">
                    <button type="submit" id="botao-pesquisa" class="btn-pesquisa">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </form>
        </div>



        <div class="container-fluid p-5">
            <div class="row">
                <div class="col-md-3">
                    <h5 style="color: #2259BC; font-weight:bold">FILTRO DE BUSCA</h5>
                    <!-- Filtro de Setor -->
                    <h5 class="mt-3 mb-3">Setor</h5>
                    <div id="setor-filtros">
                        <?php
                        $setor = ["Administração", "Agricultura, Pecuária, Veterinária", "Alimentação / Gastronomia", "Arquitetura, Decoração, Design", "Artes", "Auditoria", "Ciências", "Comercial", "Comunicação", "Construção", "Contábil", "Cultura", "Educação", "Engenharia", "Industrial", "Informática", "Jurídica", "Logística", "Marketing", "Moda", "Qualidade", "Recursos Humanos", "Saúde", "Segurança", "Serviço Social e Comunitário", "Serviços Gerais", "Telemarketing", "Transportes"];
                        foreach ($setor as $index => $linha) {
                            // Limite de 5 para exibir inicialmente
                            if ($index < 5) {
                                echo "
                <div class='form-group col-md-12'>
                    <input type='checkbox' class='form-check-input setor' name='Setor' value='" . $linha . "' onchange='aplicarFiltroVagas()'>
                    <label for='Setor' class='form-label'>" . $linha . "</label>
                </div>
            ";
                            } else {
                                echo "
                <div class='form-group col-md-12 extra-filtro setor' style='display:none;'>
                    <input type='checkbox' class='form-check-input setor' name='Setor' value='" . $linha . "' onchange='aplicarFiltroVagas()'>
                    <label for='Setor' class='form-label'>" . $linha . "</label>
                </div>
            ";
                            }
                        }
                        ?>
                    </div>
                    <!-- Botão de Expandir/Reduzir Setor -->
                    <div class="col-12">
                        <a href="javascript:void(0)" id="setor-toggle" onclick="toggleFiltro('setor')">
                            <span id="setor-text">+mais</span>
                        </a>
                    </div>

                    <!-- Filtro de Senioridade -->
                    <h5 class="mt-3 mb-3">Senioridade</h5>
                    <div id="setor-filtros">
                        <?php

                        $senioridade = ["Estagiário", "Operacional", "Auxiliar", "Assistente", "Treinee", "Analista", "Encarregado", "Supervisor", "Consultor", "Especialista", "Coordenador", "Gerente", "Diretor"];
                        foreach ($senioridade as $index => $linha) {
                            // Limite de 5 para exibir inicialmente
                            if ($index < 5) {
                                echo "
                <div class='form-group col-md-12'>
                    <input type='checkbox' class='form-check-input senioridade' name='Senioridade' value='" . $linha . "' onchange='aplicarFiltroVagas()'>
                    <label for='Setor' class='form-label'>" . $linha . "</label>
                </div>
            ";
                            } else {
                                echo "
                <div class='form-group col-md-12 extra-filtro senioridade' style='display:none;'>
                    <input type='checkbox' class='form-check-input senioridade' name='Senioridade' value='" . $linha . "' onchange='aplicarFiltroVagas()'>
                    <label for='Senioridade' class='form-label'>" . $linha . "</label>
                </div>
            ";
                            }
                        }
                        ?>
                    </div>
                    <!-- Botão de Expandir/Reduzir Setor -->
                    <div class="col-12">
                        <a href="javascript:void(0)" id="senioridade-toggle" onclick="toggleFiltro('senioridade')">
                            <span id="senioridade-text">+mais</span>
                        </a>
                    </div>


                    <!-- Filtro de Contrato -->
                    <h5 class="mt-3 mb-3">Tipo de Contrato</h5>
                    <div id="setor-filtros">
                        <?php
                        $contrato = ["CLT", "Autônomo", "Prestador de Serviço (PJ)", "Cooperado", "Jovem Aprendiz", "Estágio", "Temporário", "Trainee", "Outros"];
                        foreach ($contrato as $index => $linha) {
                            // Limite de 5 para exibir inicialmente
                            if ($index < 5) {
                                echo "
                <div class='form-group col-md-12'>
                    <input type='checkbox' class='form-check-input contrato' name='Contrato' value='" . $linha . "' onchange='aplicarFiltroVagas()'>
                    <label for='Setor' class='form-label'>" . $linha . "</label>
                </div>
            ";
                            } else {
                                echo "
                <div class='form-group col-md-12 extra-filtro contrato' style='display:none;'>
                    <input type='checkbox' class='form-check-input contrato' name='Contrato' value='" . $linha . "' onchange='aplicarFiltroVagas()'>
                    <label for='Contrato' class='form-label'>" . $linha . "</label>
                </div>
            ";
                            }
                        }
                        ?>
                    </div>
                    <!-- Botão de Expandir/Reduzir Setor -->
                    <div class="col-12">
                        <a href="javascript:void(0)" id="contrato-toggle" onclick="toggleFiltro('contrato')">
                            <span id="contrato-text">+mais</span>
                        </a>
                    </div>


                    <!-- Filtro de Modalidade -->
                    <h5 class="mt-3 mb-3">Modalidade</h5>
                    <div id="setor-filtros">
                        <?php
                        $modalidade = ["Presencial", "Home Office", "Híbrido"];
                        foreach ($modalidade as $index => $linha) {
                            echo "
                                <div class='form-group col-md-12'>
                                    <input type='checkbox' class='form-check-input modalidade' name='Modalidade' value='" . $linha . "' onchange='aplicarFiltroVagas()'>
                                    <label for='Modalidade' class='form-label'>" . $linha . "</label>
                                </div>
                            ";
                        }
                        ?>
                    </div>


                    <!-- Filtro de Período -->
                    <h5 class="mt-3 mb-3">Período</h5>
                    <div id="setor-filtros">
                        <?php
                        $periodo = ["Período Integral", "Parcial Manhãs", "Parcial Tardes", "Parcial Noites", "Noturno"];
                        foreach ($periodo as $index => $linha) {
                            echo "
            <div class='form-group col-md-12'>
                <input type='checkbox' class='form-check-input periodo' name='Periodo' value='" . $linha . "' onchange='aplicarFiltroVagas()'>
                <label for='Periodo' class='form-label'>" . $linha . "</label>
            </div>";
                        }
                        ?>
                    </div>
                </div>

                <div class="col-md-9 mb-4" id="resultados-vagas">
                    <?php
                    if ($dados->rowCount() > 0) {
                        foreach ($dados as $linha) {
                    ?>
                            <div class="col-md-12 div_curriculo shadow rounded p-4 mb-4 ">
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
                                    <button class='btn-empresa' data-bs-toggle="modal" data-bs-target="#modalvaga<?php echo $linha['id_vaga']; ?>">Ver mais</button>
                                </div>
                                <!-- The Modal -->
                                <div class="modal fade" id="modalvaga<?php echo $linha['id_vaga']; ?>" tabindex="-1" aria-labelledby="modalvagaLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>

                                            <!-- Modal body -->
                                            <div class="modal-body p-5">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <?php
                                                        echo "<h3>" . $linha['titulo'] . "</h3>";
                                                        echo "<h5>" . $linha['localizacao'] . "</h5>";
                                                        echo "<h5>" . $linha['salario'] . "</h5>";
                                                        ?>
                                                        <br>
                                                        <div class="d-flex justify-content-center align-items-center">
                                                            <a href="candidatar_vaga.php?id_vaga=<?php echo $linha['id_vaga']; ?>"><button class="btn-vaga">Candidatar-se</button></a>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 d-flex justify-content-center m-auto">
                                                        <img src="../../img/foto perfil/<?php echo $linha['foto_perfil'] ?>" alt="Logo Empresa" height="50px">
                                                    </div>
                                                    <hr class="mt-4 mb-4">
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <?php
                                                        echo "<p><b>Cargo:</b> " . $linha['cargo'] . "</p>";
                                                        echo "<p><b>Especialização:</b> " . $linha['especializacao'] . "</p>";
                                                        echo "<p><b>Senioridade:</b> " . $linha['senioridade'] . "</p>";
                                                        echo "<p><b>Quantidade de Vagas:</b> " . $linha['numero_vagas'] . "</p>";
                                                        echo "<p><b>Contrato:</b> " . $linha['contrato'] . "</p>";
                                                        echo "<p><b>Modalidade:</b> " . $linha['modalidade'] . "</p>";
                                                        echo "<p><b>Período:</b> " . $linha['periodo'] . "</p>";
                                                        echo "<p><b>Escolaridade Necessária:</b> " . $linha['escolaridade'] . "</p>";
                                                        echo "<p><b>Setor:</b> " . $linha['area'] . "</p>";
                                                        echo "<p style='text-align: justify;'><b>Descrição da Vaga:</b> " . $linha['descricao'] . "</p>";
                                                        ?>
                                                    </div>
                                                </div>
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
        </div>
    </main>
    <footer class="p-5 fixed-botton text-center text-light" style="background-color: #2259BC;">
        Site desenvolvido por:
        <br>
        Enzo Jesael Brandão Cardeal Ortiz, Felipe de Assis Vieira e Mike Will Bento do Rego
        <br>
        3B
        <br>
        &copy; <?php echo date("Y"); ?> Librand - Todos os direitos reservados.
    </footer>
</body>

</html>

<script src="../../js/btnPerfil.js"></script>
<script src="../../js/filtro_vaga.js"></script>