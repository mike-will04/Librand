<?php
include "../conexao.php";

session_start();

$Nome_Fantasia = $_POST["Nome_Fantasia"];
$Razao_Social = $_POST["Razao_Social"];
$CNPJ = $_POST["CNPJ"];
$Setor_Empresa = $_POST["Setor_Empresa"];
$Numero_Funcionarios = $_POST["Numero_Funcionarios"];
$Porte_Empresa = $_POST["Porte_Empresa"];
$CEP = $_POST["CEP"];
$Rua = $_POST["Rua"];
$Numero = isset($_POST["Numero"]) ? $_POST["Numero"] : null;
$Complemento = isset($_POST["Complemento"]) ? $_POST["Complemento"] : null;
$Bairro = isset($_POST["Bairro"]) ? $_POST["Bairro"] : null;
$Estado = $_POST["Estado"];
$Cidade = $_POST["Cidade"];
$Responsavel_Contato = $_POST["Responsavel_Contato"];
$Cargo_Responsável = $_POST["Cargo_Responsável"];
$Celular_Contato = $_POST["Celular_Contato"];
$email = $_POST["email"];
$Pagina_Web = $_POST["Pagina_Web"];
$Descricao = $_POST["Descricao"];
$dir = '../../img/foto perfil/';
$tmpName = $_FILES['image']['tmp_name'];
$name = $_FILES['image']['name'];
$id_usuario = $_SESSION['iduser'];

$check = $conn->prepare(
    'SELECT count(*) as count FROM sobre_empresa 
    INNER JOIN usuario ON sobre_empresa.id_usuario = usuario.id_usuario
    WHERE usuario.id_usuario = :id_usuario;'
);
$check->execute(array(
    ':id_usuario' => $id_usuario,
));

foreach ($check as $linha) {
    try {
        if ($linha['count'] >= 1) {
            echo "<script>alert('Dados já cadastrados');history.go(-1)</script>";
        } else {
            if (move_uploaded_file($tmpName, $dir . $name)) {
                $foto = $conn->prepare('UPDATE usuario set foto_perfil = :foto_perfil where id_usuario = :id_usuario');

                $foto->execute(array(
                    ':foto_perfil' => $name,
                    ':id_usuario' => $id_usuario
                ));

                $cadastro = $conn->prepare('INSERT INTO sobre_empresa (nome_fantasia, razao_social, cnpj, setor, numero_funcionarios, porte, cep, rua, numero, complemento, bairro, estado, cidade, responsavel_contato, cargo_responsavel, celular_contato, email, pagina_web, descricao, id_usuario) VALUES 
                (:nome_fantasia, :razao_social, :cnpj, :setor, :numero_funcionarios, :porte, :cep, :rua, :numero, :complemento, :bairro, :estado, :cidade, :responsavel_contato, :cargo_responsavel, :celular_contato, :email, :pagina_web, :descricao, :id_usuario)');

                $cadastro->execute(array(
                    ':nome_fantasia' => $Nome_Fantasia,
                    ':razao_social' => $Razao_Social,
                    ':cnpj' => $CNPJ,
                    ':setor' => $Setor_Empresa,
                    ':numero_funcionarios' => $Numero_Funcionarios,
                    ':porte' => $Porte_Empresa,
                    ':cep' => $CEP,
                    ':rua' => $Rua,
                    ':numero' => $Numero,
                    ':complemento' => $Complemento,
                    ':bairro' => $Bairro,
                    ':estado' => $Estado,
                    ':cidade' => $Cidade,
                    ':responsavel_contato' => $Responsavel_Contato,
                    ':cargo_responsavel' => $Cargo_Responsável,
                    ':celular_contato' => $Celular_Contato,
                    ':email' => $email,
                    ':pagina_web' => $Pagina_Web,
                    ':descricao' => $Descricao,
                    ':id_usuario' => $id_usuario
                ));

                if ($cadastro->rowCount() == 1) {
                    echo "<script>alert('Informações da empresa adicionada com sucesso!');location = '../index.php'</script>";
                } else {
                    echo "<script>alert('Erro ao adicionar informações da empresa.');history.go(-1)</script>";
                }

                if ($foto->rowCount() == 1) {
                    echo "<script>alert('Cadastro realizado com sucesso!!!');location = '../index.php'</script>";
                } else {
                    echo "<script>alert('Erro ao cadastrar');history.go(-1)</script>";
                }
            } else {
                echo "<script>alert('Erro ao salvar a foto de perfil.');history.go(-1)</script>";
            }
        }
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}
