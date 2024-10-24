document.getElementById('signupForm').addEventListener('submit', function(event) {
    event.preventDefault();

    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirmPassword').value;

    if (password !== confirmPassword) {
        alert("Passwords Tidak Sama!");
        return;
    }

    const successMessage = document.createElement('div');
    successMessage.textContent = 'Berhasil! Akun Anda Telah Dibuat.';
    successMessage.style.backgroundColor = 'green';
    successMessage.style.color = 'white';
    successMessage.style.padding = '10px';
    successMessage.style.marginTop = '10px';
    successMessage.style.textAlign = 'center';

    const container = document.querySelector('.container');
    container.prepend(successMessage);
});