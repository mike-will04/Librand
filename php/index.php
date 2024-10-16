<!DOCTYPE html>
<html lang="pt-br">
<?php
include "conexao.php";
session_start();

if (isset($_SESSION['iduser'])) {
    $id = $_SESSION['iduser'];

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="shortcut icon" type="imagex/png" href="../img/Logotipo_Libras_Inclusão_Azul-removebg-preview.png">
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/header.css">
</head>

<body>
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
                    <a href="" class="nav-link ">
                        Vagas
                    </a>
                    <a href="" class="nav-link">
                        Empresas cadastradas
                    </a>
                    <a href="" class="nav-link">
                        Anunciar Vaga
                    </a>
                    <?php
                    if (isset($_SESSION['logado']) and $_SESSION['logado'] == true) {
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

    <div class="container-fluid fundo-pesquisa" style="background-color: #5E87DE;">
        <form>
            <div class="input-group justify-content-center">
                <input type="search" name="" id="" class="input-pesquisa" placeholder="Procurar vagas">
                <button class="btn-pesquisa">
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
        <div class="row">
            <div class="col-3">
                <img src="../img/objetivo librand.png" alt="Objetivo" class="img-fluid">
            </div>
            <div class="col-8 mx-auto">
                <h2 style="color: #2259BC; font-weight: bold;">
                    Nosso Objetivo
                </h2>
                <span style="text-align: justify; font-size: 1.1em;">
                    Nossa meta é ajudar e facilitar pessoas com deficiência auditiva a ingressar no mercado de trabalho, disponibilizando vagas de emprego em diferentes áreas.
                </span>
            </div>
        </div>
    </div>

    <div class="container-fluid p-5" style="background-color: #5E87DE;">
        <div class="row">
            <div class="col-8">
                <h1 style="color: white; font-weight: bold;">
                    Conheça as vagas
                </h1>
                <div style="margin-top: 4%;">
                    <span style="color: white; text-align: justify; font-size: 1.1em;">
                        Oferecemos vagas inclusivas para pessoas com deficiência auditiva, em áreas como atendimento e tecnologia. Suporte especializado e tecnologias assistivas garantem um ambiente acessível.
                    </span>
                </div>
                <div style="margin-top: 4%;">
                    <a href="">
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
    <footer class="p-5 fixed-botton text-center text-light" style="background-color: #2259BC;">
        Site desenvolvido por:
        <br>
        Enzo Jesael Cardeal Ortiz, Felipe de Assis Vieira e Mike Will Bento do Rego
        <br>
        3B
        <br>
        &copy; 2024 Librand - Todos direitos reservados.
    </footer>

</body>

</html>

<script src="../js/btnPerfil.js"></script>