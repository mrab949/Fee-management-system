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

$setting = new student();

$student_email = $_SESSION['email'];
$student = $setting->getStudentByEmail($student_email);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_FILES['fileUpload']) && $_FILES['fileUpload']['error'] === UPLOAD_ERR_OK) {
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
                $id = $_SESSION['id_s'];
                $_SESSION['picture'] = $fullFileName;
                if($setting->updateStudentPicture($destPath , $id)){
                    echo '<script>alert("Profile picture updated successfully!")</script>';
                }else{
                    echo '<script>alert("Error updating picture. Please try again later.")</script>';
                }
                
            } else {
                echo '<script>alert("There was an error moving file to the directory.")</script>';
            }
        } else {
            echo '<script>alert("Upload failed. Allowed file types are: jpg, jpeg, png, gif.")</script>';
        }
    } else {
        echo '<script>alert("Please select a picture to upload")</script>';
    }
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../assets/student_profile_setting.css">
    <title>Profile Settings</title>
</head>

<body>

    <?php
    require '../partials/header.php';
    require '../partials/navbars.php';
    ?>

    <div class="main">
        <div class="container">
            <h1><i class="fas fa-user-cog"></i> Profile Settings</h1>
            <div class="profile-card">
                <div class="profile-picture">
                    <img src="../uploads/<?=$_SESSION['picture']?>" alt="Profile Picture">
                </div>
                <h2><?=$_SESSION['name']?></h2>
            </div>

            <button id="updatePictureBtn"><i class="fas fa-camera"></i> Update Profile Picture</button>

            <div id="upload" style="display: none;">
                <form action="profile_setting.php" method="post" enctype="multipart/form-data" class="upload-form">
                    <div class="form-group">
                        <label for="fileUpload" class="upload-label">Choose a Profile Picture:</label>
                        <input type="file" name="fileUpload" id="fileUpload" accept="image/*" class="upload-input">
                    </div>
                    <button type="submit" id="submit" class="btn-submit"><i class="fas fa-save"></i> Save Changes</button>
                </form>
            </div>
        </div>
        <div class="detail">
                    <h1 class="profile-title">Your information</h1>
                    <table class="profile-table">
                        <tr>
                            <td class="profile-label">Name:</td>
                            <td class="profile-value"><?=$student['name']?></td>
                        </tr>
                        <tr>
                            <td class="profile-label">Father Name:</td>
                            <td class="profile-value"><?=$student['father_name']?></td>
                        </tr>
                        <tr>
                            <td class="profile-label">Email:</td>
                            <td class="profile-value"><?=$student['email']?></td>
                        </tr>
                        <tr>
                            <td class="profile-label">Roll No:</td>
                            <td class="profile-value"><?=$student['roll_no']?></td>
                        </tr>
                        <tr>
                            <td class="profile-label">Semester:</td>
                            <td class="profile-value"><?=$student['label']?></td>
                        </tr>
                        <tr>
                            <td class="profile-label">Session:</td>
                            <td class="profile-value"><?=$student['session']?></td>
                        </tr>
                    </table>
                </div>
    </div>

    <script>
        const updatePictureBtn = document.getElementById('updatePictureBtn');
        const fileUpload = document.getElementById('upload');
        let isVisible = false;

        updatePictureBtn.addEventListener('click', () => {
            if (isVisible) {
                fileUpload.style.display = 'none';
                isVisible = false;
            } else {
                fileUpload.style.display = 'block';
                isVisible = true;
            }
        });
    </script>

    <?php
    require '../partials/footer.php';
    ?>

</body>

</html>