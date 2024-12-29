<?PHP

require_once('../config/database.php');
require '../classes/student.php';

$comment = new student();

$success = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $msg = $_POST['message'];

    if($comment->insertComment($name,$email,$msg)){
        echo "<script>alert('Thanks for reaching out!')
        window.location.href=index.php;
        </script>";
    }else{
        $success = "Error Please try again.";
    }
}

$rows = $comment->displayComments();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/index.css">
    <title>Homepage</title>
</head>

<body>
    <div class="header">
        <div class="logo">
            <img src="../pictures/cpe (2).jpg" alt="department of computer engineering">
        </div>
        <div class="departName">
            <p>DEPARTMENT OF COMPUTER ENGINEERING<br>BAHAUDDIN ZAKARIYA UNIVERSITY MULTAN</p>
        </div>
        <button class="login-btn"><i class="fas fa-sign-in-alt"></i> <a href="check_user.php">Login</a></button>
    </div>

    <header id="header">
        <div class="containern">
            <nav class="main-nav">
                <ul>
                    <li><a href="#home"><i class="fa fa-home"></i>Home</a></li>
                    <li><a href="#about"><i class="fa fa-group"></i>About</a></li>
                    <li><a href="#vision"><i class="fa fa-bullseye"></i>Chairman's Vision</a></li>
                    <li><a href="#helights"><i class="fa fa-star"></i>Highlights</a></li>
                    <li><a href="#opinions"><i class="fa-solid fa-user-graduate"></i>Voice of Students</a></li>
                    <li><a href="#comments"><i class="fa-solid fa-comment"></i>Comments</a></li>
                    <li><a href="#contactus"><i class="fa-solid fa-square-phone"></i>Contact Us</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <section class="hero" id="home">
        <h1>Welcome to <br>Department of Computer Engineering</h1>
        <video class="video-bg" autoplay muted loop>
            <source src="../pictures/bgvideo.mp4" type="video/mp4">
        </video>
    </section>

    <section class="about-section" id="about">
        <div class="container">
            <h1 class="about-heading">About Department</h1>
            <p><h3>Introduction:</h3>
                The Department of Computer Engineering was established in 2004 under the Faculty of Engineering and
                Technology by Bahauddin Zakariya University, Multan. Computer Engineering programs are accredited by the
                Pakistan Engineering Council (PEC). The modern era has witnessed rapid development in Computer
                Engineering, both in hardware and software. Each year a host of new advancements is unveiled, from home
                robotics to advanced operating systems, microprocessors, and supercomputers with massive computational
                capabilities. Computer Engineers are responsible for the design and development of certain pieces of
                technology that are used every day, from personal computers and desktops to smartphones and robotics.
                These advancements in technology are meant to add convenience to our daily lives.<br>
                <h3>Core Objectives:</h3>
                Computer Engineering
                principles can be applied to several other purposes, including the development of integrated circuits,
                embedded systems, computer vision, computer systems architecture, and much more. Our society has become
                so dependent on computers that we cannot survive without them. Also, they are great tools for improving
                human productivity.<br>
                <h3>Mission:</h3>
                 The department plays an important role in fulfilling the demand for skilled Computer
                professionals.<br>
                <h3>Key Achievements:</h3>
                The graduates are already serving in various esteemed institutions across the country and
                abroad, and many of them are pursuing their higher studies in various well-regarded universities of the
                world. Although the computer as a discipline is young, it has accomplished spectacular progress quickly.
                It is a common saying that knowledge is power, but we say that the knowledge of computers is powerful.<br>
            </p>
            <div class="readmorea"><b><a href="https://bzu.edu.pk/view_department.php?deptID=22">Read more..</a></b></div>   
        </div>
    </section>

    <!-- Vision Section -->
    <section class="vision-section" id="vision">
        <div class="container">
            <h1 class="vision-heading">Chairman's Vision</h1>
            <div class="vision-content">
                <!-- Image -->
                <img class="img_deg" src="../pictures/HOD.png" alt="Image of Chairman">
                <!-- Paragraph -->
                <p>To be recognized as an excellent organization in computer engineering education and research.
                    Strengthen
                    our graduates with professional skills and innovative techniques for the betterment of society.
                    Provide
                    innovative solutions for the local as well as global challenges in the computer engineering
                    field.<br>
                    To provide students with the fundamental knowledge, advanced skills, and professional behavior in
                    the
                    Computer Engineering field by imparting high-quality education and innovative techniques for
                    successful
                    careers in industrial and academic roles.</p>
            </div>
        </div>
    </section>
    <!-- Helights Section -->
    <section class="helights-section" id="helights">
        <div class="container">
            <h1 style="font-size: 34px; color: #001d3d; margin-bottom: 1cm;">Helights of The Department</h1>
            <div class="slider-container" style="overflow-x: scroll;">
                <!-- Cards Wrapper -->
                <div class="card-row" id="cardRow">
                    <!-- Card 1 -->
                    <div class="card">
                        <img src="../pictures/fyp.jpg" alt="Card Image 6">
                        <div class="container1">
                            <h4><b>FYP Project: A Smart Patient Health Monitoring System Using Internet of Things</b>
                            </h4>
                            <p>Supervisor: Dr. Muhammad Waqar
                                Ashraf</p>
                        </div>
                        <div class="readmore"><b><a href="https://www.facebook.com/photo.php?fbid=568843312107181&set=pb.100069445501282.-2207520000&type=3">Read more..</a></b></div>   

                    </div>

                    <!-- Card 2 -->
                    <div class="card">
                        <img src="../pictures/al.jpg" alt="Card Image 2">
                        <div class="container1">
                            <h4><b>Alumini Annual Dinner</b></h4>
                            <p>Celebrating 20 years of excellence with our outstanding alumni and graduates.</p>
                        </div>
                        <div class="readmore"><b><a href="https://www.facebook.com/photo/?fbid=751544900503687&set=a.381877377470443">Read more..</a></b></div>   

                    </div>

                    <!-- Card 3 -->
                    <div class="card">
                        <img src="../pictures/sp.jpg" alt="Card Image 3">
                        <div class="container1">
                            <h4><b>Sports Gala Week</b></h4>
                            <p>Graduates passionately participated in sports representing the department.</p>
                        </div>
                        <div class="readmore"><b><a href="https://www.facebook.com/photo.php?fbid=706990121625832&set=pb.100069445501282.-2207520000&type=3">Read more..</a></b></div>   

                    </div>

                    <!-- Card 4 -->
                    <div class="card">
                        <img src="../pictures/bf.jpg" alt="Card Image 4">
                        <div class="container1">
                            <h4><b>Bonfire Night 2023</b></h4>
                            <p>Bonfire was conducted on 16th December, 2023 and a welcome was also thrown to the 2023
                                batch graduates by seniors.</p>
                        </div>
                        <div class="readmore"><b><a href="https://www.facebook.com/photo/?fbid=664168679241310&set=pb.100069445501282.-2207520000">Read more..</a></b></div>   

                    </div>

                    <!-- Card 5 -->
                    <div class="card">
                        <img src="../pictures/ai.jpg" alt="Card Image 5">
                        <div class="container1">
                            <h4><b>Navigating the Landscape of AI</b></h4>
                            <p>Explore the world of AI, from fundamental concepts to its applications, ethics, and
                                career opportunities.</p>
                        </div>
                        <div class="readmore"><b><a href="https://www.facebook.com/photo.php?fbid=626941656297346&set=pb.100069445501282.-2207520000&type=3">Read more..</a></b></div>   

                    </div>

                    <!-- Card 6 -->
                    
                    <div class="card">
                        <img src="../pictures/t.jpg" alt="Card Image 1">
                        <div class="container1">
                            <h4><b>Green BZU Campaign</b></h4>
                            <p>Tree plantation drive at the Department of Computer Engineering.</p>
                        </div>
                        <div class="readmore"><b><a href="https://www.facebook.com/photo?fbid=870493858608790&set=pcb.870487938609382">Read more..</a></b></div>   

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Voice of Students Section -->
    <section class="opinions-section" id="opinions">
        <div class="container">
            <h1 style="font-size: 34px; color: #001d3d; margin-bottom: 1cm;">Voice of Students</h1>
            <div class="slider-container" style="overflow-x: scroll;">

                <!-- Cards Wrapper -->
                <div class="card-row" id="cardRow2">
                    <!-- Card 1 -->
                    <div class="card">
                        <img src="../pictures/eisha.jpg" alt="Card Image 1">
                        <div class="container1">
                            <h4><b>Eisha Arain</b></h4>
                            <h3 style="font-size: 15px; color: #325479fa;"> 3rd Semester</h3>
                            <p>"My life became easier after using our department's fee management system."</p>
                        </div>
                    </div>

                    <!-- Card 2 -->
                    <div class="card">
                        <img src="../pictures/senior.jpg" alt="Card Image 2">
                        <div class="container1">
                            <h4><b>Amna Khan</b></h4>
                            <h3 style="font-size: 15px; color: #325479fa;"> 7th Semester</h3>
                            <p>"The department has taken good initiative to digitalize the fee system which provides convience to all students."</p>
                        </div>
                    </div>

                    <!-- Card 3 -->
                    <div class="card">
                        <img src="../pictures/unis.jpeg" alt="Card Image 3">
                        <div class="container1">
                            <h4><b>Ali Ahmad</b></h4>
                            <h3 style="font-size: 15px; color: #325479fa;"> 1st Semester</h3>
                            <p>"I used this fee management system and to my surprise almost all my fee related problems are solved. "</p>
                        </div>
                    </div>

                    <!-- Card 4 -->
                    <div class="card">
                        <img src="../pictures/s4.jpg" alt="Card Image 4">
                        <div class="container1">
                            <h4><b>Abrar-ul-Haq</b></h4>
                            <h3 style="font-size: 15px; color: #325479fa;"> 5th Semester</h3>
                            <p>"This system also generates fee challan so, I don't have to worry about going to admin office."</p>
                        </div>
                    </div>

                    <!-- Card 5 -->
                    <div class="card">
                        <img src="../pictures/s5.jpg" alt="Card Image 5">
                        <div class="container1">
                            <h4><b>Aliza Noreen</b></h4>
                            <h3 style="font-size: 15px; color: #325479fa;"> 7th Semester</h3>
                            <p>"The department has taken good initiative to digitalize the fee system which provides convience to all students."</p>
                        </div>
                    </div>

                    <!-- Card 6 -->
                    <div class="card">
                        <img src="../pictures/pic.jpeg" alt="Card Image 6">
                        <div class="container1">
                            <h4><b>Mariyam Nawaz</b></h4>
                            <h3 style="font-size: 15px; color: #325479fa;"> 3rd Semester</h3>
                            <p>"I am impressed how this fee management system works and I personally found it convinient to upload fee challan."</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <section class="comment-section" id="comments">
        <div class="container">
            <h1>Leave a Comment</h1>
            <form action="index.php" method= "POST"  id="commentForm">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" placeholder="Your Name" required>

                <label for="name">Email:</label>
                <input type="email" id="email" name="email" placeholder="Your email" required>

                <label for="comment">Comment:</label>
                <textarea id="comment" rows="5" name="message" placeholder="Write your comment here..." required></textarea>
                <p><?=$success?></p>
                <button type="submit" class="buttonf">Submit</button>
            </form>
        </div>
        <div class="container">
            <h1>Comments</h1>
            <?php if ($rows): ?>
            <?php foreach ($rows as $row): ?>
                <div class="comment">
                <h3><?= $row['name']; ?></h3>
                <p class="email">Email: <?= $row['email']; ?></p>
                <p class = "message"><?= $row['comment']; ?></p>
                <p class="date"><?php echo date("F j, Y, g:i a", strtotime($row['created_at'])); ?></p>
                </div>
            <?php endforeach; ?>
            <?php else: ?>
            <p>No comments yet. Be the first to comment!</p>
            <?php endif; ?>
        </div>
    </section>

    <section class="contactus-section" id="contactus">
        <div class="container">
            <h1 class="section-title">Contact Us</h1>

            <p class="contact-info">
                <i class="fa-solid fa-location-dot location-icon"style="color: #264653;margin-right: 5px;"></i>Bahauddin Zakariya University, Bosan Road, Multan, Punjab, Pakistan,<br><br>

                <i class="fa-solid fa-phone phone-icon" style="color: #264653;margin-right: 5px;"></i>(061) 9330230<br><br>
                <i class="fa-solid fa-envelope email-icon" style="color: #264653;margin-right: 5px;"></i>computerengineering@bzu.edu.pk<br><br>
                <i class="fa-solid fa-envelope email-icon" style="color: #264653;margin-right: 5px;"></i>imranmalik@bzu.edu.pk<br><br><br>

                <a href="https://www.facebook.com/p/Department-of-Computer-Engineering-BZU-Multan-100069445501282/">
                    <i class="fa-brands fa-facebook social-icon"style="color: #264653;margin-right: 5px;"></i>
                </a>
                &emsp;
                <a
                    href="https://bzu.edu.pk/view_department.php?deptID=22&fbclid=IwY2xjawG5qGhleHRuA2FlbQIxMAABHT-ubMX5dl9Of4aywy3RcHni1WJKs1PlPRd1LILd2yowi6am_Pl8opKFuw_aem_5lIl0L1jE651NsXX-LV0VA">
                    <i class="fa-solid fa-globe social-icon"style="color: #264653;margin-right: 5px;"></i>
                </a>
                &emsp;
                <a href="https://www.linkedin.com/school/bzu/">
                    <i class="fa-brands fa-linkedin social-icon"style="color: #264653;margin-right: 5px;"></i>
                </a>
                &emsp;
                <a href="https://www.youtube.com/@bzu-pakistan/videos">
                    <i class="fa-brands fa-youtube social-icon"style="color: #264653;margin-right: 5px;"></i>
                </a>
            </p>
        </div>
    </section>

    <footer class="footer">
        &copy; 2024 Department of Computer Engineering | All Rights Reserved
    </footer>


</body>

</html>