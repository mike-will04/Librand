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
$dados = $conn->prepare(
    'SELECT s.*, u.foto_perfil FROM sobre_empresa s join usuario u on s.id_usuario = u.id_usuario'
);
$dados->execute(array());
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Librand</title>
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <script src="../../bootstrap/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../../bootstrap-icons/bootstrap-icons.min.css">
    <link id="favicon" rel="shortcut icon" type="imagex/png" href="../../img/Maozinha_branca.png">
    <script src="../js/favicon_dentro.js"></script>
    <link rel="stylesheet" href="../../css/empresas.css">
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
                            <a href='../vaga/vagas_ativas.php' class='nav-link' >
                                Vagas Ativas
                            </a>
                            <a href='../vaga/formulario_vaga.php' class='nav-link'>
                                Anunciar Vaga
                            </a>  
                            <a href='../index_empresa.php' class='nav-link'>
                                Empresas
                            </a>
                        ";
                    } elseif (isset($tipo) and $tipo == "candidato") {
                        echo "
                            <a href='../vaga/vaga.php' class='nav-link'>
                                Vagas
                            </a>
                            <a href='empresas.php' class='nav-link'>
                                Empresas Cadastradas
                            </a>
                        ";
                    } else {
                        echo "
                            <a href='../vaga/vaga.php' class='nav-link'>
                                Vagas
                            </a>
                            <a href='empresas.php' class='nav-link'>
                                Empresas Cadastradas
                            </a>
                            <a href='../vaga/formulario_vaga.php' class='nav-link'>
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
            <form id="form-pesquisa">
                <div class="input-group justify-content-center">
                    <input type="text" id="campo-pesquisa" class="input-pesquisa" placeholder="  Procurar empresas ">
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
                    <!-- Filtro de Localização -->
                    <h5 class="mb-3">Localização</h5>
                    <div id="localizacao-filtros">
                        <?php
                        $estado = ["Acre", "Alagoas", "Amapá", "Amazonas", "Bahia", "Ceará", "Distrito Federal", "Espírito Santo", "Goiás", "Maranhão", "Mato Grosso", "Mato Grosso do Sul", "Minas Gerais", "Pará", "Paraíba", "Paraná", "Pernambuco", "Piauí", "Rio de Janeiro", "Rio Grande do Norte", "Rio Grande do Sul", "Rondônia", "Rondônia", "Santa Catarina", "São Paulo", "Sergipe", "Tocantins"];
                        foreach ($estado as $index => $linha) {
                            // Limite de 5 para exibir inicialmente
                            if ($index < 5) {
                                echo "
                <div class='form-group col-md-12'>
                    <input type='checkbox' class='form-check-input localizacao' name='Estado' value='" . $linha . "' onchange='aplicarFiltro()'>
                    <label for='Estado' class='form-label'>" . $linha . "</label>
                </div>
            ";
                            } else {
                                echo "
                <div class='form-group col-md-12  extra-filtro localizacao' style='display:none;'>
                    <input type='checkbox' class='form-check-input localizacao' name='Estado' value='" . $linha . "' onchange='aplicarFiltro()'>
                    <label for='Estado' class='form-label'>" . $linha . "</label>
                </div>
            ";
                            }
                        }
                        ?>
                    </div>

                    <!-- Botão de Expandir/Reduzir Localização -->
                    <div class="col-12">
                        <a href="javascript:void(0)" id="localizacao-toggle" onclick="toggleFiltro('localizacao')">
                            <span id="localizacao-text">+mais</span>
                        </a>
                    </div>

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
                    <input type='checkbox' class='form-check-input setor' name='Setor' value='" . $linha . "' onchange='aplicarFiltro()'>
                    <label for='Setor' class='form-label'>" . $linha . "</label>
                </div>
            ";
                            } else {
                                echo "
                <div class='form-group col-md-12 extra-filtro setor' style='display:none;'>
                    <input type='checkbox' class='form-check-input setor' name='Setor' value='" . $linha . "' onchange='aplicarFiltro()'>
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

                    <!-- Filtro de Porte -->
                    <h5 class="mt-3 mb-3">Porte da Empresa</h5>
                    <div id="setor-filtros">
                        <?php
                        $porte = ["Pequeno", "Médio", "Grande"];
                        foreach ($porte as $index => $linha) {
                            echo "
                                <div class='form-group col-md-12'>
                                    <input type='checkbox' class='form-check-input porte' name='Porte' value='" . $linha . "' onchange='aplicarFiltro()'>
                                    <label for='Porte' class='form-label'>" . $linha . "</label>
                                </div>
                            ";
                        }
                        ?>
                    </div>
                </div>
                <div class="col-md-9 mb-4" id="resultados-empresas">
                    <?php
                    if ($dados->rowCount() > 0) {
                        foreach ($dados as $linha) {
                            echo "
                    <div class='col-md-12 div_curriculo shadow rounded p-4 mb-4 empresa' data-nome='" . strtolower($linha['nome_fantasia']) . "'>
                        <div class='row'>
                            <div class='col-md-4 d-flex justify-content-center align-items-center'>
                                <img src='../../img/foto perfil/" . $linha['foto_perfil'] . "' alt='logo empresa' height='50px'>
                            </div>
                            <div class='col-md-8 align-items-center'>
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
                <p>
                    Nenhuma empresa encontrada!
                </p>
            </div>";
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
<script src="../../js/filtro_empresa.js"></script>