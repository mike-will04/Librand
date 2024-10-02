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
    echo "<script>location = 'index.php' </script>";
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
                                <form action="cadastro_dados_pessoais.php" method="post" enctype="multipart/form-data">
                                    <!-- Nome, Sobrenome, Nome Social, Email -->
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label for="nome" class="form-label">Nome:</label>
                                            <input type="text" class="form-control" placeholder="Nome" name="Nome" required>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="sobrenome" class="form-label">Sobrenome:</label>
                                            <input type="text" class="form-control" placeholder="Sobrenome" name="Sobrenome" required>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="nomesocial" class="form-label">Nome Social:</label>
                                            <input type="text" class="form-control" placeholder="Nome Social" name="NomeSocial">
                                        </div>
                                    </div>
                                    <!-- País, CPF, Celular, Data de Nascimento -->
                                    <div class="row mt-3">
                                        <div class="form-group col-md-3">
                                            <label for="origem" class="form-label">País de Origem:</label>
                                            <input type="text" class="form-control" placeholder="País de Origem" name="Origem" required>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="cpf" class="form-label">CPF:</label>
                                            <input type="text" class="form-control" placeholder="CPF" name="CPF" required>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="celular" class="form-label">Celular:</label>
                                            <input type="text" class="form-control" placeholder="Celular" name="Celular" required>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="nascimemnto" class="form-label">Data de Nascimento:</label>
                                            <input type="date" class="form-control" placeholder="Data de Nascimento" name="Nascimemnto" required>
                                        </div>
                                    </div>
                                    <!-- Raç, Estado Civil -->
                                    <div class="row mt-3">
                                        <div class="form-group col-md-6">
                                            <label for="Raca" class="form-label">Raça/Etnia:</label>
                                            <select name="Raca" id="Raca" class="form-select" required>
                                                <option value="" disabled selected>Selecione</option>
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
                                            <label for="EstadoCivil" class="form-label">Estado Civil:</label>
                                            <select name="EstadoCivil" id="EstadoCivil" class="form-select" required>
                                                <option value="" disabled selected>Selecione</option>
                                                <option value="Solteiro(a)">Solteiro(a)</option>
                                                <option value="Casado(a)">Casado(a)</option>
                                                <option value="Divorciado(a)">Divorciado(a)</option>
                                                <option value="Viúvo(a)">Viúvo(a)</option>
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
                                                <input type="radio" class="form-check-input" id="Estrangeiro" name="Estrangeiro" value="Sim">
                                                <label class="form-check-label" for="Estrangeiro">Sim</label>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="form-check">
                                                <input type="radio" class="form-check-input" id="Estrangeiro" name="Estrangeiro" value="Não">
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
                                                <input type="radio" class="form-check-input" id="PossuiDeficiencia" name="PossuiDeficiencia" value="Sim" onclick="habilitar(true)">
                                                <label class="form-check-label" for="Deficiencia">Sim</label>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="form-check">
                                                <input type="radio" class="form-check-input" id="PossuiDeficiencia" name="PossuiDeficiencia" value="Não" onclick="habilitar(false)">
                                                <label class="form-check-label" for="Deficiencia">Não</label>
                                            </div>
                                        </div>
                                    </div>
                                    <fieldset id="fieldset1" disabled>
                                        <!-- Tipo Deficiência -->
                                        <div class="row mt-3">
                                            <div class="col-md-2">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="Auditiva" name="Auditiva" value="Auditiva">
                                                    <label class="form-check-label" for="Auditiva">Auditiva</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="AuditivaTotal" name="AuditivaTotal" value="Auditiva Total">
                                                    <label class="form-check-label" for="AuditivaTotal">Auditiva Total</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="Outros" name="Outros" value="Outros">
                                                    <label class="form-check-label" for="Outros">Outros</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="VisualBaixaVisão" name="VisualBaixaVisão" value="Visual - Baixa Visão">
                                                    <label class="form-check-label" for="VisualBaixaVisão">Visual - Baixa Visão</label>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="AuditivaFalaLibras" name="AuditivaFalaLibras" value="Auditiva (fala libras)">
                                                    <label class="form-check-label" for="AuditivaFalaLibras">Auditiva (fala libras)</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="DaFala" name="DaFala" value="Da Fala">
                                                    <label class="form-check-label" for="DaFala">Da Fala</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="Psicossocial" name="Psicossocial" value="Psicossocial">
                                                    <label class="form-check-label" for="Psicossocial">Psicossocial</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="VisualCegoTotal" name="VisualCegoTotal" value="Visual - Cego Total">
                                                    <label class="form-check-label" for="VisualCegoTotal">Visual - Cego Total</label>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="AuditivaOralizado" name="AuditivaOralizado" value="Auditiva (oralizado)">
                                                    <label class="form-check-label" for="AuditivaOralizado">Auditiva (oralizado)</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="Física" name="Fisica" value="Física">
                                                    <label class="form-check-label" for="Fisica">Física</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="tea" name="tea" value="Transtorno do espectro autista">
                                                    <label class="form-check-label" for="tea">Transtorno do espectro autista</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="VisualMonocular" name="VisualMonocular" value="Visual - Monocular">
                                                    <label class="form-check-label" for="VisualMonocular">Visual - Monocular</label>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="Auditiva Parcial" name="AuditivaParcial" value="Auditiva Parcial">
                                                    <label class="form-check-label" for="Auditiva Parcial">Auditiva Parcial</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="IntelectualLeve" name="IntelectualLeve" value="Intelectual Leve">
                                                    <label class="form-check-label" for="IntelectualLeve">Intelectual Leve</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="visual" name="visual" value="Visual">
                                                    <label class="form-check-label" for="visual">Visual</label>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Laudo Médico -->
                                        <div class="row mt-3">
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label for="Laudo">Anexar laudo Médico:</label>
                                                    <input type="file" class="form-control" name="Laudo">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Caracterísica PcD -->
                                        <div class="row mt-3">
                                            <div class="col-md-12">
                                                <label for="Caracteristica">Digite aqui algum suporte especial que sua característica como PcD demande durante a participação no recrutamento (ex.: descrição de texto em áudios, aumento de tamanho dos textos, etc.):</label>
                                                <textarea class="form-control" rows="5" id="caracteristica" name="Caracteristica" maxlength="255" required></textarea>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <!-- Renda Mensal, Renda Familiar -->
                                    <div class="row mt-3">
                                        <div class="form-group col-md-6">
                                            <label for="RendaMensal" class="form-label">Qual a sua renda mensal, aproximadamente?</label>
                                            <select name="RendaMensal" id="RendaMensal" class="form-select" required>
                                                <option value="" disabled selected>Selecione</option>
                                                <option value="Nenhuma Renda">Nenhuma Renda</option>
                                                <option value="Até 2 salários-mínimos">Até 2 salários-mínimos</option>
                                                <option value="De 2 a 4 sálarios-mínimos">De 2 a 4 sálarios-mínimos</option>
                                                <option value="De 4 a 10 sálarios-mínimos">De 4 a 10 sálarios-mínimos</option>
                                                <option value="De 10 a 20 sálarios-mínimos">De 10 a 20 sálarios-mínimos</option>
                                                <option value="Acima de 20 sálarios-mínimos">Acima de 20 sálarios-mínimos</option>
                                                <option value="Prefiro não responder">Prefiro não responder</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="RendaFamiliar" class="form-label">Qual a sua renda familiar, aproximadamente?</label>
                                            <select name="RendaFamiliar" id="RendaFamiliar" class="form-select" required>
                                                <option value="" disabled selected>Selecione</option>
                                                <option value="Nenhuma Renda">Nenhuma Renda</option>
                                                <option value="Até 2 salários-mínimos">Até 2 salários-mínimos</option>
                                                <option value="De 2 a 4 sálarios-mínimos">De 2 a 4 sálarios-mínimos</option>
                                                <option value="De 4 a 10 sálarios-mínimos">De 4 a 10 sálarios-mínimos</option>
                                                <option value="De 10 a 20 sálarios-mínimos">De 10 a 20 sálarios-mínimos</option>
                                                <option value="Acima de 20 sálarios-mínimos">Acima de 20 sálarios-mínimos</option>
                                                <option value="Prefiro não responder">Prefiro não responder</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- CEP, Rua -->
                                    <div class="row mt-3">
                                        <div class="form-group col-md-6">
                                            <label for="CEP" class="form-label">CEP:</label>
                                            <input type="text" class="form-control" placeholder="CEP" name="CEP" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="Rua" class="form-label">Rua:</label>
                                            <input type="text" class="form-control" placeholder="Rua" name="Rua" required>
                                        </div>
                                    </div>
                                    <!-- Sobre Você -->
                                    <div class="row mt-3">
                                        <div class="col-md-12">
                                            <label for="Sobre">Tem algo mais que você considera importante contar sobre você?</label>
                                            <textarea class="form-control" rows="5" id="Sobre" name="Sobre" maxlength="255"></textarea>
                                        </div>
                                    </div>
                                    <!-- Vídeo Currículo -->
                                    <div class="row mt-3">
                                        <div class="form-group col-md-12">
                                            <label for="Video" class="form-label">Vídeo Currículo:</label>
                                            <input type="text" class="form-control" placeholder="Video" name="Video">
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
            <div class="col-md-5 div_curriculo shadow rounded d-inline-flex align-items-center justify-content-center">
                <h4 class="titulo_curriculo p-3">
                    Objetivo
                </h4>
                <button class="btn_curriculo" data-bs-toggle="modal" data-bs-target="#modalObjetivo">
                    + Adicionar Objetivo
                </button>
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
                                <form action="cadastro_objetivo.php" method="post" enctype="multipart/form-data">
                                    <!-- Cargo de Interesse, Pretenção Salarial -->
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="Cargo de Interesse" class="form-label">Cargo de Interesse:</label>
                                            <input type="text" class="form-control" placeholder="Cargo de Interesse" name="CargoDeInteresse" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="PretencaoSalarial" class="form-label">Pretenção Salarial:</label>
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
        </div>

        <div class="row justify-content-center p-4">
            <div class="col-md-5 div_curriculo shadow rounded d-inline-flex align-items-center justify-content-center">
                <h4 class="titulo_curriculo p-3">
                    Exp.profissional
                </h4>
                <button class="btn_curriculo" data-bs-toggle="modal" data-bs-target="#modalExperiencia">
                    + Adicionar Exp.Profissional
                </button>
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
                                <form action="cadastro_exp_profissional.php" method="post" enctype="multipart/form-data">
                                    <!-- Empresa -->
                                    <div class="row mt-3">
                                        <div class="form-group col-md-12">
                                            <label for="Empresa" class="form-label">Empresa:</label>
                                            <input type="text" class="form-control" placeholder="Empresa" name="Empresa" required>
                                        </div>
                                    </div>
                                    <!-- Responsabilidades -->
                                    <div class="row mt-3">
                                        <div class="form-group col-md-12">
                                            <label for="Responsabilidades" class="form-label">Responsabilidades:</label>
                                            <textarea class="form-control" rows="5" id="Responsabilidades" name="Responsabilidades" maxlength="255" required></textarea>
                                        </div>
                                    </div>
                                    <!-- Cargo, Nível, Área -->
                                    <div class="row mt-3">
                                        <div class="form-group col-md-4">
                                            <label for="Cargo" class="form-label">Cargo:</label>
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
                                            <label for="Area" class="form-label">Área:</label>
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
                                            <label for="InicioEmprego" class="form-label">De:</label>
                                            <input type="date" class="form-control" placeholder="Inicio Emprego" name="InicioEmprego" required>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="FimEmprego" class="form-label">Até:</label>
                                            <input type="date" class="form-control" placeholder="Fim Emprego" id="fieldset2" name="FimEmprego" required>
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
            <div class="col-md-5 div_curriculo shadow rounded d-inline-flex align-items-center justify-content-center">
                <h4 class="titulo_curriculo p-3">
                    Formação
                </h4>
                <button class="btn_curriculo" data-bs-toggle="modal" data-bs-target="#modalFormacao">
                    + Adicionar Formação
                </button>
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
                                <form action="cadastro_formacao.php" method="post" enctype="multipart/form-data">
                                    <!-- Cargo de País, Estado -->
                                    <div class="row mt-3">
                                        <div class="form-group col-md-6">
                                            <label for="Pais" class="form-label">País:</label>
                                            <input type="text" class="form-control" placeholder="País" name="Pais" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="Estado" class="form-label">Estado:</label>
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
                                        <div class="form-group col-md-4">
                                            <label for="Nivel" class="form-label">Nível:</label>
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
                                        <div class="form-group col-md-4">
                                            <label for="Instituicao" class="form-label">Instituição:</label>
                                            <input type="text" class="form-control" placeholder="Instituição" name="Instituicao" required>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="Curso" class="form-label">Curso:</label>
                                            <input type="text" class="form-control" placeholder="Curso" name="Curso" id="Curso" required>
                                        </div>
                                    </div>
                                    <!-- Status, Campus -->
                                    <div class="row mt-3">
                                        <div class="form-group col-md-6">
                                            <label for="Status" class="form-label">Status:</label>
                                            <select name="Status" id="Status" class="form-select" required  onchange="habilitar4(this)">
                                                <option value="" disabled selected>Selecione</option>
                                                <option value="Cursando">Cursando</option>
                                                <option value="Trancado">Trancado</option>
                                                <option value="Concluído">Concluído</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="Campus" class="form-label">Campus:</label>
                                            <input type="text" class="form-control" placeholder="Campus" name="Campus" id="Campus" required>
                                        </div>
                                    </div>
                                    <!-- Inicio Formação, Fim Formação, Turno -->
                                    <div class="row mt-3">
                                        <div class="form-group col-md-4">
                                            <label for="InicioFormacao" class="form-label">Início:</label>
                                            <input type="date" class="form-control" placeholder="Inicio Formação" name="InicioFormacao" required>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="FimFormacao" class="form-label">Previsão/Data de Conclusão:</label>
                                            <input type="date" class="form-control" placeholder="Fim Formação" name="FimFormacao" required>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="Turno" class="form-label">Turno:</label>
                                            <select name="Turno" id="Turno" class="form-select" required>
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
        </div>

        <div class="row justify-content-center p-4">
            <div class="col-md-5 div_curriculo shadow rounded d-inline-flex align-items-center justify-content-center">
                <h4 class="titulo_curriculo p-3">
                    Especializações
                </h4>
                <button class="btn_curriculo" data-bs-toggle="modal" data-bs-target="#modalEspecializacoes">
                    + Adicionar Especializações
                </button>
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
                                <form action="cadastro_especializacoes.php" method="post" enctype="multipart/form-data">
                                    <!-- País, Categoria, Organização -->
                                    <div class="row mt-3">
                                        <div class="form-group col-md-4">
                                            <label for="Pais" class="form-label">País:</label>
                                            <input type="text" class="form-control" placeholder="País" name="Pais" required>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="Categoria" class="form-label">Categoria:</label>
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
                                            <label for="Organizacao" class="form-label">Organização:</label>
                                            <input type="text" class="form-control" placeholder="Organização" name="Organizacao" required>
                                        </div>
                                    </div>
                                    <!-- Início Experiência, Fim Experiência -->
                                    <div class="row mt-3">
                                        <div class="form-group col-md-6">
                                            <label for="InicioExperiencia" class="form-label">Início:</label>
                                            <input type="date" class="form-control" placeholder="Inicio Experiencia" name="InicioExperiencia" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="FimExperiencia" class="form-label">Final:</label>
                                            <input type="date" class="form-control" placeholder="Fim Experiencia" id="fieldset2" name="FimExperiencia" required>
                                        </div>
                                    </div>
                                    <!-- Responsabilidades -->
                                    <div class="row mt-3">
                                        <div class="form-group col-md-12">
                                            <label for="ResponsabilidadesExperiencia" class="form-label">Responsabilidades:</label>
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
            <div class="col-md-5 div_curriculo shadow rounded d-inline-flex align-items-center justify-content-center">
                <h4 class="titulo_curriculo p-3">
                    Idioma
                </h4>
                <button class="btn_curriculo" data-bs-toggle="modal" data-bs-target="#modalIdioma">
                    + Adicionar Idioma
                </button>
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
                                <form action="cadastro_idioma.php" method="post" enctype="multipart/form-data">
                                    <!-- Idioma, Proeficiênia -->
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="Idioma" class="form-label">Idioma:</label>
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
                                            <label for="Proficiencia" class="form-label">Proeficiência:</label>
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

<script src="../js/desabilitar_input.js"></script>