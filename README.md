# 📚 Book Management for Drupal 11
### *The Easiest Way to Create a Beautiful Book Library*

Welcome! This module is designed to help you build a professional-looking book library on your Drupal site without needing to be a developer. Whether you are creating a reading list, a portfolio, or a document library, this module makes it look premium with just a few clicks.

---

## 🏗️ How It Works (Simple Flow)
Building your library is as easy as **1-2-3**:
1. **Create**: Add a book via the simple admin form.
2. **Copy**: Find the "Shortcode" (like `book_cards id="1"`) in your list.
3. **Paste**: Paste that code into any page, and the beautiful card appears!

---

## 🚀 Beginner's Quick Start Guide

### 1. Installation
*   **Step 1**: Place the `book_management` folder into `/modules/custom/`.
*   **Step 2**: Go to **Extend** (`/admin/modules`) in your menu.
*   **Step 3**: Find **Book Management** and click **Install**. 
    *   *(Note: This creates all the magic behind the scenes automatically!)*

### 2. Adding Your First Book
*   Look for the **Books** icon in your top admin bar (it looks like a library stack).
*   Click **Add New Book**.
*   **Fields to fill:**
    *   **Title**: The name of the book.
    *   **Description**: A short summary.
    *   **Background Color**: Pick a color that matches your book's vibe!
    *   **Cover Image**: Upload a JPG or PNG of the cover.
    *   **PDF File**: Upload the actual book file for visitors to download.

### 3. Displaying Books on Your Site (Where to Paste)
Once you've saved a book, go to `/admin/book-management`. You will see a table.
Look for the **Shortcode** column. It looks like this: `book_cards id="5"`.

**Step-by-Step for First-Timers:**
1.  **Copy** the command text (e.g., `book_cards id="5"`) from the admin list.
2.  Go to your site's main menu and click **Content** (`/admin/content`).
3.  Find the Page or Article where you want the book to appear and click **Edit**.
4.  Locate the **Body** field (this is the big text box where you normally write your content).
5.  **Paste** the command directly into the Body field on its own line.
6.  Scroll to the bottom and click **Save**.
7.  **Success!** When you view the page, that text will now be replaced by the beautiful animated book card.

---

## 💡 What is a "Shortcode"? (For Beginners)
A **Shortcode** is a tiny piece of text that tells Drupal to do something big.
Instead of writing complex code, you just type `book_cards` and the module replaces it with a fully designed, animated book grid.

| Type | What you type | What happens |
| :--- | :--- | :--- |
| **Full Library** | `book_cards` | Shows **EVERY** book you've added. |
| **Single Book** | `book_cards id="1"` | Shows only that specific book. |
| **Group selection** | `book_cards id="1,3,7"` | Shows just those specific books in a row. |

---

## 🎨 Design Excellence
Every book card uses **Glassmorphism**. This means it looks like frosted glass with:
*   Subtle background blurs.
*   A "Glow" effect using the color you picked.
*   Smooth animations when users hover over it.
*   A premium "Download" button that shimmers!

---

## 🛠️ Frequently Asked Questions (FAQ)

**Q: I don't see the "Image" or "PDF" fields when I add a book!**  
*   **A:** Sometimes Drupal needs a "refresh." Go to `/admin/modules`, **Uninstall** Book Management, and then **Install** it again. This will sync the database and make the fields appear!

**Q: Can I change the design?**  
*   **A:** Yes! If you know CSS, you can edit `css/book-cards.css`. We use safe prefixes (`.bm-`) so it won't break your site's main theme.

**Q: The code appears as plain text on my page?**  
*   **A:** Double-check that the module is enabled in the **Extend** menu. Also, make sure you typed the ID correctly (e.g., `#5` in the list means `id="5"`).

---

*Crafted for beginners, polished for professionals.* 🚀
