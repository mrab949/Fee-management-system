<?php

    session_start();

    if(!isset($_SESSION['a_email'])){

        header('location:../public/index.php');

        exit();

    }

?>



<?php

    require_once('../config/database.php');

    require_once('../classes/student.php');

    require_once('../classes/admin.php');

    $admin = new admin();

    $student = new Student();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $sessions = $_POST['session'];

        $father_names = $_POST['father_name'];

        $names    = $_POST['name'];

        $emails   = $_POST['email'];

        $roll_nos = $_POST['roll_no'];

        $dobs     = $_POST['dob'];

        $genders  = $_POST['gender'];

        $id_cards = $_POST['id_card'];



        $email_set = [];

        $id_card_set = [];

        $roll_no_set = [];



        $success = true;

        $error_message = '';



        for ($i = 0; $i < count($names); $i++) {

            $email = $emails[$i];

            $id_card = $id_cards[$i];

            $roll_no = $roll_nos[$i];

            

            if (in_array($email, $email_set)) {

                $error_message = "Duplicate email detected: $email";

                $success = false;

                break;

            }

            if (in_array($id_card, $id_card_set)) {

                $error_message = "Duplicate ID card detected: $id_card";

                $success = false;

                break;

            }

            if (in_array($roll_no, $roll_no_set)) {

                $error_message = "Duplicate roll number detected in the session: $roll_no";

                $success = false;

                break;

            }



            $email_set[] = $email;

            $id_card_set[] = $id_card;

            $roll_no_set[] = $roll_no;

        }



        if ($success) {

            for ($i = 0; $i < count($names); $i++) {

                $session = $sessions;

                $email = $emails[$i];

                $father_name = $father_names[$i];

                $name = $names[$i];

                $roll_no = $roll_nos[$i];

                $dob = $dobs[$i];

                $gender = $genders[$i];

                $id_card = $id_cards[$i];



                if ($admin->adminCheck($email)) {

                    $error_message = "Email already exists in the database: $email";

                    $success = false;

                    break;    

                }



                if ($student->isDuplicateEmail($email)) {

                    $error_message = "Email already exists in the database: $email";

                    $success = false;

                    break;

                }

                if ($student->isDuplicateIdCard($id_card)) {

                    $error_message = "ID card already exists in the database: $id_card";

                    $success = false;

                    break;

                }

                if ($student->isDuplicateRollNo($roll_no, $session)) {

                    $error_message = "Roll number already exists in this session: $roll_no";

                    $success = false;

                    break;

                }

            }

        }



        if ($success) {

            for ($i = 0; $i < count($names); $i++) {

                $session = $sessions;

                $email = $emails[$i];

                $name = $names[$i];

                $father_name = $father_names[$i];

                $roll_no = $roll_nos[$i];

                $dob = $dobs[$i];

                $gender = $genders[$i];

                $id_card = $id_cards[$i];

                if (!($student->insertStudentData($name,$father_name, $roll_no, $email, $dob, $id_card, $gender, $session) )) {

                    $success = false;

                    $error_message = "Error inserting records into the database.";

                    break;

                }

                $email_set = [];

                $id_card_set = [];

                $roll_no_set = [];

            }

        }



        if ($success) {

            echo "

            <script>

                alert('All records added successfully!');

                

            </script>";

        } else {

            echo "

            <script>

                alert('$error_message');

            </script>";

        }

    }

?>





<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../assets/add_session.css">

    <title>Add New Session</title>

</head>

<body>

    <?php

        require_once '../partials/header.php';

        require_once '../partials/navbar.php';

    ?>



    <main class="main">

        <h1>Add New Session</h1>

        <div class="form-container">

            <button id="addbetchbtn" class="addbetchbtn">Add Session</button>

            <form class="form" action="add_session.php" method="post">

                <div id="students-data" class="form-data" style="display: none;">

                    <div class="year">

                        <label for="session">Session:</label>

                        <input type="text" name="session" placeholder="E.g., 2024-2025" pattern="\d{4}-\d{4}" title="Formate: YYYY-YYYY" required>

                    </div>

                    <div id="students">



                    </div>

                    <button id="add-student-btn"  class="addbetchbtn" type="button">Add Student</button>

                    <button id="submit" type="submit" class="addbetchbtn">Submit</button>

                </div>

            </form>

        </div>

    </main>

    <?php

        require_once('../partials/footer.php');

    ?>

    <script src="../assets/add_session.js"></script>

</body>

</html>
