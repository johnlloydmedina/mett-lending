<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">


<link href="img/ass.png" rel="icon" type="dist/img">


<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <style type="text/css">
<!--
.style1 {
	color: #FF0000;
	font-weight: bold;
}
-->
  </style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
   <a href="index.php"> <img src="img/ass.png" class="img-circle" alt="User Image" width="70" height="70"></a>
   <a href="index.php"><h3 style="color: black;"><strong>METT Loans & Salary</strong></h3></a>

  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Borrower Log in</p>
	
      <div class="form-group has-feedback">
        <input id="b-name" name="username" type="text" class="form-control" placeholder="Borrowers Firstname" required>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input id="acount-num" name="pass" type="password" class="form-control" placeholder="Password/Account Number" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
	  
	  	  
        <div align="right">
		  <button name="submit" type="button" id="login-borrower" class="btn btn-primary btn-flat"><i class="fa fa-send"></i>&nbsp;Sign In</button> 
        </div>
		
		<hr>
		<div class="text-center">
    <a href="index.php">Admin Log in</a>
  </div>

    
    <!-- /.social-auth-links -->


  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="plugins/bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });


$(document).on("click", "#login-borrower", ()=>{

  $.ajax({
  url: "checking.php",
  type: "POST",
  data: { 

    name: $("#b-name").val(),
    accountnum: $("#acount-num").val()

   },
  dataType: "json",
  xhrFields: {
  withCredentials: true,
  },
  crossDomain: true,
  success: function (data) { 

  if (data.response == 0) {
    Swal.fire(
      'Account not exist',
      'Please go to office and register your own account.',
      'error'
    );
  } else {

  window.location = 'borrowers_account.php?id='+data.id;  

  } 



  } 
});

});


</script>

<!--Start of Tawk.to Script
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5919eb424ac4446b24a6f355/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
End of Tawk.to Script-->
</body>
</html>

