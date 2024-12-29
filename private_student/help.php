<?php
    session_start();
    if(!isset($_SESSION['id_s'])){
        header('location:../public/index.php');
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student help</title>
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
      require_once '../partials/navbars.php';
    ?>
    <div class="detail-container">
        <h1>Complete Dashboard Guide</h1>
        <details>
            <summary>How can I upload paid fee voucher?</summary>
            <p>To upload a fee voucher, go to the <b>"Upload Challan"</b> section. Click on the <b>"Upload Challan Image"</b> button, fill out the respective form, and then upload the fee voucher image. The voucher will be successfully uploaded once submitted</p>
        </details>

        <details>
            <summary>How will I know if my uploaded fee voucher has been accepted?</summary>
            <p>Once you upload the fee voucher, it is sent to the admin for <b>verification.</b> After the admin verifies the voucher, you will receive a confirmation message. If the voucher is accepted, you will be notified. Any updates will also be displayed in the <b>"Announcement"</b> section.</p>
        </details>

        <details>
            <summary>When is the fee voucher rejected?</summary>
            <p>A fee voucher is rejected if an <b>incorrect</B> image of the challan is uploaded, such as an <b>unpaid voucher</b> or an invalid challan. Any discrepancies or mistakes in the voucher details will lead to its rejection.</p>
        </details>

        <details>
            <summary>What should I do if my uploaded voucher is rejected?</summary>
            <p>If your voucher is rejected, you should <b>contact the admin</b> to inquire about the reason for rejection. Once you have the details, make the <b>necessary corrections</b> and re-upload the voucher.</p>
        </details>

        <details>
            <summary>What should I do if I forget my login details?</summary>
            <p> If you forget your login details, you should <b>contact the admin</b> to retrieve your information. After verification, the admin will provide you with the necessary details.</p>
        </details>

        <details>
            <summary>How can I obtain a fee voucher?</summary>
            <p>To obtain a fee voucher, you will need to <b>contact the admin.</b> Provide your details, and the admin will generate the fee voucher for you.</p>
        </details>

        <details>
            <summary>How can I set up or change my profile?</summary>
            <p>To change your profile settings, go to the <b>"Profile Settings"</b> section. Here, you can update your profile picture. Please note that you can only change your profile picture, other personal details cannot be modified directly. If you need to update any other information, you will need to contact the admin for assistance.</p>
        </details>
    </div>


    <?php
        require_once '../partials/footer.php';
    ?>
</body>
</html>