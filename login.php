<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Rahat's Blog</title>
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
    <!-- <link rel="stylesheet" href="css/style.css"> -->
    <link rel="stylesheet" href="css/mobile.css">
</head>
<body>
    <!-- navbar -->
    <header>
        <nav>
            <ul>
                <li><a href="index.php#about">About</a></li>
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
                <li><a href="index.php#about">About</a></li>
                <li><a href="experience.php#education">Education</a></li>
                <li><a href="experience.php#experience">Experience</a></li>
                <li><a href="projects.php#projects">Projects</a></li>
                <li><a href="blog.php">Blog</a></li>
                <li><a href="projects.php#contact">Contact</a></li>
            </ul>
        </div>
    </header>
    <section class="container" id="login">
        <h1>Login</h1>
        <!-- PHP -->
        <?php
            require_once 'php/database.php';

            // Check if user is already logged in
            session_start();
            if (isset($_SESSION['email'])) {
                header("Location: addBlog.php"); // Redirect
                exit(); // Stop executing script
            }
            else {
                session_destroy();
                echo "<p>You must login to be able to post a blog.</p>";
            }

            // Check if form has been submitted
            if (isset($_POST['email']) && isset($_POST['password'])) {

                $email = $_POST['email'];
                $password = $_POST['password'];

                // Prevent SQL injection
                $email = stripcslashes($email);
                $password = stripcslashes($password);
                $email = mysqli_real_escape_string($db, $email);
                $password = mysqli_real_escape_string($db, $password);
                // Prevent XSS
                $email = htmlspecialchars($email);
                $password = htmlspecialchars($password);

                // Connect to local MySQL server
                $db = connectToDatabase();
                
                // Check if email is in database
                $result = $db->query(
                    "SELECT * FROM users WHERE email = '$email'"
                );

                // If email matches the database entry
                if ($result->num_rows == 1) {

                    // Get hashed password from database
                    $hashedPassword = $result->fetch_assoc()['password'];

                    if (password_verify($password, $hashedPassword)) {
                        session_start(); // Start session
                        $_SESSION['email'] = $email;

                        $db->close(); // Close connection
                        header("Location: blog.php"); // Redirect to blog.php
                    } else {
                        // If email and password are not in database, display error message
                        echo "<p class='error'>Invalid email or password.</p>";
                    }
                }
                
                else {
                    // If email and password are not in database, display error message
                    echo "<p class='error'>Invalid email or password.</p>";
                }
            }
        ?>
        <!-- End PHP -->
        <form action="login.php" method="POST"> <!-- POST used to obscure credentials from URL -->
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" placeholder="example@example.com" required>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" placeholder="Enter your password" required>
            <input type="submit" value="Login" class="submit" >
        </form>
    </section>
    <footer>
        <p>&copy; 2023 Rahat Ali</p>
    </footer>
</body>
</html>