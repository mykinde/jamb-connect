# Markdown Syntax Guide

## Headers
```
# H1 Header
## H2 Header
### H3 Header
#### H4 Header
##### H5 Header
###### H6 Header
```

## Text Formatting
- **Bold text** using `**bold**` or `__bold__`
- *Italic text* using `*italic*` or `_italic_`
- ***Bold and italic*** using `***text***`
- ~~Strikethrough~~ using `~~text~~`
- `Inline code` using backticks

## Lists

### Unordered Lists
```
- Item 1
- Item 2
  - Nested item
  - Another nested item
- Item 3
```

### Ordered Lists
```
1. First item
2. Second item
   1. Nested item
   2. Another nested item
3. Third item
```

## Links and Images
- [Link text](https://example.com)
- [Link with title](https://example.com "Title")
- ![Alt text](image-url.jpg)
- ![Image with title](image-url.jpg "Title")

## Code Blocks

### Inline Code
Use single backticks: `code here`

### Code Blocks
```
```
code block
```
```

### Syntax Highlighted Code Blocks
```python
def hello_world():
    print("Hello, World!")
```

```javascript
function helloWorld() {
    console.log("Hello, World!");
}
```

## Blockquotes
> This is a blockquote
> 
> It can span multiple lines
>> And can be nested

## Tables
| Header 1 | Header 2 | Header 3 |
|----------|----------|----------|
| Row 1    | Cell 2   | Cell 3   |
| Row 2    | Cell 5   | Cell 6   |

### Table Alignment
| Left | Center | Right |
|:-----|:------:|------:|
| L1   |   C1   |    R1 |
| L2   |   C2   |    R2 |

## Horizontal Rules
Create horizontal lines with:
```
---
***
___
```

## Line Breaks
- End a line with two spaces for a line break  
- Or use an empty line for a paragraph break

## Escaping Characters
Use backslash to escape special characters:
\*literal asterisk\*

## Advanced Features (GitHub Flavored Markdown)

### Task Lists
- [x] Completed task
- [ ] Incomplete task
- [ ] Another task

### Footnotes
Here's a sentence with a footnote[^1].

[^1]: This is the footnote content.

### Mentions and References
- @username (on platforms that support it)
- #123 (issue/PR references on GitHub)

## HTML Support
Most Markdown parsers support basic HTML:
<details>
<summary>Click to expand</summary>
Hidden content here
</details>

## Tips
1. Preview your Markdown as you write
2. Different platforms may have slight variations
3. Keep it simple - Markdown's strength is readability
4. Use consistent spacing and formatting
5. Consider your audience and platform capabilities