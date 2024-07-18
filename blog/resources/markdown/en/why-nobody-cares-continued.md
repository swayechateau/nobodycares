---
slug: "why-nobody-cares-continued"
title: "Why NobodyCare? Part 2"
featured: true
excerpt: "A brief description of the post."
hero_image: "https://wallpaperaccess.com/full/228452.jpg"
category: "General"
author: "NobodyCares"
---

# Markdown Showcase

This post showcases the various features available in Markdown.

## Headers

# H1 Header
## H2 Header
### H3 Header
#### H4 Header
##### H5 Header
###### H6 Header

## Text Formatting

- **Bold text**
- *Italic text*
- ~~Strikethrough text~~
- `Inline code`

## Lists

### Unordered List

- Item 1
- Item 2
  - Subitem 1
  - Subitem 2

### Ordered List

1. First item
2. Second item
   1. Subitem 1
   2. Subitem 2

## Links

Example Link: [example link](https://www.example.com).

## Images

![Sample Image](https://via.placeholder.com/150)

## Blockquotes

> This is a blockquote.

## Code Blocks

### C#
```csharp
using System;

class Program
{
    static void Main()
    {
        Console.WriteLine("Hello, World!");
    }
}
```

### Go
```go
package main

import "fmt"

func main() {
    fmt.Println("Hello, World!")
}
```

### PHP
```php
<?php
echo "Hello, World!";
?>
```

### JavaScript
```javascript
console.log("Hello, World!");
```

### Kotlin
```kotlin
fun main() {
    println("Hello, World!")
}
```

### Swift
```swift
import SwiftUI

struct ContentView: View {
    var body: some View {
        Text("Hello, World!")
    }
}
```

### Bash
```bash
#!/bin/bash
echo "Hello, World!"
```

### Elixir
```elixir
IO.puts("Hello, World!")
```

## Tables

| Header 1 | Header 2 | Header 3 |
|----------|----------|----------|
| Row 1    | Data     | More Data|
| Row 2    | Data     | More Data|
| Row 3    | Data     | More Data|

## Graphs

### Embedding Graph Images

![Sample Graph](https://via.placeholder.com/350x150)

### Embedding Mermaid

```mermaid
graph TD;
    A[Start] --> B{Is it?};
    B -->|Yes| C[OK];
    B -->|No| D[Not OK];
    C --> E[End];
    D --> E[End];
```
#### sequenceDiagram

```mermaid
sequenceDiagram
    participant Alice
    participant Bob
    Alice->>John: Hello John, how are you?
    loop Healthcheck
        John->>John: Fight against hypochondria
    end
    Note right of John: Rational thoughts!
    John-->>Alice: Great!
    John->>Bob: How about you?
    Bob-->>John: Jolly good!
```
#### gantt

```mermaid
gantt
    title A Gantt Diagram
    dateFormat  YYYY-MM-DD
    section Section
    A task           :a1, 2024-01-01, 30d
    Another task     :after a1  , 20d
    section Another
    Task in sec      :2024-02-01  , 12d
    another task     : 24d
```

## Embeds

### YouTube Video

<iframe width="560" height="315" src="https://www.youtube.com/embed/dQw4w9WgXcQ" frameborder="0" allowfullscreen></iframe>


### GitHub Gist

<script src="https://gist.github.com/username/gist-id.js"></script>
