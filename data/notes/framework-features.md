---
title: "PHPMark Framework Features"
date: "2024-01-15"
excerpt: "Quick reference of all framework features"
---

# PHPMark Framework Features

## Core Features

### Content Management
- **Markdown posts** with YAML frontmatter
- **File-based** - no database required
- **Hot reload** in development mode
- **Automatic sorting** by date

### Performance
- **PHP 8.3** with OPcache
- **nginx** optimized configuration  
- **Gzip compression** in production
- **Static file caching** with long expiry

### Development Experience
- **Hot reload** with Docker volumes
- **Development scripts** for easy setup
- **Production optimized** Docker builds
- **VS Code theme** built-in

## Content Structure

```
data/
├── posts/          # Blog posts (.md)
├── notes/          # Technical notes (.md)
└── pages/          # Static pages (.md, .yaml)
    ├── about.md
    └── portfolio.yaml
```

## Configuration

All settings in `includes/config.php`:

- Site name and description
- Social links  
- Theme colors
- Enable/disable sections

## Docker Setup

### Development
```bash
./dev.sh                    # Quick start
# or
docker-compose -f docker-compose.dev.yml up --build
```

### Production
```bash
docker-compose up -d
```

## Customization

- **Templates**: Edit `templates/layout.php`
- **Styles**: Modify CSS in layout template
- **Pages**: Add custom pages in `pages/`
- **Data**: Extend `DataLoader` class

Perfect for developers who want a simple, fast blog without the complexity of modern frameworks! 🎯