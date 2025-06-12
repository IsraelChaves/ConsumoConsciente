<?php
session_start();
if (isset($_SESSION['success'])) {
    echo '<div style="background: #d1fae5; color: #065f46; padding: 12px; border-radius: 6px; margin-bottom: 16px; text-align: center;">'
        . $_SESSION['success'] .
        '</div>';
    unset($_SESSION['success']);
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Consumo Consciente</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/cadastro.css">
    <link rel="apple-touch-icon" sizes="180x180" href="/assets/favicon/apple-touch-icon.png"
    <link rel="icon" type="image/png" sizes="32x32" href="/assets/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/favicon/favicon-16x16.png">
    <link rel="manifest" href="/assets/favicon/site.webmanifest">
</head>
<body class="min-h-screen flex items-center justify-center p-4">
    <div class="relative w-full max-w-md z-10 card-container">
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden card">
            <div class="bg-gradient-to-r from-green-400 to-emerald-600 p-8 text-center relative">
                <div class="flex justify-center">
                    <img src="https://i.ibb.co/hRD4DmfN/logo.png" alt="logo" class="logo" border="0">
                </div>
                <h1 class="text-3xl font-bold text-white mt-2">Consumo Consciente</h1>
                <p class="text-green-100 mt-3">Acesse sua conta</p>
            </div>
            <div class="p-8">
                <?php if (isset($_SESSION['error'])): ?>
                    <p class="text-red-500 text-center"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></p>
                <?php endif; ?>
                <form id="loginForm" action="php/login.php" method="POST" class="space-y-6">
                    <div class="relative">
                        <input type="email" id="email" name="email" required
                               class="input-effect w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-emerald-500"
                               placeholder=" ">
                        <label for="email" class="floating-label">
                            <i class="fas fa-envelope mr-2"></i>E-mail
                        </label>
                    </div>
                    <div class="relative">
                        <input type="password" id="password" name="password" required
                               class="input-effect w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-emerald-500"
                               placeholder=" ">
                        <label for="password" class="floating-label">
                            <i class="fas fa-lock mr-2"></i>Senha
                        </label>
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer" onclick="togglePassword('password')">
                            <i id="eyeIconPassword" class="fas fa-eye-slash text-gray-400 hover:text-gray-600"></i>
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input id="remember-me" name="remember-me" type="checkbox"
                                   class="h-4 w-4 text-emerald-600 focus:ring-emerald-500 border-gray-300 rounded">
                            <label for="remember-me" class="ml-2 block text-sm text-gray-700">
                                Lembrar de mim
                            </label>
                        </div>
                        <div class="text-sm">
                            <a href="redefinir_senha.html" class="font-medium text-emerald-600 hover:text-emerald-500 transition-colors">
                                Esqueceu sua senha?
                            </a>
                        </div>
                    </div>
                    <div>
                        <button type="submit"
                                class="btn-hover w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                            <i class="fas fa-sign-in-alt mr-3"></i> Entrar
                        </button>
                    </div>
                </form>
                <div class="mt-6 text-center">
                    <p class="text-sm text-gray-600">
                        Novo no Consumo Consciente?
                        <a href="cadastro.php" class="font-medium text-emerald-600 hover:text-emerald-500 transition-colors">
                            Cadastre-se
                        </a>
                    </p>
                </div>
            </div>
        </div>
        <div class="mt-6 text-center text-sm text-gray-500">
            <p>© 2025 Consumo Consciente. Todos os direitos reservados.</p>
            <p class="mt-2">
                <a href="#" class="hover:text-emerald-600 transition-colors">Termos de uso</a> • 
                <a href="#" class="hover:text-emerald-600 transition-colors">Política de privacidade</a>
            </p>
        </div>
    </div>
    <script>
        function togglePassword(id) {
            const passwordInput = document.getElementById(id);
            const eyeIcon = document.getElementById('eyeIconPassword');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            }
        }
    </script>
</body>
</html>