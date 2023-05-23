<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--  -->
    <title>Rahat's Projects</title>
    <link rel="stylesheet" href="css/style.css">
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
                <li><a href="#projects">Projects</a></li>
                <li><a href="blog.php">Blog</a></li>
                <li><a href="#contact">Contact</a></li>
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
    <!-- Projects -->
    <section id="projects" class="container">
        <h2>Projects</h2>
        <!-- Project 1 -->
        <article class="project">
            <a href="https://github.com/Rahat464/Price-Comparison-Website">
                <h3>Price Comparison Website</h3>
            </a>
            <iframe width="60%" height="300" src="https://www.youtube.com/embed/EN1SvgZUAjg" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            <p>A website which aggregates search results from multiple online retail websites and compare prices by sorting and filtering results.
                Search results are stored on a database and utilised as a cache for a short period of time to minimise API calls.
                The website is built using the Django framework backend library and used HTML and CSS for the front-end.
                The backend also includes Scrapy, a python webscraper library and a MySQL database to store the search results.
            </p>
            <a href="https://github.com/Rahat464/Price-Comparison-Website">View project</a>
        </article>
        <!-- Project 2 -->
        <article class="project">
            <a href="https://github.com/Rahat464/discord-covid">
                <h3>Covid-19 Stats Discord Bot</h3>
            </a>
            <figure>
                <img src="img/covid-bot.png" alt="">
                <figcaption>Screenshot of the Discord bot.</figcaption>
            </figure>
            <p>A script made for Discord servers which scrapes websites to get the daily and total covid cases in the UK and outputs it to the user.
                This project was made for a friend who wanted to keep track of the covid cases in the UK.
                The program uses the Responses and BeautifulSoup python library to scrape the data from the websites and the Discord API to send messages to the server.
            </p>
            <a href="https://github.com/Rahat464/discord-covid">View project</a>
        </article>
        <!-- Project 3 -->
        <article class="project">
            <a href="#">
                <h3>Portfolio website and Blog</h3>
            </a>
            <p>An online portfolio website and blog made using HTML, CSS, Javascript and PHP.
                The website is hosted on Heroku and uses a MySQL database to store blog posts.
                The website is also responsive and can be viewed on mobile devices.
                Users can create an account and login to post blogs.
                Credentials are hashed and salted, then stored in the database.
            </p>
            <a href="#">View project</a>
        </article>
    </section>
    <!-- Contact -->
    <section id="contact" class="container">
        <h2>Contact me / Links</h2>
        <p>Feel free to contact me via email or any of the platforms below.</p>
        <ul>
            <li><a href="mailto:contact@rahatali.me">
                <img src="img/email.png" alt="Email" width="40%">
            </a></li>
            <li><a href="https://github.com/Rahat464">
                <img src="img/github.png" alt="Github" width="27%">
            </a></li>
            <li><a href="https://www.linkedin.com/in/alirahat/">
                <img src="img/linkedin.png" alt="LinkedIn" width="27%">
            </a></li>
        </ul>
    </section>
    <footer>
        <p>&copy; 2023 Rahat Ali</p>
    </footer>
</body>
</html>