<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Rahat's Blog</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/mobile.css">
    <script src="js/script.js"></script>
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
        <h1>Register</h1>
        <!-- PHP -->
        <?php
            require_once 'php/database.php';

            // Check if user is already logged in
            session_start();
            if (isset($_SESSION['email'])) {
                header("Location: addblog.php"); // Redirect
                exit(); // Stop executing script
            }

            else {
                //session_destroy();
                echo "<p>You must login to be able to post a blog.</p>";

                //// Debugging
                echo "<p>Log: User not logged in.</p>";
            }

            //// Debugging
            echo "<p>Log: Checking if form has been submitted...</p>";

            // Check if form has been submitted
            if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['confirmPassword'])) {

                $email = $_POST['email'];
                $password = $_POST['password'];
                $confirmPassword = $_POST['confirmPassword'];

                // Prevent SQL injection
                $email = stripcslashes($email);
                $password = stripcslashes($password);
                $confirmPassword = stripcslashes($confirmPassword);

                $email = mysqli_real_escape_string($db, $email);
                $password = mysqli_real_escape_string($db, $password);
                $confirmPassword = mysqli_real_escape_string($db, $confirmPassword);

                // Prevent XSS
                $email = htmlspecialchars($email);
                $password = htmlspecialchars($password);
                $confirmPassword = htmlspecialchars($confirmPassword);

                // Connect to local MySQL server
                $db = connectToDatabase();

                //// Debugging
                echo "<p>Log: Connected to database.</p>";
                
                // Check if email already exists
                $result = $db->query(
                    "SELECT * FROM users WHERE email='$email'"
                );

                //// Debugging
                echo "$result";

                if (mysqli_num_rows($result) > 0) {
                    echo "<p class='error'>Account with same email already exists.</p>";
                    exit();
                }

                // Check that passwords match
                if ($_POST['password'] != $_POST['confirmPassword']) {
                    echo "<p class='error'>Passwords do not match.</p>";
                } else { // Passwords match
                    // Hash password
                    $password = password_hash($password, PASSWORD_DEFAULT);                   

                    // Insert email and password into database
                    $result = $db->query(
                        "INSERT INTO users (email, password) VALUES ('$email', '$password')"
                    );

                    //// Debugging
                    echo "<p>Log: Inserted into database.</p>";

                    // Close connection
                    $db->close();

                    session_start(); // Start session
                    $_SESSION['email'] = $email;

                    //// Debugging
                    echo "<p>Log: Redirecting...</p>";

                    header("Location: blog.php"); // Redirect to blog.php
                } 
            }
        ?>
        <!-- End PHP -->
        <form action="register.php" method="POST"> <!-- POST used to obscure credentials from URL -->
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" placeholder="example@example.com" required>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" placeholder="Enter your password" required>
            <label for="confirmPassword">Validate Password:</label>
            <input type='password' name="confirmPassword" id="confirmPassword" placeholder="Validate your password" required>
            <button onclick="return validatePassword()" class="submit">Register</button>
            <p>By registering an account, you agree to the <a href="legal.html">Terms of Use and Privacy Policy</a>.</p>
        </form>
    </section>
    <footer>
        <p>&copy; 2023 Rahat Ali</p>
    </footer>
</body>
</html>