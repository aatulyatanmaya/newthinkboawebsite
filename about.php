<?php
include 'includes/config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - TechBao</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="/">TechBao</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
                    <li class="nav-item"><a class="nav-link active" href="/about.php">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="/careers/">Careers</a></li>
                    <li class="nav-item"><a class="nav-link" href="/internships/">Internships</a></li>
                    <li class="nav-item"><a class="nav-link" href="/contact.php">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- About Section -->
    <div class="container py-5">
        <h1 class="mb-4">About TechBao</h1>
        <div class="row">
            <div class="col-lg-8">
                <h2>Our Story</h2>
                <p class="lead">TechBao is a leading technology company dedicated to innovation and excellence in software development and IT solutions.</p>
                <p>Founded with a vision to transform the digital landscape, we combine cutting-edge technology with creative problem-solving to deliver exceptional results for our clients.</p>
                
                <h2 class="mt-4">Our Mission</h2>
                <p>To empower businesses through innovative technology solutions while nurturing talent and fostering a culture of continuous learning and growth.</p>
                
                <h2 class="mt-4">Our Values</h2>
                <ul>
                    <li>Innovation and Excellence</li>
                    <li>Customer-Centric Approach</li>
                    <li>Continuous Learning</li>
                    <li>Collaborative Growth</li>
                </ul>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h3>Why Choose Us?</h3>
                        <ul class="list-unstyled">
                            <li>✓ Expert Team</li>
                            <li>✓ Innovative Solutions</li>
                            <li>✓ Quality Delivery</li>
                            <li>✓ Customer Satisfaction</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-light py-4 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5>TechBao</h5>
                    <p>Innovation Meets Excellence</p>
                </div>
                <div class="col-md-4">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="/careers/" class="text-light">Careers</a></li>
                        <li><a href="/internships/" class="text-light">Internships</a></li>
                        <li><a href="/contact.php" class="text-light">Contact Us</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Contact</h5>
                    <p>Email: info@techbao.com<br>
                    Phone: +1 234 567 890</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>