# Simpe Blog - CodeIgniter 2

Controller: `application/controllers/blog.php`  
Model: `application/models/posts_model.php`  
View: `application/views/blog/*.php`  

Posts table migration: `application/migrations/001_add_posts.php`

Add .htaccess on public/:  
```
<IfModule mod_rewrite.c>

    Options +FollowSymLinks
    RewriteEngine on

    # Send request via index.php
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteRule ^(.*)$ index.php/$1 [L]

</IfModule>
```