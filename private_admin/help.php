<?php
    session_start();
    if(!isset($_SESSION['a_email'])){
        header('location:../public/index.php');
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin help</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f9;
    }

    .detail-container {
        max-width: 1000px;
        width: 90%;
        padding: 20px;
        background-color: #ffffff;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        border: #01579b;
        margin: 4rem auto;
    }

    .detail-container h1 {
        text-align: center;
        margin-bottom:3rem;
        color: #0277bd;
    }

    details {
      border: 1px solid #ccc;
      border-radius: 5px;
      padding: 10px;
      margin-bottom: 15px;
      background-color: #fff;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      transition: background-color 0.3s ease;
    }

    details[open] {
      background-color: #e3f2fd;
    }

    summary {
      font-weight: bold;
      font-size: 1.1em;
      cursor: pointer;
      color: #0277bd;
      display: flex;
      align-items: center;
    }

    summary::before {
      content: "▶"; 
      margin-right: 10px;
      font-size: 1.2em;
      transition: transform 0.3s ease;
    }

    details[open] summary::before {
      content: "▼";
      transform: rotate(180deg);
    }

    summary:hover {
      color: #01579b;
    }

    p {
      margin: 10px 0 0;
      color: #555;
      line-height: 1.5;
    }
  </style>
</head>
<body>

    <?php 
      require_once '../partials/header.php';
      require_once '../partials/navbar.php';
    ?>
    <div class="detail-container">
        <h1>Complete Dashboard Guide</h1>
        <details>
            <summary> How can students be viewed in a customized way?
            </summary>
            <p>When you enter the student page, you will see a list of currently enrolled students of all the four sessions.To view students from a specific session, use the <b>"Select Session"</b> option available on the page. Once you select a session, the list will <b>update</b> to show students associated with the chosen session.</p>
        </details>

        <details>
            <summary>How can I register a new session?</summary>
            <p>To register a new session, go to the <b>"Add Session"</b> section. Click on the <b>"Add Session"</b> button, enter the session details, and then click on <b>"Submit."</b> This will add the new session. You can also add multiple students to the session in the same process.</p>
        </details>

        <details>
            <summary>How can I differentiate between paid, unpaid, and pending students?</summary>
            <p>On the student page, students are displayed in an <b>organized manner</b>. Paid students are shown in a <b>separate section</b>, unpaid students are grouped in another section, and pending students are listed in their respective section. You can easily view and distinguish these categories on the same page in a clear and structured layout.</p>
        </details>

        <details>
            <summary>Can I generate students report?</summary>
            <p>Yes! <br>On the student page, you will find a <b>"Generate Report"</b> button located at the <b>top-right corner</b>. Click on this button to access a form. In the form, you can select the session and specify the type of students (e.g.,<b> paid, unpaid, or pending</b>) for whom you want to generate the report. Once the required options are selected, click on the <b>"Generate Report"</b> button, and the report will be created and displayed.</p>
        </details>

        <details>
            <summary>How can I change a student's fee status?</summary>
            <p>To change a student's fee status, navigate to their profile. Below the student's details, you will find an <b>"Action"</b> section. If the student's fee status is <b>pending</b>, scroll down to view their uploaded challan in the table. After verifying the challan, click on the <b>"Update Status"</b> button. A small form will appear, where you can choose to either accept or reject the challan. Selecting <b>"Accept"</b> will approve the status, while selecting <b>"Reject"</b> will mark it as rejected and notify the student accordingly.</p>
        </details>

        <details>
            <summary>How can I extend the due date for a particular student?</summary>
            <p>To extend the due date for a particular student, go to their profile. In their profile, you will see a <b>"Due Date"</b> button along with the currently assigned date. Click on this button, and a form will open. In the form, select the new date and click on <b>"Save Changes</b>." The due date will be successfully updated for the student.</p>
        </details>

        <details>
            <summary>How can I update a student's details?</summary>
            <p>To update a student's details, go to their profile. There, you will find an <b>"Update Information"</b> button. Click on it, and a form will appear. Fill out the form with the updated details and submit it. The student's information will be successfully updated.</p>
        </details>

        <details>
            <summary>How can I send an announcement?</summary>
            <p>To send an announcement to students, go to the <b>"Updates"</b> section. There, you will find a <b>"Send an Update"</b> button. Click on it, and a form will appear. In the form, enter the subject, the body of the message, and then click on <b>"Send Message."</b> The announcement will be successfully sent. Similarly, you can also use this section to change due dates or other related updates.</p>
        </details>

        <details>
            <summary>How can I generate a fee voucher for a student?</summary>
            <p> To generate a fee voucher for a student, go to the <b>"Generate Voucher"</b> section. Fill in the required details, and then click on<b>"Generate Challan."</b> The fee voucher will be generated and ready for printing.</p>
        </details>

    </div>


    <?php
        require_once '../partials/footer.php';
    ?>
</body>
</html>