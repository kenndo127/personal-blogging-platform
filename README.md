# Personal Blog

A simple personal blog built with vanilla PHP and MySQL where an admin can create, edit, and delete blog posts.

## Features

- **Admin Dashboard** - Manage all blog posts
- **Create Posts** - Rich text editor (Quill.js) for content creation
- **Edit Posts** - Update existing blog posts
- **Delete Posts** - Remove posts with confirmation modal
- **Search Functionality** - Search posts by title or content
- **Image Upload** - Upload and display images with posts
- **Responsive Design** - Bootstrap-powered responsive layout

## Tech Stack

- **Backend:** PHP (vanilla)
- **Database:** MySQL
- **Frontend:** HTML, CSS, Bootstrap
- **Editor:** Quill.js

## Project Structure

```
personal-blog/
├── assets/              # Static assets (icons, etc.)
├── includes/            # Reusable PHP components
│   ├── db_connect.php   # Database connection
│   ├── functions.php    # Helper functions
│   ├── header.php       # Common header
│   ├── navbar.php       # Navigation bar
│   └── footer.php       # Common footer
├── js/                  # JavaScript files
    ├── index.js         # Main JS file
    └── quillSetup.js    # Quill editor configuration
├── styles/              # CSS files
├── uploads/             # User uploaded images
├── index.php            # Homepage
├── posts.php            # Create new post
├── all-posts.php        # View all posts (admin)
├── edit.php             # Edit existing post
├── news.php             # Single post view
├── search.php           # Search page
├── login.php            # Admin login
├── logout.php           # Logout handler
└── admin-verify.php     # Authentication check
```

## How to Run

1. **Clone or download** this repository

2. **Import the database**
   - Open phpMyAdmin (http://localhost/phpmyadmin)
   - Create a new database called `blog_db`
   - Import the `blog_db.sql` file from the project directory

3. **Configure database connection**
   - Edit `includes/db_connect.php`
   - Update your database credentials:
     ```php
     $host = "localhost";
     $username = "your_username";
     $password = "your_password";
     $database = "blog_db";
     ```

5. **Start XAMPP**
   - Open XAMPP Control Panel
   - Start **Apache** server
   - Start **MySQL** server
   - Place the project folder in `C:\xampp\htdocs\`

6. **Access the blog**
   - Frontend: `http://localhost/personal-blog/`
   - Admin: `http://localhost/personal-blog/login.php`

## Key Features Explained

### File Upload Security
- MIME type validation
- File size checking via `getimagesize()`
- Filename sanitization (removes special characters)
- Supports: JPEG, PNG, GIF, WebP

### Search Functionality
- Searches both title and content
- Uses prepared statements to prevent SQL injection
- Validates input to prevent empty searches

### Delete Functionality
- Unique modal for each post (prevents wrong post deletion)
- Deletes both database record and image file
- Proper error handling with user feedback

### Error Handling
- Input validation and sanitization
- Database error messages
- File upload error handling
- User-friendly alert messages

## Security Features

- ✅ Prepared statements (SQL injection prevention)
- ✅ Input sanitization with `htmlspecialchars()`
- ✅ File type validation
- ✅ Authentication check on admin pages
- ✅ XSS protection on user input display

## Future Improvements

- Add categories/tags
- Pagination for blog posts
- Comment system
- User registration (multiple admins)
- Image resizing/optimization
- Draft/Published status
- SEO meta tags

## License

This project is open source and available for personal use.

## Author

**Okechukwu Kenneth Chidiebube**

Built as a learning project for PHP and MySQL fundamentals.
