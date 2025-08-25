<?php
$slug = $_GET['slug'] ?? '';
$post = DataLoader::getPost($slug);

if (!$post) {
    header('HTTP/1.0 404 Not Found');
    $currentPage = 'blog';
    $pageTitle = '404 - Post Not Found';
    $content = '<div class="card"><h2>Post not found</h2><p>The requested blog post could not be found.</p><a href="/blog" class="link">← Back to blog</a></div>';
    require __DIR__ . '/../templates/layout.php';
    exit;
}

$currentPage = 'blog';
$pageTitle = $post['frontmatter']['title'];
$pageDescription = $post['frontmatter']['excerpt'] ?? excerpt($post['content'], 160);

// JSON-LD structured data
$jsonLd = [
    '@context' => 'https://schema.org',
    '@type' => 'BlogPosting',
    'headline' => $post['frontmatter']['title'],
    'description' => $pageDescription,
    'author' => [
        '@type' => 'Person',
        'name' => SITE_AUTHOR
    ],
    'datePublished' => $post['frontmatter']['publishDate'] ?? $post['frontmatter']['date'] ?? '',
    'mainEntityOfPage' => SITE_URL . "/blog/{$slug}"
];

ob_start();
?>

<article>
    <div style="margin-bottom: 20px;">
        <a href="/blog" class="nav-link" style="display: inline-block; margin-bottom: 20px;">← Back to blog</a>
    </div>
    
    <header style="margin-bottom: 30px;">
        <h1 style="color: <?= COLOR_PRIMARY ?>; font-size: 28px; margin-bottom: 10px;">
            <?= htmlspecialchars($post['frontmatter']['title']) ?>
        </h1>
        <div class="meta">
            Published on <?= formatDate($post['frontmatter']['publishDate'] ?? $post['frontmatter']['date'] ?? '') ?>
            <?php if (!empty($post['frontmatter']['readingTime'])): ?>
                • <?= $post['frontmatter']['readingTime'] ?> min read
            <?php endif; ?>
        </div>
        
        <?php if (!empty($post['frontmatter']['tags'])): ?>
        <div class="tags" style="margin-top: 15px;">
            <?php foreach (parseArrayField($post['frontmatter']['tags']) as $tag): ?>
                <span class="tag"><?= htmlspecialchars($tag) ?></span>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </header>
    
    <div class="blog-content">
        <?= $post['content'] ?>
    </div>
    
    <footer style="margin-top: 40px; padding-top: 20px; border-top: 1px solid <?= COLOR_BORDER ?>;">
        <a href="/blog" class="link">← Back to all posts</a>
    </footer>
</article>

<?php
$content = ob_get_clean();
require __DIR__ . '/../templates/layout.php';
?>