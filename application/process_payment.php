<?php include "../config/session.php"; ?>  

<!DOCTYPE html>
<html>
<head>

<style>
.loader {
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid #242424;
  border-right: 16px solid #ffc239;
  border-bottom: 16px solid #242424;
  border-left: 16px solid #ffc239;
  width: 120px;
  height: 120px;
  -webkit-animation: spin 2s linear infinite;
  animation: spin 2s linear infinite;
  margin:auto;
  
}

@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>
</head>
<body>
<br><br><br><br><br><br><br><br><br>
<div style="width:100%;text-align:center;vertical-align:bottom">
		<div class="loader"></div>
<?php
if(isset($_POST['save']))
{

require '../vendor/autoload.php';

DB::$user = 'root';
DB::$password = '';
DB::$dbName = 'loan';

$tid = $_SESSION['tid'];
$name = mysqli_real_escape_string($link, $_POST['teller']);
$acount =  mysqli_real_escape_string($link, $_POST['acte']);
$account_no = mysqli_real_escape_string($link, $_POST['account']);
$customer = mysqli_real_escape_string($link, $_POST['customer']);
$loan = mysqli_real_escape_string($link, $_POST['loan']);
$pay_date = mysqli_real_escape_string($link, $_POST['pay_date']);
$amount_to_pay = mysqli_real_escape_string($link, $_POST['amount_to_pay']);
$remarks = mysqli_real_escape_string($link, $_POST['remarks']);


$payment_date = DB::query("SELECT pay_date, amount_topay, amount FROM loan_info WHERE borrower='$account_no'");

$newDate = date("Y-m-d", strtotime($payment_date[0]['pay_date']));  

$date_now = date("Y-m-d");




if (date("Y-m-d") > $newDate) {

$datetime1 = date_create($date_now);
$datetime2 = date_create($newDate);

// Calculates the difference between DateTime objects
$interval = date_diff($datetime1, $datetime2);

// Printing result in years & months format
$count = $interval->format('%m');

  if ($count == 0) {

    $dt = strtotime($payment_date[0]['pay_date']);

    $new_payment_date = date("m/d/Y", strtotime("+1 month", $dt));

    $deduction = $payment_date[0]['amount']*0.2;

    $new_amount_to_pay = $payment_date[0]['amount_topay']+$deduction;

    DB::query("UPDATE loan_info SET amount_topay=%s WHERE borrower=%s", $new_amount_to_pay, $account_no);

    $updated_bal = DB::query("SELECT amount_topay FROM loan_info WHERE borrower='$account_no'");

    $new_amount = intval($updated_bal[0]['amount_topay'])-intval($amount_to_pay);

    DB::query("UPDATE loan_info SET amount_topay=%s, pay_date=%s WHERE borrower=%s", $new_amount, $new_payment_date, $account_no);


    DB::insert('payments', [
      'tid' => $tid,
      'account' => $acount,
      'account_no' => $account_no,
      'customer' => $customer,
      'loan' => $new_amount,
      'pay_date' => $pay_date,
      'amount_to_pay' => $amount_to_pay,
      'remarks' => $remarks
    ]);


    echo '<meta http-equiv="refresh" content="2;url=listpayment.php?tid='.$_SESSION['tid'].'">';
    echo '<br>';
    echo'<span class="itext" style="color: #FF0000">Saving Payment.....Please Wait!</span>';


  }else if($count == 1){

    $dt = strtotime($payment_date[0]['pay_date']);

    $new_payment_date = date("m/d/Y", strtotime("+1 month", $dt));

    $deduction = $payment_date[0]['amount']*0.2;

    $new_amount_to_pay = $payment_date[0]['amount_topay']+$deduction;

    DB::query("UPDATE loan_info SET amount_topay=%s WHERE borrower=%s", $new_amount_to_pay, $account_no);

    $updated_bal = DB::query("SELECT amount_topay FROM loan_info WHERE borrower='$account_no'");

    $new_amount = intval($updated_bal[0]['amount_topay'])-intval($amount_to_pay);

    DB::query("UPDATE loan_info SET amount_topay=%s, pay_date=%s WHERE borrower=%s", $new_amount, $new_payment_date, $account_no);


    DB::insert('payments', [
      'tid' => $tid,
      'account' => $acount,
      'account_no' => $account_no,
      'customer' => $customer,
      'loan' => $new_amount,
      'pay_date' => $pay_date,
      'amount_to_pay' => $amount_to_pay,
      'remarks' => $remarks
    ]);


    echo '<meta http-equiv="refresh" content="2;url=listpayment.php?tid='.$_SESSION['tid'].'">';
    echo '<br>';
    echo'<span class="itext" style="color: #FF0000">Saving Payment.....Please Wait!</span>';


  }else{

    $dt = strtotime($payment_date[0]['pay_date']);

    $count_date = $count+1;

    $new_payment_date = date("m/d/Y", strtotime("+".$count_date." month", $dt));

    $deduction = $payment_date[0]['amount']*0.2;

    $penalty = $deduction*$count;

    $new_amount_to_pay = $payment_date[0]['amount_topay']+$penalty;

    DB::query("UPDATE loan_info SET amount_topay=%s WHERE borrower=%s", $new_amount_to_pay, $account_no);

    $updated_bal = DB::query("SELECT amount_topay FROM loan_info WHERE borrower='$account_no'");

    $new_amount = intval($updated_bal[0]['amount_topay'])-intval($amount_to_pay);

    DB::query("UPDATE loan_info SET amount_topay=%s, pay_date=%s WHERE borrower=%s", $new_amount, $new_payment_date, $account_no);


    DB::insert('payments', [
      'tid' => $tid,
      'account' => $acount,
      'account_no' => $account_no,
      'customer' => $customer,
      'loan' => $new_amount,
      'pay_date' => $pay_date,
      'amount_to_pay' => $amount_to_pay,
      'remarks' => $remarks,
      'penalty_amount' => $penalty,
      'months_delayed' => $count." Month(s)"
    ]);


    echo '<meta http-equiv="refresh" content="2;url=listpayment.php?tid='.$_SESSION['tid'].'">';
    echo '<br>';
    echo'<span class="itext" style="color: #FF0000">Saving Payment.....Please Wait!</span>';


  }

}else{

$dt = strtotime($payment_date[0]['pay_date']);

$new_payment_date = date("m/d/Y", strtotime("+1 month", $dt));

$updated_bal = DB::query("SELECT amount_topay FROM loan_info WHERE borrower='$account_no'");

$new_amount = intval($updated_bal[0]['amount_topay'])-intval($amount_to_pay);

DB::query("UPDATE loan_info SET amount_topay=%s, pay_date=%s WHERE borrower=%s", $new_amount, $new_payment_date, $account_no);


DB::insert('payments', [
  'tid' => $tid,
  'account' => $acount,
  'account_no' => $account_no,
  'customer' => $customer,
  'loan' => $new_amount,
  'pay_date' => $pay_date,
  'amount_to_pay' => $amount_to_pay,
  'remarks' => $remarks
]);


echo '<meta http-equiv="refresh" content="2;url=listpayment.php?tid='.$_SESSION['tid'].'">';
echo '<br>';
echo'<span class="itext" style="color: #FF0000">Saving Payment.....Please Wait!</span>';


}



// echo $new_amount;







// $insert = mysqli_query($link, "INSERT INTO payments(id,tid,account,account_no,customer,loan,pay_date,amount_to_pay,remarks) VALUES('','$tid',$acount,'$account_no','$customer','$loan','$pay_date','$amount_to_pay','$remarks')") or die (mysqli_error($link));



// if(!$insert)
// {
// echo '<meta http-equiv="refresh" content="2;url=newpayments.php?tid='.$_SESSION['tid'].'">';
// echo '<br>';
// echo'<span class="itext" style="color: #FF0000">Unable to payment records.....Please try again later!</span>';
// }
// else{

// }
}
?>
</div>
</body>
</html>
