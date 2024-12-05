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
    <link rel="stylesheet" href="../css/index_empresa.css">
    <link rel="stylesheet" href="../css/header.css">
</head>

<body>
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
                    } else {
                        echo "
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
                                <a href='../html/login_empresa.html' class='nav-link'>
                                    Login
                                </a>
                                <a href='../html/cadastro_empresa.html'>
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

    <div class="container-fluid">
        <div class="row">
            <img src="../img/sobre.png" alt="Fundo Sobre Librand" class="img-fluid img_sobre">
        </div>
    </div>

    <div class="container-fluid p-4" style="background-color: #5E87DE;">
        <div class="row align-items-center">
            <div class="col-8 mx-auto">
                <h2 style="color: white; font-weight: bold;">
                    Nosso Objetivo
                </h2>
                <span style="text-align: justify; font-size: 1.1em; color: white;">
                    Nossa missão é apoiar empresas que buscam gerar inclusão e acessibilidade no mercado de trabalho. Proporcionamos uma plataforma acessível para ajudar sua empresa a encontrar talentos em diversas áreas.
                </span>
            </div>
            <div class="col-3">
                <img src="../img/alvo.png" alt="Objetivo" class="img-fluid">
            </div>
        </div>
    </div>

    <div class="container-fluid p-5">
        <div class="row align-items-center">
            <div class="col-3 mx-auto">
                <img src="../img/time.png" alt="Vaga" class="img-fluid">
            </div>
            <div class="col-8 mx-auto">
                <h1 style="color: #2259BC; font-weight: bold;">
                    Venha fazer parte do time
                </h1>
                <div style="margin-top: 4%;">
                    <span style="text-align: justify; font-size: 1.1em;">
                        Oferecemos uma solução completa para que sua empresa possa cadastrar vagas inclusivas, com suporte especializado e tecnologias assistivas. A Librand visa conectar sua empresa a profissionais capacitados, garantindo um recrutamento simples e acessível.
                    </span>
                </div>
                <div style="margin-top: 4%;">
                    <a href="../html/cadastro_empresa.html" class="ancora">
                        <button class="btn-empresa">
                            Cadastre sua empresa
                        </button>
                    </a>
                    <a href="vaga/formulario_vaga.php">
                        <button class="btn-vaga">
                            Divulgue sua vaga
                        </button>
                    </a>
                </div>

            </div>
        </div>
    </div>
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