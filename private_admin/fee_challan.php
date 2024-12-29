<?php
    //check session 
    session_start();
    if(!isset($_SESSION['a_email'])){
        header('location:../public/index.php');
        exit();
    }
    //include files
    require_once('../config/database.php');
    require_once('../classes/student.php');
    require_once('../classes/admin.php');
    //create object
    $getInfo = new student();
    $sessions = $getInfo->getYear();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generate Fee Challan</title>
    <link rel="stylesheet" href="../assets/challan.css">
    <style>
       
    </style>
</head>
<body>
    <?php include '../partials/header.php';
    include '../partials/navbar.php'; 
    ?>

    <h1>Generate Fee Challan</h1>
    <div class="form-container">
        <form action="challan.php" method="POST">
            <fieldset>
                <legend>Challan Details</legend>
                
                <div class="form-data">
                    <label for="roll_no">Roll No:</label>
                    <select name="roll_no" id="roll_no" required>
                        <option value="" selected disabled>Select Roll No...</option>
                        <?php
                        for ($i = 1; $i <= 45; $i++) {
                            echo '<option value="CPE-' . $i . '">CPE-' . $i . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="form-data">
                    <label for="session">Session:</label>
                    <select name="session" id="session" required>
                        <option value="" selected disabled>Select Session...</option>
                        <?php
                            if ($sessions) {
                                foreach ($sessions as $eachSession) {
                                    echo '<option value="' . $eachSession . '" >' . $eachSession . '</option>';
                                }
                            }
                        ?>
                    </select>
                </div>
                <div class="form-data">
                    <label for="semester">Semester:</label>
                    <select name="semester" id="semester" required>
                        <option value="" disabled selected>Select Semester...</option>
                        <option value="1st Semester">1st Semester</option>
                        <option value="2nd Semester">2nd Semester</option>
                        <option value="3rd Semester">3rd Semester</option>
                        <option value="4th Semester">4th Semester</option>
                        <option value="5th Semester">5th Semester</option>
                        <option value="6th Semester">6th Semester</option>
                        <option value="7th Semester">7th Semester</option>
                        <option value="8th Semester">8th Semester</option>
                    </select>
                </div>
                <div class="form-data">
                    <label for="amount">Amount:</label>
                    <input type="text" name="amount" placeholder="Enter fee amount">
                </div>
                <div class="form-data">
                    <label for="date">Valid date:</label>
                    <input type="date" name="date" required>
                </div>
                <div class="form-data">
                    <label for="latefee">Late Fee Charges (If any):</label>
                    <input type="text" name="latefee" placeholder="Enter late fee charges">
                </div>
                <button type="submit">Generate Challan</button>
            </fieldset>
        </form>
    </div>
    <?php include '../partials/footer.php'; ?>
</body>
</html>