<?php 

require 'vendor/autoload.php';

DB::$user = 'root';
DB::$password = '';
DB::$dbName = 'loan';

$name = $_POST['name'];
$accountnum = $_POST['accountnum'];

$payment_date = DB::query("SELECT id FROM borrowers WHERE account='$accountnum' AND fname='$name'");

if (!$payment_date) {

	echo json_encode(["response" => 0]);

}else{

	echo json_encode(["response" => 1, "id" => $payment_date[0]['id'] ]);

}


?>