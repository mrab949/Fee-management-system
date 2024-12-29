<?php
    session_start();
    if(!isset($_SESSION['id_s'])){
        header('location:../public/index.php');
        exit();
    }
?>

<?php
    require_once('../config/database.php');
    require '../classes/student.php';
    require '../classes/fees.php';

    $student_email = $_SESSION['email'];
    $roll_no = isset($_SESSION['roll_no']) ? $_SESSION['roll_no'] : "";
    $session = isset($_SESSION['session']) ? $_SESSION['session'] : "";
    $btn = "";
    $display = "";
    $setting = new student();

    $student = $setting->getStudentByEmail($student_email);
    $fees = new fee();
    $feeInfo = $fees->getStudentFeeDetails( $session , $roll_no);
    $allsession = $setting->getLastFourSessions();

    if ((!isset($student['due_date']) || !$student['due_date']) && (in_array($session,$allsession))) {
        $due_date = "Will be updated soon..";
        $labl = "Due Date:";
    }elseif(in_array($session,$allsession)){
        $due_date = $student['due_date'];
        $labl = "Due Date:";
        
    }else{
        $due_date = "Congratulations, you have passed out from the university!";
        $labl = "";
        $btn = "disabled";
        $display = "hide";
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        if(isset($_FILES['fileUpload']) && $_FILES['fileUpload']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['fileUpload']['tmp_name'];
            $fileName = $_FILES['fileUpload']['name'];
            $fileSize = $_FILES['fileUpload']['size'];
            $fileType = $_FILES['fileUpload']['type'];
            $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);

            $allowedFileExtensions = ['jpg', 'jpeg', 'png', 'gif'];

            if (in_array($fileExtension, $allowedFileExtensions)) {
                $uploadFileDir = '../uploads/';
                $fullFileName = time() . '_' . $fileName;
                $destPath = $uploadFileDir . $fullFileName;

                if (move_uploaded_file($fileTmpPath, $destPath)) {
                    
                    $semester = $_POST['semester'];
                    $amount = $_POST['amount'];
                    if ($fees->insertFees($roll_no , $session , $semester, $amount, $destPath )) {
                        $fee_status='pending';
                        if($fees->updateFeeStatus($fee_status , $roll_no , $session, $semester)){
                            echo '<script>alert("Fee challan uploaded and data saved successfully!")</script>';
                        }  
                    } else {
                        echo '<script>alert("You have already uploaded fee challan for ' . $semester . '.");</script>';
                    }
                } else {
                    echo '<script>alert("There was an error moving the file to the directory.")</script>';
                }
            } else {
                echo '<script>alert("Upload failed. Allowed file types are: jpg, jpeg, png, gif.")</script>';
            }
        } else {
            echo '<script>alert("No file uploaded or an error occurred.")</script>';
        }
    }
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Fee Challan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../assets/fees.css">
    <style>
        button.disabled{
            pointer-events: none;
            opacity: 0.5;
        }

        .container.hide{
            display:none;
        }
    </style>
</head>

<body>
    <?php
        require '../partials/header.php';
        require '../partials/navbars.php';
    ?>

    <h1 class="main_heading" style="font-weight: 900;">Your Uploads And History</h1>
    <p style="text-align: center; font-size:1.9rem; font-weight: 900; margin-top:2rem; color:black;"><?=$labl?>  <?=$due_date?></p>
    <div class="container <?=$display?>">
        <h1 style="color:black;">Upload Fee Challan</h1>
        <div class="profile-card">         
            <div class="profile-picture">
                <img src="../pictures/re.jpg" alt="Profile Picture">
            </div>
        </div>
        
        
        <button id="updatePictureBtn" class ="<?=$btn?>">Upload Challan Picture</button>
        <div class="upload" id="data" style="display: none;">
            <form action="fees.php" method="post" enctype="multipart/form-data">
                <label for="semester">Semester:</label>
                <select name="semester" required>
                    <option value="" disabled selected>Select Semester</option>
                    <option value="1st Semester">1st Semester</option>
                    <option value="2nd Semester">2nd Semester</option>
                    <option value="3rd Semester">3rd Semester</option>
                    <option value="4th Semester">4th Semester</option>
                    <option value="5th Semester">5th Semester</option>
                    <option value="6th Semester">6th Semester</option>
                    <option value="7th Semester">7th Semester</option>
                    <option value="8th Semester">8th Semester</option>
                </select>
                <label for="amount">Amount:</label>
                <input type="text" name="amount" placeholder="Enter correct amount" required>
                <label for="fileUpload" class="file-label">Select picture:</label>
                <input type="file" name="fileUpload" accept="image/*" class="file-input" required>
                <button type="submit" id="submit">Save Challan</button>
            </form>

            
        </div>
    </div>

    <div class="containerh">
        <h1>Paid Fee History</h1>
        <table>
            <thead>
                <tr>
                    <th>Roll No.</th>
                    <th>Student Name</th>
                    <th>Semester</th>
                    <th>Session</th>
                    <th>Department</th>
                    <th>Payment Date</th>
                    <th>Amount Paid</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($feeInfo) {?>
                    <?php foreach($feeInfo as $data){ ?>
                        <tr>
                            <td><?= $data['roll_no']; ?></td>
                            <td><?= $student['name']; ?></td>
                            <td><?= $data['semester']; ?></td>
                            <td><?= $data['session']; ?></td>
                            <td>Computer Engineering</td>
                            <td><?= $data['uploaded_date']; ?></td>
                            <td><?= $data['amount']; ?></td>
                            <td><?= $data['fee_status']; ?></td>    
                        </tr>
                    <?php } ?>                   
                <?php  } else { 
                        echo '<p style = "color : black;">You have not paid yet...</p>';
                } ?>                       
            </tbody>
        </table>
        <!-- <a href="student.php" class="btn-back"><i class="fa-solid fa-backward" style="margin-right:5px; color: rgb(38, 70, 83);"></i>Back to Dashboard</a> -->
    </div>

    <script>
        const updatePictureBtn = document.getElementById('updatePictureBtn');
        const data = document.getElementById('data');
        updatePictureBtn.addEventListener('click', () => {
            data.style.display = data.style.display === 'none' ? 'block' : 'none';
        });
    </script>
    

    <?php  
        require '../partials/footer.php';
    ?>
</body>

</html>