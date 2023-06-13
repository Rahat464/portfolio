<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rahat's Blog</title>
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
    <!-- Blog post submission -->
    <section class="container" id="blog">
        <!-- Login -->
        <?php
            // Check if user is already logged in
            session_start();

            if (isset($_SESSION['email'])) {
                echo "<p> Hello, " . $_SESSION['email'] . "</p>";
                echo '<div id="login_buttons">';
                echo "<a class='user_option' href='login.php'>Post a Blog</a>";
                echo '<a class="user_option" href="logout.php">Logout</a>';
                echo '</div>';
            }
            
            else {
                echo '<div id="login_buttons">';
                echo "<a class='user_option' href='register.php'>Register</a>";
                echo "<a class='user_option' href='login.php'>Login</a>";
            }

            echo '</div>';
        ?>
        <h2>Blog</h2>
        <!-- Blog posts -->
        <?php
            require_once 'php/database.php';

            $db = connectToDatabase();
            $result = $db->query("SELECT * FROM blog");
            $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

            // Close connection
            $db->close();

            // Sort array by date
            for ($i=0; $i<count($rows); $i++){ // Iterate through each row, i pointer
                
                for ($j=$i; $j<count($rows); $j++){ // j-pointer

                    // If row j is newer than row i, swap them
                    if (strtotime($rows[$i]['date']) < strtotime($rows[$j]['date'])){
                        $temp = $rows[$i];
                        $rows[$i] = $rows[$j];
                        $rows[$j] = $temp;
                    }
                }
            }

            // Iterate through array
            for ($i = 0; $i < count($rows); $i++) {
                $date_posted = date("d-m-Y", strtotime($rows[$i]['date']));
                $date_posted = str_replace("-", "/", $date_posted);
                $time_posted = date("H:i", strtotime($rows[$i]['date']));

                echo "<article class='blogPost'>";
                echo "<h3>" . $rows[$i]['title'] . "</h3>";
                echo "<p>By <span class='user'>" . $rows[$i]['email'] . "</span> &#128336; " . $date_posted . " @" . $time_posted . " BST</p>";
                echo "<p>" . $rows[$i]['body'] . "</p>";
                echo "</article>";
            }
        ?>
    </section>
    <!-- Footer -->
    <footer>
        <p>&copy; 2023 Rahat Ali | <a href="legal.html">Terms of Use and Privacy Policy</a></p>

    </footer>
</body>
</html>
