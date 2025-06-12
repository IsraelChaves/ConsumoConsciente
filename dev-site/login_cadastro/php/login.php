<?php
session_start();
include 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['password'];

    $sql = "SELECT id, nome, email, senha_hash FROM usuarios WHERE email = ? AND ativo = 1";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        $_SESSION['error'] = "Erro na preparação da consulta: " . $conn->error;
        header("Location: ../login.php");
        $conn->close();
        exit();
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($senha, $user['senha_hash'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_nome'] = $user['nome'];
            $_SESSION['user_email'] = $user['email'];
            if (isset($_POST['remember-me'])) {
                setcookie('user_email', $email, time() + (30 * 24 * 60 * 60), "/");
            }
            $stmt->close();
            $conn->close();
            header("Location: ../../pos_login/pos.php"); // Redireciona para a tela pós-login
            exit();
        } else {
            $_SESSION['error'] = "E-mail ou senha incorretos.";
        }
    } else {
        $_SESSION['error'] = "E-mail ou senha incorretos.";
    }

    $stmt->close();
    $conn->close();
    header("Location: ../login.php");
    exit();
}

$conn->close();
?>