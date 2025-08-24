<?php
$currentPage = 'portfolio';
$pageTitle = 'Portfolio';

$portfolio = DataLoader::getPortfolio();

ob_start();
?>

<div>
    <h2 style="color: <?= COLOR_PRIMARY ?>; margin-bottom: 30px;">Portfolio</h2>
    
    <?php if (empty($portfolio['projects'])): ?>
        <div class="card">
            <h3>No projects yet</h3>
            <p>Create data/pages/portfolio.yaml to showcase your projects.</p>
        </div>
    <?php else: ?>
        <div class="grid">
            <?php foreach ($portfolio['projects'] as $project): ?>
                <div class="card">
                    <h3><?= htmlspecialchars($project['name']) ?></h3>
                    <p style="margin: 10px 0;"><?= htmlspecialchars($project['description']) ?></p>
                    
                    <?php if (!empty($project['technologies'])): ?>
                    <div class="tags">
                        <?php foreach (parseArrayField($project['technologies']) as $tech): ?>
                            <span class="tag"><?= htmlspecialchars($tech) ?></span>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                    
                    <div class="links" style="margin-top: 15px;">
                        <?php if (!empty($project['websiteLink'])): ?>
                            <a href="<?= htmlspecialchars($project['websiteLink']) ?>" class="link" target="_blank">🌐 Website</a>
                        <?php endif; ?>
                        <?php if (!empty($project['githubLink'])): ?>
                            <a href="<?= htmlspecialchars($project['githubLink']) ?>" class="link" target="_blank">💻 GitHub</a>
                        <?php endif; ?>
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