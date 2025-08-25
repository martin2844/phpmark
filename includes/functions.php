<?php
// PHPMark Framework - Core Functions

class MarkdownParser {
    public static function parseFile($file) {
        if (!file_exists($file)) return null;
        
        $content = file_get_contents($file);
        $parts = explode('---', $content, 3);
        
        if (count($parts) < 3) return null;
        
        $frontmatter = [];
        $yaml_lines = explode("\n", trim($parts[1]));
        foreach ($yaml_lines as $line) {
            if (strpos($line, ':') !== false) {
                $kv = explode(':', $line, 2);
                $key = trim($kv[0]);
                $value = trim($kv[1], ' "\'[]');
                
                // Handle arrays (tags)
                if (in_array($key, ['tags', 'skills', 'interests']) && strpos($value, ',') !== false) {
                    $frontmatter[$key] = array_map('trim', explode(',', $value));
                } else {
                    $frontmatter[$key] = $value;
                }
            }
        }
        
        $markdown = trim($parts[2]);
        $html = self::markdownToHtml($markdown);
        
        return [
            'frontmatter' => $frontmatter,
            'content' => $html
        ];
    }
    
    public static function markdownToHtml($markdown) {
        // Headers (skip first H1 to avoid duplication with page title)
        $markdown = preg_replace('/^### (.*$)/im', '<h3>$1</h3>', $markdown);
        $markdown = preg_replace('/^## (.*$)/im', '<h2>$1</h2>', $markdown);
        
        // Remove the first H1 if it matches the title, otherwise convert remaining H1s to H2s
        $lines = explode("\n", $markdown);
        $firstH1Found = false;
        $processedLines = [];
        
        foreach ($lines as $line) {
            if (preg_match('/^# (.*)$/', $line, $matches) && !$firstH1Found) {
                // Skip the first H1 (it's usually the title)
                $firstH1Found = true;
                continue;
            } elseif (preg_match('/^# (.*)$/', $line, $matches)) {
                // Convert subsequent H1s to H2s
                $processedLines[] = '<h2>' . $matches[1] . '</h2>';
            } else {
                $processedLines[] = $line;
            }
        }
        
        $markdown = implode("\n", $processedLines);
        
        // Code blocks with language detection
        $markdown = preg_replace_callback('/```(\w+)?\n?(.*?)```/s', function($matches) {
            $lang = !empty($matches[1]) ? $matches[1] : '';
            $code = trim($matches[2]);
            $langClass = $lang ? "language-{$lang}" : 'language-text';
            return "<pre class=\"{$langClass}\"><code class=\"{$langClass}\">" . htmlspecialchars($code) . "</code></pre>";
        }, $markdown);
        
        // Inline code - handle backticks more carefully
        $markdown = preg_replace_callback('/`([^`]*)`/s', function($matches) {
            // Only convert if the content doesn't span multiple paragraphs
            $content = trim($matches[1]);
            if (empty($content) || strpos($content, "\n\n") !== false) {
                return '`' . $matches[1] . '`'; // Return as-is if problematic
            }
            return '<code>' . htmlspecialchars($content) . '</code>';
        }, $markdown);
        
        // Images
        $markdown = preg_replace('/!\[([^\]]*)\]\(([^)]+)\)/', '<img src="$2" alt="$1">', $markdown);
        
        // Links
        $markdown = preg_replace('/\[([^\]]+)\]\(([^)]+)\)/', '<a href="$2">$1</a>', $markdown);
        
        // Bold
        $markdown = preg_replace('/\*\*(.*?)\*\*/', '<strong>$1</strong>', $markdown);
        
        // Paragraphs
        $lines = explode("\n", $markdown);
        $html = '';
        $in_list = false;
        
        foreach ($lines as $line) {
            $line = trim($line);
            if (empty($line)) {
                if ($in_list) {
                    $html .= "</ul>\n";
                    $in_list = false;
                }
                continue;
            }
            
            if (preg_match('/^- (.+)/', $line, $matches)) {
                if (!$in_list) {
                    $html .= "<ul>\n";
                    $in_list = true;
                }
                $html .= "<li>{$matches[1]}</li>\n";
            } else {
                if ($in_list) {
                    $html .= "</ul>\n";
                    $in_list = false;
                }
                if (!preg_match('/^<(h[1-6]|pre|img)/', $line)) {
                    $html .= "<p>$line</p>\n";
                } else {
                    $html .= "$line\n";
                }
            }
        }
        
        if ($in_list) {
            $html .= "</ul>\n";
        }
        
        return $html;
    }
}

class DataLoader {
    public static function getPosts() {
        $posts = [];
        $dir = __DIR__ . '/../data/posts/';
        
        if (is_dir($dir)) {
            foreach (glob($dir . '*.md') as $file) {
                $post = MarkdownParser::parseFile($file);
                if ($post) {
                    // Add slug from filename
                    $slug = basename($file, '.md');
                    $post['slug'] = $slug;
                    $posts[] = $post;
                }
            }
        }
        
        // Sort by date descending
        usort($posts, function($a, $b) {
            $dateA = $a['frontmatter']['publishDate'] ?? $a['frontmatter']['date'] ?? '1970-01-01';
            $dateB = $b['frontmatter']['publishDate'] ?? $b['frontmatter']['date'] ?? '1970-01-01';
            return strtotime($dateB) - strtotime($dateA);
        });
        
        return $posts;
    }
    
    public static function getPost($slug) {
        $file = __DIR__ . "/../data/posts/{$slug}.md";
        return MarkdownParser::parseFile($file);
    }
    
    public static function getNotes() {
        $notes = [];
        $dir = __DIR__ . '/../data/notes/';
        
        if (is_dir($dir)) {
            foreach (glob($dir . '*.md') as $file) {
                $note = MarkdownParser::parseFile($file);
                if ($note) {
                    // Add slug from filename
                    $slug = basename($file, '.md');
                    $note['slug'] = $slug;
                    $notes[] = $note;
                }
            }
        }
        
        // Sort by date descending if available
        usort($notes, function($a, $b) {
            $dateA = $a['frontmatter']['date'] ?? $a['frontmatter']['publishDate'] ?? '1970-01-01';
            $dateB = $b['frontmatter']['date'] ?? $b['frontmatter']['publishDate'] ?? '1970-01-01';
            return strtotime($dateB) - strtotime($dateA);
        });
        
        return $notes;
    }
    
    public static function getNote($slug) {
        $file = __DIR__ . "/../data/notes/{$slug}.md";
        return MarkdownParser::parseFile($file);
    }
    
    public static function getYamlData($file) {
        $path = __DIR__ . "/../data/pages/{$file}";
        if (!file_exists($path)) return null;
        
        $content = file_get_contents($path);
        $data = [];
        
        $lines = explode("\n", $content);
        $lastKey = null;
        
        foreach ($lines as $line) {
            $line = trim($line);
            if (empty($line) || $line[0] === '#') continue;
            
            if (strpos($line, ':') !== false) {
                $kv = explode(':', $line, 2);
                $key = trim($kv[0]);
                $value = trim($kv[1], ' "\'');
                
                // Handle arrays
                if (empty($value)) {
                    // Multi-line array
                    $data[$key] = [];
                    $lastKey = $key;
                } else {
                    $data[$key] = $value;
                    $lastKey = $key;
                }
            } elseif (strpos($line, '- ') === 0) {
                // Array item
                $value = trim(substr($line, 2), ' "\'');
                if ($lastKey && is_array($data[$lastKey])) {
                    $data[$lastKey][] = $value;
                }
            }
        }
        
        return $data;
    }
    
    public static function getAbout() {
        $file = __DIR__ . '/../data/pages/about.md';
        return MarkdownParser::parseFile($file);
    }
    
    public static function getPortfolio() {
        return self::getYamlData('portfolio.yaml');
    }
}

// Helper functions
function formatDate($date) {
    return date('M j, Y', strtotime($date));
}

function excerpt($text, $length = 200) {
    $text = strip_tags($text);
    if (strlen($text) <= $length) return $text;
    return substr($text, 0, $length) . '...';
}

function getStats() {
    $posts = DataLoader::getPosts();
    $notes = DataLoader::getNotes();
    
    return [
        'posts' => count($posts),
        'notes' => count($notes),
        'latest_post' => !empty($posts) ? $posts[0] : null,
        'latest_note' => !empty($notes) ? $notes[0] : null
    ];
}

function parseArrayField($field) {
    if (empty($field)) return [];
    
    // If it's already an array, return it
    if (is_array($field)) {
        return $field;
    }
    
    // Ensure we have a string
    if (!is_string($field)) {
        return [];
    }
    
    // Handle JSON-style arrays: ["item1", "item2"]
    if (strpos($field, '[') !== false) {
        $cleaned = trim($field, '[]');
        return array_map(function($item) {
            return trim($item, ' "\'');
        }, explode(',', $cleaned));
    }
    
    // Handle comma-separated: item1, item2
    return array_map('trim', explode(',', $field));
}

?>