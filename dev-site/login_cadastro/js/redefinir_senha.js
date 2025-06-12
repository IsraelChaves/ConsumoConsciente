 function togglePassword(inputId, iconId) {
    const passwordInput = document.getElementById(inputId);
    const icon = document.getElementById(iconId);
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    } else {
        passwordInput.type = 'password';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    }
}

document.getElementById('resetForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const newPassword = document.getElementById('newPassword').value;
    const confirmPassword = document.getElementById('confirmPassword').value;
    
    if (newPassword !== confirmPassword) {
        alert('As senhas não coincidem!');
        return;
    }
    
    if (newPassword.length < 8) {
        alert('A senha deve ter pelo menos 8 caracteres!');
        return;
    }
    
    setTimeout(() => {
        document.getElementById('successMessage').classList.remove('hidden');
        document.getElementById('resetForm').reset();
        
        setTimeout(() => {
            window.location.href = 'login.html'; 
        }, 3000);
    }, 1000);
});