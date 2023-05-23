<?php
    // Log out
    session_start(); 
    session_destroy(); // Destroy session
    header("Location: blog.php"); // Redirect to blog.php
?>