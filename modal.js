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
function generateAvailableTimes() {
    const select = document.getElementById('timeInput');
    const date = new Date(document.getElementById('dateInput').value);
    select.innerHTML = '';

    if (isNaN(date.getTime())) return;

    const day = date.getDay(); 
    let start = 0, end = 0;

    if (day === 0) return; // Sunday = closed
    if (day === 6) { start = 9; end = 17; } 
    else { start = 8; end = 18; } 

    for (let h = start; h < end; h++) {
        const time = h.toString().padStart(2, '0') + ':00';
        const option = document.createElement('option');
        option.value = time;
        option.textContent = time;
        select.appendChild(option);
    }
}

document.getElementById('dateInput').addEventListener('change', generateAvailableTimes);

document.getElementById('bookingForm').addEventListener('submit', async (e) => {
    e.preventDefault();

    const formData = new FormData(e.target);
    const res = await fetch('database/book_appointment.php', {
        method: 'POST',
        body: formData
    });

    const result = await res.json();
    document.getElementById('bookingError').textContent = result.error || '';
    document.getElementById('bookingSuccess').textContent = result.success || '';

    if (result.success) {
        e.target.reset();
        document.getElementById('timeInput').innerHTML = '';
    }
});

document.querySelectorAll('.tab-btn').forEach(btn => {
    btn.addEventListener('click', () => {
      document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
  
      const tab = btn.dataset.tab;
      document.querySelectorAll('.tab-content').forEach(content => {
        content.style.display = content.dataset.tab === tab ? 'block' : 'none';
      });
    });
  });
  function loadHistory() {
    fetch('database/get_user_appointments.php')
      .then(res => res.json())
      .then(data => {
        const container = document.getElementById('historyContent');
        if (data.length === 0) {
          container.innerHTML = '<p>No appointments found.</p>';
          return;
        }
  
        container.innerHTML = data.map(app => `
          <div>
            <strong>${app.title}</strong> — ${app.appointment_date} at ${app.appointment_time}
          </div>
        `).join('');
      });
  }
  
  // вызывать при переключении на вкладку history
  document.querySelector('[data-tab="history"]').addEventListener('click', loadHistory);
  function loadHistory() {
    fetch('database/get_user_appointments.php')
      .then(res => res.json())
      .then(data => {
        const container = document.getElementById('historyContent');
        if (!container) return;
  
        if (data.length === 0) {
          container.innerHTML = '<p>No appointments found.</p>';
          return;
        }
  
        container.innerHTML = data.map(app => `
          <div>
            <strong>${app.title}</strong> — ${app.appointment_date} at ${app.appointment_time}
          </div>
        `).join('');
      });
  } 


  // вкладки
document.querySelectorAll('.tab-btn').forEach(btn => {
    btn.addEventListener('click', () => {
      document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
  
      const tab = btn.dataset.tab;
      document.querySelectorAll('.tab-content').forEach(content => {
        content.style.display = content.dataset.tab === tab ? 'block' : 'none';
      });
  
      if (tab === 'history') {
        loadHistory(); 
      }
    });
  });
  
  function togglePasswordReset(e) {
    e.preventDefault();
    const form = document.getElementById('passwordResetForm');
    form.style.display = form.style.display === 'none' ? 'block' : 'none';
  }
  document.getElementById('profileForm').addEventListener('submit', async e => {
    e.preventDefault();
    const formData = new FormData(e.target);
  
    const res = await fetch('database/profile_update.php', {
      method: 'POST',
      body: formData
    });
  
    const result = await res.json();
    document.getElementById('profileMessage').textContent = result.error || result.success || '';
    document.getElementById('profileMessage').style.color = result.error ? 'red' : 'green';
  });
  
  document.getElementById('passwordResetForm').addEventListener('submit', async e => {
    e.preventDefault();
    const formData = new FormData(e.target);
  
    const res = await fetch('database/profile_update.php', {
      method: 'POST',
      body: formData
    });
  
    const result = await res.json();
    document.getElementById('profileMessage').textContent = result.error || result.success || '';
    document.getElementById('profileMessage').style.color = result.error ? 'red' : 'green';
  
    if (result.success) {
      e.target.reset();
      document.getElementById('passwordResetForm').style.display = 'none';
    }
  });
  
  function loadAllAppointments() {
    fetch('database/get_all_appointments.php')
      .then(res => res.json())
      .then(data => {
        const table = document.getElementById('allAppointmentsTable');
        if (!data.length) return table.innerHTML = 'No appointments found.';
        table.innerHTML = `
          <table>
            <thead>
              <tr><th>User</th><th>Car</th><th>Service</th><th>Date</th><th>Time</th><th>Action</th></tr>
            </thead>
            <tbody>
              ${data.map(app => `
                <tr>
                  <td>${app.user}</td>
                  <td>${app.car_model}</td>
                  <td>${app.service}</td>
                  <td>${app.date}</td>
                  <td>${app.time}</td>
                  <td><button onclick="deleteAppointment(${app.id})">Delete</button></td>
                </tr>
              `).join('')}
            </tbody>
          </table>
        `;
      });
  }
  