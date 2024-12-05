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
    echo "<script>alert('Faça login para acessar o perfil');location = '../../html/login_empresa.html'</script>";
}

if ($tipo == "candidato") {
    echo "<script>alert('Entre como empresa para acessar o perfil');location = '../../html/login_empresa.html'</script>";
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
            <a href="../index_empresa.php" class="navbar-brand d-flex">
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
                                        <a href='perfil_empresa.php' style='display: block;'>Perfil</a>
                                        <a href='../sair.php' style='display: block;' class='card1'>Sair</a>
                                    </div>
                                    ";
                            } else {
                                echo "
                                    <div class='d-inline-flex align-items-center' style='margin-right: 10px; margin-left: 10px; cursor: pointer;'  onclick='perfil()'>
                                    <img src='../../img/foto perfil/" . $linha['foto_perfil'] .  "' alt='Foto Perfil' id='btn-perfil' style='width: 50px; height: 50px; border: 1px solid white; border-radius: 50%;'/><p style='color: white; margin-bottom: 0; margin-right: 5px; margin-left: 5px;'>" . $linha['usuario'] . "</p><i class='bi bi-chevron-down' style='color: white'></i></div>";
                                echo "<div class='card' id='carde' style='display: none;'>
                                        <a href='../empresa/info_empresa.php' style='display: block;'>Completar Cadastro Empresa</a>
                                        <a href='perfil_empresa.php' style='display: block;'>Perfil</a>
                                        <a href='../sair.php' style='display: block;' class='card1'>Sair</a>
                                    </div>
                                    ";
                            }
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row justify-content-center mt-5">
            <div class="col-md-1 div_perfil d-flex justify-content-center align-items-center">
                <form action="adicionar_foto.php" method="post" enctype="multipart/form-data">
                    <div class="upload d-flex justify-content-center align-items-center">
                        <?php
                        foreach ($usuario as $linha) {
                            if ($linha['foto_perfil'] == null) {
                                echo "<img src='../../img/foto perfil/user2.png' width='125' height='125' id='profile' class='img' style='cursor: pointer;'>";
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
                <div class="d-flex justify-content-end">
                    <button class="btn_editar" data-bs-toggle="modal" data-bs-target="#modalDadosBasicosAlterar">
                        <i class="bi bi-plus-lg"></i>
                        Editar
                    </button>
                </div>
            </div>

            <?php
            $porte = ["Pequeno", "Médio", "Grande"];
            $setor = ["Administração", "Agricultura, Pecuária, Veterinária", "Alimentação / Gastronomia", "Arquitetura, Decoração, Design", "Artes", "Auditoria", "Ciências", "Comercial", "Comunicação", "Construção", "Contábil", "Cultura", "Educação", "Engenharia", "Industrial", "Informática", "Jurídica", "Logística", "Marketing", "Moda", "Qualidade", "Recursos Humanos", "Saúde", "Segurança", "Serviço Social e Comunitário", "Serviços Gerais", "Telemarketing", "Transportes"];
            foreach ($dados2alterar as $linha) {
            ?>
                <!-- The Modal -->
                <div class="modal fade" id="modalDadosBasicosAlterar">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Dados Básicos</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                                <form action="alterar_dados_basicos.php" method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="id" value="<?php echo $linha['id_sobre'] ?>">
                                    <!-- Nome Fantasia,  Razão Social -->
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="Nome Fantasia" class="form-label">* Nome Fantasia:</label>
                                            <input type="text" class="form-control" placeholder="Nome Fantasia" name="Nome_Fantasia" required value="<?php echo $linha['nome_fantasia'] ?>">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="Razão Social" class="form-label">* Razão Social:</label>
                                            <input type="text" class="form-control" placeholder="Razão Social" name="Razao_Social" required value="<?php echo $linha['razao_social'] ?>">
                                        </div>
                                    </div>
                                    <!-- CNPJ, Setor da Empresa, Número de Funcionários, Porte da Empresa -->
                                    <div class="row mt-3">
                                        <div class="form-group col-md-3">
                                            <label for="CNPJ" class="form-label">* CNPJ:</label>
                                            <input type="text" class="form-control" placeholder="CNPJ" name="CNPJ" required value="<?php echo $linha['cnpj'] ?>">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="Setor da Empresa" class="form-label">* Setor da Empresa:</label>
                                            <select name="Setor_Empresa" class="form-select" required>
                                                <option value="" disabled selected>Selecione</option>
                                                <?php
                                                for ($cont = 0; $cont < 27; $cont++)
                                                    if ($linha['setor'] == $setor[$cont]) {
                                                        echo "<option value='$setor[$cont]' selected> $setor[$cont]</option>";
                                                    } else {
                                                        echo "<option value='$setor[$cont]'> $setor[$cont]</option>";
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="Número de Funcionários" class="form-label">* Número de Funcionários:</label>
                                            <input type="text" class="form-control" placeholder="Número de Funcionários" name="Numero_Funcionarios" required value="<?php echo $linha['numero_funcionarios'] ?>">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="Porte da Empresa" class="form-label">* Porte da Empresa:</label>
                                            <select name="Porte_Empresa" class="form-select" required>
                                                <option value="" disabled selected>Selecione</option>
                                                <?php
                                                for ($cont = 0; $cont < 3; $cont++)
                                                    if ($linha['porte'] == $porte[$cont]) {
                                                        echo "<option value='$porte[$cont]' selected> $porte[$cont]</option>";
                                                    } else {
                                                        echo "<option value='$porte[$cont]'> $porte[$cont]</option>";
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
                <div class="d-flex justify-content-end">
                    <button class="btn_editar" data-bs-toggle="modal" data-bs-target="#modalEnderecoAlterar">
                        <i class="bi bi-plus-lg"></i>
                        Editar
                    </button>
                </div>
            </div>

            <?php
            $estado = ["Acre", "Alagoas", "Amapá", "Amazonas", "Bahia", "Ceará", "Distrito Federal", "Espírito Santo", "Goiás", "Maranhão", "Mato Grosso", "Mato Grosso do Sul", "Minas Gerais", "Pará", "Paraíba", "Paraná", "Pernambuco", "Piauí", "Rio de Janeiro", "Rio Grande do Norte", "Rio Grande do Sul", "Rondônia", "Rondônia", "Santa Catarina", "São Paulo", "Sergipe", "Tocantins"];
            foreach ($dados3alterar as $linha) {
            ?>
                <!-- The Modal -->
                <div class="modal fade" id="modalEnderecoAlterar">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Endereço</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <!-- Modal body -->
                            <div class="modal-body">
                                <form action="alterar_endereco.php" method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="id" value="<?php echo $linha['id_sobre'] ?>">
                                    <!-- CEP, Rua -->
                                    <div class="row mt-3">
                                        <div class="form-group col-md-6">
                                            <label for="CEP" class="form-label">* CEP:</label>
                                            <input type="text" class="form-control" placeholder="CEP" name="CEP" required value="<?php echo $linha['cep'] ?>">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="Rua" class="form-label">* Rua:</label>
                                            <input type="text" class="form-control" placeholder="Rua" name="Rua" required value="<?php echo $linha['rua'] ?>">
                                        </div>
                                    </div>
                                    <!-- Número, Complemento, Bairro -->
                                    <div class="row mt-3">
                                        <div class="form-group col-md-4">
                                            <label for="Numero" class="form-label">Número:</label>
                                            <input type="number" class="form-control" placeholder="Número" name="Numero" value="<?php echo $linha['numero'] ?>">
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
                                            <input type="text" class="form-control" placeholder="Cidade" name="Cidade" required value="<?php echo $linha['cidade'] ?>">
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
                <div class="d-flex justify-content-end">
                    <button class="btn_editar" data-bs-toggle="modal" data-bs-target="#modalInformacoesContatoAlterar">
                        <i class="bi bi-plus-lg"></i>
                        Editar
                    </button>
                </div>
            </div>

            <?php
            foreach ($dados4alterar as $linha) {
            ?>
                <!-- The Modal -->
                <div class="modal fade" id="modalInformacoesContatoAlterar">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Informações de Contato</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <!-- Modal body -->
                            <div class="modal-body">
                                <form action="alterar_info_contato.php" method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="id" value="<?php echo $linha['id_sobre'] ?>">
                                    <!-- Responsável por Contato, Cargo do Responsável -->
                                    <div class="row mt-3">
                                        <div class="form-group col-md-6">
                                            <label for="Responsavel_Contato" class="form-label">* Responsável por Contato:</label>
                                            <input type="text" class="form-control" placeholder="Responsavel Contato" name="Responsavel_Contato" required value="<?php echo $linha['responsavel_contato'] ?>">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="Cargo_Responsável" class="form-label">* Cargo do Responsável:</label>
                                            <input type="text" class="form-control" placeholder="Cargo do Responsável" name="Cargo_Responsavel" required value="<?php echo $linha['cargo_responsavel'] ?>">
                                        </div>
                                    </div>
                                    <!-- Celular para Contato, email, Página Web -->
                                    <div class="row mt-3">
                                        <div class="form-group col-md-4">
                                            <label for="Celular_Contato" class="form-label">* Celular para Contato:</label>
                                            <input type="text" class="form-control" placeholder="Celular para Contato" name="Celular_Contato" required value="<?php echo $linha['celular_contato'] ?>">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="email" class="form-label">* Email:</label>
                                            <input type="text" class="form-control" placeholder="Email" name="email" required value="<?php echo $linha['email'] ?>">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="Pagina_Web" class="form-label">Página Web:</label>
                                            <input type="text" class="form-control" placeholder="Página Web" name="Pagina_Web" value="<?php echo $linha['pagina_web'] ?>">
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
                <div class="d-flex justify-content-end">
                    <button class="btn_editar" data-bs-toggle="modal" data-bs-target="#modalDescricaoEmpresaAlterar">
                        <i class="bi bi-plus-lg"></i>
                        Editar
                    </button>
                </div>
            </div>

            <?php
            foreach ($dados5alterar as $linha) {
            ?>
                <!-- The Modal -->
                <div class="modal fade" id="modalDescricaoEmpresaAlterar">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Formação</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                                <form action="alterar_descricao.php" method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="id" value="<?php echo $linha['id_sobre'] ?>">
                                    <!-- Descreva sua Empresa -->
                                    <div class="row mt-3">
                                        <div class="form-group col-md-12">
                                            <label>* Descreva sua Empresa:</label>
                                            <textarea class="form-control" rows="5" id="Descricao" name="Descricao" required><?php echo $linha['descricao'] ?></textarea>
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