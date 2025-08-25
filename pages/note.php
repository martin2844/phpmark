<?php
$slug = $_GET['slug'] ?? '';
$note = DataLoader::getNote($slug);

if (!$note) {
    header('HTTP/1.0 404 Not Found');
    $currentPage = 'notes';
    $pageTitle = '404 - Note Not Found';
    $content = '<div class="card"><h2>Note not found</h2><p>The requested note could not be found.</p><a href="/notes" class="link">← Back to notes</a></div>';
    require __DIR__ . '/../templates/layout.php';
    exit;
}

$currentPage = 'notes';
$pageTitle = $note['frontmatter']['title'];
$pageDescription = $note['frontmatter']['excerpt'] ?? excerpt($note['content'], 160);

ob_start();
?>

<article>
    <div style="margin-bottom: 20px;">
        <a href="/notes" class="nav-link" style="display: inline-block; margin-bottom: 20px;">← Back to notes</a>
    </div>
    
    <header style="margin-bottom: 30px;">
        <h1 style="color: <?= COLOR_PRIMARY ?>; font-size: 28px; margin-bottom: 10px;">
            <?= htmlspecialchars($note['frontmatter']['title']) ?>
        </h1>
        <?php if (!empty($note['frontmatter']['date'])): ?>
        <div class="meta">
            Updated on <?= formatDate($note['frontmatter']['date']) ?>
        </div>
        <?php endif; ?>
    </header>
    
    <div class="blog-content">
        <?= $note['content'] ?>
    </div>
    
    <footer style="margin-top: 40px; padding-top: 20px; border-top: 1px solid <?= COLOR_BORDER ?>;">
        <a href="/notes" class="link">← Back to all notes</a>
    </footer>
</article>

<?php
$content = ob_get_clean();
require __DIR__ . '/../templates/layout.php';
?>