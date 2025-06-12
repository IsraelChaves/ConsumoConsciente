<?php
session_start();
include 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['phone'];
    $senha = $_POST['senha'];
    $confirmarSenha = $_POST['confirmPassword'];

    if ($senha !== $confirmarSenha) {
        $_SESSION['error'] = "As senhas não coincidem.";
        header("Location: ../cadastro.php");
        $conn->close();
        exit();
    }

    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarios (nome, email, telefone, senha_hash) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql); // Linha 21 (aproximada)
    if (!$stmt) {
        $_SESSION['error'] = "Erro na preparação da consulta: " . $conn->error;
        $conn->close();
        header("Location: ../cadastro.php");
        exit();
    }

    $stmt->bind_param("ssss", $nome, $email, $telefone, $senhaHash);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Cadastro realizado com sucesso! Faça login para continuar.";
        $stmt->close();
        $conn->close();
        header("Location: ../login.php");
        exit();
    } else {
        $_SESSION['error'] = "Erro ao cadastrar: " . $stmt->error;
        $stmt->close();
        $conn->close();
        header("Location: ../cadastro.php");
        exit();
    }
}
?>