<?php
$pageTitle = 'Enterprise Technology Solutions';
$currentPage = 'home';
require_once 'C:/xampp/htdocs/thinkbaowebsite/includes/header.php';
?>

<section class="main-hero">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="mega-title">Transform Your Business With Technology</h1>
                <p class="lead-text">Innovative solutions for the digital age. We help businesses leverage cutting-edge technology to drive growth and efficiency.</p>
                <div class="hero-buttons">
                    <a href="/contact.php" class="btn btn-primary">Get Started</a>
                    <a href="/services.php" class="btn btn-outline">Our Services</a>
                </div>
            </div>
            <div class="col-lg-6">
                <img src="/assets/images/hero/tech-illustration.svg" alt="Technology Innovation" class="hero-image">
            </div>
        </div>
    </div>
</section>

<section class="content-section light">
    <div class="container">
        <h2 class="section-title text-center">Our Solutions</h2>
        <div class="grid-container">
            <div class="feature-card">
                <i class="fas fa-cloud"></i>
                <h3>Cloud Solutions</h3>
                <p>Scalable cloud infrastructure and services to power your digital transformation.</p>
                <a href="/services.php#cloud" class="card-link">Learn More →</a>
            </div>
            <div class="feature-card">
                <i class="fas fa-robot"></i>
                <h3>AI & Automation</h3>
                <p>Intelligent automation solutions to streamline your business processes.</p>
                <a href="/services.php#ai" class="card-link">Learn More →</a>
            </div>
            <div class="feature-card">
                <i class="fas fa-shield-alt"></i>
                <h3>Cybersecurity</h3>
                <p>Comprehensive security solutions to protect your digital assets.</p>
                <a href="/services.php#security" class="card-link">Learn More →</a>
            </div>
        </div>
    </div>
</section>

<section class="content-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <img src="/assets/images/about/team.jpg" alt="Our Team" class="rounded-image">
            </div>
            <div class="col-lg-6">
                <h2 class="section-title">Why Choose ThinkBoa?</h2>
                <div class="feature-list">
                    <div class="feature-item">
                        <i class="fas fa-check-circle"></i>
                        <div>
                            <h4>Expert Team</h4>
                            <p>Industry veterans with deep technical expertise.</p>
                        </div>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-check-circle"></i>
                        <div>
                            <h4>Proven Track Record</h4>
                            <p>Successfully delivered solutions for leading enterprises.</p>
                        </div>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-check-circle"></i>
                        <div>
                            <h4>Innovation Focus</h4>
                            <p>Always at the forefront of technology trends.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="content-section light">
    <div class="container">
        <h2 class="section-title text-center">Latest Insights</h2>
        <div class="grid-container">
            <?php
            $query = "SELECT * FROM posts WHERE status = 'published' ORDER BY created_at DESC LIMIT 3";
            $result = $conn->query($query);
            
            if ($result && $result->num_rows > 0) {
                while ($post = $result->fetch_assoc()):
            ?>
                <div class="blog-card">
                    <img src="<?php echo htmlspecialchars($post['featured_image']); ?>" alt="<?php echo htmlspecialchars($post['title']); ?>">
                    <div class="blog-content">
                        <h3><?php echo htmlspecialchars($post['title']); ?></h3>
                        <p><?php echo substr(strip_tags($post['content']), 0, 120) . '...'; ?></p>
                        <a href="/blog.php?post=<?php echo $post['slug']; ?>" class="card-link">Read More →</a>
                    </div>
                </div>
            <?php 
                endwhile;
            } else {
                echo '<p class="text-center">No blog posts available at the moment.</p>';
            }
            ?>
        </div>
        <div class="text-center mt-4">
            <a href="/blog.php" class="btn btn-outline">View All Posts</a>
        </div>
    </div>
</section>

<section class="cta-section">
    <div class="container text-center">
        <h2>Ready to Transform Your Business?</h2>
        <p>Let's discuss how we can help you achieve your technology goals.</p>
        <a href="/contact.php" class="btn btn-primary btn-lg">Contact Us Today</a>
    </div>
</section>

<?php require_once 'C:/xampp/htdocs/thinkbaowebsite/includes/footer.php'; ?>