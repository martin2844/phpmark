<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($pageTitle) ? $pageTitle . ' | ' : '' ?><?= SITE_NAME ?></title>
    <meta name="description" content="<?= $pageDescription ?? SITE_DESCRIPTION ?>">
    <meta name="keywords" content="<?= $pageKeywords ?? '' ?>">
    <meta name="author" content="<?= SITE_AUTHOR ?>">
    <meta name="robots" content="index, follow">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="<?= $ogType ?? 'website' ?>">
    <meta property="og:url" content="<?= $canonicalUrl ?? SITE_URL . $_SERVER['REQUEST_URI'] ?>">
    <meta property="og:title" content="<?= $ogTitle ?? ($pageTitle ? $pageTitle . ' | ' . SITE_NAME : SITE_NAME) ?>">
    <meta property="og:description" content="<?= $pageDescription ?? SITE_DESCRIPTION ?>">
    <meta property="og:image" content="<?= $ogImage ?? SITE_URL . '/public/og-image.jpg' ?>">
    
    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="<?= $canonicalUrl ?? SITE_URL . $_SERVER['REQUEST_URI'] ?>">
    <meta property="twitter:title" content="<?= $ogTitle ?? ($pageTitle ? $pageTitle . ' | ' . SITE_NAME : SITE_NAME) ?>">
    <meta property="twitter:description" content="<?= $pageDescription ?? SITE_DESCRIPTION ?>">
    <meta property="twitter:image" content="<?= $ogImage ?? SITE_URL . '/public/og-image.jpg' ?>">
    
    <!-- Canonical URL -->
    <link rel="canonical" href="<?= $canonicalUrl ?? SITE_URL . $_SERVER['REQUEST_URI'] ?>">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/public/favicon.ico">
    <link rel="shortcut icon" href="/public/favicon.ico">
    
    <!-- Schema.org JSON-LD -->
    <?php if (isset($jsonLd)): ?>
    <script type="application/ld+json"><?= json_encode($jsonLd) ?></script>
    <?php endif; ?>
    
    <style>
        /* PHPMark Framework Default Styles - VS Code Dark Theme */
        
        /* Reset and base styles */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        body {
            font-family: 'Courier New', monospace;
            background: <?= COLOR_BACKGROUND ?>;
            color: <?= COLOR_TEXT ?>;
            line-height: 1.6;
            font-size: 14px;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        
        /* Header styles */
        header {
            border-bottom: 1px solid <?= COLOR_BORDER ?>;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        
        h1 {
            color: <?= COLOR_PRIMARY ?>;
            font-size: 24px;
            margin-bottom: 5px;
        }
        
        .subtitle {
            color: <?= COLOR_SECONDARY ?>;
            font-size: 16px;
        }
        
        /* Navigation */
        nav {
            margin: 20px 0;
        }
        
        .nav-link {
            background: #21262d;
            border: 1px solid #30363d;
            color: <?= COLOR_TEXT ?>;
            padding: 8px 16px;
            margin: 0 5px 5px 0;
            text-decoration: none;
            display: inline-block;
            font-family: inherit;
            font-size: 12px;
            border-radius: 3px;
            transition: background 0.2s;
        }
        
        .nav-link:hover, .nav-link.active {
            background: <?= COLOR_PRIMARY ?>;
            color: <?= COLOR_BACKGROUND ?>;
        }
        
        /* Content sections */
        .section {
            animation: fadeIn 0.3s;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        .grid {
            display: grid;
            gap: 20px;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        }
        
        .card {
            background: #161b22;
            border: 1px solid <?= COLOR_BORDER ?>;
            border-radius: 6px;
            padding: 20px;
            transition: border-color 0.2s;
        }
        
        .card:hover {
            border-color: <?= COLOR_PRIMARY ?>;
        }
        
        .card h3 {
            color: <?= COLOR_PRIMARY ?>;
            margin-bottom: 10px;
            font-size: 16px;
        }
        
        .card h4 {
            color: <?= COLOR_SECONDARY ?>;
            margin-bottom: 8px;
            font-size: 14px;
        }
        
        .meta {
            color: #8b949e;
            font-size: 12px;
            margin-bottom: 10px;
        }
        
        /* Tags and links */
        .tags {
            display: flex;
            flex-wrap: wrap;
            gap: 5px;
            margin: 10px 0;
        }
        
        .tag {
            background: <?= COLOR_BORDER ?>;
            color: <?= COLOR_PRIMARY ?>;
            padding: 2px 8px;
            border-radius: 12px;
            font-size: 11px;
        }
        
        .link {
            color: <?= COLOR_PRIMARY ?>;
            text-decoration: none;
            margin-right: 15px;
            font-size: 12px;
        }
        
        .link:hover {
            text-decoration: underline;
        }
        
        /* Stats cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .stat-card {
            background: #161b22;
            border: 1px solid <?= COLOR_BORDER ?>;
            padding: 20px;
            text-align: center;
            border-radius: 6px;
        }
        
        .stat-number {
            font-size: 24px;
            color: <?= COLOR_PRIMARY ?>;
            font-weight: bold;
        }
        
        .stat-label {
            color: #8b949e;
            font-size: 12px;
            margin-top: 5px;
        }
        
        /* Blog content styles */
        .blog-content {
            max-width: 100%;
            margin: 0;
            line-height: 1.7;
        }
        
        .blog-content h1, .blog-content h2, .blog-content h3 {
            color: <?= COLOR_PRIMARY ?>;
            margin: 20px 0 10px 0;
        }
        
        .blog-content p {
            margin-bottom: 15px;
        }
        
        .blog-content pre {
            background: <?= COLOR_BACKGROUND ?>;
            border: 1px solid #30363d;
            border-radius: 6px;
            padding: 15px;
            margin: 15px 0;
            overflow-x: auto;
            font-size: 13px;
            line-height: 1.45;
        }
        
        .blog-content code {
            background: #262c36;
            color: #e6edf3;
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 13px;
            font-family: 'SF Mono', Consolas, monospace;
        }
        
        .blog-content img {
            max-width: 100%;
            height: auto;
            border-radius: 6px;
            margin: 15px 0;
            border: 1px solid <?= COLOR_BORDER ?>;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .container { padding: 10px; }
            .grid { grid-template-columns: 1fr; }
            h1 { font-size: 20px; }
            .nav-link { padding: 6px 12px; }
        }
    </style>
</head>
<body>
    <div class="container">
        <header role="banner">
            <h1 id="site-title"><?= SITE_NAME ?></h1>
            <div class="subtitle"><?= SITE_TAGLINE ?></div>
        </header>
        
        <nav role="navigation" aria-label="Main navigation">
            <a href="/" class="nav-link <?= ($currentPage ?? '') === 'home' ? 'active' : '' ?>">home</a>
            <?php if (ENABLE_BLOG): ?>
            <a href="/blog" class="nav-link <?= ($currentPage ?? '') === 'blog' ? 'active' : '' ?>">blog</a>
            <?php endif; ?>
            <?php if (ENABLE_PORTFOLIO): ?>
            <a href="/portfolio" class="nav-link <?= ($currentPage ?? '') === 'portfolio' ? 'active' : '' ?>">portfolio</a>
            <?php endif; ?>
            <?php if (ENABLE_NOTES): ?>
            <a href="/notes" class="nav-link <?= ($currentPage ?? '') === 'notes' ? 'active' : '' ?>">notes</a>
            <?php endif; ?>
            <?php if (ENABLE_ABOUT): ?>
            <a href="/about" class="nav-link <?= ($currentPage ?? '') === 'about' ? 'active' : '' ?>">about</a>
            <?php endif; ?>
        </nav>
        
        <main role="main" class="section" id="main-content">
            <?= $content ?>
        </main>
    </div>
</body>
</html>