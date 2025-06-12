function togglePassword(fieldId) {
    const input = document.getElementById(fieldId);
    const icon = document.getElementById(`eyeIcon${fieldId === 'senha' ? 'Password' : 'Confirm'}`);
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.replace('fa-eye-slash', 'fa-eye');
    } else {
        input.type = 'password';
        icon.classList.replace('fa-eye', 'fa-eye-slash');
    }
}

function checkPasswordStrength() {
    const password = document.getElementById('senha').value;
    const strengthDiv = document.getElementById('passwordStrength');
    let strength = 0;
    if (password.length >= 8) strength++;
    if (/[A-Z]/.test(password)) strength++;
    if (/[0-9]/.test(password)) strength++;
    if (/[^A-Za-z0-9]/.test(password)) strength++;
    strengthDiv.className = `password-strength strength-${strength}`;
}