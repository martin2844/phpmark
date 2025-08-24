<?php
$currentPage = 'blog';
$pageTitle = 'Blog';

$posts = DataLoader::getPosts();

ob_start();
?>

<div>
    <h2 style="color: <?= COLOR_PRIMARY ?>; margin-bottom: 30px;">Blog Posts</h2>
    
    <?php if (empty($posts)): ?>
        <div class="card">
            <h3>No posts yet</h3>
            <p>Check back later for new content!</p>
        </div>
    <?php else: ?>
        <div class="grid">
            <?php foreach ($posts as $post): ?>
                <div class="card">
                    <h3><a href="/blog/<?= $post['slug'] ?>" style="color: <?= COLOR_PRIMARY ?>; text-decoration: none;"><?= htmlspecialchars($post['frontmatter']['title']) ?></a></h3>
                    <div class="meta"><?= formatDate($post['frontmatter']['publishDate'] ?? $post['frontmatter']['date'] ?? '') ?></div>
                    
                    <?php if (!empty($post['frontmatter']['excerpt'])): ?>
                        <p style="margin-top: 10px;"><?= htmlspecialchars($post['frontmatter']['excerpt']) ?></p>
                    <?php else: ?>
                        <p style="margin-top: 10px;"><?= excerpt($post['content'], 200) ?></p>
                    <?php endif; ?>
                    
                    <?php if (!empty($post['frontmatter']['tags'])): ?>
                    <div class="tags">
                        <?php foreach (parseArrayField($post['frontmatter']['tags']) as $tag): ?>
                            <span class="tag"><?= htmlspecialchars($tag) ?></span>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                    
                    <div style="margin-top: 15px;">
                        <a href="/blog/<?= $post['slug'] ?>" class="link">Read more →</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<?php
$content = ob_get_clean();
require __DIR__ . '/../templates/layout.php';
?>