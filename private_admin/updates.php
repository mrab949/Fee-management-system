<?php
    session_start();
    if(!isset($_SESSION['a_email'])){
        header('location:../public/index.php');
        exit();
    }
?>

<?php

    require_once '../config/database.php';
    require '../classes/student.php';
    require '../classes/fees.php';

    $student = new student();
    $sessions = $student->getUpdates();
    $session = $student->getLastFourSessions();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $formType = $_POST['form_type'];
        
        if ($formType === 'update_due_date') {
            $sessionValue = $_POST['session'];
            $label = $_POST['label'];
            $due_date = $_POST['due_date'];
            $fee_status = "unpaid";
            $currentdate = date('Y-m-d');
    
            if (empty($sessionValue) || empty($label) || empty($due_date)) {
                echo "<script>alert('Please fill in all fields.');</script>";
                return;
            }
    
            if (strtotime($due_date) < strtotime($currentdate)) {
                echo "<script>alert('Due date cannot be in the past.');</script>";
            } else {
                $allsession = $student->getLastFourSessions();
                if (in_array($sessionValue, $allsession)) {
                    if ($student->updateDueDate($sessionValue, $label, $due_date, $fee_status)) {
                        echo "<script>
                                alert('Updated successfully!');
                                window.location.href = 'updates.php';
                              </script>";
                    } else {
                        echo "<script>alert('Failed to update the due date. Please try again later.');</script>";
                    }
                } else {
                    echo "<script>alert('You can only update due dates for currently enrolled four sessions.');</script>";
                }
            }
    
        } elseif ($formType === 'message') {
            $subject = $_POST['subject'];
            $message = $_POST['message'];
            
            if ($student->message($subject, $message)) {
                echo "<script>
                        alert('Message sent successfully!');
                        window.location.href = 'updates.php';
                      </script>";
            } else {
                echo "<script>alert('Error sending message, please try again later');</script>";
            }
        }
    }
?>    



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Updates - Computer Engineering BZU-Multan</title>
    <link rel="stylesheet" href="../assets/update.css">
</head>

<body>
    <?php
        require '../partials/header.php';
        require '../partials/navbar.php';
    ?>

    <div class="updates">
        <h1>Update due dates for fee submission</h1>
        <button id="updateBtn" class="updateBtn">Update Dates</button>
        <button id="sendUpdateBtn" class="updateBtn">Send an Update</button>

        <form action="updates.php" id="updatedate" method="POST" style="display: none;">
            <input type="hidden" name="form_type" value="update_due_date">
            <div class="inpts">
                <label for="session">Session:</label>
                <select name="session" id="session">
                    <option value="" selected disabled> session..</option>
                    <?php if($session){
                        foreach($session as $ses){
                            echo '<option value="'.$ses.'">'.$ses.'</option>';  
                        }
                    }?>
                </select>
                <label for="label">Semester:</label>
                <select name="label" id="label" required>
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

                <label for="due_date">Due Date:</label>
                <input type="date" name="due_date" id="due_date" required>
            </div>

            <button type="submit" class="submit-btn">Save Changes</button>
        </form>

        <form id="sendUpdateForm" action="updates.php" method="POST" style="display: none;">
            <input type="hidden" name="form_type" value="message">
            <div class="inpts">
                <label for="subject">Subject:</label>
                <input type="text" name="subject" id="subject" placeholder="Enter subject" required>

                <label for="message">Message:</label>
                <textarea name="message" id="message" placeholder="Enter your message" rows="5" required></textarea>
            </div>

            <button type="submit" class="submit-btn">Send</button>
        </form>

        <div class="due-dates">
            <?php if ($sessions) { ?>
            <table>
                <thead>
                    <tr>
                        <th>Session</th>
                        <th>Semester</th>
                        <th>Due Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($sessions as $row) { ?>
                    <tr>
                        <td>
                            <?php echo $row['session']; ?>
                        </td>
                        <td>
                            <?php echo $row['label']; ?>
                        </td>
                        <td>
                            <?php echo $row['due_date']; ?>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <?php } else { ?>
            <p class="no-updates">No updates available at the moment.</p>
            <?php } ?>
        </div>
    </div>

    <?php require '../partials/footer.php'; ?>
    <script src="../assets/update.js"></script>

</body>

</html>