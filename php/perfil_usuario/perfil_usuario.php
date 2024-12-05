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
    echo "<script>alert('Faça login para acessar o perfil');location = '../../html/login_usuario.html'</script>";
}

if ($tipo == "empresa") {
    echo "<script>alert('Entre como candidato para acessar o perfil');location = '../../html/login_usuario.html'</script>";
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

$candidatos = $conn->prepare(
    'SELECT 
        se.nome_fantasia, 
        v.*, 
        cv.* 
    FROM 
        candidato_vaga cv
    INNER JOIN 
        vaga v ON cv.id_vaga = v.id_vaga
    INNER JOIN 
        usuario u ON v.id_usuario = u.id_usuario
    INNER JOIN 
        sobre_empresa se ON u.id_usuario = se.id_usuario
    WHERE 
        cv.id_usuario = :id_usuario'
);
$candidatos->execute(array(
    ':id_usuario' => $id
));

$candidatos2 = $conn->prepare(
    'SELECT 
        se.nome_fantasia, 
        v.*, 
        cv.* 
    FROM 
        candidato_vaga cv
    INNER JOIN 
        vaga v ON cv.id_vaga = v.id_vaga
    INNER JOIN 
        usuario u ON v.id_usuario = u.id_usuario
    INNER JOIN 
        sobre_empresa se ON u.id_usuario = se.id_usuario
    WHERE 
        cv.id_usuario = :id_usuario'
);
$candidatos2->execute(array(
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
    <script src="../../js/mascara_input.js"></script>
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
                            <a href='../empresa/empresas.php' class='nav-link'>
                                Empresas Cadastradas
                            </a>
                        ";
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
                                        <a href='perfil_usuario.php' style='display: block;'>Perfil</a>
                                        <a href='../sair.php' style='display: block;' class='card1'>Sair</a>
                                    </div>
                                    ";
                            } else {
                                echo "
                                    <div class='d-inline-flex align-items-center' style='margin-right: 10px; margin-left: 10px; cursor: pointer;'  onclick='perfil()'>
                                    <img src='../../img/foto perfil/" . $linha['foto_perfil'] .  "' alt='Foto Perfil' id='btn-perfil' style='width: 50px; height: 50px; border: 1px solid white; border-radius: 50%;'/><p style='color: white; margin-bottom: 0; margin-right: 5px; margin-left: 5px;'>" . $linha['usuario'] . "</p><i class='bi bi-chevron-down' style='color: white'></i></div>";
                                echo "<div class='card' id='carde' style='display: none;'>
                                        <a href='../curriculo/cadastro_curriculo.php' style='display: block;'>Cadastrar currículo</a>
                                        <a href='perfil_usuario.php' style='display: block;'>Perfil</a>
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
                                    <img src='../img/foto perfil/user.png' alt='Foto Perfil' id='btn-perfil' style='width: 50px; height: 50px;'/><p style='color: white; margin-bottom: 0; margin-right: 5px; margin-left: 5px;'>" . $linha['usuario'] . "</p><i class='bi bi-chevron-down' style='color: white'></i></div>";
                                echo "<div class='card' id='carde' style='display: none;'>
                                        <a href='../empresa/info_empresa.php' style='display: block;'>Completar cadastro empresa</a>
                                        <a href='../perfil_empresa/perfil_empresa.php' style='display: block;'>Perfil</a>
                                        <a href='../sair.php' style='display: block;' class='card1'>Sair</a>
                                    </div>
                                    ";
                            } else {
                                echo "
                                    <div class='d-inline-flex align-items-center' style='margin-right: 10px; margin-left: 10px; cursor: pointer;'  onclick='perfil()'>
                                    <img src='../img/foto perfil/" . $linha['foto_perfil'] .  "' alt='Foto Perfil' id='btn-perfil' style='width: 50px; height: 50px; border: 1px solid white; border-radius: 50%;'/><p style='color: white; margin-bottom: 0; margin-right: 5px; margin-left: 5px;'>" . $linha['usuario'] . "</p><i class='bi bi-chevron-down' style='color: white'></i></div>";
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

    <div class="container-fluid">
        <div class="row justify-content-center mt-5">
            <div class="col-md-2 div_perfil d-flex justify-content-center align-items-center">
                <form action="adicionar_foto.php" method="post" enctype="multipart/form-data">
                    <div class="upload d-flex justify-content-center align-items-center">
                        <?php
                        foreach ($usuario as $linha) {
                            if ($linha['foto_perfil'] == null) {
                                echo "<img src='../../img/foto perfil/user.png' width='125' height='125' id='profile' class='img' style='cursor: pointer;'>";
                            } else {
                                echo "<img src='../../img/foto perfil/" . $linha['foto_perfil'] . "' width='125' height='125' id='profile' class='img' style='cursor: pointer;'>";
                            }
                        }
                        ?>
                        <div class="round">
                            <input type="file" id="flImage" name="image" class="foto" required>
                            <i class="bi bi-pencil-square" style="color:white"></i>
                        </div>
                    </div>
                    <input type="submit" value="Salvar foto" class="btn_foto">
                </form>
            </div>

            <div class="col-md-4 shadow rounded d-inline-flex div_perfil p-4">
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

            <div class="col-md-4 shadow rounded div_perfil p-4">
                <div class="row">
                    <div class="col-6">
                        <h4>Candidaturas</h4>
                    </div>
                    <div class="col-6 d-flex justify-content-end">
                        <a href="" data-bs-toggle="modal" data-bs-target="#modalcandidaturas">Ver Mais</a>
                    </div>
                </div>
                <?php
                foreach ($candidatos as $index => $linha) {
                    if ($index < 2) {
                        echo "
                        <div class='row mb-3'>
                            <div class='rounded border border-dark d-inline-flex'>
                                <div class='col-md-6'>
                                    <h5 class='m-0'>" . $linha['titulo'] . "</h5>
                                    <p class='m-0'>" . $linha['nome_fantasia'] . "</p>
                                </div>
                                <div class='col-md-6 d-flex justify-content-end m-auto'>
                                    <button type='button' class='btn btn-danger' onclick='deletarCandidatura(" . $linha["id_vaga"] . ")'>
                                        <i class='bi bi-trash' style='height: 20px; width: 20px;'></i>
                                        Apagar 
                                    </button>
                                </div>
                            </div>
                        </div>";
                    } else {
                        echo "
                        <div class='row mb-3' style='display: none;'>
                            <div class='rounded border border-dark d-inline-flex'>
                                <div class='col-md-6'>
                                    <h5 class='m-0'>Título da vaga</h5>
                                    <p class='m-0'>Nome da empresa</p>
                                </div>
                                <div class='col-md-6 d-flex justify-content-end m-auto'>
                                    <button type='button' class='btn btn-danger' onclick='deletarCandidatura(" . $linha["id_vaga"] . ")'>
                                        <i class='bi bi-trash' style='height: 20px; width: 20px;'></i>
                                        Apagar 
                                    </button>
                                </div>
                            </div>
                        </div>";
                    }
                }
                ?>
                <!-- The Modal -->
                <div class="modal fade" id="modalcandidaturas" tabindex="-1" aria-labelledby="modalcandidaturasLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Candidaturas</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                                <?php
                                foreach ($candidatos2 as $linha) {
                                    echo "
                                    <div class='row mb-3'>
                                        <div class='rounded border border-dark d-inline-flex'>
                                            <div class='col-md-6'>
                                                <h5 class='m-0'>" . $linha['titulo'] . "</h5>
                                                <p class='m-0'>" . $linha['nome_fantasia'] . "</p>
                                            </div>
                                            <div class='col-md-6 d-flex justify-content-end m-auto'>
                                                <button type='button' class='btn btn-danger' onclick='deletarCandidatura(" . $linha["id_vaga"] . ")'> 
                                                    <i class='bi bi-trash' style='height: 20px; width: 20px;'></i>
                                                    Apagar 
                                                </button>
                                            </div>
                                        </div>
                                    </div>";
                                }
                                ?>
                            </div>
                        </div>
                    </div>
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
                <div class="d-flex justify-content-end">
                    <button class="btn_editar" data-bs-toggle="modal" data-bs-target="#modalDadosPessoaisAlterar">
                        <i class="bi bi-plus-lg"></i>
                        Editar
                    </button>
                </div>
            </div>

            <?php
            $raca = ["Preta", "Parda", "Indígena", "Amarela", "Branca", "Outro", "Prefiro não responder"];
            $estado_civil = ["Solteiro(a)", "Casado(a)", "Divorciado(a)", "Viúvo(a)"];
            $renda_mensal = ["Nenhuma Renda", "Até 2 salários-mínimos", "De 2 a 4 sálarios-mínimos", "De 4 a 10 sálarios-mínimos", "De 10 a 20 sálarios-mínimos", "Acima de 20 sálarios-mínimos", "Prefiro não responder"];
            $renda_familiar = ["Nenhuma Renda", "Até 2 salários-mínimos", "De 2 a 4 sálarios-mínimos", "De 4 a 10 sálarios-mínimos", "De 10 a 20 sálarios-mínimos", "Acima de 20 sálarios-mínimos", "Prefiro não responder"];
            $estado = ["Acre", "Alagoas", "Amapá", "Amazonas", "Bahia", "Ceará", "Distrito Federal", "Espírito Santo", "Goiás", "Maranhão", "Mato Grosso", "Mato Grosso do Sul", "Minas Gerais", "Pará", "Paraíba", "Paraná", "Pernambuco", "Piauí", "Rio de Janeiro", "Rio Grande do Norte", "Rio Grande do Sul", "Rondônia", "Rondônia", "Santa Catarina", "São Paulo", "Sergipe", "Tocantins"];
            foreach ($dados3 as $linha) {
            ?>
                <!-- The Modal -->
                <div class="modal fade" id="modalDadosPessoaisAlterar">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Dados Pessoais</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                                <form action="alterar_dados_pessoais.php" method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="id" value="<?php echo $linha['id_dados'] ?>">
                                    <!-- Nome, Sobrenome, Nome Social, Email -->
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label for="nome" class="form-label">* Nome:</label>
                                            <input type="text" class="form-control" placeholder="Nome" name="Nome" value="<?php echo $linha['nome'] ?>" required>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="sobrenome" class="form-label">* Sobrenome:</label>
                                            <input type="text" class="form-control" placeholder="Sobrenome" name="Sobrenome" value="<?php echo $linha['sobrenome'] ?>" required>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="nomesocial" class="form-label">Nome Social:</label>
                                            <input type="text" class="form-control" placeholder="Nome Social" name="NomeSocial" value="<?php echo $linha['nome_social'] ?>">
                                        </div>
                                    </div>
                                    <!-- País, CPF, Celular, Data de Nascimento -->
                                    <div class="row mt-3">
                                        <div class="form-group col-md-3">
                                            <label for="origem" class="form-label">* País de Origem:</label>
                                            <input type="text" class="form-control" placeholder="País de Origem" name="Origem" value="<?php echo $linha['pais'] ?>" required>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="cpf" class="form-label">* CPF:</label>
                                            <input type="text" class="form-control" name="CPF" value="<?php echo $linha['cpf'] ?>" placeholder="XXX.XXX.XXX-XX" maxlength="14" oninput="aplicarMascaraCPF(this)" required>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="celular" class="form-label">* Celular:</label>
                                            <input type="text" class="form-control" name="Celular" value="<?php echo $linha['celular'] ?>" maxlength="15" oninput="aplicarMascaraTelefone(this)" placeholder="(XX) XXXXX-XXXX" required>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="nascimemnto" class="form-label">* Data de Nascimento:</label>
                                            <input type="date" class="form-control" placeholder="Data de Nascimento" name="Nascimemnto" value="<?php echo $linha['data'] ?>" required>
                                        </div>
                                    </div>
                                    <!-- Raç, Estado Civil -->
                                    <div class="row mt-3">
                                        <div class="form-group col-md-6">
                                            <label for="Raca" class="form-label">* Raça/Etnia:</label>
                                            <select name="Raca" id="Raca" class="form-select" required>
                                                <option value="" disabled selected>Selecione</option>
                                                <?php
                                                for ($cont = 0; $cont < 7; $cont++)
                                                    if ($linha['raca'] == $raca[$cont]) {
                                                        echo "<option value='$raca[$cont]' selected> $raca[$cont]</option>";
                                                    } else {
                                                        echo "<option value='$raca[$cont]'> $raca[$cont]</option>";
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="EstadoCivil" class="form-label">* Estado Civil:</label>
                                            <select name="EstadoCivil" id="EstadoCivil" class="form-select">
                                                <option value="" disabled selected>Selecione</option>
                                                <?php
                                                for ($cont = 0; $cont < 4; $cont++)
                                                    if ($linha['estado_civil'] == $estado_civil[$cont]) {
                                                        echo "<option value='$estado_civil[$cont]' selected> $estado_civil[$cont]</option>";
                                                    } else {
                                                        echo "<option value='$estado_civil[$cont]'> $estado_civil[$cont]</option>";
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- Estrangeiro -->
                                    <div class="row mt-3">
                                        <div class="col-md-1">
                                            <label for="Estrangeiro">Estrangeiro?</label>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="form-check">
                                                <?php
                                                echo "<input type='radio' class='form-check-input' id='Estrangeiro' name='Estrangeiro' value='Sim'";
                                                if ($linha['estrangeiro'] == 'Sim') {
                                                    echo " checked>";
                                                } else {
                                                    echo ">";
                                                }
                                                ?>
                                                <label class="form-check-label" for="Estrangeiro">Sim</label>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="form-check">
                                                <?php
                                                echo "<input type='radio' class='form-check-input' id='Estrangeiro' name='Estrangeiro' value='Não'";
                                                if ($linha['estrangeiro'] == 'Não') {
                                                    echo " checked>";
                                                } else {
                                                    echo ">";
                                                }
                                                ?>
                                                <label class="form-check-label" for="Estrangeiro">Não</label>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Possui Deficiência -->
                                    <div class="row mt-3">
                                        <div class="col-md-3">
                                            <label for="PossuiDeficiencia">Possui alguma deficiência?</label>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="form-check">
                                                <?php
                                                echo "<input type='radio' class='form-check-input' id='PossuiDeficiencia' name='PossuiDeficiencia' value='Sim' onclick='habilitaralt(true)'";
                                                if ($linha['possui_deficiencia'] == 'Sim') {
                                                    echo " checked>";
                                                } else {
                                                    echo ">";
                                                }
                                                ?>
                                                <label class="form-check-label" for="Deficiencia">Sim</label>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="form-check">
                                                <?php
                                                echo "<input type='radio' class='form-check-input' id='PossuiDeficiencia' name='PossuiDeficiencia' value='Não' onclick='habilitaralt(false)'";
                                                if ($linha['possui_deficiencia'] == 'Não') {
                                                    echo " checked>";
                                                } else {
                                                    echo ">";
                                                }
                                                ?>
                                                <label class="form-check-label" for="Deficiencia">Não</label>
                                            </div>
                                        </div>
                                    </div>
                                    <fieldset id="deficiencialabelAlt" hidden>
                                        <!-- Tipo Deficiência -->
                                        <div class="row mt-3">
                                            <div class="form-group col-md-3">
                                                <label for="celular" class="form-label">* Qual Deficiência:</label>
                                                <input type="text" class="form-control" placeholder="Deficiência" name="Deficiencia" id="deficienciaCampoAlt" value="<?php echo $linha['deficiencia'] ?>" required>
                                            </div>
                                        </div>
                                        <!-- Laudo Médico -->
                                        <div class="row mt-3">
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label for="Laudo">* Anexar laudo Médico:</label>
                                                    <input type="file" class="form-control" name="Laudo" id="laudoCampoAlt" value="<?php echo $linha['laudo'] ?>" required>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Caracterísica PcD -->
                                        <div class="row mt-3">
                                            <div class="col-md-12">
                                                <label for="Caracteristica">* Digite aqui algum suporte especial que sua característica como PcD demande durante a participação no recrutamento (ex.: descrição de texto em áudios, aumento de tamanho dos textos, etc.):</label>
                                                <textarea class="form-control" rows="5" name="Caracteristica" maxlength="255" id="caracteristicaCampoAlt" required><?php echo $linha['suporte'] ?></textarea>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <!-- Renda Mensal, Renda Familiar -->
                                    <div class="row mt-3">
                                        <div class="form-group col-md-6">
                                            <label for="RendaMensal" class="form-label">* Qual a sua renda mensal, aproximadamente?</label>
                                            <select name="RendaMensal" id="RendaMensal" class="form-select" required>
                                                <option value="" disabled selected>Selecione</option>
                                                <?php
                                                for ($cont = 0; $cont < 7; $cont++)
                                                    if ($linha['renda_pessoal'] == $renda_mensal[$cont]) {
                                                        echo "<option value='$renda_mensal[$cont]' selected> $renda_mensal[$cont]</option>";
                                                    } else {
                                                        echo "<option value='$renda_mensal[$cont]'> $renda_mensal[$cont]</option>";
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="RendaFamiliar" class="form-label">* Qual a sua renda familiar, aproximadamente?</label>
                                            <select name="RendaFamiliar" id="RendaFamiliar" class="form-select" required>
                                                <option value="" disabled selected>Selecione</option>
                                                <?php
                                                for ($cont = 0; $cont < 7; $cont++)
                                                    if ($linha['renda_familiar'] == $renda_familiar[$cont]) {
                                                        echo "<option value='$renda_familiar[$cont]' selected> $renda_familiar[$cont]</option>";
                                                    } else {
                                                        echo "<option value='$renda_familiar[$cont]'> $renda_familiar[$cont]</option>";
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- CEP, Rua -->
                                    <div class="row mt-3">
                                        <div class="form-group col-md-6">
                                            <label for="CEP" class="form-label">* CEP:</label>
                                            <input type="text" class="form-control" name="CEP" value="<?php echo $linha['cep'] ?>" maxlength="10" oninput="aplicarMascaraCEP(this)" placeholder="XXXXX-XXX" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="Rua" class="form-label">* Rua:</label>
                                            <input type="text" class="form-control" placeholder="Rua" name="Rua" value="<?php echo $linha['rua'] ?>" required>
                                        </div>
                                    </div>
                                    <!-- Número, Complemento, Bairro -->
                                    <div class="row mt-3">
                                        <div class="form-group col-md-4">
                                            <label for="Numero" class="form-label">Número:</label>
                                            <input type="number" class="form-control" placeholder="Numero" name="Numero" value="<?php echo $linha['numero'] ?>">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="Complemento" class="form-label">Complemento:</label>
                                            <input type="text" class="form-control" placeholder="Complemento" name="Complemento" value="<?php echo $linha['complemento'] ?>">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="Bairro" class="form-label">Bairro:</label>
                                            <input type="text" class="form-control" placeholder="Bairro" name="Bairro" value="<?php echo $linha['bairro'] ?>">
                                        </div>
                                    </div>
                                    <!-- Estado, Cidade -->
                                    <div class="row mt-3">
                                        <div class="form-group col-md-6">
                                            <label for="Estado" class="form-label">* Estado:</label>
                                            <select name="Estado" id="Estado" class="form-select" required>
                                                <option value="" disabled selected>Selecione</option>
                                                <?php
                                                for ($cont = 0; $cont < 27; $cont++)
                                                    if ($linha['estado'] == $estado[$cont]) {
                                                        echo "<option value='$estado[$cont]' selected> $estado[$cont]</option>";
                                                    } else {
                                                        echo "<option value='$estado[$cont]'> $estado[$cont]</option>";
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="Cidade" class="form-label">* Cidade:</label>
                                            <input type="text" class="form-control" placeholder="Cidade" name="Cidade" value="<?php echo $linha['cidade'] ?>" required>
                                        </div>
                                    </div>
                                    <!-- Sobre Você -->
                                    <div class="row mt-3">
                                        <div class="col-md-12">
                                            <label for="Sobre">Tem algo mais que você considera importante contar sobre você?</label>
                                            <textarea class="form-control" rows="5" id="Sobre" name="Sobre"><?php echo $linha['comentario'] ?></textarea>
                                        </div>
                                    </div>
                                    <!-- Vídeo Currículo -->
                                    <div class="row mt-3">
                                        <div class="form-group col-md-12">
                                            <label for="Video" class="form-label">Vídeo Currículo:</label>
                                            <input type="text" class="form-control" placeholder="Video" name="Video" value="<?php echo $linha['video'] ?>">
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
            <?php
            }
            ?>
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
                                <div class='btn-group mt-3'>
                                    <button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#modalObjetivoAlterar'>
                                        <i class='bi bi-pencil-square' style='height: 20px; width: 20px;'></i>
                                        Editar
                                    </button>
                                    <button type='button' class='btn btn-danger' onclick='deletarObjetivo(" . $linha["id_objetivo"] . ")'>
                                        <i class='bi bi-trash' style='height: 20px; width: 20px;'></i>
                                        Apagar 
                                    </button>
                                </div>
                                </div>
                                ";
                        }
                    } else {
                        echo "Nenhum dado encontrado!";
                    }
                    ?>
                </div>
                <div class="d-flex justify-content-end">
                    <button class="btn_editar" data-bs-toggle="modal" data-bs-target="#modalObjetivo">
                        <i class="bi bi-plus-lg"></i>
                        Adicionar Objetivo
                    </button>
                </div>
            </div>
            <!-- The Modal -->
            <div class="modal fade" id="modalObjetivo">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Objetivo</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <!-- Modal body -->
                        <div class="modal-body">
                            <form action="../curriculo/cadastro_objetivo.php" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="redirect" value="../perfil_usuario/perfil_usuario.php">
                                <!-- Cargo de Interesse, Pretenção Salarial -->
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="Cargo de Interesse" class="form-label">* Cargo de Interesse:</label>
                                        <input type="text" class="form-control" placeholder="Cargo de Interesse" name="CargoDeInteresse" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="PretencaoSalarial" class="form-label">* Pretenção Salarial:</label>
                                        <select name="PretencaoSalarial" id="PretencaoSalarial" class="form-select" required>
                                            <option value="" disabled selected>Selecione</option>
                                            <option value="A partir de R$1.000">A partir de R$1.000</option>
                                            <option value="A partir de R$2.000">A partir de R$2.000</option>
                                            <option value="A partir de R$3.000">A partir de R$3.000</option>
                                            <option value="A partir de R$4.000">A partir de R$4.000</option>
                                            <option value="A partir de R$5.000">A partir de R$5.000</option>
                                            <option value="A partir de R$6.000">A partir de R$6.000</option>
                                            <option value="A partir de R$7.000">A partir de R$7.000</option>
                                            <option value="A partir de R$8.000">A partir de R$8.000</option>
                                            <option value="A partir de R$9.000">A partir de R$9.000</option>
                                            <option value="A partir de R$10.000">A partir de R$10.000</option>
                                        </select>
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

            <?php
            $pretencao = ["A partir de R$1.000", "A partir de R$2.000", "A partir de R$3.000", "A partir de R$4.000", "A partir de R$5.000", "A partir de R$6.000", "A partir de R$7.000", "A partir de R$8.000", "A partir de R$9.000", "A partir de R$10.000"];
            foreach ($objetivo2 as $linha) {
            ?>
                <!-- The Modal -->
                <div class="modal fade" id="modalObjetivoAlterar">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Objetivo</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <!-- Modal body -->
                            <div class="modal-body">
                                <form action="alterar_objetivo.php" method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="id" value="<?php echo $linha['id_objetivo'] ?>">
                                    <!-- Cargo de Interesse, Pretenção Salarial -->
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="Cargo de Interesse" class="form-label">* Cargo de Interesse:</label>
                                            <input type="text" class="form-control" placeholder="Cargo de Interesse" name="CargoDeInteresse" value="<?php echo $linha['cargo_de_interesse'] ?>" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="PretencaoSalarial" class="form-label">* Pretenção Salarial:</label>
                                            <select name="PretencaoSalarial" id="PretencaoSalarial" class="form-select" required>
                                                <option value="" disabled selected>Selecione</option>
                                                <?php
                                                for ($cont = 0; $cont < 10; $cont++)
                                                    if ($linha['pretencao_salarial'] == $pretencao[$cont]) {
                                                        echo "<option value='$pretencao[$cont]' selected> $pretencao[$cont]</option>";
                                                    } else {
                                                        echo "<option value='$pretencao[$cont]'> $pretencao[$cont]</option>";
                                                    }
                                                ?>
                                            </select>
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
            <?php
            }
            ?>

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
                                <div class='btn-group mt-3'>
                                    <button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#modalExperienciaAlterar'>
                                        <i class='bi bi-pencil-square' style='height: 20px; width: 20px;'></i>
                                        Editar
                                    </button>
                                    <button type='button' class='btn btn-danger' onclick='deletarExpProfissional(" . $linha["id_experiencia"] . ")'>
                                        <i class='bi bi-trash' style='height: 20px; width: 20px;'></i>
                                        Apagar 
                                    </button>
                                </div>
                                </div>
                                ";
                        }
                    } else {
                        echo "Nenhum dado encontrado!";
                    }
                    ?>
                </div>
                <div class="d-flex justify-content-end">
                    <button class="btn_editar" data-bs-toggle="modal" data-bs-target="#modalExperiencia">
                        <i class="bi bi-plus-lg"></i>
                        Adicionar Exp. Profissional
                    </button>
                </div>
            </div>
            <!-- The Modal -->
            <div class="modal fade" id="modalExperiencia">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Exp.Profissional</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <!-- Modal body -->
                        <div class="modal-body">
                            <form action="../curriculo/cadastro_exp_profissional.php" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="redirect" value="../perfil_usuario/perfil_usuario.php">
                                <!-- Empresa -->
                                <div class="row mt-3">
                                    <div class="form-group col-md-12">
                                        <label for="Empresa" class="form-label">* Empresa:</label>
                                        <input type="text" class="form-control" placeholder="Empresa" name="Empresa" required>
                                    </div>
                                </div>
                                <!-- Responsabilidades -->
                                <div class="row mt-3">
                                    <div class="form-group col-md-12">
                                        <label for="Responsabilidades" class="form-label">* Responsabilidades:</label>
                                        <textarea class="form-control" rows="5" id="Responsabilidades" name="Responsabilidades" maxlength="255" required></textarea>
                                    </div>
                                </div>
                                <!-- Cargo, Nível, Área -->
                                <div class="row mt-3">
                                    <div class="form-group col-md-4">
                                        <label for="Cargo" class="form-label">* Cargo:</label>
                                        <input type="text" class="form-control" placeholder="Cargo" name="Cargo" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="Nivel" class="form-label">Nível:</label>
                                        <select name="Nivel" id="Nivel" class="form-select">
                                            <option value="" disabled selected>Selecione</option>
                                            <option value="Estagiário">Estagiário</option>
                                            <option value="Operacional">Operacional</option>
                                            <option value="Auxiliar">Auxiliar</option>
                                            <option value="Assistente">Assistente</option>
                                            <option value="Treinee">Treinee</option>
                                            <option value="Analista">Analista</option>
                                            <option value="Encarregado">Encarregado</option>
                                            <option value="Supervisor">Supervisor</option>
                                            <option value="Consultor">Consultor</option>
                                            <option value="Especialista">Especialista</option>
                                            <option value="Coordenador">Coordenador</option>
                                            <option value="Gerente">Gerente</option>
                                            <option value="Diretor">Diretor</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="Area" class="form-label">* Área:</label>
                                        <select name="Area" id="Area" class="form-select" required>
                                            <option value="" disabled selected>Selecione</option>
                                            <option value="Administração">Administração</option>
                                            <option value="Agricultura, Pecuária, Veterinária">Agricultura</option>
                                            <option value="Alimentação / Gastronomia">Alimentação</option>
                                            <option value="Arquitetura, Decoração, Design">Arquitetura</option>
                                            <option value="Artes">Artes</option>
                                            <option value="Auditoria">Auditoria</option>
                                            <option value="Ciências">Ciências</option>
                                            <option value="Comercial">Comercial</option>
                                            <option value="Comunicação">Comunicação</option>
                                            <option value="Construção">Construção</option>
                                            <option value="Contábil">Contábil</option>
                                            <option value="Cultura">Cultura</option>
                                            <option value="Educação">Educação</option>
                                            <option value="Engenharia">Engenharia</option>
                                            <option value="Industrial">Industrial</option>
                                            <option value="Informática">Informática</option>
                                            <option value="Jurídica">Jurídica</option>
                                            <option value="Logística">Logística</option>
                                            <option value="Marketing">Marketing</option>
                                            <option value="Moda">Moda</option>
                                            <option value="Qualidade">Qualidade</option>
                                            <option value="Recursos Humanos">Recursos Humanos</option>
                                            <option value="Saúde">Saúde</option>
                                            <option value="Segurança">Segurança</option>
                                            <option value="Serviço Social e Comunitário">Serviço Social e Comunitário</option>
                                            <option value="Serviços Gerais">Serviços Gerais</option>
                                            <option value="Telemarketing">Telemarketing</option>
                                            <option value="Transportes">Transportes</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- Inicio Emprego, Fim emprego, Cargo atual -->
                                <div class="row mt-3">
                                    <div class="form-group col-md-4">
                                        <label for="InicioEmprego" class="form-label">* De:</label>
                                        <input type="date" class="form-control" placeholder="Inicio Emprego" name="InicioEmprego" required>
                                    </div>
                                    <div class="form-group col-md-4" id="fieldsetlabel">
                                        <label for="FimEmprego" class="form-label">* Até:</label>
                                        <input type="date" class="form-control" placeholder="Fim Emprego" name="FimEmprego" id="fieldset2" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="Atual" class="form-label">Meu cargo atual:</label>
                                        <input type="checkbox" class="form-check-input" placeholder="Atual" name="Atual" onclick="habilitar2(this)">
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

            <?php
            $nivel = ["Estagiário", "Operacional", "Auxiliar", "Assistente", "Treinee", "Analista", "Encarregado", "Supervisor", "Consultor", "Especialista", "Coordenador", "Gerente", "Diretor"];
            $area = ["Administração", "Agricultura, Pecuária, Veterinária", "Alimentação / Gastronomia", "Arquitetura, Decoração, Design", "Artes", "Auditoria", "Ciências", "Comercial", "Comunicação", "Construção", "Contábil", "Cultura", "Educação", "Engenharia", "Industrial", "Informática", "Jurídica", "Logística", "Marketing", "Moda", "Qualidade", "Recursos Humanos", "Saúde", "Segurança", "Serviço Social e Comunitário", "Serviços Gerais", "Telemarketing", "Transportes"];
            foreach ($exp_profissional2 as $linha) {
            ?>
                <!-- The Modal -->
                <div class="modal fade" id="modalExperienciaAlterar">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Exp.Profissional</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <!-- Modal body -->
                            <div class="modal-body">
                                <form action="alterar_exp_profissional.php" method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="id" value="<?php echo $linha['id_experiencia'] ?>">
                                    <!-- Empresa -->
                                    <div class="row mt-3">
                                        <div class="form-group col-md-12">
                                            <label for="Empresa" class="form-label">* Empresa:</label>
                                            <input type="text" class="form-control" placeholder="Empresa" name="Empresa" value="<?php echo $linha['empresa'] ?>" required>
                                        </div>
                                    </div>
                                    <!-- Responsabilidades -->
                                    <div class="row mt-3">
                                        <div class="form-group col-md-12">
                                            <label for="Responsabilidades" class="form-label">* Responsabilidades:</label>
                                            <textarea class="form-control" rows="5" id="Responsabilidades" name="Responsabilidades" maxlength="255" required><?php echo $linha['responsabilidades'] ?></textarea>
                                        </div>
                                    </div>
                                    <!-- Cargo, Nível, Área -->
                                    <div class="row mt-3">
                                        <div class="form-group col-md-4">
                                            <label for="Cargo" class="form-label">* Cargo:</label>
                                            <input type="text" class="form-control" placeholder="Cargo" name="Cargo" value="<?php echo $linha['cargo'] ?>" required>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="Nivel" class="form-label">Nível:</label>
                                            <select name="Nivel" id="Nivel" class="form-select">
                                                <option value="" disabled selected>Selecione</option>
                                                <?php
                                                for ($cont = 0; $cont < 12; $cont++)
                                                    if ($linha['nivel'] == $nivel[$cont]) {
                                                        echo "<option value='$nivel[$cont]' selected > $nivel[$cont]</option>";
                                                    } else {
                                                        echo "<option value='$nivel[$cont]'> $nivel[$cont]</option>";
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="Area" class="form-label">* Área:</label>
                                            <select name="Area" id="Area" class="form-select" required>
                                                <option value="" disabled selected>Selecione</option>
                                                <?php
                                                for ($cont = 0; $cont < 27; $cont++)
                                                    if ($linha['area'] == $area[$cont]) {
                                                        echo "<option value='$area[$cont]' selected >$area[$cont]</option>";
                                                    } else {
                                                        echo "<option value='$area[$cont]'>$area[$cont]</option>";
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- Inicio Emprego, Fim emprego, Cargo atual -->
                                    <div class="row mt-3">
                                        <div class="form-group col-md-4">
                                            <label for="InicioEmprego" class="form-label">* De:</label>
                                            <input type="date" class="form-control" placeholder="Inicio Emprego" name="InicioEmprego" value="<?php echo $linha['inicio_emprego'] ?>" required>
                                        </div>
                                        <div class="form-group col-md-4" id="fieldsetlabelalt">
                                            <label for="FimEmprego" class="form-label">* Até:</label>
                                            <input type="date" class="form-control" placeholder="Fim Emprego" name="FimEmprego" id="fieldset2alt" value="<?php echo $linha['fim_emprego'] ?>" required>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="Atual" class="form-label">Meu cargo atual:</label>
                                            <?php
                                            echo "<input type='checkbox' class='form-check-input' name='Atual' onclick='habilitar2alt(this)' value='" . $linha['atual'] . "'";
                                            if ($linha['atual'] == '1') {
                                                echo " checked>";
                                            } else {
                                                echo ">";
                                            }
                                            ?>
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
            <?php
            }
            ?>

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
                                <div class='btn-group mt-3'>
                                    <button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#modalFormacaoAlterar'>
                                        <i class='bi bi-pencil-square' style='height: 20px; width: 20px;'></i>
                                        Editar
                                    </button>
                                    <button type='button' class='btn btn-danger' onclick='deletarFormacao(" . $linha["id_formacao"] . ")'>
                                        <i class='bi bi-trash' style='height: 20px; width: 20px;'></i>
                                        Apagar 
                                    </button>
                                </div>
                                </div>
                                ";
                        }
                    } else {
                        echo "Nenhum dado encontrado!";
                    }
                    ?>
                </div>
                <div class="d-flex justify-content-end">
                    <button class="btn_editar" data-bs-toggle="modal" data-bs-target="#modalFormacao">
                        <i class="bi bi-plus-lg"></i>
                        Adicionar Formação
                    </button>
                </div>
            </div>
            <!-- The Modal -->
            <div class="modal fade" id="modalFormacao">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Formação</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            <form action="../curriculo/cadastro_formacao.php" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="redirect" value="../perfil_usuario/perfil_usuario.php">
                                <!-- Cargo de País, Estado -->
                                <div class="row mt-3">
                                    <div class="form-group col-md-6">
                                        <label for="Pais" class="form-label">* País:</label>
                                        <input type="text" class="form-control" placeholder="País" name="Pais" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="Estado" class="form-label">* Estado:</label>
                                        <select name="Estado" id="Estado" class="form-select" required>
                                            <option value="" disabled selected>Selecione</option>
                                            <option value="Acre">Acre</option>
                                            <option value="Alagoas">Alagoas</option>
                                            <option value="Amapá">Amapá</option>
                                            <option value="Amazonas">Amazonas</option>
                                            <option value="Bahia">Bahia</option>
                                            <option value="Ceará">Ceará</option>
                                            <option value="Distrito Federal">Distrito Federal</option>
                                            <option value="Espírito Santo">Espírito Santo</option>
                                            <option value="Goiás">Goiás</option>
                                            <option value="Maranhão">Maranhão</option>
                                            <option value="Mato Grosso">Mato Grosso</option>
                                            <option value="Mato Grosso do Sul">Mato Grosso do Sul</option>
                                            <option value="Minas Gerais">Minas Gerais</option>
                                            <option value="Pará">Pará</option>
                                            <option value="Paraíba">Paraíba</option>
                                            <option value="Paraná">Paraná</option>
                                            <option value="Pernambuco">Pernambuco</option>
                                            <option value="Piauí">Piauí</option>
                                            <option value="Rio de Janeiro">Rio de Janeiro</option>
                                            <option value="Rio Grande do Norte">Rio Grande do Norte</option>
                                            <option value="Rio Grande do Sul">Rio Grande do Sul</option>
                                            <option value="Rondônia">Rondônia</option>
                                            <option value="Roraima">Roraima</option>
                                            <option value="Santa Catarina">Santa Catarina</option>
                                            <option value="São Paulo">São Paulo </option>
                                            <option value="Sergipe">Sergipe</option>
                                            <option value="Tocantins">Tocantins</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- Nível, Instituição e Curso -->
                                <div class="row mt-3">
                                    <div class="form-group col-md-4" id="nivel">
                                        <label for="Nivel" class="form-label">* Nível:</label>
                                        <select name="Nivel" id="Nivel" class="form-select" required onchange="habilitar3(this)">
                                            <option value="" disabled selected>Selecione</option>
                                            <option value="Ensino Fundamental">Ensino Fundamental</option>
                                            <option value="Ensino Médio">Ensino Médio</option>
                                            <option value="Técnico">Técnico</option>
                                            <option value="Graduação">Graduação</option>
                                            <option value="Especialização">Especialização</option>
                                            <option value="Mestrado">Mestrado</option>
                                            <option value="Doutorado">Doutorado</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4" id="instituicao">
                                        <label for="Instituicao" class="form-label">* Instituição:</label>
                                        <input type="text" class="form-control" placeholder="Instituição" name="Instituicao" required>
                                    </div>
                                    <div class="form-group col-md-4" id="Cursolabel">
                                        <label for="Curso" class="form-label">* Curso:</label>
                                        <input type="text" class="form-control" placeholder="Curso" name="Curso" id="Curso" required>
                                    </div>
                                </div>
                                <!-- Status, Campus -->
                                <div class="row mt-3">
                                    <div class="form-group col-md-6" id="status">
                                        <label for="Status" class="form-label">* Status:</label>
                                        <select name="Status" id="Status" class="form-select" required onchange="habilitar4(this)">
                                            <option value="" disabled selected>Selecione</option>
                                            <option value="Cursando">Cursando</option>
                                            <option value="Trancado">Trancado</option>
                                            <option value="Concluído">Concluído</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6" id="Campuslabel">
                                        <label for="Campus" class="form-label">Campus:</label>
                                        <input type="text" class="form-control" placeholder="Campus" name="Campus" id="Campus">
                                    </div>
                                </div>
                                <!-- Inicio Formação, Fim Formação, Turno -->
                                <div class="row mt-3">
                                    <div class="form-group col-md-4" id="inicio">
                                        <label for="InicioFormacao" class="form-label">* Início:</label>
                                        <input type="date" class="form-control" placeholder="Inicio Formação" name="InicioFormacao" required>
                                    </div>
                                    <div class="form-group col-md-4" id="fim">
                                        <label for="FimFormacao" class="form-label">* Previsão/Data de Conclusão:</label>
                                        <input type="date" class="form-control" placeholder="Fim Formação" name="FimFormacao" required>
                                    </div>
                                    <div class="form-group col-md-4" id="Turnolabel">
                                        <label for="Turno" class="form-label">Turno:</label>
                                        <select name="Turno" class="form-select" id="Turno">
                                            <option value="" disabled selected>Selecione</option>
                                            <option value="Matutino">Matutino</option>
                                            <option value="Vespertino">Vespertino</option>
                                            <option value="Noturno">Noturno</option>
                                            <option value="Integral">Integral</option>
                                            <option value="EAD">EAD</option>
                                        </select>
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

            <?php
            $estado = ["Acre", "Alagoas", "Amapá", "Amazonas", "Bahia", "Ceará", "Distrito Federal", "Espírito Santo", "Goiás", "Maranhão", "Mato Grosso", "Mato Grosso do Sul", "Minas Gerais", "Pará", "Paraíba", "Paraná", "Pernambuco", "Piauí", "Rio de Janeiro", "Rio Grande do Norte", "Rio Grande do Sul", "Rondônia", "Rondônia", "Santa Catarina", "São Paulo", "Sergipe", "Tocantins"];
            $nivel = ["Ensino Fundamental", "Ensino Médio", "Técnico", "Graduação", "Especialização", "Mestrado", "Doutorado"];
            $status = ["Cursando", "Trancado", "Concluído"];
            $turno = ["Matutino", "Vespertino", "Noturno", "Integral", "EAD"];
            foreach ($formacao2 as $linha) {
            ?>
                <!-- The Modal -->
                <div class="modal fade" id="modalFormacaoAlterar">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Formação</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                                <form action="alterar_formacao.php" method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="id" value="<?php echo $linha['id_formacao'] ?>">
                                    <!-- Cargo de País, Estado -->
                                    <div class="row mt-3">
                                        <div class="form-group col-md-6">
                                            <label for="Pais" class="form-label">* País:</label>
                                            <input type="text" class="form-control" placeholder="País" name="Pais" value="<?php echo $linha['pais'] ?>" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="Estado" class="form-label">* Estado:</label>
                                            <select name="Estado" id="Estado" class="form-select" required>
                                                <option value="" disabled selected>Selecione</option>
                                                <?php
                                                for ($cont = 0; $cont < 26; $cont++)
                                                    if ($linha['estado'] == $estado[$cont]) {
                                                        echo "<option value='$estado[$cont]' selected > $estado[$cont]</option>";
                                                    } else {
                                                        echo "<option value='$estado[$cont]'> $estado[$cont]</option>";
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- Nível, Instituição e Curso -->
                                    <div class="row mt-3">
                                        <div class="form-group col-md-4" id="nivelAlt">
                                            <label for="Nivel" class="form-label">* Nível:</label>
                                            <select name="Nivel" id="Nivel" class="form-select" required onchange="habilitar3alt(this)">
                                                <option value="" disabled selected>Selecione</option>
                                                <?php
                                                for ($cont = 0; $cont < 6; $cont++)
                                                    if ($linha['nivel'] == $nivel[$cont]) {
                                                        echo "<option value='$nivel[$cont]' selected > $nivel[$cont]</option>";
                                                    } else {
                                                        echo "<option value='$nivel[$cont]'> $nivel[$cont]</option>";
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4" id="instituicaoAlt">
                                            <label for="Instituicao" class="form-label">* Instituição:</label>
                                            <input type="text" class="form-control" placeholder="Instituição" name="Instituicao" value="<?php echo $linha['instituicao'] ?>" required>
                                        </div>
                                        <div class="form-group col-md-4" id="CursolabelAlt">
                                            <label for="Curso" class="form-label">* Curso:</label>
                                            <input type="text" class="form-control" placeholder="Curso" name="Curso" id="CursoAlt" value="<?php echo $linha['curso'] ?>" required>
                                        </div>
                                    </div>
                                    <!-- Status, Campus -->
                                    <div class="row mt-3">
                                        <div class="form-group col-md-6" id="statusAlt">
                                            <label for="Status" class="form-label">* Status:</label>
                                            <select name="Status" id="StatusAlt" class="form-select" required onchange="habilitar4alt(this)">
                                                <option value="" disabled selected>Selecione</option>
                                                <?php
                                                for ($cont = 0; $cont < 3; $cont++)
                                                    if ($linha['status'] == $status[$cont]) {
                                                        echo "<option value='$status[$cont]' selected > $status[$cont]</option>";
                                                    } else {
                                                        echo "<option value='$status[$cont]'> $status[$cont]</option>";
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6" id="CampuslabelAlt">
                                            <label for="Campus" class="form-label">Campus:</label>
                                            <input type="text" class="form-control" placeholder="Campus" name="Campus" id="CampusAlt" value="<?php echo $linha['campus'] ?>">
                                        </div>
                                    </div>
                                    <!-- Inicio Formação, Fim Formação, Turno -->
                                    <div class="row mt-3">
                                        <div class="form-group col-md-4" id="inicioAlt">
                                            <label for="InicioFormacao" class="form-label">* Início:</label>
                                            <input type="date" class="form-control" placeholder="Inicio Formação" name="InicioFormacao" value="<?php echo $linha['inicio'] ?>" required>
                                        </div>
                                        <div class="form-group col-md-4" id="fimAlt">
                                            <label for="FimFormacao" class="form-label">* Previsão/Data de Conclusão:</label>
                                            <input type="date" class="form-control" placeholder="Fim Formação" name="FimFormacao" value="<?php echo $linha['conclusao'] ?>" required>
                                        </div>
                                        <div class="form-group col-md-4" id="TurnolabelAlt">
                                            <label for="Turno" class="form-label">Turno:</label>
                                            <select name="Turno" class="form-select" id="TurnoAlt">
                                                <option value="" disabled selected>Selecione</option>
                                                <?php
                                                for ($cont = 0; $cont < 4; $cont++)
                                                    if ($linha['turno'] == $turno[$cont]) {
                                                        echo "<option value='$turno[$cont]' selected > $turno[$cont]</option>";
                                                    } else {
                                                        echo "<option value='$turno[$cont]'> $turno[$cont]</option>";
                                                    }
                                                ?>
                                            </select>
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
            <?php
            }
            ?>

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
                                <div class='btn-group mt-3'>
                                    <button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#modalEspecializacoesAlterar'>
                                        <i class='bi bi-pencil-square' style='height: 20px; width: 20px;'></i>
                                        Editar
                                    </button>
                                    <button type='button' class='btn btn-danger' onclick='deletarEspecializacoes(" . $linha["id_especializacoes"] . ")'>
                                        <i class='bi bi-trash' style='height: 20px; width: 20px;'></i>
                                        Apagar 
                                    </button>
                                </div>
                                </div>
                                ";
                        }
                    } else {
                        echo "Nenhum dado encontrado!";
                    }
                    ?>
                </div>
                <div class="d-flex justify-content-end">
                    <button class="btn_editar" data-bs-toggle="modal" data-bs-target="#modalEspecializacoes">
                        <i class="bi bi-plus-lg"></i>
                        Adicionar Especialização
                    </button>
                </div>
                <!-- The Modal -->
                <div class="modal fade" id="modalEspecializacoes">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Especialização</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                                <form action="../curriculo/cadastro_especializacoes.php" method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="redirect" value="../perfil_usuario/perfil_usuario.php">
                                    <!-- País, Categoria, Organização -->
                                    <div class="row mt-3">
                                        <div class="form-group col-md-4">
                                            <label for="Pais" class="form-label">* País:</label>
                                            <input type="text" class="form-control" placeholder="País" name="Pais" required>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="Categoria" class="form-label">* Categoria:</label>
                                            <select name="Categoria" id="Categoria" class="form-select" required>
                                                <option value="" disabled selected>Selecione</option>
                                                <option value="Cursos">Cursos</option>
                                                <option value="Entidade Estudantil">Entidade Estudantil</option>
                                                <option value="Monitoria">Monitoria</option>
                                                <option value="Organização de Eventos">Organização de Eventos</option>
                                                <option value="Participação de Eventos">Participação de Eventos</option>
                                                <option value="Projeto ou Iniciação Acadêmica">Projeto ou Iniciação Acadêmica</option>
                                                <option value="Voluntariado">Voluntariado</option>
                                                <option value="Outra">Outra</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="Organizacao" class="form-label">* Organização:</label>
                                            <input type="text" class="form-control" placeholder="Organização" name="Organizacao" required>
                                        </div>
                                    </div>
                                    <!-- Início Experiência, Fim Experiência -->
                                    <div class="row mt-3">
                                        <div class="form-group col-md-6">
                                            <label for="InicioExperiencia" class="form-label">* Início:</label>
                                            <input type="date" class="form-control" placeholder="Inicio Experiencia" name="InicioExperiencia" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="FimExperiencia" class="form-label">* Previsão/Data de Conclusão:</label>
                                            <input type="date" class="form-control" placeholder="Fim Experiencia" id="fieldset2" name="FimExperiencia" required>
                                        </div>
                                    </div>
                                    <!-- Responsabilidades -->
                                    <div class="row mt-3">
                                        <div class="form-group col-md-12">
                                            <label for="ResponsabilidadesExperiencia" class="form-label">* Responsabilidades:</label>
                                            <textarea class="form-control" rows="5" id="ResponsabilidadesExperiencia" name="ResponsabilidadesExperiencia" maxlength="255" required></textarea>
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

                <?php
                $categoria = ["Cursos", "Entidade Estudantil", "Organização de Eventos", "Participação de Eventos", "Projeto ou Iniciação Acadêmica", "Voluntariado", "Outra"];
                foreach ($especializacoes2 as $linha) {
                ?>
                    <!-- The Modal -->
                    <div class="modal fade" id="modalEspecializacoesAlterar">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">Especialização</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>

                                <!-- Modal body -->
                                <div class="modal-body">
                                    <form action="alterar_especializacoes.php" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="id" value="<?php echo $linha['id_especializacoes'] ?>">
                                        <!-- País, Categoria, Organização -->
                                        <div class="row mt-3">
                                            <div class="form-group col-md-4">
                                                <label for="Pais" class="form-label">* País:</label>
                                                <input type="text" class="form-control" placeholder="País" name="Pais" value="<?php echo $linha['pais'] ?>" required>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="Categoria" class="form-label">* Categoria:</label>
                                                <select name="Categoria" id="Categoria" class="form-select" required>
                                                    <option value="" disabled selected>Selecione</option>
                                                    <?php
                                                    for ($cont = 0; $cont < 7; $cont++)
                                                        if ($linha['categoria'] == $categoria[$cont]) {
                                                            echo "<option value='$categoria[$cont]' selected > $categoria[$cont]</option>";
                                                        } else {
                                                            echo "<option value='$categoria[$cont]'> $categoria[$cont]</option>";
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="Organizacao" class="form-label">* Organização:</label>
                                                <input type="text" class="form-control" placeholder="Organização" name="Organizacao" value="<?php echo $linha['organizacao'] ?>" required>
                                            </div>
                                        </div>
                                        <!-- Início Experiência, Fim Experiência -->
                                        <div class="row mt-3">
                                            <div class="form-group col-md-6">
                                                <label for="InicioExperiencia" class="form-label">* Início:</label>
                                                <input type="date" class="form-control" placeholder="Inicio Experiencia" name="InicioExperiencia" value="<?php echo $linha['inicio'] ?>" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="FimExperiencia" class="form-label">* Previsão/Data de Conclusão:</label>
                                                <input type="date" class="form-control" placeholder="Fim Experiencia" id="fieldset2" name="FimExperiencia" value="<?php echo $linha['final'] ?>" required>
                                            </div>
                                        </div>
                                        <!-- Responsabilidades -->
                                        <div class="row mt-3">
                                            <div class="form-group col-md-12">
                                                <label for="ResponsabilidadesExperiencia" class="form-label">* Responsabilidades:</label>
                                                <textarea class="form-control" rows="5" id="ResponsabilidadesExperiencia" name="ResponsabilidadesExperiencia" maxlength="255" required><?php echo $linha['responsabilidades'] ?></textarea>
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
                <?php
                }
                ?>

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
                                <div class='btn-group mt-3'>
                                    <button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#modalIdiomaAlterar' onclick='alterarIdioma(" . $linha["id_idioma"] . ")'>
                                        <i class='bi bi-pencil-square' style='height: 20px; width: 20px;'></i>
                                        Editar
                                    </button>
                                    <button type='button' class='btn btn-danger' onclick='deletarIdioma(" . $linha["id_idioma"] . ")'>
                                        <i class='bi bi-trash' style='height: 20px; width: 20px;'></i>
                                        Apagar 
                                    </button>
                                </div>
                                </div>
                                ";
                        }
                    } else {
                        echo "Nenhum dado encontrado!";
                    }
                    ?>
                </div>
                <div class="d-flex justify-content-end">
                    <button class="btn_editar" data-bs-toggle="modal" data-bs-target="#modalIdioma">
                        <i class="bi bi-plus-lg"></i>
                        Adicionar Idioma
                    </button>
                </div>
                <!-- The Modal -->
                <div class="modal fade" id="modalIdioma">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Idioma</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                                <form action="../curriculo/cadastro_idioma.php" method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="redirect" value="../perfil_usuario/perfil_usuario.php">
                                    <!-- Idioma, Proeficiênia -->
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="Idioma" class="form-label">* Idioma:</label>
                                            <select name="Idioma" id="Idioma" class="form-select" required>
                                                <option value="" disabled selected>Selecione</option>
                                                <option value="Alemão">Alemão</option>
                                                <option value="Árabe">Árabe</option>
                                                <option value="Bengali">Bengali</option>
                                                <option value="Chinês (Mandarim)">Chinês (Mandarim)</option>
                                                <option value="Coreano">Coreano</option>
                                                <option value="Espanhol">Espanhol</option>
                                                <option value="Francês">Francês</option>
                                                <option value="Gujarati">Gujarati</option>
                                                <option value="Hindi">Hindi</option>
                                                <option value="Igbo">Igbo</option>
                                                <option value="Indonésio">Indonésio</option>
                                                <option value="Inglês">Inglês</option>
                                                <option value="Italiano">Italiano</option>
                                                <option value="Japonês">Japonês</option>
                                                <option value="Javanês">Javanês</option>
                                                <option value="Marathi">Marathi</option>
                                                <option value="Persa (Farsi)">Persa (Farsi)</option>
                                                <option value="Português">Português</option>
                                                <option value="Russo">Russo</option>
                                                <option value="Tâmil">Tâmil</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="Proficiencia" class="form-label">* Proficiência:</label>
                                            <select name="Proficiencia" id="Proficiencia" class="form-select" required>
                                                <option value="" disabled selected>Selecione</option>
                                                <option value="Básico">Básico</option>
                                                <option value="Intermediário">Intermediário</option>
                                                <option value="Avançado">Avançado</option>
                                                <option value="Fluente">Fluente</option>
                                            </select>
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

                <?php
                $idioma = ["Alemão", "Árabe", "Bengali", "Chinês (Mandarim)", "Coreano", "Espanhol", "Francês", "Gujarati", "Hindi", "Igbo", "Indonésio", "Inglês", "Italiano", "Japonês", "Javanês", "Marathi", "Persa (Farsi)", "Português", "Russo", "Tâmil"];
                $proficiencia = ["Básico", "Intermediário", "Avançado", "Fluente"];
                foreach ($idioma2 as $linha) {
                ?>
                    <!-- The Modal -->
                    <div class="modal fade" id="modalIdiomaAlterar">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">Idioma</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>

                                <!-- Modal body -->
                                <div class="modal-body">
                                    <form action="alterar_idioma.php" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="id" value="<?php echo $linha['id_idioma'] ?>">
                                        <!-- Idioma, Proeficiênia -->
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="Idioma" class="form-label">* Idioma:</label>
                                                <select name="Idioma" id="Idioma" class="form-select" required>
                                                    <option value="" disabled selected>Selecione</option>
                                                    <?php
                                                    for ($cont = 0; $cont < 20; $cont++)
                                                        if ($linha['idioma'] == $idioma[$cont]) {
                                                            echo "<option value='$idioma[$cont]' selected > $idioma[$cont]</option>";
                                                        } else {
                                                            echo "<option value='$idioma[$cont]'> $idioma[$cont]</option>";
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="Proficiencia" class="form-label">* Proficiência:</label>
                                                <select name="Proficiencia" id="Proficiencia" class="form-select" required>
                                                    <option value="" disabled selected>Selecione</option>
                                                    <?php
                                                    for ($cont = 0; $cont < 3; $cont++)
                                                        if ($linha['proficiencia'] == $proficiencia[$cont]) {
                                                            echo "<option value='$proficiencia[$cont]' selected > $proficiencia[$cont]</option>";
                                                        } else {
                                                            echo "<option value='$proficiencia[$cont]'> $proficiencia[$cont]</option>";
                                                        }
                                                    ?>
                                                </select>
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
                <?php
                }
                ?>

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
<script src="../../js/desabilitar_input.js"></script>
<script src="../../js/delete_perfil_usuario.js"></script>
<script src="../../js/upload.js"></script>