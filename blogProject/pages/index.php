<?php
require_once(__DIR__ . '/../config/Database.php');
require_once(__DIR__ . '/../classes/Post.php');

$db      = new Database();
$conn    = $db->getConnection();
$postObj = new Post($conn);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BlogPost — Share Your Story</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700;800&family=Inter:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../public/assets/css/landing.css">
</head>

<body>

    <!-- Navbar -->
    <nav class="landing-nav">
        <div class="nav-brand">BlogPost</div>
        <div class="nav-links">
            <a href="browsePost.php">Browse Posts</a>
            <a href="../auth/login.php" class="btn-nav-login">Sign In</a>
            <a href="../auth/register.php" class="btn-nav-register">Get Started</a>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <p class="hero-tag">Welcome to BlogPost</p>
            <h1 class="hero-title">Where Great Stories<br>Come to Life</h1>
            <p class="hero-subtitle">Discover thoughtful writing on technology, design, programming and more. Join a community of passionate writers and readers.</p>
            <div class="hero-buttons">
                <a href="browse.php" class="btn-hero-primary">Start Reading</a>
                <a href="../auth/register.php" class="btn-hero-secondary">Start Writing</a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section">
        <div class="container">
            <div class="section-header text-center mb-5">
                <p class="section-tag">Why BlogPost?</p>
                <h2 class="section-title">Everything you need to<br>share your ideas</h2>
            </div>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125" />
                            </svg>
                        </div>
                        <h5 class="feature-title">Easy Writing</h5>
                        <p class="feature-text">Write and publish your posts with our simple and intuitive editor. No technical knowledge required.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                            </svg>
                        </div>
                        <h5 class="feature-title">Growing Community</h5>
                        <p class="feature-text">Connect with writers and readers who share your passion. Grow your audience and engage with great content.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z" />
                            </svg>
                        </div>
                        <h5 class="feature-title">Organize with Tags</h5>
                        <p class="feature-text">Categorize your posts with tags and categories. Make your content easy to find and discover.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="cta-overlay"></div>
        <div class="cta-content text-center">
            <h2 class="cta-title">Ready to share your story?</h2>
            <p class="cta-subtitle">Join thousands of writers who are already sharing their ideas on BlogPost.</p>
            <a href="../auth/register.php" class="btn-cta">Create Free Account</a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="landing-footer">
        <p>© 2026 BlogPost. All rights reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>