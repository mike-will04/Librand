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
    <link rel="shortcut icon" type="imagex/png" href="img/Logotipo_Libras_Inclusão_Azul-removebg-preview.png">
    <style>
        .div_curriculo {
            height: 125px;
            margin: 0 2% 0 2%;
            ;
        }

        /* .titulo_curriculo{
            font-weight: bold;
        } */

        .btn_curriculo {
            border: none;
            color: white;
            background-color: #2259BC;
            padding: 5px 30px;
            height: 35px;
            width: 275px;
            text-align: center;
            text-decoration: none;
            font-size: 1rem;
            border-radius: 20px;
            font-weight: bold;
            transition-duration: 0.4s;
        }

        .btn_curriculo:hover {
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
            margin-bottom: 2%;
        }

        .btn_curriculo_salvar:hover {
            background-color: #132d5f;
            color: white;
        }

        @media only screen and (min-width: 320px) and (max-width: 767px) {
            .div_curriculo {
                text-align: center;
                display: flex;
                flex-wrap: wrap;
                align-content: center;
            }
        }

        @media only screen and (min-width: 768px) and (max-width: 1024px) {
            .div_curriculo {
                text-align: center;
                display: flex;
                flex-wrap: wrap;
                align-content: center;
            }
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-sm " style="background-color: #2259BC;">
        <div class="container-fluid justify-content-center">
            <a href="index.php" class="navbar-brand d-flex">
                <img src="../img/Logotipo Librand.png" alt="Logo Librand" style="width: 100px;">
            </a>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row p-4">
            <div class="col-12 text-center">
                <h3 class="titulo_curriculo">
                    Agora vamos fazer seu currículo
                </h3>
            </div>
        </div>

        <div class="row justify-content-center p-4">
            <div class="col-md-5 div_curriculo shadow rounded d-inline-flex align-items-center justify-content-center">
                <h4 class="titulo_curriculo p-3">
                    Dados Pessoais
                </h4>
                <button class="btn_curriculo" data-bs-toggle="modal" data-bs-target="#modalDadosPessoais">
                    + Adicionar dados pessoais
                </button>
                <!-- The Modal -->
                <div class="modal fade" id="modalDadosPessoais">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Dados Pessoais</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="form-group col-md-3">
                                            <label for="nome" class="form-label">Nome:</label>
                                            <input type="text" class="form-control" placeholder="Nome" name="nome" required>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="sobrenome" class="form-label">Sobrenome:</label>
                                            <input type="text" class="form-control" placeholder="Sobrenome" name="sobrenome" required>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="nomesocial" class="form-label">Nome Social:</label>
                                            <input type="text" class="form-control" placeholder="Nome Social" name="nomesocial">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="email" class="form-label">Email:</label>
                                            <input type="email" class="form-control" placeholder="Email" name="email" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-3">
                                            <label for="origem" class="form-label">País de Origem:</label>
                                            <input type="text" class="form-control" placeholder="País de Origem" name="origem" required>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="cpf" class="form-label">CPF:</label>
                                            <input type="text" class="form-control" placeholder="CPF" name="cpf" required>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="celular" class="form-label">Celular:</label>
                                            <input type="text" class="form-control" placeholder="Celular" name="celular">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="nascimemnto" class="form-label">Data de Nascimento:</label>
                                            <input type="date" class="form-control" placeholder="Data de Nascimento" name="nascimemnto" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="raca" class="form-label">Raça/Etnia:</label>
                                            <select name="raca" id="raca" class="form-select">
                                                <option>Selecione</option>
                                                <option value="Preta">Preta</option>
                                                <option value="Parda">Parda</option>
                                                <option value="Indígena">Indígena</option>
                                                <option value="Amarela">Amarela</option>
                                                <option value="Branca">Branca</option>
                                                <option value="Outro">Outro</option>
                                                <option value="Prefiro não responder">Prefiro não responder</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="estadocivil" class="form-label">Estado Civil:</label>
                                            <select name="estadocivil" id="estadocivil" class="form-select">
                                                <option>Selecione</option>
                                                <option value="Solteiro(a)">Solteiro(a)</option>
                                                <option value="Casado(a)">Casado(a)</option>
                                                <option value="Divorciado(a)">Divorciado(a)</option>
                                                <option value="Viúvo(a)">Viúvo(a)</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label for="genero" class="form-label">Sua identidade de gênero:</label>
                                            <select name="genero" id="genero" class="form-select">
                                                <option>Selecione</option>
                                                <option value="Mulher cisgênero">Mulher cisgênero</option>
                                                <option value="Homem cisgênero">Homem cisgênero</option>
                                                <option value="Mulher trans">Mulher trans</option>
                                                <option value="Homem trans">Homem trans</option>
                                                <option value="Não binário">Não binário</option>
                                                <option value="Outro">Outro</option>
                                                <option value="Prefiro não responder">Prefiro não responder</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="orientacao" class="form-label">Orientção Sexual:</label>
                                            <select name="orientacao" id="orientacao" class="form-select">
                                                <option>Selecione</option>
                                                <option value="Heterosexual">Heterosexual</option>
                                                <option value="Homosexual">Homosexual</option>
                                                <option value="Bissexual">Bissexual</option>
                                                <option value="Assexual">Assexual</option>
                                                <option value="Pansexual">Pansexual</option>
                                                <option value="Outro">Outro</option>
                                                <option value="Prefiro não responder">Prefiro não responder</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="pronome" class="form-label">Estado Civil:</label>
                                            <select name="pronome" id="pronome" class="form-select">
                                                <option>Selecione</option>
                                                <option value="Ela / dela">Ela / dela</option>
                                                <option value="Ele / dele">Ele / dele</option>
                                                <option value="Outro">Outro</option>
                                                <option value="Prefiro não responder">Prefiro não responder</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-1">
                                            <label for="estrangeiro">Estrangeiro?</label>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="form-check">
                                                <input type="radio" class="form-check-input" id="estrangeiro" name="estrangeiro" value="Sim" checked>
                                                <label class="form-check-label" for="radio1">Sim</label>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="form-check">
                                                <input type="radio" class="form-check-input" id="estrangeiro" name="estrangeiro" value="Não" checked>
                                                <label class="form-check-label" for="radio1">Não</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label for="estrangeiro">Possui alguma deficiência?</label>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="form-check">
                                                <input type="radio" class="form-check-input" id="estrangeiro" name="estrangeiro" value="Sim" checked>
                                                <label class="form-check-label" for="radio1">Sim</label>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="form-check">
                                                <input type="radio" class="form-check-input" id="estrangeiro" name="estrangeiro" value="Não" checked>
                                                <label class="form-check-label" for="radio1">Não</label>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <input type="submit" class="btn_curriculo_salvar" value="Salvar">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5 div_curriculo shadow rounded d-inline-flex align-items-center justify-content-center">
                <h4 class="titulo_curriculo p-3">
                    Objetivo
                </h4>
                <button class="btn_curriculo">
                    + Adicionar Objetivo
                </button>
            </div>
        </div>

        <div class="row justify-content-center p-4">
            <div class="col-md-5 div_curriculo shadow rounded d-inline-flex align-items-center justify-content-center">
                <h4 class="titulo_curriculo p-3">
                    Exp.profissional
                </h4>
                <button class="btn_curriculo">
                    + Adicionar Exp.Profissional
                </button>
            </div>
            <div class="col-md-5 div_curriculo shadow rounded d-inline-flex align-items-center justify-content-center">
                <h4 class="titulo_curriculo p-3">
                    Formação
                </h4>
                <button class="btn_curriculo">
                    + Adicionar Formação
                </button>
            </div>
        </div>

        <div class="row justify-content-center p-4">
            <div class="col-md-5 div_curriculo shadow rounded d-inline-flex align-items-center justify-content-center">
                <h4 class="titulo_curriculo p-3">
                    Especializações
                </h4>
                <button class="btn_curriculo">
                    + Adicionar Especializações
                </button>
            </div>
            <div class="col-md-5 div_curriculo shadow rounded d-inline-flex align-items-center justify-content-center">
                <h4 class="titulo_curriculo p-3">
                    Idioma
                </h4>
                <button class="btn_curriculo">
                    + Adicionar Idioma
                </button>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-12 d-inline-flex align-items-center justify-content-center">
                <button class="btn_curriculo_salvar">
                    Salvar
                </button>
            </div>
        </div>
    </div>


</body>

</html>