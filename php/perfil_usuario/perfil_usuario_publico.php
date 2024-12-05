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
    'SELECT d.*, u.email FROM dados_pessoais d join usuario u on d.id_usuario = u.id_usuario WHERE d.id_usuario = :id_usuario'
);
$dados->execute(array(
    ':id_usuario' => $id
));

$dados2 = $conn->prepare(
    'SELECT * FROM dados_pessoais WHERE id_usuario = :id_usuario'
);
$dados2->execute(array(
    ':id_usuario' => $id
));

$dados3 = $conn->prepare(
    'SELECT * FROM dados_pessoais WHERE id_usuario = :id_usuario'
);
$dados3->execute(array(
    ':id_usuario' => $id
));

$exp_profissional = $conn->prepare(
    'SELECT * FROM experiencia WHERE id_usuario = :id_usuario'
);
$exp_profissional->execute(array(
    ':id_usuario' => $id
));

$exp_profissional = $conn->prepare(
    'SELECT * FROM experiencia WHERE id_usuario = :id_usuario'
);
$exp_profissional->execute(array(
    ':id_usuario' => $id
));

$exp_profissional2 = $conn->prepare(
    'SELECT * FROM experiencia WHERE id_usuario = :id_usuario'
);
$exp_profissional2->execute(array(
    ':id_usuario' => $id
));

$formacao = $conn->prepare(
    'SELECT * FROM formacao WHERE id_usuario = :id_usuario'
);
$formacao->execute(array(
    ':id_usuario' => $id
));

$formacao2 = $conn->prepare(
    'SELECT * FROM formacao WHERE id_usuario = :id_usuario'
);
$formacao2->execute(array(
    ':id_usuario' => $id
));

$idioma = $conn->prepare(
    'SELECT * FROM idioma WHERE id_usuario = :id_usuario'
);
$idioma->execute(array(
    ':id_usuario' => $id
));

$idioma2 = $conn->prepare(
    'SELECT * FROM idioma WHERE id_usuario = :id_usuario'
);
$idioma2->execute(array(
    ':id_usuario' => $id
));


$objetivo = $conn->prepare(
    'SELECT * FROM objetivo WHERE id_usuario = :id_usuario'
);
$objetivo->execute(array(
    ':id_usuario' => $id
));

$objetivo2 = $conn->prepare(
    'SELECT * FROM objetivo WHERE id_usuario = :id_usuario'
);
$objetivo2->execute(array(
    ':id_usuario' => $id
));

$especializacoes = $conn->prepare(
    'SELECT * FROM especializacoes WHERE id_usuario = :id_usuario'
);
$especializacoes->execute(array(
    ':id_usuario' => $id
));

$especializacoes2 = $conn->prepare(
    'SELECT * FROM especializacoes WHERE id_usuario = :id_usuario'
);
$especializacoes2->execute(array(
    ':id_usuario' => $id
));

$usuario = $conn->prepare(
    'SELECT * FROM usuario WHERE id_usuario = :id_usuario'
);
$usuario->execute(array(
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
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <script src="../../bootstrap/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../../bootstrap-icons/font/bootstrap-icons.min.css">
    <link id="favicon" rel="shortcut icon" type="imagex/png" href="../../img/Maozinha_branca.png">
    <script src="../../js/favicon_dentro.js"></script>
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
                                        <a href='../perfil_empresa/perfil_empresa.php' style='display: block;'>Perfil</a>
                                        <a href='../sair.php' style='display: block;' class='card1'>Sair</a>
                                    </div>
                                    ";
                            } else {
                                echo "
                                    <div class='d-inline-flex align-items-center' style='margin-right: 10px; margin-left: 10px; cursor: pointer;'  onclick='perfil()'>
                                    <img src='../../img/foto perfil/" . $linha['foto_perfil'] .  "' alt='Foto Perfil' id='btn-perfil' style='width: 50px; height: 50px; border: 1px solid white; border-radius: 50%;'/><p style='color: white; margin-bottom: 0; margin-right: 5px; margin-left: 5px;'>" . $linha['usuario'] . "</p><i class='bi bi-chevron-down' style='color: white'></i></div>";
                                echo "<div class='card' id='carde' style='display: none;'>
                                        <a href='../empresa/info_empresa.php' style='display: block;'>Completar cadastro empresa</a>
                                        <a href='../perfil_empresa/perfil_empresa.php'  style='display: block;'>Perfil</a>
                                        <a href='../sair.php' style='display: block;' class='card1'>Sair</a>
                                    </div>
                                    ";
                            }
                        }
                    } else {
                        echo "
                            <a href='../vaga;vaga.php' class='nav-link'>
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
                            echo "<img src='../../img/foto perfil/user2.png' width='125' height='125' id='profile' class='img' style='cursor: pointer;'>";
                        } else {
                            echo "<img src='../../img/foto perfil/" . $linha['foto_perfil'] . "' width='125' height='125' id='profile' class='img' style='cursor: pointer;'>";
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
                        echo "<div><h5>" . $linha['nome'] . " " . $linha['sobrenome'] . "</h5>";
                        echo "<h6>Contato</h6>";
                        echo "Email: " . $linha['email'] . "<br>";
                        echo "Celular: " . $linha['celular'] . "<br>";
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
                <h3>Dados Pessoais</h3>
                <div class="texto_dados mt-4 d-flex justify-content-start">
                    <?php
                    if ($dados2->rowCount() > 0) {
                        $linha = $dados2->fetch();
                        echo "Data de Nascimento: " . $linha['data'] . "<br>";
                        echo "Nacionalidade: " . $linha['pais'] . "<br>";
                        echo "CPF: " . $linha['cpf'] . "<br>";
                        echo "Raça/Etnia: " . $linha['raca'] . "<br>";
                        echo "Estado Civil: " . $linha['estado_civil'] . "<br>";
                        echo "Renda Pessoal: " . $linha['renda_pessoal'] . "<br>";
                        echo "Renda Familiar: " . $linha['renda_familiar'] . "<br>";
                        echo "Estrangeiro: " . $linha['estrangeiro'] . "<br>";
                        echo "CEP: " . $linha['cep'] . "<br>";
                        echo "Rua: " . $linha['rua'];
                        if ($linha['numero'] != "") {
                            echo "-" . $linha['numero'];
                        }
                        if ($linha['bairro'] != "") {
                            echo "-" . $linha['bairro'] . "<br>";
                        }
                        if ($linha['complemento'] != "") {
                            echo "Complemento: " . $linha['complemento'];
                        }
                        echo "<br>Cidade: " . $linha['cidade'] . "-" . $linha['estado'];
                        if ($linha['possui_deficiencia'] == "Não") {
                            echo "<br>Deficiência: Nenhuma";
                        } else {
                            echo "<br>Deficiência: " . $linha['deficiencia'] . "<br>";
                            echo "Suporte: " . $linha['suporte'];
                        }
                    } else {
                        echo "Nenhum dado encontrado!";
                    }
                    ?>
                </div>
            </div>
        </div>

        <div class="row justify-content-center mt-5">
            <div class="col-md-11 shadow p-4">
                <h3>Objetivo</h3>
                <div class="texto_dados mt-4">
                    <?php
                    if ($objetivo->rowCount() > 0) {
                        while ($linha = $objetivo->fetch()) {
                            echo "<div class='mb-4'>";
                            echo "Cargo de Interesse: " . $linha['cargo_de_interesse'] . "<br>";
                            echo "Pretenção Salarial: " . $linha['pretencao_salarial'] . "<br>";
                            echo "
                                </div>
                                ";
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
                <h3>Exp. Profissional</h3>
                <div class="texto_dados mt-4">
                    <?php
                    if ($exp_profissional->rowCount() > 0) {
                        while ($linha = $exp_profissional->fetch()) {
                            echo "<div class='mb-4' >";
                            echo "Empresa: " . $linha['empresa'] . "<br>";
                            echo "Responsabilidades: " . $linha['responsabilidades'] . "<br>";
                            echo "Cargo: " . $linha['cargo'] . "<br>";
                            if (isset($linha['nivel'])) {
                                echo "Nível: " . $linha['nivel'] . "<br>";
                            }
                            echo "Área: " . $linha['area'];
                            if ($linha['atual'] == "1") {
                                echo "<br>Emprego atual: Sim" . "<br>";
                            } else {
                                echo "<br>De: " . $linha['inicio_emprego'] . "<br>";
                                echo "Até: " . $linha['fim_emprego'] . "<br>";
                                echo "Emprego atual: Não" . "<br>";
                            }
                            echo "
                                </div>
                                ";
                        }
                    } else {
                        echo "Nenhum dado encontrado!";
                    }
                    ?>
                </div>
            </div>
        </div>

        <div class="row justify-content-center mt-5">
            <div class="col-md-11 shadow p-4">
                <h3>Formação</h3>
                <div class="texto_dados mt-4">
                    <?php
                    if ($formacao->rowCount() > 0) {
                        while ($linha = $formacao->fetch()) {
                            echo "<div class='mb-4' >";
                            echo "País: " . $linha['pais'] . "<br>";
                            echo "Estado: " . $linha['estado'] . "<br>";
                            echo "Nível: " . $linha['nivel'] . "<br>";
                            echo "Instituição: " . $linha['instituicao'] . "<br>";
                            if (($linha['nivel'] != "Ensino Fundamental") and ($linha['nivel'] != "Ensino Médio")) {
                                echo "Curso: " . $linha['curso'] . "<br>";
                            }
                            echo "Status: " . $linha['status'] . "<br>";
                            if (($linha['nivel'] != "Ensino Fundamental") and ($linha['nivel'] != "Ensino Médio")) {
                                echo "Campus: " . $linha['campus'] . "<br>";
                            }
                            echo "Início: " . $linha['inicio'] . "<br>";
                            echo "Previsão/Data de Conclusão: " . $linha['conclusao'] . "<br>";
                            if ($linha['status'] == "Cursando") {
                                echo "Turno: " . $linha['turno'] . "<br>";
                            }
                            echo "
                                </div>
                                ";
                        }
                    } else {
                        echo "Nenhum dado encontrado!";
                    }
                    ?>
                </div>
            </div>
        </div>

        <div class="row justify-content-center mt-5">
            <div class="col-md-11 shadow p-4">
                <h3>Especialização</h3>
                <div class="texto_dados mt-4">
                    <?php
                    if ($especializacoes->rowCount() > 0) {
                        while ($linha = $especializacoes->fetch()) {
                            echo "<div class='mb-4' >";
                            echo "País: " . $linha['pais'] . "<br>";
                            echo "Categoria: " . $linha['categoria'] . "<br>";
                            echo "Organização: " . $linha['organizacao'] . "<br>";
                            echo "Início: " . $linha['inicio'] . "<br>";
                            echo "Previsão/Data de Conclusão: " . $linha['final'] . "<br>";
                            echo "Responsabilidades: " . $linha['responsabilidades'] . "<br>";
                            echo "
                                </div>
                                ";
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
                <h3>Idioma</h3>
                <div class="texto_dados mt-4">
                    <?php
                    if ($idioma->rowCount() > 0) {
                        while ($linha = $idioma->fetch()) {
                            echo "<div class='mb-4' >";
                            echo "Idioma: " . $linha['idioma'] . "<br>";
                            echo "Proficiência: " . $linha['proficiencia'] . "<br>";
                            echo "
                                </div>
                                ";
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