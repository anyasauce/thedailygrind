// Initialize AOS
AOS.init({
    duration: 800,
    once: true,
    easing: 'ease-in-out'
});

document.addEventListener('DOMContentLoaded', function () {
    const passwordInput = document.getElementById('floatingPassword');
    const togglePassword = document.getElementById('togglePassword');

    if (passwordInput && togglePassword) {
        togglePassword.addEventListener('click', function () {
            const type = passwordInput.type === 'password' ? 'text' : 'password';
            passwordInput.type = type;
            togglePassword.innerHTML = type === 'password'
                ? '<i class="bi bi-eye-slash"></i>'
                : '<i class="bi bi-eye"></i>';
        });
    } else {
        console.error('Password input or toggle button not found.');
    }
});

(function () {
    'use strict'

    let forms = document.querySelectorAll('.needs-validation')

    Array.prototype.slice.call(forms)
        .forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)
        })
})()


document.addEventListener("DOMContentLoaded", function () {
    const num1 = Math.floor(Math.random() * 10) + 1;
    const num2 = Math.floor(Math.random() * 10) + 1;
    const answer = num1 + num2;

    document.getElementById("num1").textContent = num1;
    document.getElementById("num2").textContent = num2;

    const captchaInput = document.getElementById("captcha");
    const submitBtn = document.getElementById("submitBtn");

    captchaInput.addEventListener("input", function () {
        if (parseInt(captchaInput.value, 10) === answer) {
            submitBtn.removeAttribute("disabled");
        } else {
            submitBtn.setAttribute("disabled", "disabled");
        }
    });
});
