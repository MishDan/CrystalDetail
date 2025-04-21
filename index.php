<?php
session_start();

if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$loggedIn = isset($_SESSION['user_id']);

$userDisplay = "Login / Register";
$userId = null;

if ($loggedIn) {
    $mysqli = new mysqli("localhost", "root", "", "car_users_db");
    $stmt = $mysqli->prepare("SELECT first_name, last_name, username FROM users WHERE id = ?");
    $stmt->bind_param("i", $_SESSION['user_id']);
    $stmt->execute();
    $stmt->bind_result($first, $last, $username);
    $stmt->fetch();
    $stmt->close();

    $userDisplay = $username ?: "$first $last";
}
?>



<!DOCTYPE html>
<html lang="en">
    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CrystalDetail - Professional Car Detailing</title>
    <link rel="stylesheet" href="style.css">
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
            Register or Login
        </button>
    <?php endif; ?>
</div>
                    </li>
                </ul>
            </nav>
        </div>
    </header>
   
    <div id="loginModal" class="modal">
   
        
    </div>

    <!-- Hero Section -->
    <section id="home" class="hero">
        <div class="hero-content">
            <h1>Professional Car Detailing Services</h1>
            <p>Bring back your vehicle's showroom shine with our premium detailing services. Expert care for every detail of your car.</p>
            <div class="hero-buttons">
                <a href="#contact" class="btn btn-primary">Book Now</a>
                <a href="#services" class="btn btn-secondary">Our Services</a>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="services">
        <div class="container">
            <h2>Our Services</h2>
            <p class="section-description">Discover our comprehensive range of detailing services designed to restore and protect your vehicle.</p>
            <div class="services-grid">
                <div class="service-card">
                    <div class="service-icon">🚿</div>
                    <h3>Exterior Wash</h3>
                    <p>Thorough cleaning of your vehicle's exterior using premium products that protect your paint while removing dirt and grime.</p>
                    <div class="service-details">
                        <span class="price">From $49.99</span>
                        <span class="duration">1 hour</span>
                    </div>
                </div>
                <div class="service-card">
                    <div class="service-icon">🧹</div>
                    <h3>Interior Cleaning</h3>
                    <p>Deep cleaning of all interior surfaces, including vacuuming, steam cleaning, and conditioning of leather and plastic surfaces.</p>
                    <div class="service-details">
                        <span class="price">From $89.99</span>
                        <span class="duration">2 hours</span>
                    </div>
                </div>
                <div class="service-card">
                    <div class="service-icon">✨</div>
                    <h3>Polishing</h3>
                    <p>Machine polishing to remove swirl marks, light scratches, and oxidation, restoring your car's paint to a mirror-like finish.</p>
                    <div class="service-details">
                        <span class="price">From $149.99</span>
                        <span class="duration">3-4 hours</span>
                    </div>
                </div>
                <div class="service-card">
                    <div class="service-icon">🛡️</div>
                    <h3>Ceramic Coating</h3>
                    <p>Advanced protective layer that bonds with your car's paint, providing long-lasting protection against UV rays, chemicals, and scratches.</p>
                    <div class="service-details">
                        <span class="price">From $499.99</span>
                        <span class="duration">1-2 days</span>
                    </div>
                </div>
                <div class="service-card">
                    <div class="service-icon">🔧</div>
                    <h3>Scratch Touch-ups</h3>
                    <p>Professional repair of minor scratches and paint damage to restore your vehicle's appearance and prevent further damage.</p>
                    <div class="service-details">
                        <span class="price">From $99.99</span>
                        <span class="duration">2-3 hours</span>
                    </div>
                </div>
                <div class="service-card">
                    <div class="service-icon">🎨</div>
                    <h3>Paint Protection Film</h3>
                    <p>Invisible urethane film applied to high-impact areas to protect your paint from stone chips, scratches, and environmental damage.</p>
                    <div class="service-details">
                        <span class="price">From $899.99</span>
                        <span class="duration">1-2 days</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Gallery Section -->
    <section id="gallery" class="gallery">
        <div class="container">
            <h2>Gallery</h2>
            <p class="section-description">Browse our portfolio of meticulously detailed vehicles.</p>
            <div class="gallery-grid">
                <div class="gallery-item" data-service="Ceramic Coating">
                    <img src="Images/After_bmwM4.png" alt="Black BMW M4">
                    <div class="gallery-caption">
                        <h3>Ceramic Coating</h3>
                        <p>Yellow BMW M4 with premium ceramic coating</p>
                    </div>
                </div>
                <div class="gallery-item" data-service="Exterior Wash">
                    <img src="Images/After_MB_S.png" alt="Mercedes-Benz S-Class">
                    <div class="gallery-caption">
                        <h3>Exterior Wash</h3>
                        <p>Mercedes-Benz S-Class after detailing</p>
                    </div>
                </div>
                <div class="gallery-item" data-service="Interior Cleaning">
                    <img src="Images/After_Audi_Q8.png" alt="Luxury SUV Interior">
                    <div class="gallery-caption">
                        <h3>Interior Cleaning</h3>
                        <p>Immaculate interior detail</p>
                    </div>
                </div>
                <div class="gallery-item" data-service="Ceramic Coating">
                    <img src="Images/After_bmwM4.png" alt="Black BMW M4">
                    <div class="gallery-caption">
                        <h3>Ceramic Coating</h3>
                        <p>Yellow BMW M4 with premium ceramic coating</p>
                    </div>
                </div>
                <div class="gallery-item" data-service="Exterior Wash">
                    <img src="Images/After_MB_S.png" alt="Mercedes-Benz S-Class">
                    <div class="gallery-caption">
                        <h3>Exterior Wash</h3>
                        <p>Mercedes-Benz S-Class after detailing</p>
                    </div>
                </div>
                <div class="gallery-item" data-service="Interior Cleaning">
                    <img src="Images/After_Audi_Q8.png" alt="Luxury SUV Interior">
                    <div class="gallery-caption">
                        <h3>Interior Cleaning</h3>
                        <p>Immaculate interior detail</p>
                    </div>
                </div>
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
                        <span class="logo-text">PristineCars</span>
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
                        <li><a href="#home">Home</a></li>
                        <li><a href="#services">Our Services</a></li>
                        <li><a href="#gallery">Gallery</a></li>
                        <li><a href="#reviews">Reviews</a></li>
                        <li><a href="#contact">Contact</a></li>
                    </ul>
                </div>
                <div class="footer-hours">
                    <h3>Business Hours</h3>
                    <ul>
                        <li><span>Monday - Friday:</span> 8:00 AM - 6:00 PM</li>
                        <li><span>Saturday:</span> 9:00 AM - 5:00 PM</li>
                        <li><span>Sunday:</span> Closed</li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2024 PristineCars. All rights reserved.</p>
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
          <input type="text" name="first_name" placeholder="First Name">
          <input type="text" name="last_name" placeholder="Last Name">
          <input type="Email" name="username" placeholder="Username">
          <input type="text" name="car_make" placeholder="Car Make">
          <input type="text" name="car_model" placeholder="Car Model">
          <input type="text" name="phone" placeholder="Phone Number">
        </div>

        <!-- Login(united!!!) -->
        <input type="text" name="gmail" placeholder="Username or Gmail" required>
        <input type="password" name="password" placeholder="Password" required>

        <input type="hidden" name="mode" id="authMode" value="login">
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

        <button type="submit">Submit</button>

        <p id="registerLink"><a href="#" onclick="toggleForm(event)">Don't have an account? Register here</a></p>
        <p id="loginLink" style="display: none;"><a href="#" onclick="toggleForm(event)">Already have an account? Login here</a></p>
      </form>
    </div>
  </div>
</div>

<div class="modal" id="userModal" style="display: none;">
  <div class="modal-content">
    <span class="close" onclick="closeUserModal()">&times;</span>
    <h2>Hello, <?php echo htmlspecialchars($userDisplay); ?></h2>
    <button onclick="logoutUser()">Logout</button>
  </div>
</div>
      <script src="script.js"></script>
      <script src="modal.js"></script>

</body>
</html>