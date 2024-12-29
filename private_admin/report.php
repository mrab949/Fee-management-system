<?php
    session_start();
    if(!isset($_SESSION['a_email'])){
        header('location:../public/index.php');
        exit();
    }

    require '../config/database.php';
    require '../classes/student.php';
    require '../classes/admin.php';

    $sdnt = new student();
    $data = [];
    $status = null;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $session = $_POST['session'] ?? '';
        $status = $_POST['status'] ?? '';
        if (empty($session) || empty($status)) {
            echo "<script>alert('Please select both session and status.');</script>";
        } else {
            $data = $sdnt->getStudentBySession($session);
            if (empty($data)) {
                echo "<script>alert('No student found for the selected session.');</script>";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/report.css">
    <title>Generate Student Report</title>
</head>
<body onload = "printReport();">
    <h1>Student(s) Report</h1>
    <div class="student-container">
        <?php if (!empty($data[$status])) { ?>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Roll No</th>
                        <th>Session</th>
                        <th>Semester</th>
                        <th>Fee Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data[$status] as $student) { ?>
                        <tr>
                            <td><?= htmlspecialchars($student['name']) ?></td>
                            <td><?= htmlspecialchars($student['roll_no']) ?></td>
                            <td><?= htmlspecialchars($student['session']) ?></td>
                            <td><?= htmlspecialchars($student['label']) ?></td>
                            <td><?= htmlspecialchars($student['fee_status']) ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <p class="no-data">No students found for the selected session and status.</p>
        <?php } ?>
    </div>
    
    <script>
        function printReport() {
            window.print();
            setTimeout(() => {
                window.location.href = 'view_student.php';
            }, 2000);
        }
    </script>
</body>
</html>
