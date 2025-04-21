function openModal() {
    document.getElementById('authModal').style.display = 'flex';
    
}

function closeModal() {
    document.getElementById('authModal').style.display = 'none';
    clearMessages();
}

function toggleForm(e) {
    e.preventDefault();
    const regFields = document.getElementById('registerFields');
    const formTitle = document.getElementById('formTitle');
    const registerLink = document.getElementById('registerLink');
    const loginLink = document.getElementById('loginLink');
    const modeInput = document.getElementById('authMode');
    const gmailInput = document.querySelector('input[name="gmail"]');
    const isLogin = regFields.style.display === 'none';

    regFields.style.display = isLogin ? 'block' : 'none';
    formTitle.innerText = isLogin ? 'Register' : 'Login';
    registerLink.style.display = isLogin ? 'none' : 'block';
    loginLink.style.display = isLogin ? 'block' : 'none';
    modeInput.value = isLogin ? 'register' : 'login';
    gmailInput.placeholder = isLogin ? 'Username' : 'Username or Gmail';

    // Required 
    regFields.querySelectorAll('input').forEach(input => {
        input.required = isLogin;
        
    });

    clearMessages();
}

function clearMessages() {
    document.getElementById('formError').innerText = '';
    document.getElementById('formSuccess').innerText = '';
}

document.getElementById('authForm').addEventListener('submit', async (e) => {
    e.preventDefault();
    clearMessages();

    const form = e.target;
    const formData = new FormData(form);
    const mode = formData.get('mode');

    if (mode === 'register') 
        
        {
        const password = formData.get('password');
        if (password.length < 8 || !/\d/.test(password) || !/[A-Za-z]/.test(password)) {
            document.getElementById('formError').innerText = 'Password must be at least 8 characters, include letters and numbers.';
            return;
        }
    }

    try {
        const response = await fetch('database/auth.php', {
            method: 'POST',
            body: formData
        });
        const result = await response.json();

        if (result.error) {
            document.getElementById('formError').innerText = result.error;
        } else if (result.success) {
            document.getElementById('formSuccess').innerText = result.success;
            setTimeout(() => {
                closeModal();
                form.reset();
                if (mode === 'login') {
                    window.location.reload();
                }
            }, 1200);
        }
    } catch (err) {
        document.getElementById('formError').innerText = 'Something went wrong. Try again.';
    }
});


function openUserModal() {
    document.getElementById('userModal').style.display = 'flex';
}
function closeUserModal() {
    document.getElementById('userModal').style.display = 'none';
}
function logoutUser() {
    fetch('database/logout.php', {
        method: 'POST',
        credentials: 'include'
    }).then(() => {
        window.location.reload();
    });
}