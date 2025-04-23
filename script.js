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
            startAutoScroll(); // Запуск автоскролла после загрузки
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





  const lang = localStorage.getItem('lang') || 'en';

  fetch(`lang/${lang}.json`)
    .then(res => res.json())
    .then(t => {
      document.querySelector(".hero h1").innerText = t.heroTitle;
      document.querySelector(".hero p").innerText = t.heroDesc;
      document.querySelector(".btn-primary").innerText = t.bookNow;
      document.querySelector(".btn-secondary").innerText = t.ourServices;

      document.querySelector("#services h2").innerText = t.servicesTitle;
      document.querySelector("#services .section-description").innerText = t.servicesDesc;

      document.querySelector("#gallery h2").innerText = t.galleryTitle;
      document.querySelector("#gallery .section-description").innerText = t.galleryDesc;

      document.querySelector("#reviews h2").innerText = t.reviewsTitle;

      document.querySelector("#contact h2").innerText = t.contactTitle;

      document.querySelector(".footer-links h3").innerText = t.quickLinks;
      document.querySelector(".footer-hours h3").innerText = t.businessHours;
      document.querySelectorAll(".footer-hours li")[0].querySelector("span").innerText = t.mondayFriday;
      document.querySelectorAll(".footer-hours li")[1].querySelector("span").innerText = t.saturday;
      document.querySelectorAll(".footer-hours li")[2].querySelector("span").innerText = t.sunday;
      document.querySelectorAll(".footer-hours li")[2].querySelector("span + span, p").innerText = t.closed;
    });


  
// Language
function setLang(lang) {
    localStorage.setItem('lang', lang);
    location.reload();
  }

  document.addEventListener('DOMContentLoaded', () => {
    const lang = localStorage.getItem('lang') || 'en';
  
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
    const lang = localStorage.getItem('lang') || 'en';

    fetch(`database/get_services.php?lang=${lang}`)
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
