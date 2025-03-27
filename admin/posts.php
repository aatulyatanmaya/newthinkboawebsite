<?php
require_once 'includes/header.php';

// Handle post deletion
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $stmt = $conn->prepare("DELETE FROM posts WHERE id = ?");
    $stmt->bind_param("i", $_GET['delete']);
    $stmt->execute();
}

// Get all posts
$query = "SELECT p.*, u.username FROM posts p 
          LEFT JOIN users u ON p.author_id = u.id 
          ORDER BY p.created_at DESC";
$posts = $conn->query($query);
?>

<div class="content-header">
    <h1>Blog Posts</h1>
    <a href="post-edit.php" class="btn btn-primary">Add New Post</a>
</div>

<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Status</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($post = $posts->fetch_assoc()): ?>
            <tr>
                <td><?php echo htmlspecialchars($post['title']); ?></td>
                <td><?php echo htmlspecialchars($post['username']); ?></td>
                <td>
                    <span class="badge bg-<?php echo $post['status'] === 'published' ? 'success' : 'warning'; ?>">
                        <?php echo ucfirst($post['status']); ?>
                    </span>
                </td>
                <td><?php echo date('M d, Y', strtotime($post['created_at'])); ?></td>
                <td>
                    <a href="post-edit.php?id=<?php echo $post['id']; ?>" class="btn btn-sm btn-info">Edit</a>
                    <a href="posts.php?delete=<?php echo $post['id']; ?>" 
                       class="btn btn-sm btn-danger"
                       onclick="return confirm('Are you sure you want to delete this post?')">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php require_once 'includes/footer.php'; ?>