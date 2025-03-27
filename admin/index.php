<?php
require_once 'includes/header.php';

// Get quick stats
$stats = [
    'posts' => $conn->query("SELECT COUNT(*) as count FROM posts")->fetch_assoc()['count'],
    'jobs' => $conn->query("SELECT COUNT(*) as count FROM jobs")->fetch_assoc()['count'],
    'applications' => $conn->query("SELECT COUNT(*) as count FROM job_applications")->fetch_assoc()['count'],
    'contacts' => $conn->query("SELECT COUNT(*) as count FROM contact_submissions WHERE status='pending'")->fetch_assoc()['count']
];
?>

<div class="dashboard-overview">
    <h1>Dashboard Overview</h1>
    
    <div class="stats-grid">
        <div class="stat-card">
            <i class="fas fa-blog"></i>
            <h3>Blog Posts</h3>
            <p class="stat-number"><?php echo $stats['posts']; ?></p>
            <a href="posts.php" class="stat-link">Manage Posts</a>
        </div>
        
        <div class="stat-card">
            <i class="fas fa-briefcase"></i>
            <h3>Active Jobs</h3>
            <p class="stat-number"><?php echo $stats['jobs']; ?></p>
            <a href="jobs.php" class="stat-link">Manage Jobs</a>
        </div>
        
        <div class="stat-card">
            <i class="fas fa-users"></i>
            <h3>Job Applications</h3>
            <p class="stat-number"><?php echo $stats['applications']; ?></p>
            <a href="applications.php" class="stat-link">View Applications</a>
        </div>
        
        <div class="stat-card">
            <i class="fas fa-envelope"></i>
            <h3>Pending Contacts</h3>
            <p class="stat-number"><?php echo $stats['contacts']; ?></p>
            <a href="contacts.php" class="stat-link">View Messages</a>
        </div>
    </div>

    <div class="dashboard-sections">
        <div class="recent-posts">
            <h2>Recent Blog Posts</h2>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Status</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT p.*, u.username FROM posts p 
                                LEFT JOIN users u ON p.author_id = u.id 
                                ORDER BY p.created_at DESC LIMIT 5";
                        $result = $conn->query($query);
                        while ($post = $result->fetch_assoc()):
                        ?>
                        <tr>
                            <td><?php echo htmlspecialchars($post['title']); ?></td>
                            <td><?php echo htmlspecialchars($post['username']); ?></td>
                            <td><span class="badge bg-<?php echo $post['status'] === 'published' ? 'success' : 'warning'; ?>">
                                <?php echo ucfirst($post['status']); ?>
                            </span></td>
                            <td><?php echo date('M d, Y', strtotime($post['created_at'])); ?></td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="recent-applications">
            <h2>Recent Job Applications</h2>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Position</th>
                            <th>Status</th>
                            <th>Applied</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT a.*, j.title as job_title FROM job_applications a 
                                LEFT JOIN jobs j ON a.job_id = j.id 
                                ORDER BY a.created_at DESC LIMIT 5";
                        $result = $conn->query($query);
                        while ($application = $result->fetch_assoc()):
                        ?>
                        <tr>
                            <td><?php echo htmlspecialchars($application['full_name']); ?></td>
                            <td><?php echo htmlspecialchars($application['job_title']); ?></td>
                            <td><span class="badge bg-<?php echo $application['status'] === 'pending' ? 'warning' : 'info'; ?>">
                                <?php echo ucfirst($application['status']); ?>
                            </span></td>
                            <td><?php echo date('M d, Y', strtotime($application['created_at'])); ?></td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>