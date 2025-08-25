<?php
// PHPMark Framework Configuration

// Site settings - CUSTOMIZE THESE
define('SITE_NAME', 'Your Site Name');
define('SITE_TAGLINE', 'your_site_tagline');
define('SITE_DESCRIPTION', 'Your site description for SEO');
define('SITE_URL', 'https://yoursite.com');
define('SITE_AUTHOR', 'Your Name');
define('SITE_EMAIL', 'your@email.com');
define('SITE_LINKEDIN', 'linkedin.com/in/yourprofile');
define('SITE_GITHUB', 'github.com/yourusername');

// Theme colors (VS Code Dark theme by default)
define('COLOR_PRIMARY', '#58a6ff');
define('COLOR_SECONDARY', '#7c3aed');
define('COLOR_BACKGROUND', '#0d1117');
define('COLOR_TEXT', '#c9d1d9');
define('COLOR_BORDER', '#21262d');

// Enable/disable sections
define('ENABLE_BLOG', true);
define('ENABLE_NOTES', true);
define('ENABLE_PORTFOLIO', true);
define('ENABLE_ABOUT', true);

// Load core functions
require_once __DIR__ . '/functions.php';
?>