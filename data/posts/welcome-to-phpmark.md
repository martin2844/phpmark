---
title: "Welcome to PHPMark Framework"
publishDate: "2024-01-15"
excerpt: "Getting started with your new SSR blog framework"
tags: ["phpmark", "php", "blog", "framework"]
readingTime: "3"
---

# Welcome to PHPMark Framework

Welcome to **PHPMark Framework** - a simple, fast, and elegant server-side rendered blog framework built with PHP, Markdown, and YAML.

## What makes PHPMark special?

### ⚡ **Lightning Fast**
- Server-side rendered with PHP 8.3
- Zero JavaScript required
- nginx + OPcache optimization
- ~50ms response times

### 🎨 **Beautiful by Default**
- VS Code dark theme aesthetic  
- Mobile responsive design
- Clean, minimal interface
- Accessible markup

### 📝 **Content First**
- Write in **Markdown** with YAML frontmatter
- File-based content management
- No database required
- Version control friendly

## Quick Example

Here's how easy it is to create a blog post:

```markdown
---
title: "My First Post"
publishDate: "2024-01-15"
tags: ["blog", "markdown"]
---

# My First Post

This is a **simple** blog post written in Markdown!

- Easy to write
- Easy to manage  
- Easy to deploy
```

## Get Started

1. Edit `includes/config.php` to customize your site
2. Add your content to `data/posts/` and `data/notes/`
3. Run `./dev.sh` for development
4. Deploy with `docker-compose up -d`

That's it! Your blog is ready. 🚀

---

*Built with ❤️ by PHPMark Framework*