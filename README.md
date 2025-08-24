# PHPMark Framework

A **minimal, server-side rendered blog framework** built with PHP, Markdown, and YAML. Zero JavaScript required, lightning fast, and developer-friendly.

## 🔥 Features

### ✅ **Zero JavaScript Required**
- Works 100% without JavaScript enabled
- Server-side rendered HTML
- Progressive enhancement ready
- Perfect for accessibility

### ⚡ **Performance Optimized**
- **PHP 8.3 + nginx + OPcache** - Maximum speed
- **Gzip compression** enabled
- **Aggressive caching** headers
- **~50ms response times**

### 🎨 **Beautiful by Default**
- **VS Code dark theme** aesthetic
- **Mobile responsive** design
- **Clean typography** and spacing
- **Accessible** markup

### 📝 **Content Management**
- **Markdown-based** posts and notes
- **YAML frontmatter** for metadata  
- **File-based** - no database required
- **Version control friendly**

### 🚀 **Developer Experience**
- **Hot reload** in development
- **Docker setup** included
- **One-command deployment**
- **Extensible architecture**

## 🏃 Quick Start

1. **Clone the framework:**
   ```bash
   git clone https://github.com/yourusername/phpmark-framework
   cd phpmark-framework
   ```

2. **Customize your site:**
   ```bash
   # Edit site configuration
   nano includes/config.php
   ```

3. **Start development:**
   ```bash
   ./dev.sh
   # Visit http://localhost:3000
   ```

4. **Deploy to production:**
   ```bash
   docker-compose up -d
   ```

That's it! Your blog is live. 🎉

## 📁 Project Structure

```
phpmark-framework/
├── includes/
│   ├── config.php          # Site configuration
│   └── functions.php       # Core framework functions
├── pages/
│   ├── home.php           # Homepage
│   ├── blog.php           # Blog index
│   ├── blog-post.php      # Individual blog posts
│   ├── notes.php          # Notes index
│   ├── note.php           # Individual notes
│   ├── about.php          # About page
│   └── portfolio.php      # Portfolio page
├── templates/
│   └── layout.php         # Main HTML template
├── data/
│   ├── posts/             # Blog posts (.md files)
│   ├── notes/             # Technical notes (.md files)
│   └── pages/             # Static content (.md, .yaml)
├── public/                # Static assets
├── docker/                # Docker configurations
└── index.php             # Main router
```

## ✏️ Writing Content

### Blog Posts

Create `.md` files in `data/posts/`:

```markdown
---
title: "My First Post"
publishDate: "2024-01-15"
excerpt: "A brief description of the post"
tags: ["php", "blog", "framework"]
readingTime: "5"
---

# My First Post

Write your content here in **Markdown**!

## Features

- Easy to write
- Beautiful output
- Fast rendering

```php
echo "Code blocks work too!";
```
```

### Notes

Create `.md` files in `data/notes/`:

```markdown
---
title: "Quick Note"
date: "2024-01-15"
excerpt: "A helpful note about something"
---

# Quick Note

Perfect for documentation, tutorials, or quick references.
```

### Static Pages

Edit `data/pages/about.md` and `data/pages/portfolio.yaml` to customize your about and portfolio pages.

## 🛠️ Configuration

Edit `includes/config.php` to customize:

```php
// Site settings
define('SITE_NAME', 'Your Site Name');
define('SITE_TAGLINE', 'your_site_tagline');
define('SITE_DESCRIPTION', 'Your site description');
define('SITE_URL', 'https://yoursite.com');

// Author info
define('SITE_AUTHOR', 'Your Name');
define('SITE_EMAIL', 'your@email.com');
define('SITE_LINKEDIN', 'linkedin.com/in/yourprofile');
define('SITE_GITHUB', 'github.com/yourusername');

// Theme colors (VS Code Dark by default)
define('COLOR_PRIMARY', '#58a6ff');
define('COLOR_SECONDARY', '#7c3aed');

// Enable/disable sections
define('ENABLE_BLOG', true);
define('ENABLE_NOTES', true);
define('ENABLE_PORTFOLIO', true);
define('ENABLE_ABOUT', true);
```

## 🐳 Docker Setup

### Development (with hot reload)

```bash
# Quick start
./dev.sh

# Or manual
docker-compose -f docker-compose.dev.yml up --build -d
```

**Development features:**
- Hot reload enabled
- No caching for instant updates  
- Error display enabled
- OPcache with 2s revalidation

### Production

```bash
docker-compose up -d
```

**Production features:**
- Optimized OPcache settings
- Gzip compression enabled
- Aggressive HTTP caching
- Error logging (no display)

## 🎨 Customization

### Styling

Edit the CSS in `templates/layout.php`. The framework uses inline styles for simplicity and performance.

### Adding Pages

1. Create a new PHP file in `pages/`
2. Add the route in `index.php`
3. Add navigation link in `templates/layout.php`

### Extending Functionality

The `DataLoader` class in `includes/functions.php` handles content loading. Extend it to add new content types or data sources.

## 🚀 Performance

PHPMark Framework is optimized for speed:

- **HTML Generation**: ~5-10ms
- **Total Response**: ~50ms  
- **Memory Usage**: ~20MB container
- **Zero JS**: Instant page display
- **Gzip**: ~70% size reduction

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Test thoroughly
5. Submit a pull request

## 📄 License

MIT License - feel free to use PHPMark Framework for any project!

## 🙏 Credits

Built with ❤️ by developers who believe in simple, fast, and accessible web technologies.

---

**PHPMark Framework** - *Simple. Fast. Elegant.*