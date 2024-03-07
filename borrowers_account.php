<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="img/ass.png" rel="icon" type="dist/img">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Account</title>
  </head>
  <body>
  <nav class="navbar navbar-light" style="background-color: #e3f2fd;">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">
        <img src="img/ass.png" alt="" width="30" height="24" class="d-inline-block align-text-top">
        Micro Finance Bank
      </a>
      <h3>Hi <span id="fullname">asdads</span></h3>
      <form class="d-flex">
        <a class="btn btn-secondary" href="http://localhost/loan/account.php"><i class="bi bi-box-arrow-right"></i><i class="fa fa-sign-out" aria-hidden="true"></i>Logout</a>
      </form>
    </div>
  </nav>

<div class="container" id="account-container" data-id="<?php echo $_GET['id']; ?>">
<br>
<div class="card">
  <div class="card-body">
      <h3 id="account-number"></h3>
  </div>
</div>
<br>  
<div class="card">
  <div class="card-header">
    <b>Loan Details</b>  
  </div>  
  <div class="card-body">
  <table class="table">
    <thead>
      <tr>
        <th scope="col">Account</th>
        <th scope="col">Description</th>
        <th scope="col">Amount</th>
        <th scope="col">Balance</th>
        <th scope="col">Agent</th>
        <th scope="col">Release</th>
        <th scope="col">Payment</th>
        <th scope="col">Status</th>
      </tr>
    </thead>
    <tbody id="list-loan">

    </tbody>
  </table>
  </div>
</div>
<br>
<div class="card">
  <div class="card-header">
    <b>Recent Payments</b>  
  </div>  
  <div class="card-body">
  <table class="table">
    <thead>
      <tr>
        <th scope="col">Balance</th>
        <th scope="col">Amount to Pay</th>
        <th scope="col">Date</th>
        <th scope="col">Remarks</th>
      </tr>
    </thead>
    <tbody id="list-payment">

    </tbody>
  </table>
  </div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>

  </body>

<script type="text/javascript">
  
console.log($("#account-container").data("id"));

  $.ajax({
  url: "info.php",
  type: "POST",
  data: { 

    id: $("#account-container").data("id")

   },
  dataType: "json",
  xhrFields: {
  withCredentials: true,
  },
  crossDomain: true,
  success: function (data) { 

  $("#account-number").text("Account Number: "+data.info[0].account)  

  $("#fullname").text(data.info[0].fname+" "+data.info[0].lname+"☺️ !");  

  $("#list-loan").empty();  
  $.each(data.loan, (index, loan)=>{

  $("#list-loan").append(`

      <tr>
        <td>${loan.baccount}</td>
        <td>${loan.desc}</td>
        <td>${loan.amount}</td>
        <td>${loan.amount_topay}</td>
        <td>${loan.agent}</td>
        <td>${loan.date_release}</td>
        <td>${loan.pay_date}</td>
        <td>${loan.upstatus}</td>
      </tr>  

  `);  

  });

  $("#list-payment").empty();  
  $.each(data.payments, (index, pay)=>{

  $("#list-payment").append(`

      <tr>
        <td>${pay.loan}</td>
        <td>${pay.amount_to_pay}</td>
        <td>${pay.pay_date}</td>
        <td>${pay.remarks}</td>
      </tr>  

  `);  

  });


  } 
});


</script>

</html>