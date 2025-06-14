<?php
session_start();

// Генерация CSRF токена
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Подключение к базе данных
$mysqli = new mysqli("localhost", "root", "", "car_users_db");

if ($mysqli->connect_error) {
    die("Database connection failed: " . $mysqli->connect_error);
}

// Проверка авторизации
$loggedIn = isset($_SESSION['user_id']);
$userDisplay = "Login / Register";
$userId = $loggedIn ? $_SESSION['user_id'] : null;
$carModelValue = '';
$firstName = $lastName = $username = $phone = $carMake = $carModel = $role = null;

if ($loggedIn) {
    // Получение данных пользователя
    $stmt = $mysqli->prepare("SELECT first_name, last_name, username, phone, car_make, car_model, role, profile_image FROM users WHERE id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $stmt->bind_result($firstName, $lastName, $username, $phone, $carMake, $carModel, $role, $profileImage);

    if ($stmt->fetch()) {
        $userDisplay = htmlspecialchars("$firstName $lastName");
        $carModelValue = trim("$carMake $carModel");
    } else {
        // Если пользователь не найден — сброс сессии
        session_destroy();
        header("Location: index.php");
        exit;
    }

    $stmt->close();
}
$lang = $_GET['lang'] ?? ($_COOKIE['lang'] ?? 'en');
$lang = in_array($lang, ['en', 'ru', 'lv']) ? $lang : 'en';
// Получение списка услуг
$services = [];
$res = $mysqli->query("SELECT id, icon, price, duration, title_$lang AS title, description_$lang AS description FROM services");

if ($res) {
    while ($row = $res->fetch_assoc()) {
        $services[] = $row;
    }
}

$mysqli->close();
?>



<!DOCTYPE html>
<html lang="en">
    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CrystalDetail - Professional Car Detailing</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="..." crossorigin="anonymous" />

</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="container">
            <div class="logo">
                <span class="logo-text">CrystalDetail</span>
            </div>
            <nav class="nav">
                <button class="mobile-menu-btn" aria-label="Toggle mobile menu">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
                <ul class="nav-list">
                    <li><a href="#home">Home</a></li>
                    <li><a href="#services">Our Services</a></li>
                    <li><a href="#gallery">Gallery</a></li>
                    <li><a href="#reviews">Reviews</a></li>
                    <li><a href="#contact">Contact</a></li>
                    <li>
                        
                    <div class="user-bar">
    <?php if ($loggedIn): ?>
        <button class="open-modal-btn" onclick="openUserModal()">
            <?php echo htmlspecialchars($userDisplay); ?>
        </button>
    <?php else: ?>
        <button class="open-modal-btn" onclick="openModal()">
        <i class="fa-solid fa-right-to-bracket"></i>
        </button>
    <?php endif; ?>
</div>
                    </li>
                </ul>
            </nav>
        </div>
    </header>
   


    <!-- Hero Section -->
    <section id="home" class="hero">
        <div class="hero-content">
            <h1>Professional Car Detailing Services</h1>
            <p>Bring back your vehicle's showroom shine with our premium detailing services. Expert care for every detail of your car.</p>
            <div class="hero-buttons">
            <a href="javascript:void(0)" onclick="openCreateAppointmentTab()" class="btn btn-primary">Book Now</a>
            <a href="#services" class="btn btn-secondary">Our Services</a>
            </div>
        </div>
    </section>
    


<section id="services" class="services">
    <div class="container">
        <h2>Our Services</h2>
        <p class="section-description">
            Discover our comprehensive range of detailing services designed to restore and protect your vehicle.
        </p>

        <div class="services-grid">
            <?php foreach ($services as $service): ?>
                <div class="service-card">
                    <div class="service-icon"><?= htmlspecialchars($service['icon']) ?></div>
                    <h3><?= htmlspecialchars($service['title']) ?></h3>
                    <p><?= htmlspecialchars($service['description']) ?></p>
                    <div class="service-details">
                        <span class="price"><?= htmlspecialchars($service['price']) ?></span>
                        <span class="duration"><?= htmlspecialchars($service['duration']) ?></span>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

    <!-- Gallery Section -->

    <section id="gallery" class="gallery">
        <div class="container">
            <h2>Gallery</h2>
            <p class="section-description">Browse our portfolio of meticulously detailed vehicles.</p>
            <div class="gallery-grid" id="galleryGrid"></div>
        </div>
    </section>
<!-- Video section -->
    <section id="video-demo" class="video-demo">
  <div class="container">
    <h2>How We Wash Cars</h2>
    <p class="section-description">Watch our professional detailing in action.</p>
    <div class="video-wrapper">
      <iframe 
        src="https://www.youtube.com/embed/mnj_EeaNvjI" 
        title="YouTube car wash demo"
        frameborder="0"
        allowfullscreen>
      </iframe>
    </div>
    </div>
    </section>

                
    <!-- Reviews Section -->
    <section id="reviews" class="reviews">
        <div class="container">
            <h2>Customer Reviews</h2>
            <div id="reviews-grid" class="reviews-grid"></div>
            <div style="text-align: center; margin-top: 2rem;">
                <button id="prevBtn">← Prev</button>
                <button id="nextBtn">Next →</button>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="contact">
        <div class="container">
            <h2>Ask us a question</h2>
            <div class="contact-grid">
                <div class="contact-info">
                    <h3>Get In Touch</h3>
                    <div class="info-item">
                        <span class="icon">📞</span>
                        <div>
                            <h4>Phone</h4>
                            <p>+371 2626262525</p>
                            <p class="text-small">Mon-Fri, 8am-6pm</p>
                        </div>
                    </div>
                    <div class="info-item">
                        <span class="icon">📧</span>
                        <div>
                            <h4>Email</h4>
                            <p>info@crystaletail.lv</p>
                        </div>
                    </div>
                    <div class="info-item">
                        <span class="icon">📍</span>
                        <div>
                            <h4>Location</h4>
                            <p>Detailing iela 44</p>
                            <p>Latvia, Liepaja</p>
                        </div>
                    </div>
                </div>
                <form id="contact-form" class="contact-form">
                    <div class="form-group">
                        <label for="name">Your Name*</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="email">Email Address*</label>
                            <input type="email" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="tel" id="phone" name="phone">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="service">Service Interested In</label>
                        <select id="service" name="service">
                            <option value="">Select a service</option>
                            <option value="exterior-wash">Exterior Wash</option>
                            <option value="interior-cleaning">Interior Cleaning</option>
                            <option value="polishing">Polishing</option>
                            <option value="ceramic-coating">Ceramic Coating</option>
                            <option value="scratch-touchups">Scratch Touch-ups</option>
                            <option value="paint-protection">Paint Protection Film</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="message">Your Message*</label>
                        <textarea id="message" name="message" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Send Message</button>
                </form>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-info">
                    <div class="logo">
                        <span class="logo-icon">🚗</span>
                        <span class="logo-text">CrystalDetail</span>
                    </div>
                    <p>Professional car detailing services with a passion for perfection. We bring back the showroom shine to every vehicle we touch.</p>
                    <div class="social-links">
                        <a href="#" aria-label="Facebook">📱</a>
                        <a href="#" aria-label="Instagram">📸</a>
                        <a href="#" aria-label="Twitter">🐦</a>
                    </div>
                </div>
                <div class="footer-links">
                    <h3>Quick Links</h3>
                    <ul>
                        <li><a href="#home">Home</a></li>         <!-- индекс 0 -->
                        <li><a href="#services">Our Services</a></li> <!-- индекс 1 -->
                        <li><a href="#gallery">Gallery</a></li>    <!-- индекс 2 -->
                        <li><a href="#reviews">Reviews</a></li>    <!-- индекс 3 -->
                        <li><a href="#contact">Contact</a></li>    <!-- индекс 4 -->
                    </ul>

                </div>
                <div class="footer-hours">
                    <h3>Business Hours</h3>
                    <ul>
                        <li><span>Monday - Friday:</span> 8:00 AM - 6:00 PM</li>
                        <li><span>Saturday:</span> 9:00 AM - 5:00 PM</li>
                        <li class="closed"><span>Sunday:</span> Closed</li>
                        <div class="language-switcher">
                        <button onclick="setLang('en')">EN</button>
                        <button onclick="setLang('ru')">RU</button>
                        <button onclick="setLang('lv')">LV</button>
                        </div>
                                        </div>

                        </ul>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2024 CrystalDetail. All rights reserved.</p>
            </div>
        </div>
    </footer>

<!-- Modal login Or register -->
<div class="modal" id="authModal">
  <div class="modal-content">
    <div class="modal-image">
      <img src="https://images.pexels.com/photos/1149831/pexels-photo-1149831.jpeg" alt="Car">
    </div>

    <div class="modal-form">
      <span class="close" onclick="closeModal()">&times;</span>

      <form id="authForm">
        <h2 id="formTitle">Login</h2>
        <div id="formError" style="color:red; margin-bottom: 10px;"></div>
        <div id="formSuccess" style="color:green; margin-bottom: 10px;"></div>

        <!-- Register -->
        <div id="registerFields" style="display: none;">
            <input type="text" name="first_name" placeholder="First Name" disabled>
            <input type="text" name="last_name" placeholder="Last Name" disabled>
            <input type="email" name="username" placeholder="Email" disabled>
            <input type="text" name="car_make" placeholder="Car Make" disabled>
            <input type="text" name="car_model" placeholder="Car Model" disabled>
            <input type="text" name="phone" placeholder="Phone Number" disabled>
        </div>

        <!-- Login(united!!!) -->
        <input type="text" name="gmail" placeholder="Username or Gmail" required>
        <input type="password" name="password" placeholder="Password" required>

        <input type="hidden" name="mode" id="authMode" value="login">
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

        <button type="submit">Submit</button>
                <p>
      <a id="registerLink" href="#" onclick="toggleForm(event); return false;">Don't have an account? Register here</a>
   
      <a id="loginLink" style="display: none;" href="#" onclick="toggleForm(event); return false;">Already have an account? Login here</a>
   </p>
      </form>
    </div>
  </div>
</div>

<div class="modal" id="userModal" style="display: none;">
  <div class="modal-content booking-modal">
  <span class="close close-user-modal" onclick="closeUserModal()">&times;</span>

    <div class="appointment-wrapper">
      
      <!-- Sidebar Tabs -->
      <div class="sidebar">
        <h3><span></span><?php echo htmlspecialchars($userDisplay); ?></h3>        <ul>
            <li class="tab-btn active" data-tab="create">Create Appointment</li>
            <li class="tab-btn" data-tab="history">My History</li>
            <li class="tab-btn" data-tab="edit">Edit Profile</li>
            <li class="tab-btn" data-tab="write-review">Create review</li>

            <?php if ($role === 'moder' || $role === 'admin'): ?>
                <li class="tab-btn" data-tab="all_appointments">All Appointments</li>
                

            <?php endif; ?>

            <?php if ($role === 'admin'): ?>
                <li class="tab-btn" data-tab="all_users">All Users</li>
                <li class="tab-btn" data-tab="edit_services">Services</li>
                <li class="tab-btn" data-tab="reviews">Reviews</li>
                <li class="tab-btn" data-tab="gallery_admin">Gallery</li>
                <li class="tab-btn" data-tab="messages"> Messages</li>


                
            <?php endif; ?>

            <li style="margin-top: 20px;">
                <button onclick="logoutUser()">Logout</button>
            </li>
        </ul>
      </div>

      <!-- Tabs Container -->
      <div class="tabs-container">

        <!-- Create Appointment Tab -->
        <div class="appointment-form tab-content" data-tab="create">
            <h2>Create Appointment</h2>
            <form id="bookingForm">
                <label for="car_modele">Car Model</label>
                <input type="text" id="car_modele" name="car_model" value="<?php echo htmlspecialchars(trim("$carMake $carModel")); ?>" required>
                <label for="service_id">Service</label>
                <select name="service_id" id="service_id" required>
                    <option value="">Select Service</option>
                </select>
                <label for="dateInput">Date</label>
                <input type="date" id="dateInput" name="date" required>
                <label for="timeInput">Time</label>
                <select id="timeInput" name="time" required></select>
                <div class="message" id="bookingError"></div>
                <div class="message success" id="bookingSuccess"></div>
                <button type="submit">Confirm Booking</button>
            </form>
        </div>
        <!-- My History Tab -->
        <div class="appointment-history tab-content" data-tab="history" style="display: none;">
          <h2> </h2>
          <div id="historyContent">Loading...</div>
        </div>
        
        
<!-- Edit Profile Tab -->
<div class="appointment-edit tab-content" data-tab="edit" style="display: none;">
  <div class="profile-edit-wrapper">
    <h2 id="editProfileTitle">Edit Profile</h2>

    <form id="profileForm" enctype="multipart/form-data">
      <div class="profile-img-wrapper" onclick="document.getElementById('profileImageInput').click()" style="cursor:pointer">
        <input type="file" id="profileImageInput" name="profile_image" accept="image/*" style="display:none">
        <img id="previewImage" src="Images_db/<?= htmlspecialchars($profileImage ?? 'icon_default_user.png') ?>" alt="Profile image"
             onerror="this.onerror=null; this.src='Images_db/icon_default_user.png';">
        <p style="font-size: 12px; color: #666;">Click to change</p>
      </div>

      <div class="profile-grid">
        <input type="text" name="first_name" placeholder="First Name" value="<?= htmlspecialchars($firstName) ?>" required>
        <input type="text" name="last_name" placeholder="Last Name" value="<?= htmlspecialchars($lastName) ?>" required>
        <input type="text" name="username" placeholder="Username or Gmail" value="<?= htmlspecialchars($username) ?>" required>
        <input type="text" name="phone" placeholder="Phone Number" value="<?= htmlspecialchars($phone) ?>">
        <input type="text" name="car_make" placeholder="Car Make" value="<?= htmlspecialchars($carMake) ?>">
        <input type="text" name="car_model" placeholder="Car Model" value="<?= htmlspecialchars($carModel) ?>">
      </div>

      <button type="submit" id="saveChangesBtn">Save Changes</button>
    </form>

    <div style="text-align: center;">
      <a href="#" onclick="togglePasswordReset(event)" id="resetPasswordLink">New Password</a>
    </div>

    <form id="passwordResetForm">
      <input type="password" name="current_password" placeholder="Current Password" required>
      <input type="password" name="new_password" placeholder="New Password" required>
      <button type="submit" id="changePasswordBtn">Change Password</button>
    </form>

    <div class="message" id="profileMessage"></div>
  </div>
</div>



    <div class="tab-content" data-tab="all_appointments" style="display: none;">
    <h2>All Appointments</h2>

    <div class="filter-buttons">
        <button onclick="loadAppointments('upcoming')" class="active" id="btn-upcoming">Upcoming</button>
        <button onclick="loadAppointments('past')" id="btn-past">Past (last 7 days)</button>
    </div>

    <div id="allAppointmentsTable">Loading...</div>
        <div id="paginationControls" class="pagination"></div>
    </div>
        <!-- All Users Tab -->
        <div class="tab-content" data-tab="all_users" style="display: none;">
            <h2>All users</h2>
            <div id="allUsersTable">Loading...</div>
            <div id="userPaginationControls" class="pagination"></div>
        </div>


    <div class="tab-content" data-tab="edit_services" style="display: none;">
        <h2>Edit Services</h2>

        <div id="serviceEditorWrapper" style="max-height: 60vh; overflow-y: auto; border: 1px solid #e5e7eb; padding: 1rem; border-radius: 0.5rem;">
            <div id="serviceEditor">Loading...</div>
        </div>

        <div id="servicePaginationControls" class="pagination"></div>

        <button onclick="addNewService()" style="margin-top: 1rem; background:#10b981; color:white;">Add New Service</button>
    </div>


    <div class="tab-content" data-tab="reviews" style="display: none;">
    <h2>All Reviews</h2>
    <div id="reviewsTable">Loading...</div>
    <div id="reviewsPagination" class="pagination"></div>
    </div>        


    <div class="tab-content" data-tab="gallery_admin" style="display: none;">
        <h2>Edit Gallery</h2>

        <div id="galleryScrollWrapper" style="max-height: 60vh; overflow-y: auto; padding-right: 1rem; margin-bottom: 1rem;">
            <div id="galleryAdminEditor">Loading...</div>
        </div>

        <div id="galleryPaginationControls" class="pagination"></div>
        <button onclick="addNewGalleryImage()" style="margin-top: 1rem; background:#10b981; color:white;">Add New Image</button>
    </div>


<!-- questions -->
<div class="tab-content" data-tab="messages" style="display: none;">
    <h2>Messages from contact form</h2>
    <div id="messagesList">Loading...</div>
    <div id="messagesPagination" class="pagination"></div>
</div>

<!-- reviews -->
<div class="tab-content" data-tab="write-review" style="display: none;">
  <h2>Write a Review</h2>
  <form id="reviewForm">
    <label class = "firstreviewlabel">Service</label>
    <select name="service" required>
      <option value="">Select Service</option>
      <?php foreach ($services as $s): ?>
        <option value="<?= htmlspecialchars($s['title']) ?>"><?= htmlspecialchars($s['title']) ?></option>
      <?php endforeach; ?>
    </select>

    <label>Rating</label>
    <div class="star-container">
      <?php for ($i = 1; $i <= 5; $i++): ?>
        <span class="star" data-value="<?= $i ?>">★</span>
      <?php endfor; ?>
    </div>
    <input type="hidden" name="stars" id="starsInput" value="0">

    <label>Your Review</label>
    <textarea name="text" required></textarea>

    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">

    <button type="submit">Submit Review</button>
    <div class="message" id="reviewMessage"></div>
  </form>
</div>



  </div>
</div>
<script src="script.js"></script>
<script src="modal.js"></script>

<!-- Затем inline-логика -->
<script>
  const isLoggedIn = <?= json_encode($loggedIn) ?>;

  function openModal() {
    document.getElementById('authModal').style.display = 'flex';
  }

  function openUserModal() {
    document.getElementById('userModal').style.display = 'flex';
  }
</script>

</body>
</html>