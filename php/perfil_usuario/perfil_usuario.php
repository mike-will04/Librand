<!DOCTYPE html>
<html lang="pt-br">
    <?php
        include "../conexao.php";
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

        $exp_profissional = $conn->prepare(
            'SELECT * FROM experiencia WHERE id_usuario = :id_usuario'
        );
        $exp_profissional->execute(array(
            ':id_usuario' => $id
        ));

        $formacao = $conn->prepare(
            'SELECT * FROM formacao WHERE id_usuario = :id_usuario'
        );
        $formacao->execute(array(
            ':id_usuario' => $id
        ));

        $idioma = $conn->prepare(
            'SELECT * FROM idioma WHERE id_usuario = :id_usuario'
        );
        $idioma->execute(array(
            ':id_usuario' => $id
        ));

        $objetivo = $conn->prepare(
            'SELECT * FROM objetivo WHERE id_usuario = :id_usuario'
        );
        $objetivo->execute(array(
            ':id_usuario' => $id
        ));

        $especializacoes = $conn->prepare(
            'SELECT * FROM especializacoes WHERE id_usuario = :id_usuario'
        );
        $especializacoes->execute(array(
            ':id_usuario' => $id
        ));
    ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Librand</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="shortcut icon" type="imagex/png" href="../../img/Logotipo_Libras_Inclusão_Azul-removebg-preview.png">
    <style>
        .card {
            background-color: white;
            width: 150px;
            position: absolute;
            border-radius: 0px 0px 10px 10px;
            text-align: center;
            z-index: 1;
            top: 100%;
            right: 0;
        }

        .card a {
            color: black;
            text-decoration: none;  
        }

        .card a:hover {
            color: white;
            background-color: rgb(192, 191, 191);
        }

        .div_perfil {
            height: 200px;
            margin: 0 2.1% 0 2.1%;
        }

        .texto_dados{
            font-size: 1.1rem;
        }

        .btn_editar {
            border: none;
            color: white;
            background-color: #2259BC;
            padding: 5px 30px;
            height: 35px;
            width: 300px;
            text-align: center;
            text-decoration: none;
            font-size: 1rem;
            border-radius: 20px;
            font-weight: bold;
            transition-duration: 0.4s;
        }

        .btn_editar:hover {
            background-color: #132d5f;
            color: white;
        }

        .btn_curriculo_salvar {
            border: none;
            color: white;
            background-color: #2259BC;
            padding: 5px 30px;
            height: 35px;
            width: 150px;
            text-align: center;
            text-decoration: none;
            font-size: 1rem;
            border-radius: 20px;
            font-weight: bold;
            transition-duration: 0.4s;
        }

        .btn_curriculo_salvar:hover {
            background-color: #132d5f;
            color: white;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-sm" style="background-color: #2259BC;">
        <div class="container-fluid">
            <a href="../index.php" class="navbar-brand d-flex">
                <img src="../../img/Logotipo Librand.png" alt="Logo Librand" style="width: 100px;">
            </a>
            
            <div class="collapse navbar-collapse" id="menuNavbar">
                <div class="navbar-nav ms-auto align-items-center" style='text-align: center;'>
                    <?php
                        if (isset($_SESSION['logado']) and $_SESSION['logado'] == true) {
                            foreach ($check as $linha) {
                                if ($linha['foto_perfil'] == null) {
                                    echo "
                                    <div class='d-inline-flex align-items-center' style='margin-right: 10px; margin-left: 10px; cursor: pointer;'  onclick='perfil()'>
                                    <img src='../../img/user.png' alt='Foto Perfil' id='btn-perfil' class='width: 50px; height: 50px;'/><p style='color: white; margin-bottom: 0; margin-right: 5px;'>" . $linha['usuario'] . "</p><i class='bi bi-chevron-down' style='color: white'></i></div>";
                                    echo "<div class='card' id='carde' style='display: none;'>
                                        <a href='perfil_usuario.php' style='display: block;'>Perfil</a>
                                        <a href='../sair.php' style='display: block;' class='card1'>Sair</a>
                                    </div>
                                    "; 
                                } else {
                                    echo "
                                    <div class='d-inline-flex align-items-center' style='margin-right: 10px; margin-left: 10px; cursor: pointer;'  onclick='perfil()'>
                                    <img src='../../img/" . $linha['foto_perfil'] .  "' alt='Foto Perfil' id='btn-perfil' class='width: 50px; height: 50px;'/><p style='color: white; margin-bottom: 0; margin-right: 5px;'>" . $linha['usuario'] . "</p><i class='bi bi-chevron-down' style='color: white'></i></div>";
                                    echo "<div class='card' id='carde' style='display: none;'>
                                        <a href='perfil_usuario.php  style='display: block;'>Perfil</a>
                                        <a href='../sair.php' style='display: block;' class='card1'>Sair</a>
                                    </div>
                                    "; 
                                }
                            }
                        } else {
                            echo "
                                <a href='../../login_usuario.html' class='nav-link'>
                                    Login
                                </a>
                                <a href='../../cadastro_usuario.html'>
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
            <div class="col-md-2 shadow rounded d-inline-flex div_perfil">
                
            </div>
            <div class="col-md-4 shadow rounded d-inline-flex div_perfil p-4">
                <div class="d-flex justify-content-center align-items-center texto_dados ">
                    <?php
                        if ($dados->rowCount() > 0) {
                            $linha = $dados->fetch();
                            echo "<div><h5>".$linha['nome']." ".$linha['sobrenome']."</h5>";
                            echo "<h6>Contato</h6>";
                            echo "Email: ".$linha['email']."<br>";
                            echo "Celular: ".$linha['celular']."<br>";
                            echo "Cidade: ".$linha['cidade']."-".$linha['estado']."</div>";
                        } else {
                            echo "Nenhum dado encontrado!";
                        }
                    ?>
                </div>
            </div>
            <div class="col-md-4 shadow rounded d-inline-flex div_perfil">
                
            </div>
        </div>

        <div class="row justify-content-center mt-5">
            <div class="col-md-11 shadow rounded p-4">
                <h3>Dados Pessoais</h3>
                <div class="texto_dados mt-4 d-flex justify-content-start">
                    <?php
                        if ($dados2->rowCount() > 0) {
                            $linha = $dados2->fetch();
                            echo "Data de Nascimento: ".$linha['data']."<br>";
                            echo "Nacionalidade: ".$linha['pais']."<br>";
                            echo "CPF: ".$linha['cpf']."<br>";
                            echo "Raça/Etnia: ".$linha['raca']."<br>";
                            echo "Estado Civil: ".$linha['estado_civil']."<br>";
                            echo "Renda Pessoal: ".$linha['renda_pessoal']."<br>";
                            echo "Renda Familiar: ".$linha['renda_familiar']."<br>";
                            echo "Estrangeiro: ".$linha['estrangeiro']."<br>";
                            echo "CEP: ".$linha['cep']."<br>";
                            echo "Rua: ".$linha['rua'];
                            if ($linha['numero'] != ""){
                                echo "-".$linha['numero'];
                            }
                            if ($linha['bairro'] != "") {
                                echo "-".$linha['bairro']."<br>";
                            }
                            if ($linha['complemento'] != "") {
                                echo "Complemento: ".$linha['complemento'];
                            }
                            echo "<br>Cidade: ".$linha['cidade']."-".$linha['estado'];
                            if ($linha['possui_deficiencia'] == "Não"){
                                echo "<br>Deficiência: Nenhuma";
                            } else {
                                echo "<br>Deficiência: ".$linha['deficiencia']."<br>";
                                echo "Suporte: ".$linha['suporte'];
                            }
                        } else {
                            echo "Nenhum dado encontrado!";
                        }
                    ?>
                </div>
                <div class="d-flex justify-content-end">
                    <button class="btn_editar" data-bs-toggle="modal" data-bs-target="#modalDadosPessoais">
                        <i class="bi bi-plus-lg"></i>
                        Editar
                    </button>
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
                                echo "Cargo de Interesse: ".$linha['cargo_de_interesse']."<br>";
                                echo "Pretenção Salarial: ".$linha['pretencao_salarial']."<br>";
                                echo "
                                <div class='btn-group mt-3'>
                                    <button type='button' class='btn btn-primary'>
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
        </div>

        <div class="row justify-content-center mt-5">
            <div class="col-md-11 shadow rounded p-4">
                <h3>Exp. Profissional</h3>
                <div class="texto_dados mt-4">
                    <?php
                        if ($exp_profissional->rowCount() > 0) {
                            while ($linha = $exp_profissional->fetch()) {
                                echo "<div class='mb-4' >";
                                echo "Empresa: ".$linha['empresa']."<br>";
                                echo "Responsabilidades: ".$linha['responsabilidades']."<br>";
                                echo "Cargo: ".$linha['cargo']."<br>";
                                echo "Nível: ".$linha['nivel']."<br>";
                                echo "Área: ".$linha['area'];
                                if ($linha['atual'] == "1"){
                                    echo "<br>Emprego atual: Sim"."<br>";
                                } else {
                                    echo "<br>De: ".$linha['inicio_emprego']."<br>";
                                    echo "Até: ".$linha['fim_emprego']."<br>";
                                    echo "Emprego atual: Não"."<br>";
                                }
                                echo "
                                <div class='btn-group mt-3'>
                                    <button type='button' class='btn btn-primary'>
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
                                        <label for="FimEmprego" class="form-label" >* Até:</label>
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
        </div>

        <div class="row justify-content-center mt-5"> 
            <div class="col-md-11 shadow p-4">
                <h3>Formação</h3>
                <div class="texto_dados mt-4">
                    <?php
                        if ($formacao->rowCount() > 0) {
                            while ($linha = $formacao->fetch()) {
                                echo "<div class='mb-4' >";
                                echo "País: ".$linha['pais']."<br>";
                                echo "Estado: ".$linha['estado']."<br>";
                                echo "Nível: ".$linha['nivel']."<br>";
                                echo "Instituição: ".$linha['instituicao']."<br>";
                                if (($linha['nivel'] != "Ensino Fundamental") and ($linha['nivel'] != "Ensino Médio")){
                                    echo "Curso: ".$linha['curso']."<br>";
                                }
                                echo "Status: ".$linha['status']."<br>";
                                if (($linha['nivel'] != "Ensino Fundamental") and ($linha['nivel'] != "Ensino Médio")){
                                    echo "Campus: ".$linha['campus']."<br>";
                                }
                                echo "Início: ".$linha['inicio']."<br>";
                                echo "Previsão/Data de Conclusão: ".$linha['conclusao']."<br>";
                                if ($linha['status'] == "Cursando"){
                                    echo "Turno: ".$linha['turno']."<br>";
                                }
                                echo "
                                <div class='btn-group mt-3'>
                                    <button type='button' class='btn btn-primary'>
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
                                                <option value="Rondônia">Rondônia</option>
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
                                                <option value="Especialização">Mestrado</option>
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
                                            <select name="Status" id="Status" class="form-select" required  onchange="habilitar4(this)">
                                                <option value="" disabled selected>Selecione</option>
                                                <option value="Cursando">Cursando</option>
                                                <option value="Trancado">Trancado</option>
                                                <option value="Concluído">Concluído</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6" id="Campuslabel">
                                            <label for="Campus" class="form-label">Campus:</label>
                                            <input type="text" class="form-control" placeholder="Campus" name="Campus"id="Campus">
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
        </div>

        <div class="row justify-content-center mt-5">
            <div class="col-md-11 shadow p-4">
                <h3>Especializações</h3>
                <div class="texto_dados mt-4">
                    <?php
                        if ($especializacoes->rowCount() > 0) {
                            while ($linha = $especializacoes->fetch()) {
                                echo "<div class='mb-4' >";
                                echo "País: ".$linha['pais']."<br>";
                                echo "Categoria: ".$linha['categoria']."<br>";
                                echo "Organização: ".$linha['organizacao']."<br>";
                                echo "Início: ".$linha['inicio']."<br>";
                                echo "Previsão/Data de Conclusão: ".$linha['final']."<br>";
                                echo "Responsabilidades: ".$linha['responsabilidades']."<br>";
                                echo "
                                <div class='btn-group mt-3'>
                                    <button type='button' class='btn btn-primary'>
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
                        Adicionar Especializações
                    </button>
                </div>
                <!-- The Modal -->
                <div class="modal fade" id="modalEspecializacoes">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Especializações</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                                <form action="../curriculo/cadastro_especializacoes.php" method="post" enctype="multipart/form-data">
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
                                echo "Idioma: ".$linha['idioma']."<br>";
                                echo "Proficiência: ".$linha['proficiencia']."<br>";
                                echo "
                                <div class='btn-group mt-3'>
                                    <button type='button' class='btn btn-primary'>
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

<script src="../../js/btnPerfil.js"></script>
<script src="../../js/desabilitar_input.js"></script>

<script>
    function deletarIdioma(id) {
        const confirmAction = confirm("Você tem certeza que deseja excluir este idioma?");
        if (confirmAction) {
            window.location.href = 'apagar_idioma.php?id=' + id;
        }
    }

    function deletarEspecializacoes(id) {
        const confirmAction = confirm("Você tem certeza que deseja excluir esta especialização?");
        if (confirmAction) {
            window.location.href = 'apagar_especializacoes.php?id=' + id;
        }
    }

    function deletarFormacao(id) {
        const confirmAction = confirm("Você tem certeza que deseja excluir esta formação?");
        if (confirmAction) {
            window.location.href = 'apagar_formacao.php?id=' + id;
        }
    }

    function deletarExpProfissional(id) {
        const confirmAction = confirm("Você tem certeza que deseja excluir esta exp.profissional?");
        if (confirmAction) {
            window.location.href = 'apagar_exp_profissional.php?id=' + id;
        }
    }

    function deletarObjetivo(id) {
        const confirmAction = confirm("Você tem certeza que deseja excluir este objetivo?");
        if (confirmAction) {
            window.location.href = 'apagar_objetivo.php?id=' + id;
        }
    }
</script>