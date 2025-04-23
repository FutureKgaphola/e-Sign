window.addEventListener('DOMContentLoaded', event => {
    const btnLogin = document.getElementById('btnlogin');
    const spinner = document.getElementById('spinner');
    const email = document.getElementById('userEmail');
    const password = document.getElementById('userPass');

    spinner.style.display = 'none';
    btnLogin.addEventListener('click', async(event) => {
        event?.preventDefault();

          // Basic validation
          if (!email.value || !password.value) {
            alert('Please enter both email and password.');
            return;
        }
        if (password.value.length < 6) {
            alert('Password must be at least 6 characters long.');
            return;
        }
        if (!validateEmail(email.value)) {
            alert('Please enter a valid email address.');
            return;
        }
        spinner.style.display = 'block';
        btnLogin.style.display = 'none';
        const resp= await fetch('login/submit', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: `email=${encodeURIComponent(email.value)}&password=${encodeURIComponent(password.value)}`
        });
        if (resp.status === 200) {
            spinner.style.display = 'none';
            btnLogin.style.display = 'block';
            //return;
        } else {
            alert(resp.status);
            spinner.style.display = 'none';
            btnLogin.style.display = 'block';
        }
    });


    function validateEmail(email) {
        // Simple email regex
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
    }
});