<?php
    session_start();
    if(!isset($_SESSION['a_email'])){
        header('location:../public/index.php');
        exit();
    }
    require_once('../config/database.php');
    require_once('../classes/student.php');
    require_once('../classes/admin.php');

    $getInfo = new student();     

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $roll_no = $_POST['roll_no'];
        $session = $_POST['session'];
        $semester = $_POST['semester'];
        $amount = $_POST['amount'];
        $latefee = $_POST['latefee'];
        $validDate = $_POST['date'];
        $challan_no = mt_rand(00000000 , 99999999);

        if(!$data =$getInfo->getStudentByRollAndSssion($roll_no , $session)){
            echo "<script>alert('No student found.');
            window.location.href = 'fee_challan.php';
            </script>";
        }

        function numberToWords($amount) {
            $words = array(
                0 => '', 1 => 'One', 2 => 'Two', 3 => 'Three', 4 => 'Four',
                5 => 'Five', 6 => 'Six', 7 => 'Seven', 8 => 'Eight', 9 => 'Nine',
                10 => 'Ten', 11 => 'Eleven', 12 => 'Twelve', 13 => 'Thirteen', 
                14 => 'Fourteen', 15 => 'Fifteen', 16 => 'Sixteen', 
                17 => 'Seventeen', 18 => 'Eighteen', 19 => 'Nineteen', 
                20 => 'Twenty', 30 => 'Thirty', 40 => 'Forty', 
                50 => 'Fifty', 60 => 'Sixty', 70 => 'Seventy', 
                80 => 'Eighty', 90 => 'Ninety'
            );
        
            $digits = array('', 'Thousand', 'Million', 'Billion', 'Trillion');
        
            if ($amount == 0) {
                return "Zero";
            }
        
            $output = '';
            $i = 0;
            while ($amount > 0) {
                $chunk = $amount % 1000;
                if ($chunk) {
                    $output = convertChunk($chunk, $words) . " " . $digits[$i] . " " . $output;
                }
                $amount = (int)($amount / 1000);
                $i++;
            }
        
            return trim($output);
        }
        
        function convertChunk($amount, $words) {
            $output = '';
            if ($amount > 99) {
                $output .= $words[(int)($amount / 100)] . " Hundred ";
                $amount %= 100;
            }
        
            if ($amount > 20) {
                $output .= $words[(int)($amount / 10) * 10] . " ";
                $amount %= 10;
            }
        
            $output .= $words[$amount];
            return trim($output);
        }      
        if(!$latefee){
            $latefee = 0;
        }else{
            $amountInWords = numberToWords($latefee);
        }
        if(!$amount){
            $amount = 0;
        }else{
            $amountInWords = numberToWords($amount);
        }

        if(!isset($amountInWords)){
            $amountInWords = "Zero";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$data['name']?></title>
    <link rel="stylesheet" href="../assets/print_challan.css">
    <style>
        
    </style>
</head>
<body onload="printVoucher();">

<div class="challan-container">
        <div class="challan">
        <div class="header">
            <img src="../uploads/bzu_logo.jpg" alt="University Logo">
            <div class="header-text">
                <p>Bahauddin Zakariya University Multan</p>
            </div>
        </div>
        <table class="info">
        <p style="text-align:center; margin:0px;  margin-bottom:3px;">Office copy</p>

            <tr>
                <th><strong>Challan No:</strong></th>
                <td><?=$challan_no?></td>
            </tr>
            <tr>
                <th>HBL</th>
                <td>0042-79920660-03</td>
            </tr>
            <tr>
                <th>Bank Alflah</th>
                <td>MFBZU</td>
            </tr>
            <tr>
                <th>NBP</th>
                <td>4168894299</td>
            </tr>
            <tr>
                <th>UBL</th>
                <td>273689498</td>
            </tr>
        </table>
        <p style="text-align:center; margin:0px; padding: 6px; margin-bottom:9px;border: 1px solid black;">BZU REGULAR FEE(MORNING)</p>
        <table class="info">
            <tr>
                <th>Issue Date</th>
                <td><?=Date('j M Y')?></td>
            </tr>
            <tr>
                <th>CNIC</th>
                <td><?=$data['id_card']?></td>
            </tr>
            <tr>
                <th>Student Name</th>
                <td><strong><?=$data['name']?></strong></td>
            </tr>
            <tr>
                <th>Father's Name</th>
                <td><strong><?=$data['father_name']?></strong></td>
            </tr>
            <tr>
                <th>Student ID</th>
                <td><?=$data['id']?></td>
            </tr>
            <tr>
                <th>Roll No</th>
                <td><?=$roll_no?></td>
            </tr>
            <tr>
                <th>Program</th>
                <td>B.Sc Computer Engineering (Morning)</td>
            </tr>
            <tr>
                <th>Session</th>
                <td><strong><?=$session?></strong></td>
            </tr>
            <tr>
                <th>Total Fee & Dues</th>
                <td><?=$amount?></td>
            </tr>
            <tr>
                <th>Late Fee (if any)</th>
                <td><?=$latefee?></td>
            </tr>
            <tr>
                <th>Amount in Words</th>
                <td class="amount-words"><?=$amountInWords?> Only</td>
            </tr>
        </table>
        <div class="footer">
            <p style="margin: 0px;">This Challan is Valid up to <?=$validDate?></p>
            <p>Sign Officer | Sign Cashier</p>
        </div>
    </div>
    <div class="challan">
        <div class="header">
            <img src="../uploads/bzu_logo.jpg" alt="University Logo">
            <div class="header-text">
                <p>Bahauddin Zakariya University Multan</p>
            </div>
        </div>
        <table class="info">
        <p style="text-align:center; margin:0px; margin-bottom:3px;">Bank copy</p>

            <tr>
                <th><strong>Challan No:</strong></th>
                <td><?=$challan_no?></td>
            </tr>
            <tr>
                <th>HBL</th>
                <td>0042-79920660-03</td>
            </tr>
            <tr>
                <th>Bank Alflah</th>
                <td>MFBZU</td>
            </tr>
            <tr>
                <th>NBP</th>
                <td>4168894299</td>
            </tr>
            <tr>
                <th>UBL</th>
                <td>273689498</td>
            </tr>
        </table>
        <p style="text-align:center; margin:0px; padding: 6px; margin-bottom:9px;border: 1px solid black;">BZU REGULAR FEE(MORNING)</p>
        <table class="info">
            <tr>
                <th>Issue Date</th>
                <td><?=Date('j M Y')?></td>
            </tr>
            <tr>
                <th>CNIC</th>
                <td><?=$data['id_card']?></td>
            </tr>
            <tr>
                <th>Student Name</th>
                <td><?=$data['name']?></td>
            </tr>
            <tr>
                <th>Father's Name</th>
                <td><?=$data['father_name']?></td>
            </tr>
            <tr>
                <th>Student ID</th>
                <td><?=$data['id']?></td>
            </tr>
            <tr>
                <th>Roll No</th>
                <td><?=$roll_no?></td>
            </tr>
            <tr>
                <th>Program</th>
                <td>B.Sc Computer Engineering (Morning)</td>
            </tr>
            <tr>
                <th>Session</th>
                <td><?=$session?></td>
            </tr>
            <tr>
                <th>Total Fee & Dues</th>
                <td><?=$amount?></td>
            </tr>
            <tr>
                <th>Late Fee (if any)</th>
                <td><?=$latefee?></td>
            </tr>
            <tr>
                <th>Amount in Words</th>
                <td class="amount-words"><?=$amountInWords?> Only</td>
            </tr>
        </table>
        <div class="footer">
            <p>This Challan is Valid up to <?=$validDate?></p>
            <p>Sign Officer | Sign Cashier</p>
        </div>
    </div>
    <div class="challan">
        <div class="header">
            <img src="../uploads/bzu_logo.jpg" alt="University Logo">
            <div class="header-text">
                <p>Bahauddin Zakariya University Multan</p>
            </div>
        </div>
        <table class="info">
        <p style="text-align:center; margin:0px; margin-bottom:3px;">Admin copy</p>

            <tr>
                <th><strong>Challan No:</strong></th>
                <td><?=$challan_no?></td>
            </tr>
            <tr>
                <th>HBL</th>
                <td>0042-79920660-03</td>
            </tr>
            <tr>
                <th>Bank Alflah</th>
                <td>MFBZU</td>
            </tr>
            <tr>
                <th>NBP</th>
                <td>4168894299</td>
            </tr>
            <tr>
                <th>UBL</th>
                <td>273689498</td>
            </tr>
        </table>
        <p style="text-align:center; margin:0px; padding: 6px; margin-bottom:9px;border: 1px solid black;">BZU REGULAR FEE(MORNING)</p>
        <table class="info">
            <tr>
                <th>Issue Date</th>
                <td><?=Date('j M Y')?></td>
            </tr>
            <tr>
                <th>CNIC</th>
                <td><?=$data['id_card']?></td>
            </tr>
            <tr>
                <th>Student Name</th>
                <td><?=$data['name']?></td>
            </tr>
            <tr>
                <th>Father's Name</th>
                <td><?=$data['father_name']?></td>
            </tr>
            <tr>
                <th>Student ID</th>
                <td><?=$data['id']?></td>
            </tr>
            <tr>
                <th>Roll No</th>
                <td><?=$roll_no?></td>
            </tr>
            <tr>
                <th>Program</th>
                <td>B.Sc Computer Engineering (Morning)</td>
            </tr>
            <tr>
                <th>Session</th>
                <td><?=$session?></td>
            </tr>
            <tr>
                <th>Total Fee & Dues</th>
                <td><?=$amount?></td>
            </tr>
            <tr>
                <th>Late Fee (if any)</th>
                <td><?=$latefee?></td>
            </tr>
            <tr>
                <th>Amount in Words</th>
                <td class="amount-words"><?=$amountInWords?> Only</td>
            </tr>
        </table>
        <div class="footer">
            <p>This Challan is Valid up to <?=$validDate?></p>
            <p>Sign Officer | Sign Cashier</p>
        </div>
    </div>
    <div class="challan">
        <div class="header">
            <img src="../uploads/bzu_logo.jpg" alt="University Logo">
            <div class="header-text">
                <p>Bahauddin Zakariya University Multan</p>
            </div>
        </div>
        <table class="info">
        <p style="text-align:center; margin:0px;  margin-bottom:3px;">Student copy</p>
            <tr>
                <th><strong>Challan No:</strong></th>
                <td><?=$challan_no?></td>
            </tr>
            <tr>
                <th>HBL</th>
                <td>0042-79920660-03</td>
            </tr>
            <tr>
                <th>Bank Alflah</th>
                <td>MFBZU</td>
            </tr>
            <tr>
                <th>NBP</th>
                <td>4168894299</td>
            </tr>
            <tr>
                <th>UBL</th>
                <td>273689498</td>
            </tr>
        </table>
        <p style="text-align:center; margin:0px; padding: 6px; margin-bottom:9px;border: 1px solid black;">BZU REGULAR FEE(MORNING)</p>
        <table class="info">
            <tr>
                <th>Issue Date</th>
                <td><?=Date('j M Y')?></td>
            </tr>
            <tr>
                <th>CNIC</th>
                <td><?=$data['id_card']?></td>
            </tr>
            <tr>
                <th>Student Name</th>
                <td><?=$data['name']?></td>
            </tr>
            <tr>
                <th>Father's Name</th>
                <td><?=$data['father_name']?></td>
            </tr>
            <tr>
                <th>Student ID</th>
                <td><?=$data['id']?></td>
            </tr>
            <tr>
                <th>Roll No</th>
                <td><?=$roll_no?></td>
            </tr>
            <tr>
                <th>Program</th>
                <td>B.Sc Computer Engineering (Morning)</td>
            </tr>
            <tr>
                <th>Session</th>
                <td><?=$session?></td>
            </tr>
            <tr>
                <th>Total Fee & Dues</th>
                <td><?=$amount?></td>
            </tr>
            <tr>
                <th>Late Fee (if any)</th>
                <td><?=$latefee?></td>
            </tr>
            <tr>
                <th>Amount in Words</th>
                <td class="amount-words"><?=$amountInWords?> Only</td>
            </tr>
        </table>
        <div class="footer">
            <p>This Challan is Valid up to <?=$validDate?></p>
            <p>Sign Officer | Sign Cashier</p>
        </div>
    </div>

</div>

<script>
    function printVoucher() {
    window.print();
    setTimeout(() => {
        window.location.href = 'fee_challan.php'; 
    }, 1000);
}
</script>

</body>
</html>