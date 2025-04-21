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
function openModal() {
    document.getElementById('loginModal').style.display = 'flex';
}

function closeModal() {
    document.getElementById('loginModal').style.display = 'none';
}

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