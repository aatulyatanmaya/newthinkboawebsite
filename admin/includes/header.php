<?php
require_once '../includes/config.php';
require_once '../includes/functions.php';

if (!is_admin()) {
    redirect('/admin/login.php');
}

$current_user = get_current_website_user();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - ThinkBoa</title>
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/css/admin.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="admin-wrapper">
        <nav class="admin-nav">
            <div class="nav-header">
                <h3>ThinkBoa Admin</h3>
            </div>
            <ul class="nav-menu">
                <li><a href="/admin/index.php"><i class="fas fa-dashboard"></i> Dashboard</a></li>
                <li><a href="/admin/posts.php"><i class="fas fa-blog"></i> Blog Posts</a></li>
                <li><a href="/admin/jobs.php"><i class="fas fa-briefcase"></i> Jobs</a></li>
                <li><a href="/admin/applications.php"><i class="fas fa-users"></i> Applications</a></li>
                <li><a href="/admin/services.php"><i class="fas fa-cogs"></i> Services</a></li>
                <li><a href="/admin/users.php"><i class="fas fa-user"></i> Users</a></li>
                <li><a href="/admin/settings.php"><i class="fas fa-gear"></i> Settings</a></li>
            </ul>
        </nav>
        <main class="admin-main">
            <header class="admin-header">
                <div class="user-menu">
                    <span>Welcome, <?php echo htmlspecialchars($current_user['username']); ?></span>
                    <a href="/admin/logout.php" class="btn btn-sm btn-outline-danger">Logout</a>
                </div>
            </header>
            <div class="admin-content">