<?php
$currentPage = 'home';
$pageTitle = 'Home';

$stats = getStats();

ob_start();
?>

<div>
    <h2 style="color: <?= COLOR_PRIMARY ?>; margin-bottom: 30px;">Welcome to <?= SITE_NAME ?></h2>
    
    <!-- Stats Grid -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-number"><?= $stats['posts'] ?></div>
            <div class="stat-label">Blog Posts</div>
        </div>
        <div class="stat-card">
            <div class="stat-number"><?= $stats['notes'] ?></div>
            <div class="stat-label">Notes</div>
        </div>
    </div>
    
    <!-- Latest Posts -->
    <?php if (ENABLE_BLOG && !empty($stats['latest_post'])): ?>
    <div class="latest-posts">
        <h3 style="color: <?= COLOR_PRIMARY ?>; margin-bottom: 20px;">Latest Posts</h3>
        <div class="grid">
            <?php
            $posts = array_slice(DataLoader::getPosts(), 0, 3);
            foreach ($posts as $post):
            ?>
                <div class="card">
                    <h4><a href="/blog/<?= $post['slug'] ?>" style="color: <?= COLOR_PRIMARY ?>; text-decoration: none;"><?= $post['frontmatter']['title'] ?></a></h4>
                    <div class="meta"><?= formatDate($post['frontmatter']['publishDate'] ?? $post['frontmatter']['date'] ?? '') ?></div>
                    <p style="margin-top: 10px;"><?= excerpt($post['content'], 150) ?></p>
                    <?php if (!empty($post['frontmatter']['tags'])): ?>
                    <div class="tags">
                        <?php foreach (parseArrayField($post['frontmatter']['tags']) as $tag): ?>
                            <span class="tag"><?= htmlspecialchars($tag) ?></span>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>
    
    <!-- About Preview -->
    <div class="about-preview" style="margin-top: 30px;">
        <div class="card">
            <h3>About This Site</h3>
            <p>This is a PHPMark Framework site - a minimal, server-side rendered blog framework built with PHP, Markdown, and YAML. Fast, simple, and zero JavaScript required.</p>
            <?php if (ENABLE_ABOUT): ?>
            <p style="margin-top: 15px;"><a href="/about" class="link">Learn more →</a></p>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
require __DIR__ . '/../templates/layout.php';
?>