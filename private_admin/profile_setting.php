<?php
    session_start();
    if(!isset($_SESSION['a_email'])){
        header('location:../public/index.php');
        exit();
    }
?>

<?php
    require_once('../config/database.php');
    require '../classes/admin.php';

    $setting = new admin();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $form_type = $_POST['form_type'];
        if($form_type === 'picture'){
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
                        $id = $_SESSION['id'];
                        if($setting->updateadminPicture($destPath , $id)){
                            $_SESSION['a_picture'] = $uploadFileDir . $fullFileName;
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
                echo "No file uploaded or an error occurred.";
            }
        }elseif ($form_type === 'data') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $hashedPassword =  password_hash($password, PASSWORD_DEFAULT);
            $id = $_SESSION['id'];
            if ($setting->updateAdminData($name , $email , $hashedPassword ,$id)) {
                $_SESSION['a_name'] = $name;
                echo '<script>alert("Your informations updated successfully!")</script>';
            } else {
                echo '<script>alert("Error updating information. Please try again later.")</script>';
            }
            
        }elseif($form_type === 'addAdmin'){
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $hashedPassword =  password_hash($password, PASSWORD_DEFAULT);
            if ($setting->addAdmin($name , $email , $hashedPassword )) {
                $_SESSION['a_name'] = $name;
                echo '<script>alert("A new admin added successfully!")</script>';
            } else {
                echo '<script>alert("Error adding a new admin. Please try again later.")</script>';
            }
        }
        
    }
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../assets/admin_profile_setting.css">
    <title>Admin Profile Settings</title>
</head>

<body>
    <?php
        require '../partials/header.php';
        require '../partials/navbar.php';
    ?>

    <main>
        <div class="container">
            <h1><i class="fas fa-user-cog"></i> Profile Settings</h1>
            <div class="profile-card">
                <div class="profile-picture">
                    <img src="<?=$_SESSION['a_picture']?>" alt="Profile Picture">
                </div>
                <h2><?=$_SESSION['a_name']?></h2>
                <div class="buttons-row">
                    <button id="updatePictureBtn">
                        <i class="fas fa-camera"></i> Update Profile Picture
                    </button>

                    <button id="addAdminBtn">
                        <i class="fas fa-user-plus fa-1x"></i> Add admin
                    </button>

                    <button id="updateInfoBtn">
                        <i class="fas fa-edit"></i> Update Profile Information
                    </button>
                </div>
            </div>

            <form action="profile_setting.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="form_type" value="picture">

                <div id="pictureSection" class="form-section">
                    <label for="fileUpload">
                        <i class="fas fa-file-upload"></i> Select Picture:
                    </label>

                    <input type="file" id="fileUpload" required name = "fileUpload" accept="image/*">
                    <button type="submit">
                        <i class="fas fa-save"></i> Save Changes
                    </button>
                </div>
            </form>

            <form action="profile_setting.php" method="POST" >
                <input type="hidden" name="form_type" value="data">

                <div id="infoSection" class="form-section">
                    <label for="name">
                        <i class="fas fa-user"></i> Name:
                    </label>
                    <input type="text" id="name" name = "name" placeholder="Your Name" required>
                    <label for="password">
                        <i class="fas fa-key"></i> Password:
                    </label>
                    <input type="password" id="password" name="password" placeholder="12345678" required>
                    <label for="email">
                        <i class="fas fa-envelope"></i> Email:
                    </label>
                    <input type="email" id="email" name="email" placeholder="Your Email" required>
                    <button type="submit">
                        <i class="fas fa-save"></i> Save Changes
                    </button>
                </div>
            </form>


            <form action="profile_setting.php" method="POST" >
                <input type="hidden" name="form_type" value="addAdmin">

                <div id="addAdmin" class="form-section">
                    <label for="name">
                        <i class="fas fa-user"></i> Name:
                    </label>
                    <input type="text" id="name" name = "name" placeholder="Your Name" required>
                    <label for="password">
                        <i class="fas fa-key"></i> Password:
                    </label>
                    <input type="password" id="password" name="password" placeholder="12345678" required>
                    <label for="email">
                        <i class="fas fa-envelope"></i> Email:
                    </label>
                    <input type="email" id="email" name="email" placeholder="Your Email" required>
                    <button type="submit">
                        <i class="fas fa-save"></i> Add a new admin
                    </button>
                </div>
            </form>
        </div>
    </main>

    <footer>
        <?php
            require '../partials/footer.php';
        ?>
    </footer>

    <script>
        const updatePictureBtn = document.getElementById('updatePictureBtn');
        const updateInfoBtn = document.getElementById('updateInfoBtn');
        const pictureSection = document.getElementById('pictureSection');
        const infoSection = document.getElementById('infoSection');
        const addAdmin = document.getElementById('addAdmin');
        const addAdminBtn = document.getElementById('addAdminBtn');

        updatePictureBtn.addEventListener('click', () => {
            pictureSection.classList.toggle('active');
            infoSection.classList.remove('active');
            addAdmin.classList.remove('active');
        });

        updateInfoBtn.addEventListener('click', () => {
            infoSection.classList.toggle('active');
            pictureSection.classList.remove('active');
            addAdmin.classList.remove('active');
        });

        addAdminBtn.addEventListener('click' , ()=>{
            addAdmin.classList.toggle('active');
            pictureSection.classList.remove('active');
            infoSection.classList.remove('active');
        })
    </script>

</body>

</html>
