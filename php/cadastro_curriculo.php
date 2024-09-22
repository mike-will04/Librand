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
        .div_curriculo{
            height: 125px;
            margin: 0 2% 0 2%;;
        }

        /* .titulo_curriculo{
            font-weight: bold;
        } */

        .btn_curriculo{
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

        .btn_curriculo:hover{
            background-color: #132d5f;
            color: white;
        }

        .btn_curriculo_salvar{
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

        .btn_curriculo_salvar:hover{
            background-color: #132d5f;
            color: white;
        }

        @media only screen and (min-width: 320px) and (max-width: 767px){
            .div_curriculo{
                text-align: center;
                display: flex;
                flex-wrap: wrap;
                align-content: center;
            }
        }

        @media only screen and (min-width: 768px) and (max-width: 1024px){
            .div_curriculo{
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
                <button class="btn_curriculo">
                    + Adicionar dados pessoais
                </button>
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
