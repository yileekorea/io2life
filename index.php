<?php
// server should keep session data for AT LEAST 1 hour
ini_set('session.gc_maxlifetime', (30*24*60*60));

// each client should remember their session id for EXACTLY 30days
session_set_cookie_params(30*24*60*60);

session_start();

require_once 'class.user.php';

$user_login = new USER();


$cookie = isset($_COOKIE['MzRemember']) ? $_COOKIE['MzRemember'] : '';
if (($cookie) && ($user_login->is_logged_in()!="")) {
	list ($email, $token, $mac) = explode(':', $cookie);
	if (!hash_equals(hash_hmac('sha256', $email . ':' . $token, '1@3$5^7*'), $mac)) {
		return false;
	}
	$usertoken = 'f0411fa6fef2c594057d5904b1624e0d';
	if (hash_equals($usertoken, $token)) {
		$_SESSION['start'] = time(); // Taking now logged in time.
		// Ending a session in 30 minutes from the starting time.
		$_SESSION['expire'] = $_SESSION['start'] + (30 * 24 * 60 * 60);	//In days : (n * 24 * 60 * 60 ) n = no of days 

		$user_login->redirect('home.php');
	}
}

/*
if(($user_login->is_logged_in()!="") && isset($_COOKIE['MzRemember']))
{

	$_SESSION['start'] = time(); // Taking now logged in time.
	// Ending a session in 30 minutes from the starting time.
	$_SESSION['expire'] = $_SESSION['start'] + (30 * 24 * 60 * 60);	//In days : (n * 24 * 60 * 60 ) n = no of days 

	$user_login->redirect('home.php');
}
*/

if(isset($_POST['btn-login']))
{
	$email = trim($_POST['txtemail']);
	$upass = trim($_POST['txtupass']);
	
	if($user_login->login($email,$upass))
	{

		$token = 'f0411fa6fef2c594057d5904b1624e0d';
		//$token = mcrypt_create_iv(); // generate a token, should be 128 - 256 bit
		$cookie = $email . ':' . $token;
		$mac = hash_hmac('sha256', $cookie, '1@3$5^7*');
		$cookie .= ':' . $mac;
		setcookie('MzRemember', $cookie);

//		setcookie('MzRemember',$_POST['rememberMe']);
		$user_login->redirect('home.php');
	}
}
?>


<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login | io2Life</title>

        <!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="assets/css/form-elements.css">
        <link rel="stylesheet" href="assets/css/style.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="assets/ico/favicon.png">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">

    </head>

    <body>

        <!-- Top content -->
        <div class="top-content">
        	
            <div class="inner-bg">
                <div class="container">
					<?php 
					if(isset($_GET['inactive']))
					{
						?>
						<div class='alert alert-error'>
							<button class='close' data-dismiss='alert'>&times;</button>
							<strong>죄송합니다!</strong> 이 계정은 활성화 되지 않았습니다. 가입때 사용하신 이멜일에서 활성화 링크를 누르세요. 
						</div>
						<?php
					}
					?>

						<?php
						if(isset($_GET['error']))
						{
							?>
							<div class='alert alert-success'>
								<button class='close' data-dismiss='alert'>&times;</button>
								<strong>입력 내용이 틀립니다!</strong> 
							</div>
							<?php
						}
						?>

                    <div class="row">

                        <div class="col-sm-6 col-sm-offset-3 form-box">
                        	<div class="form-top">
                        		<div class="form-top-left">
                        			<h3>로그인 | <b>io2Life</b></h3>
                            		<p>로그인 하기를 원하시면,,, 이메일 주소와 비밀번호 입력하세요:</p>
                        		</div>
                        		<div class="form-top-right">
                        			<i class="fa fa-key"></i>
                        		</div>
                            </div>
                            <div class="form-bottom">
			                    <form role="form" action="" method="post" class="login-form">
			                    	<div class="form-group">
			                    		<label class="sr-only" for="form-username">Username</label>
										<input type="text" name="txtemail" placeholder="이메일 주소..." class="form-username form-control" id="txtemail" required />
			                        </div>
			                        <div class="form-group">
			                        	<label class="sr-only" for="form-password">Password</label>
			                        	<input type="password" name="txtupass" placeholder="비밀번호..." class="form-password form-control" id="txtupass" required />
					<label>
						<input name="rememberMe" id="rememberMe" type="checkbox" checked="checked" value="1" />
						&nbsp;Remember me
					</label>		</div>
			                        <button type="submit" class="btn" name="btn-login">로그인!</button>
									<br></br>
									처음 오셨어요? <a href="signup.php"><b>여기서 가입</b></a>
			                    </form>
		                    </div>
                        </div>
                    </div>
					<div class="row">
						<div class="col-md-4 col-md-offset-4 text-center">	
							<a href="fpass.php">비밀번호 찾기 ? </a>
						</div>
					</div>
                </div>
            </div>
            
        </div>


        <!-- Javascript -->
        <script src="assets/js/jquery-1.11.1.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.backstretch.min.js"></script>
        <script src="assets/js/scripts.js"></script>
        
        <!--[if lt IE 10]>
            <script src="assets/js/placeholder.js"></script>
        <![endif]-->

    </body>

</html>