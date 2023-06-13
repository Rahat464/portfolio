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
            echo "<script>console.log('Log: Session started');</script>";
            if (isset($_SESSION['email'])) {
                echo "<script>console.log('Log: User already logged in, redirecting to addBlog.php');</script>";
                header("Location: addBlog.php"); // Redirect
                exit(); // Stop executing script
            }
            else {
                session_destroy();
                echo "<script>console.log('Log: User not logged in');</script>";
                echo "<script>console.log('Log: Session destroyed');</script>";
                echo "<p>You must login to be able to post a blog.</p>";
            }

            // Check if form has been submitted
            if (isset($_POST['email']) && isset($_POST['password'])) {
                echo "<script>console.log('Log: Login form submitted');</script>";

                $email = $_POST['email'];
                $password = $_POST['password'];

                // Prevent SQL injection and XSS
                $email = stripcslashes($email);
                $password = stripcslashes($password);
                $email = htmlspecialchars($email);
                $password = htmlspecialchars($password);

                // Connect to local MySQL server
                $db = connectToDatabase();
                echo "<script>console.log('Log: Connecting to database');</script>";

                // Check if email is in database
                $result = $db->query(
                    "SELECT * FROM users WHERE email = '$email'"
                );

                // If email matches the database entry
                if ($result->num_rows == 1) {
                    echo "<script>console.log('Log: Email found in database');</script>";

                    // Get hashed password from database
                    $hashedPassword = $result->fetch_assoc()['password'];

                    if (password_verify($password, $hashedPassword)) {
                        session_start(); // Start session
                        echo "<script>console.log('Log: Password matches, starting session');</script>";

                        $_SESSION['email'] = $email;

                        $db->close(); // Close connection
                        echo "<script>console.log('Log: Redirecting to blog.php');</script>";
                        header("Location: https://rahatali.me/blog.php"); // Redirect to blog.php
                    } else {
                        // If email and password are not in database, display error message
                        echo "<p class='error'>Invalid email or password.</p>";
                        echo "<script>console.log('Log: Incorrect credential');</script>";
                    }
                }
                
                else {
                    // If email and password are not in database, display error message
                    echo "<p class='error'>Invalid email or password.</p>";
                    echo "<script>console.log('Log: Incorrect credential');</script>";
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