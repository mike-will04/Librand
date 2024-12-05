<!DOCTYPE html>
<html lang="pt-br">
<?php
include "conexao.php";
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
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Librand</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../bootstrap-icons/font/bootstrap-icons.min.css">
    <link id="favicon" rel="shortcut icon" type="imagex/png" href="../img/Maozinha_branca.png">
    <script src="../js/favicon_fora.js"></script>
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/header.css">
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
            <a href="index.php" class="navbar-brand d-flex">
                <img src="../img/Logotipo Librand.png" alt="Logo Librand" style="width: 100px;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="menuNavbar">
                <div class="navbar-nav ms-auto align-items-center" style='text-align: center;'>
                    <?php
                    if (isset($tipo) and $tipo == "empresa") {
                        echo "
                            <a href='vaga/vagas_ativas.php' class='nav-link' >
                                Vagas Ativas
                            </a>
                            <a href='vaga/formulario_vaga.php' class='nav-link'>
                                Anunciar Vaga
                            </a>  
                            <a href='index_empresa.php' class='nav-link'>
                                Empresas
                            </a>
                        ";
                    } elseif (isset($tipo) and $tipo == "candidato") {
                        echo "
                            <a href='vaga/vaga.php' class='nav-link'>
                                Vagas
                            </a>
                            <a href='empresa/empresas.php' class='nav-link'>
                                Empresas Cadastradas
                            </a>
                        ";
                    } else {
                        echo "
                            <a href='vaga/vaga.php' class='nav-link'>
                                Vagas
                            </a>
                            <a href='empresa/empresas.php' class='nav-link'>
                                Empresas Cadastradas
                            </a>
                            <a href='vaga/formulario_vaga.php' class='nav-link'>
                                Anunciar Vaga
                            </a>
                            <a href='index_empresa.php' class='nav-link'>
                                Empresas
                            </a>  
                        ";
                    }
                    if ((isset($_SESSION['logado']) and $_SESSION['logado'] == true) and (isset($tipo) and $tipo == "candidato")) {
                        foreach ($check as $linha) {
                            if ($linha['foto_perfil'] == null) {
                                echo "
                                    <div class='d-inline-flex align-items-center' style='margin-right: 10px; margin-left: 10px; cursor: pointer;'  onclick='perfil()'>
                                    <img src='../img/foto perfil/user.png' alt='Foto Perfil' id='btn-perfil' style='width: 50px; height: 50px;'/><p style='color: white; margin-bottom: 0; margin-right: 5px; margin-left: 5px;'>" . $linha['usuario'] . "</p><i class='bi bi-chevron-down' style='color: white'></i></div>";
                                echo "<div class='card' id='carde' style='display: none;'>
                                        <a href='curriculo/cadastro_curriculo.php' style='display: block;'>Cadastrar currículo</a>
                                        <a href='perfil_usuario/perfil_usuario.php' style='display: block;'>Perfil</a>
                                        <a href='sair.php' style='display: block;' class='card1'>Sair</a>
                                    </div>
                                    ";
                            } else {
                                echo "
                                    <div class='d-inline-flex align-items-center' style='margin-right: 10px; margin-left: 10px; cursor: pointer;'  onclick='perfil()'>
                                    <img src='../img/foto perfil/" . $linha['foto_perfil'] .  "' alt='Foto Perfil' id='btn-perfil' style='width: 50px; height: 50px; border: 1px solid white; border-radius: 50%;'/><p style='color: white; margin-bottom: 0; margin-right: 5px; margin-left: 5px;'>" . $linha['usuario'] . "</p><i class='bi bi-chevron-down' style='color: white'></i></div>";
                                echo "<div class='card' id='carde' style='display: none;'>
                                        <a href='curriculo/cadastro_curriculo.php' style='display: block;'>Cadastrar currículo</a>
                                        <a href='perfil_usuario/perfil_usuario.php' style='display: block;'>Perfil</a>
                                        <a href='sair.php' style='display: block;' class='card1'>Sair</a>
                                    </div>
                                    ";
                            }
                        }
                    } elseif ((isset($_SESSION['logado']) and $_SESSION['logado'] == true) and (isset($tipo) and $tipo == "empresa")) {
                        foreach ($check as $linha) {
                            if ($linha['foto_perfil'] == null) {
                                echo "
                                    <div class='d-inline-flex align-items-center' style='margin-right: 10px; margin-left: 10px; cursor: pointer;'  onclick='perfil()'>
                                    <img src='../img/foto perfil/user.png' alt='Foto Perfil' id='btn-perfil' style='width: 50px; height: 50px;'/><p style='color: white; margin-bottom: 0; margin-right: 5px; margin-left: 5px;'>" . $linha['usuario'] . "</p><i class='bi bi-chevron-down' style='color: white'></i></div>";
                                echo "<div class='card' id='carde' style='display: none;'>
                                        <a href='empresa/info_empresa.php' style='display: block;'>Completar cadastro empresa</a>
                                        <a href='perfil_empresa/perfil_empresa.php' style='display: block;'>Perfil</a>
                                        <a href='sair.php' style='display: block;' class='card1'>Sair</a>
                                    </div>
                                    ";
                            } else {
                                echo "
                                    <div class='d-inline-flex align-items-center' style='margin-right: 10px; margin-left: 10px; cursor: pointer;'  onclick='perfil()'>
                                    <img src='../img/foto perfil/" . $linha['foto_perfil'] .  "' alt='Foto Perfil' id='btn-perfil' style='width: 50px; height: 50px; border: 1px solid white; border-radius: 50%;'/><p style='color: white; margin-bottom: 0; margin-right: 5px; margin-left: 5px;'>" . $linha['usuario'] . "</p><i class='bi bi-chevron-down' style='color: white'></i></div>";
                                echo "<div class='card' id='carde' style='display: none;'>
                                        <a href='empresa/info_empresa.php' style='display: block;'>Completar Cadastro Empresa</a>
                                        <a href='perfil_empresa/perfil_empresa.php' style='display: block;'>Perfil</a>
                                        <a href='sair.php' style='display: block;' class='card1'>Sair</a>
                                    </div>
                                    ";
                            }
                        }
                    } else {
                        echo "
                                <a href='../html/login_usuario.html' class='nav-link'>
                                    Login
                                </a>
                                <a href='../html/cadastro_usuario.html'>
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
                                    <a href="curriculo/cadastro_curriculo.php">
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
                                    <a href="empresa/info_empresa.php">
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
            <form id="form-pesquisa" action="vaga/vaga.php" method="GET">
                <div class="input-group justify-content-center">
                    <input
                        type="text"
                        id="campo-pesquisa"
                        name="pesquisa"
                        class="input-pesquisa"
                        placeholder="  Procurar vagas ">
                    <button type="submit" id="botao-pesquisa" class="btn-pesquisa">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </form>
        </div>


        <div class="container-fluid p-5">
            <div class="row">
                <div>
                    <h1 style="color: #2259BC; font-weight: bold;">
                        Sobre a Librand
                    </h1>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-3">
                    <img src="../img/objetivo librand.png" alt="Objetivo" class="img-fluid">
                </div>
                <div class="col-8 mx-auto">
                    <h2 style="color: #2259BC; font-weight: bold;">
                        Nosso Objetivo
                    </h2>
                    <p style="text-align: justify; font-size: 1.1em;">
                    A Librand tem como compromisso promover inclusão, acessibilidade e facilitar a entrada de pessoas com deficiência auditiva no mercado de trabalho. Enquanto buscamos diminuir desafios como o preconceito e a falta de comunicação adaptada, é oferecida a intermediação de empresas comprometidas com a diversidade e pessoas que buscam um ambiente acessível.
                    </p>
                </div>
            </div>
        </div>

        <div class="container-fluid p-5" style="background-color: #5E87DE;">
            <div class="row">
                <div class="col-md-8">
                    <h1 style="color: white; font-weight: bold;">
                        Conheça as vagas
                    </h1>
                    <div style="margin-top: 4%;">
                        <p style="color: white; text-align: justify; font-size: 1.1em;">
                            Aqui você encontra oportunidades pensadas para você! Em nosso site você tem acesso á vagas de emprego adaptadas para pessoas com deficiências auditivas, com suportes especializados e tecnologia assistiva que visam proporcionar um ambiente acessível e livre de obstáculos. O Librand intermedia empresas que visam a inclusão e candidatos que buscam um espaço de trabalho justo.<br>
                            Clique abaixo e descubra como dar o próximo passo na sua carreira.
                        </p>
                    </div>
                    <div style="margin-top: 4%;">
                        <a href="vaga/vaga.php">
                            <button class="btn-vaga">
                                Acesse as vagas
                            </button>
                        </a>
                    </div>

                </div>
                <div class="col-3 mx-auto">
                    <img src="../img/vaga.png" alt="Vaga" class="img-fluid">
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

<script src="../js/btnPerfil.js"></script>
<script src="../../js/filtro_vaga.js"></script>