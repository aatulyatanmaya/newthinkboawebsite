<?php
include 'includes/config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - TechBao</title>
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
                    <li class="nav-item"><a class="nav-link" href="/about.php">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="/careers/">Careers</a></li>
                    <li class="nav-item"><a class="nav-link" href="/internships/">Internships</a></li>
                    <li class="nav-item"><a class="nav-link active" href="/contact.php">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Contact Section -->
    <div class="container py-5">
        <h1 class="mb-4">Contact Us</h1>
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h2>Get in Touch</h2>
                        <form action="#" method="POST" class="mt-4">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="subject" class="form-label">Subject</label>
                                <input type="text" class="form-control" id="subject" name="subject" required>
                            </div>
                            <div class="mb-3">
                                <label for="message" class="form-label">Message</label>
                                <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Send Message</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h2>Contact Information</h2>
                        <div class="mt-4">
                            <h5>Address</h5>
                            <p>123 Tech Street<br>Innovation City, TC 12345<br>United States</p>
                            
                            <h5 class="mt-4">Email</h5>
                            <p>info@techbao.com</p>
                            
                            <h5 class="mt-4">Phone</h5>
                            <p>+1 234 567 890</p>
                            
                            <h5 class="mt-4">Business Hours</h5>
                            <p>Monday - Friday: 9:00 AM - 6:00 PM<br>
                            Saturday - Sunday: Closed</p>
                        </div>
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