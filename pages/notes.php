<?php
$currentPage = 'notes';
$pageTitle = 'Notes';

$notes = DataLoader::getNotes();

ob_start();
?>

<div>
    <h2 style="color: <?= COLOR_PRIMARY ?>; margin-bottom: 30px;">Notes</h2>
    
    <?php if (empty($notes)): ?>
        <div class="card">
            <h3>No notes yet</h3>
            <p>Check back later for new content!</p>
        </div>
    <?php else: ?>
        <div class="grid">
            <?php foreach ($notes as $note): ?>
                <div class="card">
                    <h3><a href="/notes/<?= $note['slug'] ?>" style="color: <?= COLOR_PRIMARY ?>; text-decoration: none;"><?= htmlspecialchars($note['frontmatter']['title']) ?></a></h3>
                    <?php if (!empty($note['frontmatter']['date'])): ?>
                    <div class="meta"><?= formatDate($note['frontmatter']['date']) ?></div>
                    <?php endif; ?>
                    
                    <?php if (!empty($note['frontmatter']['excerpt'])): ?>
                        <p style="margin-top: 10px;"><?= htmlspecialchars($note['frontmatter']['excerpt']) ?></p>
                    <?php else: ?>
                        <p style="margin-top: 10px;"><?= excerpt($note['content'], 150) ?></p>
                    <?php endif; ?>
                    
                    <div style="margin-top: 15px;">
                        <a href="/notes/<?= $note['slug'] ?>" class="link">Read more →</a>
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