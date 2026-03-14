# 📚 Book Management for Drupal 11

A premium, high-end book management system for Drupal. This module allows you to manage a library of books with titles, descriptions, cover images, and PDF downloads, and display them anywhere on your site using a beautiful **Glassmorphism Design System**.

![Premium Display Support](https://img.shields.io/badge/Design-Glassmorphism-blueviolet)
![Drupal Version](https://img.shields.io/badge/Drupal-10%20%2F%2011-blue)

## ✨ Features
- **Custom Entity Support**: Uses the Content Entity API for high-performance data management.
- **Glassmorphism UI**: World-class frontend design with backdrop blurs, glow effects, and hover animations.
- **Instant Embedding**: Use simple shortcode-style tags to inject books into any node body.
- **Color Picker Integration**: Customize the glow and background of every book card individually.
- **Capsule Buttons**: Modern, pill-shaped download buttons with shimmer effects.

---

## 🚀 Installation & Setup

1. **Upload the Module**  
   Place the `book_management` folder into your Drupal site's `modules/custom/` directory.

2. **Enable the Module**  
   Navigate to `/admin/modules` and enable **Book Management**.  
   *Note: No external contributed modules are required.*

3. **Set Permissions**  
   Go to `/admin/people/permissions` and ensure your administrative role has the permission:  
   `administer site configuration` (or specific book management permissions if defined).

---

## 📖 How to Use

### 1. Add Your Books
- Navigate to the **Books** icon in your admin toolbar (or go to `/admin/book-management`).
- Click **Add New Book**.
- Enter the Title, Description, and pick a **Background Color**.
- Upload a **Cover Image** and a **PDF file**.

### 2. Find the Book ID
- Go to the book list at `/admin/book-management`.
- Look at the **ID** column (e.g., `#8`). This is the number you will use to show that specific book.

### 3. Display on a Page
Simply edit any Node (Page, Article, etc.) and type one of the following commands directly into the body text:

| Command | Result |
| :--- | :--- |
| `[book_cards]` | Displays **ALL** books in a premium grid. |
| `[book_cards id="8"]` | Displays only the book with **ID 8**. |
| `[book_cards id="8,10,12"]` | Displays a specific group of books together. |

---

## 🎨 Customization (Developers)

### CSS Styling
The visual system is entirely isolated within `css/book-cards.css`. Every class is prefixed with `.bm-` to ensure **zero conflict** with your site's main theme (like Olivero or Claro).

### Performance
This module uses a **Direct Replacement Engine** via `hook_node_view`. This means:
- It works even if your Text Filters (HTML tags) are misconfigured.
- It is significantly faster than traditional Drupal Shortcode plugins.
- It is safe from recursion and server crashes.

---

## 🛠️ Troubleshooting

**"The shortcode is showing as plain text!"**
1. Ensure the module is enabled.
2. Make sure you are using the correct ID from the admin list.
3. Try typing the word `book_cards` without the brackets `[` or `]`—the module is smart enough to find both!

**"The admin icon is missing!"**
Clear your Drupal caches at `/admin/config/development/performance` or via Drush (`drush cr`).

---

*Crafted with Passion for High-End Drupal Experiences.*
