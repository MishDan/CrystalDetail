let reviews = [];
let currentPage = 0;
const perPage = 2;

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
                    <img src="${review.image_url}" alt="${review.name}">
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
            renderReviews();
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



document.addEventListener('DOMContentLoaded', () => {
    const grid = document.getElementById('galleryGrid');
  
    fetch('database/get_gallery_images.php')
      .then(res => res.json())
      .then(images => {
        grid.innerHTML = images.map(img => `
          <div class="gallery-item" data-service="${img.service}">
            <img src="${img.image_path}" alt="${img.description}">
            <div class="gallery-caption">
              <h3>${img.service}</h3>
              <p>${img.description}</p>
            </div>
          </div>
        `).join('');
      });
  });
  