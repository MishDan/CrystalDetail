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
    const isRegister = regFields.style.display === 'none';

    regFields.style.display = isRegister ? 'block' : 'none';
    document.getElementById('formTitle').innerText = isRegister ? 'Register' : 'Login';
    document.getElementById('registerLink').style.display = isRegister ? 'none' : 'block';
    document.getElementById('loginLink').style.display = isRegister ? 'block' : 'none';
    document.getElementById('authMode').value = isRegister ? 'register' : 'login';
    document.querySelector('input[name="gmail"]').placeholder = isRegister ? 'Username' : 'Username or Gmail';

    // Отключить/включить поля регистрации !"!!!!!!!!!!!!!!" fix
    regFields.querySelectorAll('input').forEach(input => {
        input.required = isRegister;
        input.disabled = !isRegister;
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
  
      if (tab === 'all_users') loadAllUsers(); 
      if (tab === 'all_appointments') loadAppointments();
      if (tab === 'edit_services') loadServices();
      if (tab === 'reviews') loadReviews();

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
  
  // history
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

  let currentType = 'upcoming';
  
  function loadAppointments(type = 'upcoming', page = 1) {
    currentType = type;
    currentPage = page;
  
    document.getElementById('btn-upcoming').classList.remove('active');
    document.getElementById('btn-past').classList.remove('active');
    document.getElementById(`btn-${type}`).classList.add('active');
  
    fetch(`database/get_all_appointments.php?type=${type}&page=${page}`)
      .then(res => res.json())
      .then(data => {
        const table = document.getElementById('allAppointmentsTable');
        const pagination = document.getElementById('paginationControls');
        if (!data.appointments.length) {
          table.innerHTML = '<p>No appointments found.</p>';
          pagination.innerHTML = '';
          return;
        }
  
        table.innerHTML = `
          <table>
            <thead>
              <tr>
                <th>Name</th><th>Phone</th><th>Car</th><th>Service</th>
                <th>Date</th><th>Time</th><th>Action</th>
              </tr>
            </thead>
            <tbody>
              ${data.appointments.map(app => `
                <tr>
                  <td>${app.first_name} ${app.last_name}</td>
                  <td>${app.phone || '-'}</td>
                  <td>${app.car_model}</td>
                  <td>${app.service}</td>
                  <td><input type="date" value="${app.date}" onchange="updateDate(${app.id}, this.value)"></td>
                  <td><input type="time" value="${app.time}" onchange="updateTime(${app.id}, this.value)"></td>
                  <td><button onclick="deleteAppointment(${app.id})">Delete</button></td>
                </tr>
              `).join('')}
            </tbody>
          </table>
        `;
  
        pagination.innerHTML = '';
        for (let i = 1; i <= data.total_pages; i++) {
          pagination.innerHTML += `<button class="${i === currentPage ? 'active' : ''}" onclick="loadAppointments('${type}', ${i})">${i}</button>`;
        }
      });
  }
  
  // Delete appointment
  function deleteAppointment(id) {
    if (!confirm('Delete this appointment?')) return;
  
    fetch(`database/delete_appointment.php?id=${id}`, { method: 'POST' })
      .then(res => res.json())
      .then(res => {
        if (res.success) loadAppointments(currentType, currentPage);
        else alert(res.error || 'Delete failed.');
      });
  }
  
  // Update date or time
  function updateDate(id, value) {
    fetch('database/update_appointment.php', {
      method: 'POST',
      body: new URLSearchParams({ id, field: 'date', value })
    }).then(res => res.json()).then(console.log);
    loadAppointments()
    
  }
  
  function updateTime(id, value) {
    fetch('database/update_appointment.php', {
      method: 'POST',
      body: new URLSearchParams({ id, field: 'time', value })
    }).then(res => res.json()).then(console.log);
    loadAppointments()
}
  

function loadAllUsers(page = 1) {
    fetch(`database/get_all_users.php?page=${page}`)
      .then(res => res.json())
      .then(data => {
        const container = document.getElementById('allUsersTable');
        const pagination = document.getElementById('userPaginationControls');
  
        if (!data.users.length) {
          container.innerHTML = '<p>No users found.</p>';
          pagination.innerHTML = '';
          return;
        }
  
        container.innerHTML = `
          <table>
            <thead>
              <tr><th>Name</th><th>Username</th><th>Email</th><th>Phone</th><th>Car</th><th>Role</th><th>Actions</th></tr>
            </thead>
            <tbody>
              ${data.users.map(u => `
                <tr data-id="${u.id}">
                <td><input value="${u.first_name} ${u.last_name}" disabled class="edit-name"></td>
                <td><input value="${u.username}" disabled class="edit-username"></td>
                <td><input value="${u.gmail}" disabled class="edit-gmail"></td>
                <td><input value="${u.phone}" disabled class="edit-phone"></td>
                <td><input value="${u.car_make} ${u.car_model}" disabled class="edit-car"></td>
                <td>
                    <select class="edit-role" disabled>
                    ${['user', 'moder', 'admin'].map(r => `<option value="${r}" ${u.role === r ? 'selected' : ''}>${r}</option>`).join('')}
                    </select>
                </td>
                <td>
                    <button onclick="toggleEditRow(this)">Edit</button>
                    ${
                    u.role === 'banned'
                        ? `<button onclick="unbanUser(${u.id})" style="background:#10b981;color:white;">Unban</button>`
                        : `<button onclick="banUser(${u.id})" style="background:red;color:white;">Ban</button>`
                    }
                </td>
                </tr>
              `).join('')}
            </tbody>
          </table>
        `;
  
        pagination.innerHTML = '';
        for (let i = 1; i <= data.total_pages; i++) {
          pagination.innerHTML += `<button class="${i === page ? 'active' : ''}" onclick="loadAllUsers(${i})">${i}</button>`;
        }
      });
  }
  
  function banUser(userId) {
    if (!confirm("Are you sure you want to ban this user?")) return;
    updateUserRole(userId, 'banned');
  }
  
  function updateUserRole(userId, role) {
    fetch('database/update_user_role.php', {
      method: 'POST',
      body: new URLSearchParams({ userId, role })
    })
    .then(res => res.json())
    .then(res => {
      if (res.success) loadAllUsers();
      else alert(res.error || 'Failed to update role');
    });
  }
  function unbanUser(userId) {
    if (!confirm("Unban this user?")) return;
  
    fetch('database/update_user_role.php', {
      method: 'POST',
      body: new URLSearchParams({ userId, role: 'user' })
    })
    .then(res => res.json())
    .then(res => {
      if (res.success) {
        loadAllUsers();
      } else {
        alert(res.error || 'Failed to unban user');
      }
    });
  }
  function toggleEditRow(btn) {
    const row = btn.closest('tr');
    const isEditing = btn.textContent === 'Save';
    const userId = row.dataset.id;
  
    const [nameInput, usernameInput, gmailInput, phoneInput, carInput] = row.querySelectorAll('input');
    const roleSelect = row.querySelector('.edit-role');
  
    if (!isEditing) {
      // Enable fields
      nameInput.disabled = false;
      usernameInput.disabled = false;
      gmailInput.disabled = false;
      phoneInput.disabled = false;
      carInput.disabled = false;
      roleSelect.disabled = false;
      btn.textContent = 'Save';
    } else {
      // Disable fields + save to DB
      nameInput.disabled = true;
      usernameInput.disabled = true;
      gmailInput.disabled = true;
      phoneInput.disabled = true;
      carInput.disabled = true;
      roleSelect.disabled = true;
      btn.textContent = 'Edit';
  
      const [firstName, lastName] = nameInput.value.split(' ');
      const [carMake, carModel] = carInput.value.split(' ', 2);
  
      const formData = new URLSearchParams();
      formData.append('user_id', userId);
      formData.append('first_name', firstName || '');
      formData.append('last_name', lastName || '');
      formData.append('username', usernameInput.value);
      formData.append('gmail', gmailInput.value);
      formData.append('phone', phoneInput.value);
      formData.append('car_make', carMake || '');
      formData.append('car_model', carModel || '');
      formData.append('role', roleSelect.value);
  
      fetch('database/update_user_info.php', {
        method: 'POST',
        body: formData
      })
      .then(res => res.json())
      .then(data => {
        if (!data.success) alert(data.error || 'Failed to update user');
      });
    }
  }



  let currentServicePage = 1;

function loadServices(page = 1) {
  fetch(`database/get_services_paginated.php?page=${page}`)
    .then(res => res.json())
    .then(data => {
      const editor = document.getElementById('serviceEditor');
      const pagination = document.getElementById('servicePaginationControls');
      currentServicePage = page;

      if (!data.services.length) {
        editor.innerHTML = '<p>No services found.</p>';
        pagination.innerHTML = '';
        return;
      }

      const s = data.services[0];
      editor.innerHTML = `
      <form onsubmit="saveService(event, ${s.id})">
        <label>Title</label>
        <input name="title" value="${s.title}" required>
    
        <label>Description</label>
        <textarea name="description" required>${s.description}</textarea>
    
        <label>Icon</label>
        <input name="icon" value="${s.icon || ''}">
    
        <label>Price</label>
        <input name="price" value="${s.price || ''}">
    
        <label>Duration</label>
        <input name="duration" value="${s.duration || ''}">
    
        <button type="submit">Save</button>
        <button type="button" onclick="deleteService(${s.id})" style="background:red; color:white; margin-left: 1rem;">Delete</button>
      </form>
    `;
    

      pagination.innerHTML = '';
      for (let i = 1; i <= data.total_pages; i++) {
        pagination.innerHTML += `<button class="${i === page ? 'active' : ''}" onclick="loadServices(${i})">${i}</button>`;
      }
    });
}

function saveService(e, id) {
  e.preventDefault();
  const form = e.target;
  const formData = new FormData(form);
  formData.append('id', id);

  fetch('database/update_service.php', {
    method: 'POST',
    body: formData
  })
    .then(res => res.json())
    .then(res => {
      if (res.success) alert('Service updated!');
      else alert(res.error || 'Failed to update.');
    });
}

function addNewService() {
  fetch('database/create_service.php', {
    method: 'POST'
  })
    .then(res => res.json())
    .then(res => {
      if (res.success) loadServices(res.page);
      else alert(res.error || 'Failed to add.');
    });
}

function deleteService(id) {
    if (!confirm("Are you sure you want to delete this service?")) return;
  
    fetch('database/delete_service.php', {
      method: 'POST',
      body: new URLSearchParams({ id })
    })
      .then(res => res.json())
      .then(res => {
        if (res.success) {
          alert("Service deleted.");
          loadServices(currentServicePage > 1 ? currentServicePage - 1 : 1);
        } else {
          alert(res.error || "Failed to delete.");
        }
      });
  }
  
  let currentReviewsPage = 1;

function loadReviews(page = 1) {
  fetch(`database/get_reviews_admin.php?page=${page}`)
    .then(res => res.json())
    .then(data => {
      const table = document.getElementById('reviewsTable');
      const pag = document.getElementById('reviewsPagination');
      currentReviewsPage = page;

      if (!data.reviews.length) {
        table.innerHTML = '<p>No reviews found.</p>';
        pag.innerHTML = '';
        return;
      }

      table.innerHTML = `
        <table>
          <thead>
            <tr><th>Name</th><th>Stars</th><th>Service</th><th>Text</th><th>Action</th></tr>
          </thead>
          <tbody>
            ${data.reviews.map(r => `
              <tr>
                <td>${r.name}</td>
                <td>${'★'.repeat(Math.floor(r.stars))}${r.stars % 1 ? '½' : ''}</td>
                <td>${r.service}</td>
                <td>${r.text}</td>
                <td><button onclick="deleteReview(${r.id})" style="color:red;">Delete</button></td>
              </tr>
            `).join('')}
          </tbody>
        </table>
      `;

      pag.innerHTML = '';
      for (let i = 1; i <= data.total_pages; i++) {
        pag.innerHTML += `<button class="${i === page ? 'active' : ''}" onclick="loadReviews(${i})">${i}</button>`;
      }
    });
}

function deleteReview(id) {
    if (!confirm('Are you sure you want to delete this review?')) return;
    fetch('database/delete_review.php', {
      method: 'POST',
      body: new URLSearchParams({ id })
    })
      .then(res => res.json())
      .then(data => {
        if (data.success) {
          loadReviews(currentReviewsPage);
        } else {
          alert(data.error || 'Failed to delete review.');
        }
      });
  }
  