<?php 
require 'vendor/autoload.php';

DB::$user = 'root';
DB::$password = '';
DB::$dbName = 'loan';

$id = $_POST['id'];

$info = DB::query("SELECT * FROM borrowers WHERE id='$id'");

$loan = DB::query("SELECT * FROM loan_info WHERE borrower='$id'");

$payments = DB::query("SELECT * FROM payments WHERE account_no='$id'");

echo json_encode(["loan" => $loan, "info" => $info, "payments" => $payments]);


?>