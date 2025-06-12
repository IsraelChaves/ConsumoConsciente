<?php
session_start();
include '../../login_cadastro/php/conexao.php'; // ajuste o caminho conforme necessário

// Verifica se o usuário está logado
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../login_cadastro/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Se for para excluir a conta
if (isset($_POST['delete_account'])) {
    $sql = "DELETE FROM usuarios WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    if ($stmt->execute()) {
        session_destroy();
        header("Location: ../../login_cadastro/login.php");
        exit();
    } else {
        $_SESSION['error'] = "Erro ao excluir conta: " . $stmt->error;
        header("Location: editar_perfil.html");
        exit();
    }
}

$nome = $_POST['name'];
$email = $_POST['email'];
$telefone = $_POST['phone'];
$senha = $_POST['password'];
$confirmarSenha = $_POST['confirm_password'];

// Validação simples
if ($senha && $senha !== $confirmarSenha) {
    $_SESSION['error'] = "As senhas não coincidem!";
    header("Location: editar_perfil.html");
    exit();
}

// Atualiza dados
if ($senha) {
    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
    $sql = "UPDATE usuarios SET nome=?, email=?, telefone=?, senha_hash=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $nome, $email, $telefone, $senhaHash, $user_id);
} else {
    $sql = "UPDATE usuarios SET nome=?, email=?, telefone=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $nome, $email, $telefone, $user_id);
}

if ($stmt->execute()) {
    $_SESSION['success'] = "Perfil atualizado com sucesso!";
} else {
    $_SESSION['error'] = "Erro ao atualizar perfil: " . $stmt->error;
}
$stmt->close();
$conn->close();

header("Location: editar_perfil.html");
exit();
?>