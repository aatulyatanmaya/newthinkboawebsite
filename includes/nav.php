<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="/">ThinkBoa</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarMain">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link <?php echo ($currentPage === 'home') ? 'active' : ''; ?>" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($currentPage === 'about') ? 'active' : ''; ?>" href="/about.php">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($currentPage === 'services') ? 'active' : ''; ?>" href="/services.php">Services</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($currentPage === 'blog') ? 'active' : ''; ?>" href="/blog.php">Blog</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($currentPage === 'careers') ? 'active' : ''; ?>" href="/careers.php">Careers</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($currentPage === 'contact') ? 'active' : ''; ?>" href="/contact.php">Contact</a>
                </li>
            </ul>
        </div>
    </div>
</nav>