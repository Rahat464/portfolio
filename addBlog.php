<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rahat's Blog</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/mobile.css">
    <script src="js/script.js"></script>
</head>
<body>
    <!-- navbar -->
    <header>
        <nav>
            <ul>
                <li><a href="#about">About</a></li>
                <li><a href="experience.php#education">Education</a></li>
                <li><a href="experience.php#experience">Experience</a></li>
                <li id="nav_name"><a href="index.php">
                    <strong>&lt;<span class="name">Rahat Ali</span>&gt;</strong>
                </a></li>
                <li><a href="projects.php#projects">Projects</a></li>
                <li><a href="blog.php">Blog</a></li>
                <li><a href="projects.php#contact">Contact</a></li>
            </ul>
        </nav>
        <!-- Mobile nav -->
        <div id="mobile_nav">
            <ul>
                <li><a href="#about">About</a></li>
                <li><a href="experience.php#education">Education</a></li>
                <li><a href="experience.php#experience">Experience</a></li>
                <li><a href="projects.php#projects">Projects</a></li>
                <li><a href="blog.php">Blog</a></li>
                <li><a href="projects.php#contact">Contact</a></li>
            </ul>
        </div>        
    </header>
    <!-- Blog post submission -->
    <section class="container" id="blog">
        <section id="addPost">
            <h3>Write a blog</h3>
            <form method="POST">
                <input type="text" name="title" id="title" placeholder="Title" required>
                <textarea name="body" id="body" cols="500" rows="5" placeholder="Enter your post" required></textarea>
                <!-- <input type="submit" value="Submit" class="submit"> -->
                <!-- <input type="submit" value="Submit" class="submit" onclick="preventDefault()"> -->
                <button onclick="preventDefault()" class="submit">Submit</button>
                <!-- clear button -->
                <input type="reset" value="Clear" id='clear' class="clear">
            </form>  
        </section>
    </section>
    <!-- Footer -->
    <footer>
        <p>&copy; 2023 Rahat Ali</p>
    </footer>
</body>
</html>
<?php
    // Check if user is already logged in
    session_start();
    if (!isset($_SESSION['email'])) {
        header("Location: login.php"); // Redirect
        exit(); // Stop executing script
    }

    // Check if form has been submitted and that the fields are not empty
    if (isset($_POST['title']) || isset($_POST['body'])) {

        // Check if fields are empty
        if ($_POST['body'] != "" && $_POST['title'] != "") {
            
            // Get form data
            $title = $_POST['title'];
            $body = $_POST['body'];
            $email = $_SESSION['email'];

            // Prevent SQL injection
            $title = stripcslashes($title);
            $body = stripcslashes($body);

            // Prevent XSS
            $title = htmlspecialchars($title);
            $body = htmlspecialchars($body);
            
            
            // Insert into database
            $db = new mysqli('localhost', 'root', '', 'ecs417');
            $result = $db->query(
                "INSERT INTO blog (date, title, body, email) VALUES (NOW(), '$title', '$body', '$email')"
            );

            // If insertion was successful, redirect to blog page
            if ($result) {
                Header("Location: blog.php");
            }
            else {
                echo "An error occurred, please try again.";
            }
        }
    }
?>
