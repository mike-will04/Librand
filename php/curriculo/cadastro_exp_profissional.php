<?php
include "../conexao.php";

session_start();

$Empresa = $_POST["Empresa"];
$Responsabilidades = $_POST["Responsabilidades"];
$Cargo = $_POST["Cargo"];
$Nivel = isset($_POST["Nivel"]) ? $_POST["Nivel"] : null;
$Area = $_POST["Area"];
$InicioEmprego = $_POST["InicioEmprego"];
$FimEmprego = $_POST["FimEmprego"];
$Atual = isset($_POST["Atual"]) ? 1 : 0;
$id_usuario = $_SESSION['iduser'];
$redirectPage = $_POST['redirect'];

$check = $conn->prepare(
    'SELECT count(*) as count FROM experiencia WHERE id_usuario = :id_usuario'
);
$check->execute(array(
    ':id_usuario' => $id_usuario,
));

foreach ($check as $linha) {
    try {
        $cadastro = $conn->prepare('INSERT INTO experiencia (empresa, responsabilidades, cargo, nivel, area, inicio_emprego, fim_emprego, atual, id_usuario) VALUES 
        (:empresa, :responsabilidades, :cargo, :nivel, :area, :inicio_emprego, :fim_emprego, :atual, :id_usuario)');
        $cadastro->execute(array(
            ':empresa' => $Empresa,
            ':responsabilidades' => $Responsabilidades,
            ':cargo' => $Cargo,
            ':nivel' => $Nivel,
            ':area' => $Area,
            ':inicio_emprego' => $InicioEmprego,
            ':fim_emprego' => $FimEmprego,
            ':atual' => $Atual,
            ':id_usuario' => $id_usuario
        ));
        if ($cadastro->rowCount() == 1) {
            $_SESSION['message'] = 'Exp.Profissional adicionada com sucesso!';
        } else {
            echo "<script>alert('Erro ao adicionar exp.profissional.');history.go(-1)</script>";
        }
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}

header("Location: $redirectPage");
exit();
