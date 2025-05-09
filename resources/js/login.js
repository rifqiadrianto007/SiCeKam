        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');

        const eyeVisible = `
        <path
            d="M12 4.5c-4.478 0-8.268 2.943-9.542 7 1.274 4.057 5.064 7 9.542 7s8.268-2.943 9.542-7c-1.274-4.057-5.064-7-9.542-7zM12 15a3 3 0 110-6 3 3 0 010 6z" />
        `;

        const eyeSlash = `
        <path
            d="M3.98 8.223A10.97 10.97 0 001.458 10C2.732 14.057 6.522 17 11 17c1.392 0 2.716-.262 3.924-.736l-1.625-1.625A4.978 4.978 0 0111 15a5 5 0 01-5-5c0-.872.223-1.69.615-2.403L3.98 8.223z" />
        <path d="M19.293 19.293l-16-16 1.414-1.414 16 16-1.414 1.414z" />
        `;

        let visible = false;

        togglePassword.addEventListener('click', () => {
        visible = !visible;
        passwordInput.type = visible ? 'text' : 'password';
        eyeIcon.innerHTML = visible ? eyeVisible : eyeSlash;
        });
