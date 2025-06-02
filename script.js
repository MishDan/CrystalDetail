//  localStorage 
const lang = localStorage.getItem('lang') || 'en';

fetch(`lang/${lang}.json`)
  .then(res => {
    if (!res.ok) throw new Error('Failed to load translation file');
    return res.json();
  })
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

    const footerLinks = document.querySelectorAll(".footer-links li a");
    if (footerLinks.length >= 5) {
      footerLinks[0].innerText = t.nav.home;
      footerLinks[1].innerText = t.nav.services;
      footerLinks[2].innerText = t.nav.gallery;
      footerLinks[3].innerText = t.nav.reviews;
      footerLinks[4].innerText = t.nav.contact;
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
    document.querySelector("label[for='message']").innerText = t.contact.message;
    document.querySelector("#contact-form button").innerText = t.contact.sendMessage;

    document.querySelector(".footer-info p").innerText = t.footer.about;
    document.querySelector(".footer-links h3").innerText = t.footer.quickLinks;
    document.querySelector(".footer-hours h3").innerText = t.footer.businessHours;
    document.querySelectorAll(".footer-hours li")[0].querySelector("span").innerText = t.footer.mondayFriday;
    document.querySelectorAll(".footer-hours li")[1].querySelector("span").innerText = t.footer.saturday;
    document.querySelector(".closed").innerText = t.footer.sunday;
    document.querySelector(".footer-bottom p").innerText = t.footer.bottomNote;

 
    document.getElementById("formTitle").innerText = t.modal.login;
    document.querySelector("input[name='gmail']").placeholder = t.modal.usernameOrGmail;
    document.querySelector("input[name='password']").placeholder = t.modal.password;
    document.querySelector("#authForm button").innerText = t.modal.submit;
    document.getElementById("registerLink").innerText = t.modal.noAccount;
    document.getElementById("loginLink").innerText = t.modal.haveAccount;

    const regFields = document.querySelectorAll("#registerFields input");
    if (regFields.length === 6 && t.modal.registerFields) {
      regFields.forEach((input, i) => {
        input.placeholder = t.modal.registerFields[i] || input.placeholder;
      });
    }

    // Create Appointment
    document.querySelector('[data-tab="create"] h2').innerText = t.userPanel.createAppointment;
    document.querySelector('label[for="car_modele"]').innerText = t.userPanel.carModel;
    document.querySelector('label[for="service_id"]').innerText = t.userPanel.selectService;
    document.querySelector('label[for="dateInput"]').innerText = t.userPanel.date;
    document.querySelector('label[for="timeInput"]').innerText = t.userPanel.time;
    document.querySelector('#bookingForm button[type="submit"]').innerText = t.userPanel.confirmBooking;

    // edit Profile
    document.querySelector('[data-tab="edit"] h2').innerText = t.userPanel.editProfile;
    document.getElementById('previewImage').nextElementSibling.innerText = t.userPanel.clickToChange;
    document.querySelector('input[name="first_name"]').placeholder = t.userPanel.firstName;
    document.querySelector('input[name="last_name"]').placeholder = t.userPanel.lastName;
    document.querySelector('input[name="username"]').placeholder = t.userPanel.usernameOrGmail;
    document.querySelector('input[name="phone"]').placeholder = t.userPanel.phone;
    document.querySelector('input[name="car_make"]').placeholder = t.userPanel.carMake;
    document.querySelector('input[name="car_model"]').placeholder = t.userPanel.carModel;
    document.querySelector("#saveChangesBtn").innerText = t.userPanel.saveChanges;
    document.querySelector("#resetPasswordLink").innerText = t.userPanel.resetPassword;
    document.querySelector("input[name='current_password']").placeholder = t.userPanel.currentPassword;
    document.querySelector("input[name='new_password']").placeholder = t.userPanel.newPassword;
    document.querySelector("#passwordResetForm button").innerText = t.userPanel.changePassword;

    // History
    document.querySelector('[data-tab="history"] h2').innerText = t.userPanel.myHistory;
    document.getElementById("historyContent").innerText = t.userPanel.loading;

    //  reviwe
    document.querySelector('[data-tab="write-review"] h2').innerText = t.userPanel.writeReview;
    const reviewLabels = document.querySelectorAll('[data-tab="write-review"] label');
    reviewLabels[0].innerText = t.userPanel.selectService;
    reviewLabels[1].innerText = t.userPanel.rating;
    reviewLabels[2].innerText = t.userPanel.yourReview;
    document.querySelector('[data-tab="write-review"] button').innerText = t.userPanel.submitReview;

// side bar
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
      t.userPanel.gallery,
      t.userPanel.message
    ];
    tabs.forEach((tab, i) => {
      if (tabNames[i]) tab.innerText = tabNames[i];
    });
    document.querySelector(".sidebar h3").innerText = `${t.userPanel.hello}`;
    document.querySelector(".sidebar button").innerText = t.userPanel.logout;

    // select
    fetch(`database/get_services.php?lang=${lang}`)
      .then(res => res.json())
      .then(services => {
        const dropdown = document.getElementById('service_id');
        if (dropdown) {
          dropdown.innerHTML = `<option value="">${t.userPanel.selectService}</option>`;
          services.forEach(service => {
            const option = document.createElement("option");
            option.value = service.id;
            option.textContent = service.title;
            dropdown.appendChild(option);
          });
        }
      });
  })
  .catch(err => console.error('Translation error:', err));

let reviews = [];
let currentPage = 0;
const perPage = 2;
let autoScrollInterval;

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
  clearInterval(autoScrollInterval);
  autoScrollInterval = setInterval(() => {
    if ((currentPage + 1) * perPage < reviews.length) {
      currentPage++;
    } else {
      currentPage = 0;
    }
    renderReviews();
  }, 10000);
}

loadReviews();

const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
const navList = document.querySelector('.nav-list');

mobileMenuBtn.addEventListener('click', () => {
  navList.classList.toggle('active');
  mobileMenuBtn.classList.toggle('active');
});

document.getElementById('authModal').addEventListener('click', (e) => {
  if (e.target === document.getElementById('authModal')) {
    closeModal();
  }
});

window.addEventListener('scroll', () => {
  const header = document.querySelector('.header');
  if (window.scrollY > 50) {
    header.classList.add('scrolled');
  } else {
    header.classList.remove('scrolled');
  }
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

function setLang(lang) {
  localStorage.setItem('lang', lang);
  document.cookie = `lang=${lang}; path=/; max-age=2592000`;
  location.reload();
}