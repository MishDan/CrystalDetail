let reviews = [];
let currentPage = 0;
const perPage = 2;
let autoScrollInterval;
const lang = localStorage.getItem('lang') || 'en';

function renderReviews() {
    const grid = document.getElementById('reviews-grid');
    grid.innerHTML = '';

    const start = currentPage * perPage;
    const end = start + perPage;
    const current = reviews.slice(start, end);

    current.forEach(review => {
        let fullStars = '★'.repeat(Math.floor(review.stars));
        let halfStar = review.stars % 1 !== 0 ? '½' : '';

        grid.innerHTML += `
            <div class="review-card">
                <div class="review-header">
                    <img src="${review.image_url}" alt="${review.name}"
                         onerror="this.onerror=null; this.src='Images_db/icon_default_user.png';">
                    <div class="review-info">
                        <h3>${review.name}</h3>
                        <div class="stars">${fullStars}${halfStar}</div>
                    </div>
                </div>
                <p class="review-text">"${review.text}"</p>
                <span class="review-service">${review.service}</span>
            </div>
        `;
    });
}

function loadReviews() {
    fetch('database/get_reviews.php')
        .then(res => res.json())
        .then(data => {
            reviews = data;
            currentPage = 0;
            renderReviews();
            startAutoScroll();
        });
}

document.getElementById('prevBtn').addEventListener('click', () => {
    if (currentPage > 0) {
        currentPage--;
        renderReviews();
    }
});

document.getElementById('nextBtn').addEventListener('click', () => {
    if ((currentPage + 1) * perPage < reviews.length) {
        currentPage++;
        renderReviews();
    }
});

function startAutoScroll() {
    clearInterval(autoScrollInterval); // если уже было запущено — сбрасываем

    autoScrollInterval = setInterval(() => {
        if ((currentPage + 1) * perPage < reviews.length) {
            currentPage++;
        } else {
            currentPage = 0; // возврат к началу
        }
        renderReviews();
    }, 10000); // 10 секунд
}

loadReviews();

loadReviews();


const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
const navList = document.querySelector('.nav-list');

mobileMenuBtn.addEventListener('click', () => {
    navList.classList.toggle('active');
    mobileMenuBtn.classList.toggle('active');
});

// Modal 
// function openModal() {
//     document.getElementById('loginModal').style.display = 'flex';
// }

// function closeModal() {
//     document.getElementById('loginModal').style.display = 'none';
// }

// Close modal when clicking outside
document.getElementById('authModal').addEventListener('click', (e) => {
    if (e.target === document.getElementById('authModal')) {
        closeModal();
    }
});
// Header scroll effect
window.addEventListener('scroll', () => {
    const header = document.querySelector('.header');
    if (window.scrollY > 50) {
        header.classList.add('scrolled');
    } else {
        header.classList.remove('scrolled');
    }
});

// section services 
document.addEventListener('DOMContentLoaded', () => {
    fetch('database/get_services.php')
        .then(res => res.json())
        .then(services => {
            const grid = document.querySelector('.services-grid');
            grid.innerHTML = ''; 

            services.forEach(service => {
                grid.innerHTML += `
                    <div class="service-card">
                        <div class="service-icon">${service.icon}</div>
                        <h3>${service.title}</h3>
                        <p>${service.description}</p>
                        <div class="service-details">
                            <span class="price">${service.price}</span>
                            <span class="duration">${service.duration}</span>
                        </div>
                    </div>
                `;
            });
        });
});




fetch(`lang/${lang}.json`)
  .then(res => res.json())
  .then(t => {



    
    document.querySelector("title").innerText = t.siteTitle;
    document.querySelector(".logo-text").innerText = t.logoText;
    const navItems = document.querySelectorAll(".nav-list li a");
    if (navItems.length >= 5) {
      navItems[0].innerText = t.nav.home;
      navItems[1].innerText = t.nav.services;
      navItems[2].innerText = t.nav.gallery;
      navItems[3].innerText = t.nav.reviews;
      navItems[4].innerText = t.nav.contact;
    }

    document.querySelector(".hero h1").innerText = t.hero.title;
    document.querySelector(".hero p").innerText = t.hero.desc;
    document.querySelector(".btn-primary").innerText = t.hero.bookNow;
    document.querySelector(".btn-secondary").innerText = t.hero.ourServices;

    document.querySelector("#services h2").innerText = t.services.title;
    document.querySelector("#services .section-description").innerText = t.services.desc;

    document.querySelector("#gallery h2").innerText = t.gallery.title;
    document.querySelector("#gallery .section-description").innerText = t.gallery.desc;

    document.querySelector("#video-demo h2").innerText = t.video.title;
    document.querySelector("#video-demo p").innerText = t.video.desc;


    document.querySelector("#reviews h2").innerText = t.reviews.title;
    document.querySelector("#prevBtn").innerText = t.reviews.prev;
    document.querySelector("#nextBtn").innerText = t.reviews.next;


    document.querySelector("#contact h2").innerText = t.contact.title;
    document.querySelector(".contact-info h3").innerText = t.contact.getInTouch;
    const contactLabels = document.querySelectorAll(".contact-info h4");
    contactLabels[0].innerText = t.contact.phone;
    contactLabels[1].innerText = t.contact.email;
    contactLabels[2].innerText = t.contact.location;


    document.querySelector("label[for='name']").innerText = t.contact.name;
    document.querySelector("label[for='email']").innerText = t.contact.emailAddress;
    document.querySelector("label[for='phone']").innerText = t.contact.phoneNumber;
    document.querySelector("label[for='service']").innerText = t.contact.interestedService;
    document.querySelector("#service option").innerText = t.contact.selectService;

    const serviceSelect = document.querySelector("#service");
    if (serviceSelect && t.contact.servicesList) {
      [...serviceSelect.options].slice(1).forEach(opt => opt.remove());
      t.contact.servicesList.forEach(service => {
        const option = document.createElement("option");
        option.value = service.toLowerCase().replace(/ /g, "-");
        option.innerText = service;
        serviceSelect.appendChild(option);
      });
    }

    document.querySelector("label[for='message']").innerText = t.contact.message;
    document.querySelector("#contact-form button").innerText = t.contact.sendMessage;


    document.querySelector(".footer-info p").innerText = t.footer.about;
    document.querySelector(".footer-links h3").innerText = t.footer.quickLinks;
    document.querySelector(".footer-hours h3").innerText = t.footer.businessHours;
    document.querySelectorAll(".footer-hours li")[0].querySelector("span").innerText = t.footer.mondayFriday;
    document.querySelectorAll(".footer-hours li")[1].querySelector("span").innerText = t.footer.saturday;
    document.querySelectorAll(".footer-hours li")[2].querySelector("span").innerText = t.footer.sunday;
    document.querySelector(".footer-bottom p").innerText = t.foot


      document.querySelector('[data-tab="edit"] h2').innerText = t.userPanel.editProfile;
      document.querySelector("label[for='profileImageInput']").innerText = t.userPanel.profileImage;
      document.getElementById('previewImage').nextElementSibling.innerText = t.userPanel.clickToChange;
      
      document.querySelector("label[for='first_name']").innerText = t.userPanel.firstName || t.modal.registerFields[0];
      document.querySelector("label[for='last_name']").innerText = t.userPanel.lastName || t.modal.registerFields[1];
      document.querySelector("label[for='username']").innerText = t.userPanel.usernameOrGmail || "Username";
      document.querySelector("label[for='phonee']").innerText = t.userPanel.phone;
      document.querySelector("label[for='car_makee']").innerText = t.userPanel.carMake ;
      document.querySelector("label[for='car_modele']").innerText = t.userPanel.carModel;
      document.querySelector("#saveChangesBtn").innerText = t.userPanel.saveChanges;
      document.querySelector("#resetPasswordLink").innerText = t.userPanel.newPassword;
      document.querySelector("#changePasswordBtn").innerText = t.userPanel.changePassword;


      document.querySelector(".appointment-form h2").innerText = t.userPanel.createAppointment || t.modal.registerFields[4];
      
      document.querySelector('[data-tab="write-review"] h2').innerText = t.userPanel.writeReview;
      const labels = document.querySelectorAll('[data-tab="write-review"] label');
      labels[0].innerText = t.userPanel.selectService;
      labels[1].innerText = t.userPanel.rating;
      labels[2].innerText = t.userPanel.yourReview;
      document.querySelector('[data-tab="write-review"] button').innerText = t.userPanel.submitReview;
      document.querySelector('[data-tab="write-review"] h2').innerText = t.userPanel.writeReview;
      document.querySelector('[data-tab="write-review"] h2').innerText = t.userPanel.writeReview;
      
      // document.querySelector(".content .firstreviewlabel").innerText = t.userPanel.hello || t.modal.registerFields[4];
      // document.querySelector(".reviewform").innerText = t.userPanel.createAppointment || t.modal.registerFields[4];
      // document.querySelector(".appointment-form h2").innerText = t.userPanel.createAppointment || t.modal.registerFields[4];

    document.querySelector("label[for='service_id']").innerText = t.userPanel.selectService || t.modal.registerFields[4];
    document.querySelector("label[for='dateInput']").innerText = t.userPanel.date || t.modal.registerFields[4];
    document.querySelector("label[for='timeInput']").innerText = t.userPanel.time || t.modal.registerFields[4];


      document.querySelector("button[type='submit']").innerText = t.userPanel.saveChanges;
      document.querySelector("a[href='#']").innerText = t.userPanel.resetPassword;

      // Reset Password form
      document.querySelector("input[name='current_password']").placeholder = t.userPanel.currentPassword;
      document.querySelector("input[name='new_password']").placeholder = t.userPanel.newPassword;
      document.querySelector("#passwordResetForm button").innerText = t.userPanel.changePassword;




    document.getElementById("formTitle").innerText = t.modal.login;
    document.querySelector("input[name='gmail']").placeholder = t.modal.usernameOrGmail;
    document.querySelector("input[name='password']").placeholder = t.modal.password;
    document.querySelector("#authForm button").innerText = t.modal.submit;
    document.getElementById("registerLink").innerText = t.modal.noAccount;
    document.getElementById("loginLink").innerText = t.modal.haveAccount;

    

// Перевод вкладки "Create Appointment"

    


    // Заполнить select #service_id с учётом выбранного языка
fetch(`database/get_services.php?lang=${lang}`)
  .then(res => res.json())
  .then(services => {
    const dropdown = document.getElementById('service_id');
    if (!dropdown) return;

    dropdown.innerHTML = `<option value="">${t.appointment.selectService}</option>`;
    services.forEach(service => {
      const option = document.createElement("option");
      option.value = service.id;
      option.textContent = service.title;
      dropdown.appendChild(option);
      
    });
  });

    

    const regFields = document.querySelectorAll("#registerFields input");
    if (regFields.length === 6 && t.modal.registerFields) {

        regFields.forEach((input, i) => {
        input.placeholder = t.modal.registerFields[i] || input.placeholder;
      });
    }

    // User Panel
    document.querySelector(".sidebar h3").innerText = `${t.userPanel.hello},`;
    const tabs = document.querySelectorAll(".sidebar ul li.tab-btn");
    const tabNames = [
      t.userPanel.createAppointment,
      t.userPanel.myHistory,
      t.userPanel.editProfile,

    
      t.userPanel.writeReview,
      t.userPanel.allAppointments,
      t.userPanel.allUsers,
      t.userPanel.editServices,
      t.userPanel.reviews,
      t.userPanel.gallery
    ];


    
    tabs.forEach((tab, i) => {
      if (tabNames[i]) tab.innerText = tabNames[i];
    });
    document.querySelector(".sidebar button").innerText = t.userPanel.logout;

  });



  


  document.addEventListener('DOMContentLoaded', () => {
  
    fetch(`database/get_gallery_images.php?lang=${lang}`)
      .then(res => res.json())
      .then(images => {
        const grid = document.getElementById('galleryGrid');
        grid.innerHTML = images.map(img => `
          <div class="gallery-item" data-service="${img.service}">
            <img src="${img.image_url}" alt="${img.alt_text}">
            <div class="gallery-caption">
              <h3>${img.service}</h3>
              <p>${img.caption}</p>
            </div>
          </div>
        `).join('');
      });
  });
  document.addEventListener('DOMContentLoaded', () => {


});
// Language
function setLang(lang) {
    localStorage.setItem('lang', lang);
    location.reload();
  }
  function translateEditProfileTab(t) {
  document.querySelector("#editProfileTitle").innerText = t.userPanel.editProfile;
  document.querySelector("label[for='profileImageInput']").innerText = t.userPanel.profileImage;
  document.getElementById('previewImage').nextElementSibling.innerText = t.userPanel.clickToChange;

  document.querySelector("label[for='first_name']").innerText = t.userPanel.firstName;
  document.querySelector("label[for='last_name']").innerText = t.userPanel.lastName;
  document.querySelector("label[for='username']").innerText = t.userPanel.usernameOrGmail;
  document.querySelector("label[for='phone']").innerText = t.userPanel.phone;
  document.querySelector("label[for='car_make']").innerText = t.userPanel.carMake;
  document.querySelector("label[for='car_model']").innerText = t.userPanel.carModel;

  document.querySelector("#saveChangesBtn").innerText = t.userPanel.saveChanges;
  document.querySelector("#resetPasswordLink").innerText = t.userPanel.resetPassword;

  document.querySelector("input[name='current_password']").placeholder = t.userPanel.currentPassword;
  document.querySelector("input[name='new_password']").placeholder = t.userPanel.newPassword;
  document.querySelector("#passwordResetForm button").innerText = t.userPanel.changePassword;
}
