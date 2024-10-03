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
    <style>
        
        .btn-header{
            border: none;
            color: #2259BC;
            padding: 10px 32px;
            text-align: center;
            text-decoration: none;
            font-size: 1rem;
            transition-duration: 0.4s;
            cursor: pointer;
            border-radius: 20px;
            font-weight: bold;
        }

        .btn-header:hover{
            background-color: #132d5f;
            color: white;
        }

        .nav-link{
            color: white;
            font-weight: bold;
        }

        .nav-link:hover{
            color: rgb(209, 208, 208);
        }

        .input-pesquisa{
            border-radius: 10px 0 0 10px;
            box-sizing: border-box;
            width: 40%;
            height: 55px;
            border: 2px solid #2259BC;
            outline: none;
        }

        .btn-pesquisa{
            border-radius: 0 10px 10px 0;
            border: 2px solid #2259BC;
            background-color: #2259BC;
            color: white;
            height: 55px;
            padding: 0 20px;
        }

        .btn-pesquisa:hover{
            background-color: #132d5f;
            transition-duration: 0.4s;
            border: 2px solid #132d5f;
        }

        input[type=search]:focus{
            box-shadow: 0 0 5pt 2pt #98bcff;
            transition: 0.5s;
        }

        .fundo-pesquisa{
            padding: 3%;
        }

        .btn-vaga{
            border: none;
            color: #2259BC;
            padding: 10px 32px;
            text-align: center;
            text-decoration: none;
            font-size: 1rem;
            transition-duration: 0.4s;
            cursor: pointer;
            border-radius: 20px;
            font-weight: bold;
        }

        .btn-vaga:hover{
            background-color: #132d5f;
            color: white;
        }

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

        .card1:hover {
            color: white;
            background-color: rgb(192, 191, 191);
            border-radius: 0px 0px 10px 10px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-sm" style="background-color: #2259BC;">
        <div class="container-fluid">
            <a href="index.php" class="navbar-brand d-flex">
                <img src="../img/Logotipo Librand.png" alt="Logo Librand" style="width: 100px;">
            </a>
            
            <div class="collapse navbar-collapse" id="menuNavbar">
                <div class="navbar-nav ms-auto align-items-center" style='text-align: center;'>
                    <?php
                        if (isset($_SESSION['logado']) and $_SESSION['logado'] == true) {
                            foreach ($check as $linha) {
                                if ($linha['foto_perfil'] == null) {
                                    echo "
                                    <div class='d-inline-flex align-items-center' style='margin-right: 10px; margin-left: 10px; cursor: pointer;'  onclick='perfil()'>
                                    <img src='../img/user.png' alt='Foto Perfil' id='btn-perfil' class='width: 50px; height: 50px;'/><p style='color: white; margin-bottom: 0; margin-right: 5px;'>" . $linha['usuario'] . "</p><i class='bi bi-chevron-down' style='color: white'></i></div>";
                                    echo "<div class='card' id='carde' style='display: none;'>
                                        <a href='perfil_usuario.php' style='display: block;'>Perfil</a>
                                        <a href='sair.php' style='display: block;' class='card1'>Sair</a>
                                    </div>
                                    "; 
                                } else {
                                    echo "
                                    <div class='d-inline-flex align-items-center' style='margin-right: 10px; margin-left: 10px; cursor: pointer;'  onclick='perfil()'>
                                    <img src='../img/" . $linha['foto_perfil'] .  "' alt='Foto Perfil' id='btn-perfil' class='width: 50px; height: 50px;'/><p style='color: white; margin-bottom: 0; margin-right: 5px;'>" . $linha['usuario'] . "</p><i class='bi bi-chevron-down' style='color: white'></i></div>";
                                    echo "<div class='card' id='carde' style='display: none;'>
                                        <a href='perfil_usuario.php  style='display: block;'>Perfil</a>
                                        <a href='sair.php' style='display: block;' class='card1'>Sair</a>
                                    </div>
                                    "; 
                                }
                            }
                        } else {
                            echo "
                                <a href='../login_usuario.html' class='nav-link'>
                                    Login
                                </a>
                                <a href='../cadastro_usuario.html'>
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
        <div class="row">

        </div>

        <div class="row">

        </div>

        <div class="row">

        </div>

        <div class="row">

        </div>

        <div class="row">

        </div>

        <div class="row">

        </div>

        <div class="row">

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