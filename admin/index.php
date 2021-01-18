<?php
session_start();
error_reporting(0);
include("include/config.php");
if(isset($_POST['submit']))
{
	$username=$_POST['username'];
	$password=md5($_POST['password']);
$ret=mysqli_query($con,"SELECT * FROM admin WHERE username='$username' and password='$password'");
$num=mysqli_fetch_array($ret);
if($num>0)
{
$extra="change-password.php";//
$_SESSION['alogin']=$_POST['username'];
$_SESSION['id']=$num['id'];
$host=$_SERVER['HTTP_HOST'];
$uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
header("location:http://$host$uri/$extra");
exit();
}
else
{
$_SESSION['errmsg']="Invalid username or password";
$extra="index.php";
$host  = $_SERVER['HTTP_HOST'];
$uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
header("location:http://$host$uri/$extra");
exit();
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>CMS | Admin login</title>
	<link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link type="text/css" href="css/theme.css" rel="stylesheet">
	<link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
	<link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
	<style>
		.module-head{
			background:green;
			
		}
		.module-head h3{
			color:white;
		}
		.control-group{
			
			background:rgba(255,255,255,0.1);
		}
		
		  .row-fluid [class*="span"]{
			width:100%;
			background:rgba(255,255,255,0.1);
			border:5px solid black;
			outline:none;
			padding:10px,20px;
			border-radius:35px;
			border:1px solid black;
			/* border-right:1px solid rgba(255,255,255,0.2);
			border-bottom:1px solid rgba(255,255,255,0.2); */
			font-size:16px;
			letter-spacing:1px;
			color:black;
			box-shadow:0 25px 45px rgba(0,0,0,0.2);
			font-weight:bold
		}
		.btn{
			background:white;
			color:#666;
			max-width:100px;
			cursor:pointer;
			font-weight:600;
			box-shadow:0 25px 45px rgba(0,0,0,0.2);
			border-radius:35px;
		}
		.wrapper{
			/* background-image:url(images/bb.jpg.jpg);
			background-position: center; 
			background-repeat: no-repeat; */
			width: 100%;
    height: 300px;
    display: flex;
    justify-content: center;
    align-items: center;
    background: -webkit-linear-gradient(left, green, white);
    font-family: 'Nunito', sans-serif;
		}
		.co{
			width:85px;
			height:57px;
			position:absolute;
			top:-6px;
			left:-4px;
		}
		.brand{
			position:absolute;
			top:-1px;
			left:70px;
			
		}
		
	</style>
</head>
<body>

	<div class="navbar navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">
					<i class="icon-reorder shaded"></i>
				</a>
                <img   class="co" src="images/mono.png" alt="">
			  	<a class="brand" href="#">
			  		UON Student Service Portal | Admin
			  	</a>

				<div class="nav-collapse collapse navbar-inverse-collapse">
				
					<ul class="nav pull-right">

						<li><a href="../">
						Back to Portal
						
						</a></li>

						

						
					</ul>
				</div><!-- /.nav-collapse -->
			</div>
		</div><!-- /navbar-inner -->
	</div><!-- /navbar -->



	<div class="wrapper">
		<div class="container">
			<div class="row">
				<div class="module module-login span4 offset4">
					<form class="form-vertical" method="post">
						<div class="module-head">
							<h3>Sign In</h3>
						</div>
						<span style="color:red;" ><?php echo htmlentities($_SESSION['errmsg']); ?><?php echo htmlentities($_SESSION['errmsg']="");?></span>
						<div class="module-body">
							<div class="control-group">
								<div class="controls row-fluid">
									<input class="span12" type="text" id="inputEmail" name="username" placeholder="Username">
								</div>
							</div>
							<div class="control-group">
								<div class="controls row-fluid">
						<input class="span12" type="password" id="inputPassword" name="password" placeholder="Password">
								</div>
							</div>
						</div>
						<div class="module-foot">
							<div class="control-group">
								<div class="controls clearfix">
									<button type="submit" class="btn btn-primary pull-right" name="submit">Login</button>
									
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div><!--/.wrapper-->

	<div class="footer">
		<div class="container">
			 

			<b class="copyright">&copy; 2021 UON Student Service Portal </b> All rights reserved.
		</div>
		 <!-- <div style="margin-left:250px;">
		 <div class="aligncenter">
     <script type="text/javascript">
       	amzn_assoc_ad_type = "banner";
	amzn_assoc_marketplace = "amazon";
	amzn_assoc_region = "US";
	amzn_assoc_placement = "assoc_banner_placement_default";
	amzn_assoc_campaigns = "amzn_music_bounty";
	amzn_assoc_banner_type = "category";
	amzn_assoc_isresponsive = "true";
	amzn_assoc_banner_id = "1GTA90RTC5R9V7HJA902";
	amzn_assoc_tracking_id = "fashion120eb-20";
	amzn_assoc_linkid = "c08e19baee7fb40a6f2aef3702ff26cf";
     </script>
     <script src="//z-na.amazon-adsystem.com/widgets/q?ServiceVersion=20070822&Operation=GetScript&ID=OneJS&WS=1"></script>
    </div> -->
	<!-- </div> -->
	</div>
	<script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
	<script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
	<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
</body>