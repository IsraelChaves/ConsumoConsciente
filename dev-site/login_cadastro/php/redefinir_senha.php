<?php
// filepath: c:\xampp\htdocs\dev-site\login_cadastro\redefinir_senha.php
include 'conexao.php'; // ajuste o caminho se necessário

$email = $_POST['email'];
$novaSenha = $_POST['newPassword'];
$confirmarSenha = $_POST['confirmPassword'];

// Validação simples
if ($novaSenha !== $confirmarSenha) {
    echo "<script>alert('As senhas não coincidem!'); window.history.back();</script>";
    exit();
}

// Verifica se o e-mail existe
$sql = "SELECT id FROM usuarios WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows == 0) {
    echo "<script>alert('E-mail não encontrado!'); window.history.back();</script>";
    exit();
}

// Atualiza a senha
$novaSenhaHash = password_hash($novaSenha, PASSWORD_DEFAULT);
$sql = "UPDATE usuarios SET senha_hash = ? WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $novaSenhaHash, $email);

if ($stmt->execute()) {
    echo "<script>alert('Senha redefinida com sucesso!'); window.location.href='login.php';</script>";
} else {
    echo "<script>alert('Erro ao redefinir senha!'); window.history.back();</script>";
}
$stmt->close();
$conn->close();
?>