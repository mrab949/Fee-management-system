<?php

    session_start();

    if(!isset($_SESSION['id_s'])){

        header('location:../public/index.php');

        exit();

    }

?>



<?php

    $roll_no = $_SESSION['roll_no'];

    $session = $_SESSION['session'];



    require '../config/database.php';

    require '../classes/student.php';

    require '../classes/fees.php';

    $msg = new fee();

    $c_msgs = $msg->getChallanMsg($roll_no, $session);

    $update = new student();

    $updates = $update->getUpdate();

?>





<!DOCTYPE html>

<html lang="en">



<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <title>Department Announcements</title>

    <link rel="stylesheet" href="../assets/announcement.css">

  



</head>



<body>



    <?php

        require '../partials/header.php';

        require '../partials/navbars.php';

    ?>



    <main>

        <div class="msg">

            <h2>Direct messages</h2><br><br>

            <?php if($c_msgs){ ?>

                <?php foreach($c_msgs as $c_msg){ ?>



                    <div class="announcement">

                        <h3>

                            <?= $c_msg['subject'];?>

                        </h3><br>

                        <p>

                            <?= $c_msg['message'];?>

                        </p>

                        <p class="date">

                        Message sent on: <?= date('Y-m-d', strtotime($c_msg['date']));?>

                        </p>

                    </div>

                <?php }?>

            <?php }else{ ?>

                <p class="p">Nothing to see here...</p>

            <?php } ?>

        </div>

        



        <div class="msg">

            <h2>Latest Announcements</h2><br><br>

            <?php if($updates){ ?>

                <?php foreach($updates as $update){ ?>



                    <div class="announcement">

                        <h3>

                            <?= $update['subject'];?>

                        </h3><br>

                        <p>

                            <?= $update['message'];?>

                        </p>

                        <p class="date">

                            Posted date: <?= date('Y-m-d', strtotime($update['date']));?>

                        </p>

                    </div>

                <?php }?>

            <?php }else{ ?>

                <p class="p">Nothing to see here...</p>

            <?php } ?>

            <!-- <a href="student.php" class="btn-back"><i class="fa-solid fa-backward" style="margin-right:5px;color: rgb(38, 70, 83);"></i>Back to Dashboard</a> -->

        </div>

        

    </main>



    <?php

        require '../partials/footer.php';

    ?>



</body>

</html>
