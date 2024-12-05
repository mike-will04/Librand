<!DOCTYPE html>
<html lang="pt-br">
<?php
include "../conexao.php";
session_start();

$id = $_GET['id'];

if (isset($_SESSION['iduser'])) {
    $id_user = $_SESSION['iduser'];
    $tipo = $_SESSION['tipo'];

    $check = $conn->prepare(
        'SELECT * FROM usuario WHERE id_usuario = :id'
    );
    $check->execute(array(
        ':id' => $id_user
    ));
} else {
    $_SESSION['logado'] = false;
}

$dados = $conn->prepare(
    'SELECT s.*, u.email FROM sobre_empresa s join usuario u on s.id_usuario = u.id_usuario WHERE s.id_usuario = :id_usuario'
);
$dados->execute(array(
    ':id_usuario' => $id
));

$dados2 = $conn->prepare(
    'SELECT * FROM sobre_empresa WHERE id_usuario = :id_usuario'
);
$dados2->execute(array(
    ':id_usuario' => $id
));

$dados3 = $conn->prepare(
    'SELECT * FROM sobre_empresa WHERE id_usuario = :id_usuario'
);
$dados3->execute(array(
    ':id_usuario' => $id
));

$dados4 = $conn->prepare(
    'SELECT * FROM sobre_empresa WHERE id_usuario = :id_usuario'
);
$dados4->execute(array(
    ':id_usuario' => $id
));

$dados5 = $conn->prepare(
    'SELECT * FROM sobre_empresa WHERE id_usuario = :id_usuario'
);
$dados5->execute(array(
    ':id_usuario' => $id
));

$dados2alterar = $conn->prepare(
    'SELECT * FROM sobre_empresa WHERE id_usuario = :id_usuario'
);
$dados2alterar->execute(array(
    ':id_usuario' => $id
));

$dados3alterar = $conn->prepare(
    'SELECT * FROM sobre_empresa WHERE id_usuario = :id_usuario'
);
$dados3alterar->execute(array(
    ':id_usuario' => $id
));

$dados4alterar = $conn->prepare(
    'SELECT * FROM sobre_empresa WHERE id_usuario = :id_usuario'
);
$dados4alterar->execute(array(
    ':id_usuario' => $id
));

$dados5alterar = $conn->prepare(
    'SELECT * FROM sobre_empresa WHERE id_usuario = :id_usuario'
);
$dados5alterar->execute(array(
    ':id_usuario' => $id
));

$usuario = $conn->prepare(
    'SELECT * FROM usuario WHERE id_usuario = :id_usuario'
);
$usuario->execute(array(
    ':id_usuario' => $id
));
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
    <link rel="stylesheet" href="../../css/perfil_usuario.css">
    <link rel="stylesheet" href="../../css/header.css">
    <link rel="stylesheet" href="../../css/upload.css">
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
            <a href="../index.php" class="navbar-brand d-flex">
                <img src="../../img/Logotipo Librand.png" alt="Logo Librand" style="width: 100px;">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="menuNavbar">
                <div class="navbar-nav ms-auto align-items-center" style='text-align: center;'>
                    <?php
                    if (isset($_SESSION['logado']) and $_SESSION['logado'] == true) {
                        foreach ($check as $linha) {
                            if ($linha['foto_perfil'] == null) {
                                echo "
                                    <div class='d-inline-flex align-items-center' style='margin-right: 10px; margin-left: 10px; cursor: pointer;'  onclick='perfil()'>
                                    <img src='../../img/foto perfil/user.png' alt='Foto Perfil' id='btn-perfil' style='width: 50px; height: 50px;'/><p style='color: white; margin-bottom: 0; margin-right: 5px; margin-left: 5px;'>" . $linha['usuario'] . "</p><i class='bi bi-chevron-down' style='color: white'></i></div>";
                                echo "<div class='card' id='carde' style='display: none;'>
                                        <a href='../empresa/info_empresa.php' style='display: block;'>Completar cadastro empresa</a>
                                        <a href='../perfil_usuario/perfil_usuario.php' style='display: block;'>Perfil</a>
                                        <a href='../sair.php' style='display: block;' class='card1'>Sair</a>
                                    </div>
                                    ";
                            } else {
                                echo "
                                    <div class='d-inline-flex align-items-center' style='margin-right: 10px; margin-left: 10px; cursor: pointer;'  onclick='perfil()'>
                                    <img src='../../img/foto perfil/" . $linha['foto_perfil'] .  "' alt='Foto Perfil' id='btn-perfil' style='width: 50px; height: 50px; border: 1px solid white; border-radius: 50%;'/><p style='color: white; margin-bottom: 0; margin-right: 5px; margin-left: 5px;'>" . $linha['usuario'] . "</p><i class='bi bi-chevron-down' style='color: white'></i></div>";
                                echo "<div class='card' id='carde' style='display: none;'>
                                        <a href='../empresa/info_empresa.php' style='display: block;'>Completar Cadastro Empresa</a>
                                        <a href='../perfil_usuario/perfil_usuario.php' style='display: block;'>Perfil</a>
                                        <a href='../sair.php' style='display: block;' class='card1'>Sair</a>
                                    </div>
                                    ";
                            }
                        }
                    } else {
                        echo "
                            <a href='../vaga/vaga.php' class='nav-link'>
                                Vagas
                            </a>
                            <a href='../empresa/empresas.php' class='nav-link'>
                                Empresas Cadastradas
                            </a>
                            <a href='../vaga/formulario_vaga.php' class='nav-link'>
                                Anunciar Vaga
                            </a>
                            <a href='../index_empresa.php' class='nav-link'>
                                Empresas
                            </a>  
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

    <div class="container-fluid">
        <div class="row justify-content-center mt-5">
            <div class="col-md-1 div_perfil d-flex justify-content-center align-items-center">
                <div class="upload d-flex justify-content-center align-items-center m-auto">
                    <?php
                    foreach ($usuario as $linha) {
                        if ($linha['foto_perfil'] == null) {
                            echo "<img src='../../img/foto perfil/user2.png' width='125' height='125' id='profile' class='img'>";
                        } else {
                            echo "<img src='../../img/foto perfil/" . $linha['foto_perfil'] . "' width='125' height='125' id='profile' class='img'>";
                        }
                    }
                    ?>
                </div>
            </div>

            <div class="col-md-9 shadow rounded d-inline-flex div_perfil p-4">
                <div class="d-flex justify-content-center align-items-center texto_dados ">
                    <?php
                    if ($dados->rowCount() > 0) {
                        $linha = $dados->fetch();
                        echo "<div><h5>" . $linha['nome_fantasia'] . "</h5>";
                        echo "<h6>Contato</h6>";
                        echo "Email: " . $linha['email'] . "<br>";
                        echo "Celular: " . $linha['celular_contato'] . "<br>";
                        echo "Cidade: " . $linha['cidade'] . "-" . $linha['estado'] . "</div>";
                    } else {
                        echo "Nenhum dado encontrado!";
                    }
                    ?>
                </div>
            </div>
        </div>

        <div class="row justify-content-center mt-5">
            <div class="col-md-11 shadow rounded p-4">
                <h3>Dados Básicos</h3>
                <div class="texto_dados mt-4 d-flex justify-content-start">
                    <?php
                    if ($dados2->rowCount() > 0) {
                        $linha = $dados2->fetch();
                        echo "Nome Fantasia: " . $linha['nome_fantasia'] . "<br>";
                        echo "Razão Social: " . $linha['razao_social'] . "<br>";
                        echo "CNPJ: " . $linha['cnpj'] . "<br>";
                        echo "Setor da Empresa: " . $linha['setor'] . "<br>";
                        echo "Número de Funcionários: " . $linha['numero_funcionarios'] . "<br>";
                        echo "Porte da Empresa: " . $linha['porte'] . "<br>";
                    } else {
                        echo "Nenhum dado encontrado!";
                    }
                    ?>
                </div>
            </div>
        </div>

        <div class="row justify-content-center mt-5">
            <div class="col-md-11 shadow p-4">
                <h3>Endereço</h3>
                <div class="texto_dados mt-4">
                    <?php
                    if ($dados3->rowCount() > 0) {
                        while ($linha = $dados3->fetch()) {
                            echo "<div class='mb-4'>";
                            echo "CEP: " . $linha['cep'] . "<br>";
                            echo "Rua: " . $linha['rua'] . "<br>";
                            if ($linha['numero'] != "") {
                                echo "Número: " . $linha['numero'] . "<br>";
                            }
                            if ($linha['complemento'] != "") {
                                echo "Complemento: " . $linha['complemento'] . "<br>";
                            }
                            if ($linha['bairro'] != "") {
                                echo "Bairro: " . $linha['bairro'] . "<br>";
                            }
                            echo "Estado: " . $linha['estado'] . "<br>";
                            echo "Cidade: " . $linha['cidade'] . "<br>";
                            echo "</div>";
                        }
                    } else {
                        echo "Nenhum dado encontrado!";
                    }
                    ?>
                </div>
            </div>
        </div>

        <div class="row justify-content-center mt-5">
            <div class="col-md-11 shadow rounded p-4">
                <h3>Informações de Contato</h3>
                <div class="texto_dados mt-4">
                    <?php
                    if ($dados4->rowCount() > 0) {
                        while ($linha = $dados4->fetch()) {
                            echo "<div class='mb-4' >";
                            echo "Responsável por Contato: " . $linha['responsavel_contato'] . "<br>";
                            echo "Cargo: " . $linha['cargo_responsavel'] . "<br>";
                            echo "Celular: " . $linha['celular_contato'] . "<br>";
                            echo "Email: " . $linha['email'] . "<br>";
                            if ($linha['pagina_web'] != "") {
                                echo "Página Web: " . $linha['pagina_web'] . "<br>";
                            }
                            echo "</div>";
                        }
                    } else {
                        echo "Nenhum dado encontrado!";
                    }
                    ?>
                </div>
            </div>
        </div>

        <div class="row justify-content-center mt-5 mb-5">
            <div class="col-md-11 shadow p-4">
                <h3>Descrição da Empresa</h3>
                <div class="texto_dados mt-4">
                    <?php
                    if ($dados5->rowCount() > 0) {
                        while ($linha = $dados5->fetch()) {
                            echo "<div class='mb-4' >";
                            echo $linha['descricao'] . "<br>";
                            echo "</div>";
                        }
                    } else {
                        echo "Nenhum dado encontrado!";
                    }
                    ?>
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

<script src="../../js/btnPerfil.js"></script>