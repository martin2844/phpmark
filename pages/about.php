<?php
$currentPage = 'about';
$pageTitle = 'About';

$about = DataLoader::getAbout();

if (!$about) {
    $content = '<div class="card"><h2>About page not configured</h2><p>Create data/pages/about.md to customize this page.</p></div>';
} else {
    ob_start();
    ?>
    <div class="card">
        <h2 style="color: <?= COLOR_PRIMARY ?>; margin-bottom: 20px;"><?= $about['frontmatter']['name'] ?? 'About' ?></h2>
        
        <?php if (!empty($about['frontmatter']['title'])): ?>
        <div class="meta" style="margin-bottom: 20px;"><?= $about['frontmatter']['title'] ?></div>
        <?php endif; ?>
        
        <div style="margin-bottom: 15px;" class="blog-content"><?= $about['content'] ?></div>
        
        <?php if (!empty($about['frontmatter']['skills'])): ?>
        <div style="margin-top: 30px;">
            <h3 style="color: <?= COLOR_PRIMARY ?>; margin-bottom: 15px;">Skills</h3>
            <div class="tags">
                <?php foreach (parseArrayField($about['frontmatter']['skills']) as $skill): ?>
                    <span class="tag"><?= htmlspecialchars($skill) ?></span>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
        
        <?php if (!empty($about['frontmatter']['interests'])): ?>
        <div style="margin-top: 20px;">
            <h3 style="color: <?= COLOR_PRIMARY ?>; margin-bottom: 15px;">Interests</h3>
            <div class="tags">
                <?php foreach (parseArrayField($about['frontmatter']['interests']) as $interest): ?>
                    <span class="tag"><?= htmlspecialchars($interest) ?></span>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
        
        <div style="margin-top: 30px;">
            <?php if (!empty($about['frontmatter']['email'])): ?>
            <a href="mailto:<?= $about['frontmatter']['email'] ?>" class="link">✉ Contact me</a>
            <?php endif; ?>
            <?php if (!empty($about['frontmatter']['linkedin'])): ?>
            <a href="https://<?= $about['frontmatter']['linkedin'] ?>" class="link" target="_blank">💼 LinkedIn</a>
            <?php endif; ?>
            <?php if (!empty($about['frontmatter']['github'])): ?>
            <a href="https://<?= $about['frontmatter']['github'] ?>" class="link" target="_blank">💻 GitHub</a>
            <?php endif; ?>
        </div>
    </div>
    <?php
    $content = ob_get_clean();
}

require __DIR__ . '/../templates/layout.php';
?>