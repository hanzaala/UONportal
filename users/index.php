<?php
session_start();
error_reporting(0);
include("includes/config.php");
if(isset($_POST['submit']))
{
$ret=mysqli_query($con,"SELECT * FROM users WHERE userEmail='".$_POST['username']."' and password='".md5($_POST['password'])."'");
$num=mysqli_fetch_array($ret);
if($num>0)
{
$extra="dashboard.php";//
$_SESSION['login']=$_POST['username'];
$_SESSION['id']=$num['id'];
$host=$_SERVER['HTTP_HOST'];
$uip=$_SERVER['REMOTE_ADDR'];
$status=1;
$log=mysqli_query($con,"insert into userlog(uid,username,userip,status) values('".$_SESSION['id']."','".$_SESSION['login']."','$uip','$status')");
$uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
header("location:http://$host$uri/$extra");
exit();
}
else
{
$_SESSION['login']=$_POST['username'];	
$uip=$_SERVER['REMOTE_ADDR'];
$status=0;
mysqli_query($con,"insert into userlog(username,userip,status) values('".$_SESSION['login']."','$uip','$status')");
$errormsg="Invalid username or password";
$extra="login.php";

}
}



if(isset($_POST['change']))
{
   $email=$_POST['email'];
    $contact=$_POST['contact'];
    $password=md5($_POST['password']);
$query=mysqli_query($con,"SELECT * FROM users WHERE userEmail='$email' and contactNo='$contact'");
$num=mysqli_fetch_array($query);
if($num>0)
{
mysqli_query($con,"update users set password='$password' WHERE userEmail='$email' and contactNo='$contact' ");
$msg="Password Changed Successfully";

}
else
{
$errormsg="Invalid email id or Contact no";
}
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>CMS | User Login</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        
    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
	<link href="assets/css/style-responsive.css" rel="stylesheet">
	<style>
		 *{
			margin:0;
			padding:0;
			box-sizing:border-box;
		font-family:"poppins" , sans-serif;
		}
		body{
			overflow:hidden;
		}
		/* section{
			display:flex;
			justify-content:center;
			align-items:center;
			min-height:100vh;
			background:linear-gradient(to bottom,#f1f4f9,#dff1ff);


		}
		section .color{
			position:absolute;
			filter:blur(150px);

		}
		section .color:nth-child(1){
			top:-120px;
			width:1000px;
			height:900px;
			background:green;
		}
		section .color:nth-child(2){
bottom:-700px;
left:100px;
width:500px;
height:500px;
background:#fffd87;
		}
		section .color:nth-child(3){
bottom:-600px;
right:50px;
width:500px;
height:200px;
background:#00d2ff;
		} */
		.form-login h2.form-login-heading{
			position:relative;
			color:black;
			background:green;
		}
		.form-login{
			background:rgba(255,255,255,0.5);
			
			/* backdrop-filter:blur(1px); */
			box-shadow:0 25px 45px rgba(0,0,0,0.6);
			border:1px solid rgba(255,255,255,0.5);
			border-right:1px solid rgba(255,255,255,0.2);
			border-bottom:1px solid rgba(255,255,255,0.2);
			/* position:absolute;
			
			left:600px; */
		}
		.form-login h2::before{
			content:"";
			position:absolute;
			left:100px;
			bottom:10px;
			width:80px;
			height:4px;
			background:black;
		}
		.form-control {
			/* width:100%;
			background:rgba(255,255,255,0.1);
			border:5px solid black;
			outline:none;
			padding:10px,20px;
			border-radius:35px;
			border:1px solid black; */
			/* border-right:1px solid rgba(255,255,255,0.2);
			border-bottom:1px solid rgba(255,255,255,0.2); */
			font-size:16px;
			letter-spacing:1px;
			color:black;
			box-shadow:0 25px 45px rgba(0,0,0,0.3);
			font-weight:bold

		}
		.btn-theme{
			background:white;
			color:#666;
			max-width:100px;
			cursor:pointer;
			font-weight:600;
			box-shadow:0 25px 45px rgba(0,0,0,0.4);
			border-radius:35px;
		} 
		a{
			position: absolute;
			top:40px;
			left:140px;
			color:Black;
			font-size:16px;
			font-weight:bold;
		}
		.modal-header{
			background:green;
		}
		.close{
			font-size:34px
		}
		button.btn.btn-default{
			background:white;
			color:#666;
			max-width:100px;
			cursor:pointer;
			font-weight:600;
			box-shadow:0 25px 45px rgba(0,0,0,0.4);
			border-radius:35px;
		}
		.modal-content{
			
			background-image:url(assets/img/ff.jpg);
			
			background-position: center; /* Center the image */
			background-repeat: no-repeat; /* Do not repeat the image */
			
		}

		
		
		input{
			color:black;
		}
	
		

	</style>
<script type="text/javascript">
function valid()
{
 if(document.forgot.password.value!= document.forgot.confirmpassword.value)
{
alert("Password and Confirm Password Field do not match  !!");
document.forgot.confirmpassword.focus();
return false;
}
return true;
}
</script>

  </head>

  <body>

      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
    <section>
		<div class="color"></div>
		<div class="color"></div>
		<div class="color"></div>
	</section>
	
	  <div id="login-page">
	  	<div class="container">
	  		<h3 align="center" style="color:Black">UON Student Service Portal</h3>
	<hr />
		      <form class="form-login" name="login" method="post">
		        <h2 class="form-login-heading">sign in now</h2>
		        <p style="padding-left:4%; padding-top:2%;  color:black ;font-size:16px;
			font-weight:bold;">
		        	<?php if($errormsg){
echo htmlentities($errormsg);
		        		}?></p>

		        		<p style="padding-left:4%; padding-top:2%;  color:green">
		        	<?php if($msg){
echo htmlentities($msg);
		        		}?></p>
		        <div class="login-wrap">
		            <input type="text" class="form-control" name="username" placeholder="Email"  required autofocus>
		            <br>
		            <input type="password" class="form-control" name="password" required placeholder="Password">
		            <label class="checkbox">
		                <span class="pull-right">
		                    <a data-toggle="modal" href="login.html#myModal"> Forgot Password?</a>
		
		                </span>
		            </label>
		            <button class="btn btn-theme btn-block" name="submit" type="submit"><i class="fa fa-lock"></i> SIGN IN</button>
		            <hr>
		           </form>
		           
		
		        </div>
		
		          <!-- Modal -->
		           <form class="form-login" name="forgot" method="post">
		          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
		              <div class="modal-dialog">
		                  <div class="modal-content">
		                      <div class="modal-header">
		                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		                          <h4 class="modal-title">Forgot Password ?</h4>
		                      </div>
		                      <div class="modal-body">
		                          <p>Enter your details below to reset your password.</p>
<input type="email" name="email" placeholder="Email" autocomplete="off" class="form-control" required><br >
<input type="text" name="contact" placeholder="contact No" autocomplete="off" class="form-control" required><br>
 <input type="password" class="form-control" placeholder="New Password" id="password" name="password"  required ><br />
<input type="password" class="form-control unicase-form-control text-input" placeholder="Confirm Password" id="confirmpassword" name="confirmpassword" required >

		
		                      </div>
		                      <div class="modal-footer">
		                          <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
		                          <button class="btn btn-theme" type="submit" name="change" onclick="return valid();">Submit</button>
		                      </div>
		                  </div>
		              </div>
		          </div>
		          <!-- modal -->
		          </form>
		
		      	  	
	  	
	  	</div>
	  </div>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    <!--BACKSTRETCH-->
    <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
    <script type="text/javascript" src="assets/js/jquery.backstretch.min.js"></script>
    <script>
        $.backstretch("assets/img/jj.jpg", {speed: 500});
    </script>


  </body>
</html>
