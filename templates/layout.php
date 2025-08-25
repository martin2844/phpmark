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
        /* PHPMark Framework - Generic Layout Styles */
        
        /* Reset and base styles */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        body {
            font-family: system-ui, -apple-system, sans-serif;
            background: #ffffff;
            color: #333333;
            line-height: 1.6;
            font-size: 16px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            overflow-x: hidden; /* Prevent horizontal scroll */
        }
        
        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            flex: 1;
            box-sizing: border-box;
        }
        
        /* Header styles */
        header {
            border-bottom: 2px solid #e5e7eb;
            padding: 30px 0 20px;
            margin-bottom: 40px;
        }
        
        .site-title {
            font-size: 28px;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 8px;
            text-decoration: none;
        }
        
        .site-title:hover {
            color: #4f46e5;
        }
        
        .subtitle {
            color: #6b7280;
            font-size: 18px;
            font-weight: 400;
        }
        
        /* Navigation */
        nav {
            margin: 25px 0 40px;
            min-height: 44px; /* Fixed height to prevent layout shift */
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }
        
        .nav-link {
            color: #4b5563;
            text-decoration: none;
            padding: 10px 16px;
            border-radius: 6px;
            font-weight: 500;
            transition: all 0.2s ease;
            display: inline-block;
            white-space: nowrap; /* Prevent text wrapping */
        }
        
        .nav-link:hover {
            background: #f3f4f6;
            color: #1f2937;
        }
        
        .nav-link.active {
            background: #4f46e5;
            color: #ffffff;
        }
        
        /* Content sections */
        main {
            margin-bottom: 60px;
        }
        
        /* About page specific fixes */
        .about-content {
            padding: 32px;
        }
        
        .grid {
            display: grid;
            gap: 30px;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            width: 100%;
            box-sizing: border-box;
        }
        
        .card {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 24px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            transition: all 0.2s ease;
            box-sizing: border-box;
            min-width: 0; /* Prevent grid blowout */
        }
        
        .card:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            border-color: #d1d5db;
        }
        
        .card h3 {
            color: #1f2937;
            margin-bottom: 12px;
            font-size: 20px;
            font-weight: 600;
        }
        
        .card h4 {
            color: #4f46e5;
            margin-bottom: 10px;
            font-size: 18px;
            font-weight: 500;
        }
        
        .meta {
            color: #6b7280;
            font-size: 14px;
            margin-bottom: 12px;
        }
        
        /* Tags and links */
        .tags {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin: 12px 0;
        }
        
        .tag {
            background: #f3f4f6;
            color: #4b5563;
            padding: 4px 12px;
            border-radius: 16px;
            font-size: 12px;
            font-weight: 500;
        }
        
        .link {
            color: #4f46e5;
            text-decoration: none;
            margin-right: 16px;
            font-size: 14px;
            font-weight: 500;
        }
        
        .link:hover {
            text-decoration: underline;
        }
        
        /* Stats cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 24px;
            margin-bottom: 40px;
        }
        
        .stat-card {
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            padding: 24px;
            text-align: center;
            border-radius: 8px;
        }
        
        .stat-number {
            font-size: 32px;
            color: #1f2937;
            font-weight: 700;
        }
        
        .stat-label {
            color: #6b7280;
            font-size: 14px;
            margin-top: 8px;
            font-weight: 500;
        }
        
        /* Content styles */
        .blog-content {
            max-width: 100%;
            margin: 0;
            line-height: 1.8;
            overflow-wrap: break-word;
            word-wrap: break-word;
        }
        
        .blog-content h1, .blog-content h2, .blog-content h3 {
            color: #1f2937;
            margin: 32px 0 16px 0;
            font-weight: 600;
        }
        
        .blog-content h1 { font-size: 32px; }
        .blog-content h2 { font-size: 24px; }
        .blog-content h3 { font-size: 20px; }
        
        .blog-content p {
            margin-bottom: 20px;
            color: #374151;
        }
        
        .blog-content pre {
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 20px;
            margin: 24px 0;
            overflow-x: auto;
            font-size: 14px;
            line-height: 1.6;
            max-width: 100%;
            box-sizing: border-box;
        }
        
        .blog-content code {
            background: #f3f4f6;
            color: #1f2937;
            padding: 3px 6px;
            border-radius: 4px;
            font-size: 14px;
            font-family: 'Monaco', 'Menlo', monospace;
        }
        
        .blog-content img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin: 24px 0;
            border: 1px solid #e5e7eb;
        }
        
        .blog-content ul, .blog-content ol {
            margin: 16px 0;
            padding-left: 24px;
        }
        
        .blog-content li {
            margin-bottom: 8px;
            color: #374151;
        }
        
        .blog-content ul li::marker {
            color: #6b7280;
        }
        
        .blog-content ol li::marker {
            color: #6b7280;
        }
        
        /* Footer styles */
        footer {
            border-top: 1px solid #e5e7eb;
            background: #f9fafb;
            margin-top: auto;
            padding: 40px 0 30px;
            text-align: center;
        }
        
        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        .footer-links {
            display: flex;
            gap: 32px;
            justify-content: center;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }
        
        .footer-link {
            color: #6b7280;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: color 0.2s ease;
        }
        
        .footer-link:hover {
            color: #4f46e5;
        }
        
        .copyright {
            color: #9ca3af;
            font-size: 14px;
            margin-top: 12px;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .container { padding: 0 16px; }
            .grid { grid-template-columns: 1fr; }
            .site-title { font-size: 24px; }
            .subtitle { font-size: 16px; }
            
            nav {
                margin: 20px 0 30px;
                gap: 6px;
            }
            
            .nav-link { 
                padding: 8px 12px; 
                font-size: 14px;
            }
            
            .footer-links { 
                gap: 20px;
                flex-direction: column;
            }
            
            footer { 
                padding: 30px 0 20px;
            }
            
            .card {
                padding: 20px;
            }
            
            .about-content {
                padding: 24px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <header role="banner">
            <a href="/" class="site-title"><?= SITE_NAME ?></a>
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
    
    <footer role="contentinfo">
        <div class="footer-content">
            <div class="footer-links">
                <?php if (defined('SITE_EMAIL') && SITE_EMAIL): ?>
                <a href="mailto:<?= SITE_EMAIL ?>" class="footer-link">Contact</a>
                <?php endif; ?>
                <?php if (defined('SITE_GITHUB') && SITE_GITHUB): ?>
                <a href="https://<?= SITE_GITHUB ?>" class="footer-link" target="_blank" rel="noopener">GitHub</a>
                <?php endif; ?>
                <?php if (defined('SITE_LINKEDIN') && SITE_LINKEDIN): ?>
                <a href="https://<?= SITE_LINKEDIN ?>" class="footer-link" target="_blank" rel="noopener">LinkedIn</a>
                <?php endif; ?>
            </div>
            <div class="copyright">
                © <?= date('Y') ?> <?= SITE_AUTHOR ?>. Built with PHPMark Framework.
            </div>
        </div>
    </footer>
</body>
</html>