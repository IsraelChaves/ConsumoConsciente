  function togglePassword() {
    const passwordInput = document.getElementById('password');
    const eyeIcon = document.getElementById('eyeIcon');
    
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

document.getElementById('loginForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    const emailError = document.getElementById('emailError');
    const passwordError = document.getElementById('passwordError');
    
    // Reset errors
    emailError.classList.add('hidden');
    passwordError.classList.add('hidden');
    
    let isValid = true;
    
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        emailError.classList.remove('hidden');
        isValid = false;
    }
    
    if (password.length < 6) {
        passwordError.classList.remove('hidden');
        isValid = false;
    }
    
    if (!isValid) return;
    
    const submitBtn = document.querySelector('button[type="submit"]');
    const originalText = submitBtn.innerHTML;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Entrando...';
    submitBtn.disabled = true;
    
    setTimeout(() => {
        submitBtn.innerHTML = originalText;
        submitBtn.disabled = false;
        
        const successAlert = document.createElement('div');
        successAlert.className = 'fixed top-4 right-4 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow-lg z-50 animate-fade-in';
        successAlert.innerHTML = `
            <div class="flex items-center">
                <i class="fas fa-check-circle mr-2"></i>
                <span>Login realizado com sucesso! Redirecionando...</span>
            </div>
        `;
        document.body.appendChild(successAlert);
        
        setTimeout(() => {
            successAlert.classList.add('opacity-0', 'transition-opacity', 'duration-500');
            setTimeout(() => successAlert.remove(), 500);
        }, 3000);
    }, 1500);
});

document.querySelectorAll('input').forEach(input => {
    input.addEventListener('focus', function() {
        const label = this.nextElementSibling;
        label.classList.add('text-emerald-600');
    });
    
    input.addEventListener('blur', function() {
        const label = this.nextElementSibling;
        if (!this.value) {
            label.classList.remove('text-emerald-600');
        }
    });
});