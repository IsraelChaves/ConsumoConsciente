<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consumo Consciente - Cadastro</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="css/cadastro.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="apple-touch-icon" sizes="180x180" href="/assets/favicon/apple-touch-icon.png">
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
                <p class="text-green-100 mt-3">Junte-se a nós na jornada sustentável</p>
            </div>
            <div class="p-8">
                <?php if (isset($_SESSION['error'])): ?>
                    <p class="text-red-500 text-center"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></p>
                <?php endif; ?>
                <form id="registerForm" action="php/cadastro.php" method="POST" class="space-y-4">
                    <div class="grid grid-cols-1 gap-4">
                        <div class="relative">
                            <input type="text" id="nome" name="nome" required
                                   class="input-effect w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-emerald-500"
                                   placeholder=" ">
                            <label for="nome" class="floating-label">
                                <i class="fas fa-user mr-2"></i>Nome
                            </label>
                        </div>
                    </div>
                    <div class="relative">
                        <input type="email" id="email" name="email" required
                               class="input-effect w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-emerald-500"
                               placeholder=" ">
                        <label for="email" class="floating-label">
                            <i class="fas fa-envelope mr-2"></i>E-mail
                        </label>
                    </div>
                    <div class="relative">
                        <input type="tel" id="phone" name="phone" required
                               class="input-effect w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-emerald-500"
                               placeholder=" " pattern="[0-9]{11}">
                        <label for="phone" class="floating-label">
                            <i class="fas fa-phone mr-2"></i>Telefone (com DDD)
                        </label>
                    </div>
                    <div class="relative">
                        <input type="password" id="senha" name="senha" required
                               class="input-effect w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-emerald-500"
                               placeholder=" " oninput="checkPasswordStrength()">
                        <label for="senha" class="floating-label">
                            <i class="fas fa-lock mr-2"></i>Crie uma senha
                        </label>
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer" onclick="togglePassword('senha')">
                            <i id="eyeIconPassword" class="fas fa-eye-slash text-gray-400 hover:text-gray-600"></i>
                        </div>
                        <div id="passwordStrength" class="password-strength strength-0"></div>
                    </div>
                    <div class="relative">
                        <input type="password" id="confirmPassword" name="confirmPassword" required
                               class="input-effect w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-emerald-500"
                               placeholder=" ">
                        <label for="confirmPassword" class="floating-label">
                            <i class="fas fa-lock mr-2"></i>Confirme a senha
                        </label>
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer" onclick="togglePassword('confirmPassword')">
                            <i id="eyeIconConfirm" class="fas fa-eye-slash text-gray-400 hover:text-gray-600"></i>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <input id="terms" name="terms" type="checkbox" required
                               class="h-4 w-4 text-emerald-600 focus:ring-emerald-500 border-gray-300 rounded">
                        <label for="terms" class="ml-2 block text-sm text-gray-700">
                            Eu concordo com os <a href="#" class="text-emerald-600 hover:underline">Termos de Serviço</a> e <a href="#" class="text-emerald-600 hover:underline">Política de Privacidade</a>
                        </label>
                    </div>
                    <div class="pt-2">
                        <button type="submit"
                                class="btn-hover w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                            <i class="fas fa-user-plus mr-3"></i> Criar conta
                        </button>
                    </div>
                </form>
                <div class="mt-6 text-center">
                    <p class="text-sm text-gray-600">
                        Já tem uma conta?
                        <a href="login.php" class="font-medium text-emerald-600 hover:text-emerald-500 transition-colors">
                            Faça login
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
    <script src="js/cadastro.js"></script>
    <script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script');d.innerHTML="window.__CF$cv$params={r:'93ea7065f9edb03e',t:'MTc0NzA1ODM5Mi4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";b.getElementsByTagName('head')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none';a.style.visibility='hidden';document.body.appendChild(a);if('loading'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script>
</body>
</html>