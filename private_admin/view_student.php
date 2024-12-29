<?php
    session_start();
    if(!isset($_SESSION['a_email'])){
        header('location:../public/index.php');
        exit();
    }
?>



<?php
    require_once('../config/database.php');
    require '../classes/student.php';

    $student = new Student();
    $allSessions = $student->getYear();
    $sessions = $student->getLastFourSessions();
    $selectedSession = isset($_POST['session']) ? $_POST['session'] : null;

    if ($selectedSession) {
        $students = $student->getStudentBySession($selectedSession);
    } else {
        $students = $student->getStudentsByYears($sessions);
    }
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manage Students' Fees</title>
    <link rel="stylesheet" href="../assets/view_student.css">
</head>

<body>
    <?php require_once '../partials/header.php'; ?>
    <?php require_once '../partials/navbar.php'; ?>


    <h1 class="heading">View and Manage Students' Fees</h1>


    <form action="" method="post">
        <div class="custom-select">
            <select name="session" onchange="this.form.submit()">
                <option value="" disabled <?=empty($selectedSession) ? 'selected' : '' ?>>Select session...</option>
                <?php
                if ($allSessions) {
                    foreach ($allSessions as $eachSession) {
                        $selected = ($eachSession === $selectedSession) ? 'selected' : '';
                        echo '<option value="' . $eachSession . '" ' . $selected . '>' . $eachSession . '</option>';
                    }
                }
            ?>
            </select>
        </div>
    </form>

     
    <?php

        $total_students = 0;
        $paid_students = 0;
        $unpaid_students = 0;
        $pending_students = 0;

        if ($students) {
            foreach (['paid', 'pending', 'unpaid'] as $status) {
                if (!empty($students[$status])) {
                    $total_students += count($students[$status]);
                    if ($status === 'paid') {
                        $paid_students += count($students[$status]);
                    } elseif ($status === 'unpaid') {
                        $unpaid_students += count($students[$status]);
                    } elseif ($status === 'pending') {
                        $pending_students += count($students[$status]);
                    }
                }
            }
        }
        ?>

        <div class="insights-container">
            <div class="insight">
                <h3>Total Students</h3>
                <p><?php echo $total_students; ?></p>
            </div>
            <div class="insight">
                <h3>Paid Students</h3>
                <p><?php echo $paid_students; ?></p>
            </div>
            <div class="insight">
                <h3>Pending Students</h3>
                <p><?php echo $pending_students; ?></p>
            </div>
            <div class="insight">
                <h3>Unpaid Students</h3>
                <p><?php echo $unpaid_students; ?></p>
            </div>
        </div>

        <?php if ($students) { ?>
            <?php foreach (['paid', 'pending', 'unpaid'] as $status) { ?>
                <?php if (!empty($students[$status])) { ?>
                    <h2 class="section-title" style= "margin-top:2rem;"><?= ucfirst($status) ?> Students</h2>
                    <div class="card-container" style="padding: 2.3rem;">
                        <?php foreach ($students[$status] as $student) { ?>
                            <div class="card">
                                <img src="../uploads/<?=$student['picture']?>" alt="Student Photo" class="profile-pic">
                                <div class="card-content">
                                    <h2 class="student-name">
                                        <?= $student['name'] ?>
                                    </h2>
                                    <p class="roll-number">Roll No: <?= $student['roll_no'] ?></p>
                                    <p class="roll-number">Fee Status: <?= ucfirst($student['fee_status']) ?></p>
                                    
                                    <button class="view-profile-btn <?=$student['fee_status']?>">
                                        <a href="s_profile.php?email=<?= $student['email']?>"><i class="fa fa-user"></i> View Profile</a>
                                    </button>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>
            <?php } ?>
        <?php } else { ?>
            <p>No students found for the selected session(s).</p>
    <?php } ?>


    <button class="report" id="report">Generate report</button>

    <div class="overlay" id="overlay"></div>
    <div class="report-form" id="reportForm">
        <h2 style="margin-bottom: 2rem;">Generate report</h2>
        <form action="report.php" method="POST">
            <label for="session">Session:</label>
            <select id="select1" name="session">
                <option value="" selected disabled>Select Session..</option>        
                <?php
                    foreach ($allSessions as $eachSession) {
                        echo'<option value="' . $eachSession . '">' . $eachSession . '</option>';
                    }
                    
                ?>
            </select>
            
            <label for="select2">Student type:</label>
            <select id="select2" name="status">
                <option value="" selected disabled>Select Type..</option>
                <option value="paid">Paid</option>
                <option value="unpaid">Unpaid</option>
                <option value="pending">Pending</option>
            </select>
            <button type="submit" class="generate-btn">Generate Report</button>
        </form>
    </div>



    <script src="../assets/view_student.js"></script>
    <?php require_once '../partials/footer.php'; ?>
</body>

</html>