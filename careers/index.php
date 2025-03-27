<?php
require_once '../includes/config.php';
require_once '../includes/functions.php';

$query = "SELECT * FROM jobs WHERE status = 'open' ORDER BY created_at DESC";
$jobs = $conn->query($query)->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Careers - TechBao</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/css/style.css" rel="stylesheet">
</head>
<body>
    <?php include '../includes/header.php'; ?>

    <div class="container py-5">
        <div class="row mb-4">
            <div class="col-lg-8">
                <h1>Join Our Team</h1>
                <p class="lead">Be part of a dynamic team that's shaping the future of technology. We offer exciting opportunities for talented individuals who are passionate about innovation and excellence.</p>
            </div>
        </div>

        <div class="row mb-5">
            <div class="col-12">
                <h2>Open Positions</h2>
                <?php if (empty($jobs)): ?>
                    <div class="alert alert-info">No open positions at the moment. Please check back later.</div>
                <?php else: ?>
                    <div class="row g-4">
                        <?php foreach ($jobs as $job): ?>
                            <div class="col-md-6">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo htmlspecialchars($job['title']); ?></h5>
                                        <p class="card-text text-muted">
                                            <small>
                                                <i class="bi bi-geo-alt"></i> <?php echo htmlspecialchars($job['location']); ?> |
                                                <i class="bi bi-clock"></i> <?php echo ucfirst($job['type']); ?>
                                            </small>
                                        </p>
                                        <p class="card-text"><?php echo nl2br(htmlspecialchars(substr($job['description'], 0, 200))); ?>...</p>
                                        <a href="view.php?id=<?php echo $job['id']; ?>" class="btn btn-outline-primary">View Details</a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h3>Why Join Us?</h3>
                        <ul class="list-unstyled">
                            <li class="mb-3"><i class="bi bi-check-circle-fill text-success"></i> Competitive compensation and benefits</li>
                            <li class="mb-3"><i class="bi bi-check-circle-fill text-success"></i> Professional growth opportunities</li>
                            <li class="mb-3"><i class="bi bi-check-circle-fill text-success"></i> Work with cutting-edge technologies</li>
                            <li class="mb-3"><i class="bi bi-check-circle-fill text-success"></i> Collaborative and innovative environment</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h3>Looking for Internships?</h3>
                        <p>We offer exciting internship opportunities for students and recent graduates.</p>
                        <a href="/internships/" class="btn btn-primary">View Internship Programs</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include '../includes/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>