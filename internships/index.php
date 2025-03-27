<?php
require_once '../includes/config.php';
require_once '../includes/functions.php';

$query = "SELECT * FROM internships WHERE status = 'open' ORDER BY created_at DESC";
$internships = $conn->query($query)->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Internship Programs - TechBao</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/css/style.css" rel="stylesheet">
</head>
<body>
    <?php include '../includes/header.php'; ?>

    <div class="container py-5">
        <div class="row mb-4">
            <div class="col-lg-8">
                <h1>Internship Programs</h1>
                <p class="lead">Start your career journey with TechBao. Our internship programs offer hands-on experience and mentorship opportunities in both online and offline formats.</p>
            </div>
        </div>

        <div class="row mb-5">
            <div class="col-12">
                <div class="row g-4">
                    <?php if (empty($internships)): ?>
                        <div class="col-12">
                            <div class="alert alert-info">No internship programs are currently open. Please check back later.</div>
                        </div>
                    <?php else: ?>
                        <?php foreach ($internships as $internship): ?>
                            <div class="col-md-6">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo htmlspecialchars($internship['title']); ?></h5>
                                        <p class="card-text text-muted">
                                            <small>
                                                <i class="bi bi-clock"></i> <?php echo htmlspecialchars($internship['duration']); ?> |
                                                <i class="bi bi-laptop"></i> <?php echo ucfirst($internship['type']); ?>
                                            </small>
                                        </p>
                                        <p class="card-text"><?php echo nl2br(htmlspecialchars(substr($internship['description'], 0, 200))); ?>...</p>
                                        <a href="view.php?id=<?php echo $internship['id']; ?>" class="btn btn-outline-primary">View Details</a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h3>Online Internships</h3>
                        <p>Work remotely and gain valuable experience in:</p>
                        <ul>
                            <li>Software Development</li>
                            <li>Digital Marketing</li>
                            <li>UI/UX Design</li>
                            <li>Content Creation</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h3>Offline Internships</h3>
                        <p>Join us at our office and experience:</p>
                        <ul>
                            <li>Hands-on Project Work</li>
                            <li>Mentorship Programs</li>
                            <li>Team Collaboration</li>
                            <li>Professional Networking</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-12">
                <div class="card bg-light">
                    <div class="card-body">
                        <h3>Why Choose TechBao Internships?</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <ul class="list-unstyled">
                                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success"></i> Real-world project experience</li>
                                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success"></i> Mentorship from industry experts</li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul class="list-unstyled">
                                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success"></i> Flexible learning opportunities</li>
                                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success"></i> Potential for full-time roles</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include '../includes/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>