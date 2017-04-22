<?php
session_start();
require_once 'class.user.php';

$reg_user = new USER();

if($reg_user->is_logged_in()!="")
{
	$reg_user->redirect('home.php');
}


if(isset($_POST['btn-signup']))
{
	$mac = trim($_POST['txtmac']);
	$uname = trim($_POST['txtuname']);
	$email = trim($_POST['txtemail']);
	$upass = trim($_POST['txtpass']);
	$code = md5(uniqid(rand()));
	
	$stmt = $reg_user->runQuery("SELECT * FROM tbl_users WHERE userEmail=:email_id");
	$stmt->execute(array(":email_id"=>$email));
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	
	if($stmt->rowCount() > 0)
	{
		$msg = "
		      <div class='alert alert-error'>
				<button class='close' data-dismiss='alert'>&times;</button>
					<strong>Sorry !</strong>  이미 존재하는 이메일 주소입니다 , 다른 이메일 주소를 사용하시기 바랍니다. 
			  </div>
			  ";
	}
	else
	{
		if($reg_user->register($mac,$uname,$email,$upass,$code))
		{			
			$id = $reg_user->lasdID();		
			$key = base64_encode($id);
			$id = $key;
			
			$message = "					
						안녕하세요 $uname,님
						<br /><br />
						io2LIFE에 오신것을 환영합니다!<br/>
						회원가입 절차를 마치시려면 아래의 링크를 클릭하세요...<br/>
						<br /><br />
						<a href='https://iot2ym.iptime.org/io2life/verify.php?id=$id&code=$code'>계정을 활성화 하시려면 여기를 클릭하세요! ^*^</a>
						<br /><br />
						감사합니다,";
						
			$subject = "io2LIFE 회원가입 확인 메일... ";
						
			$reg_user->send_mail($email,$message,$subject);	
			$msg = "
					<div class='alert alert-success'>
						<button class='close' data-dismiss='alert'>&times;</button>
						<strong>성공하였습니다!</strong>  작성하신 이메일로 확인 메일이 발송되었습니다.
                    이메일을 확인하시고 링크를 클릭하여 회원가입을 마치시기 바랍니다. 
			  		</div>
					";
		}
		else
		{
			echo "sorry , Query could no execute...";
		}		
	}
}
?>


<!DOCTYPE html>
<html lang="ko">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Signup | io2LIFE</title>

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
				<?php if(isset($msg)) echo $msg;  ?>

					<div class="row">
                        <div class="col-sm-6 col-sm-offset-3 form-box">
                        	<div class="form-top">
                        		<div class="form-top-left">
                        			<h3>회원가입 | <b>io2LIFE</b></h3>
                            		<p>새로 회원가입을 원하시면,,, 기기일련번호, 아이디, 이메일주소, 비밀번호 입력하세요:</p>
                        		</div>
                        		<div class="form-top-right">
                        			<i class="fa fa-key"></i>
                        		</div>
                            </div>
                            <div class="form-bottom">
			                    <form role="form" action="" method="post" class="login-form">
			                        <div class="form-group">
			                        	<label class="sr-only" for="form-password">MAC</label>
			                        	<input type="text" name="txtmac" placeholder="기기일련번호..." class="form-username form-control" id="txtmac" required />
			                        </div>
			                    	<div class="form-group">
			                    		<label class="sr-only" for="form-username">Username</label>
										<input type="text" name="txtuname" placeholder="아이디..." class="form-username form-control" id="txtuname" required />
			                        </div>
			                    	<div class="form-group">
			                    		<label class="sr-only" for="form-username">Email</label>
										<input type="text" name="txtemail" placeholder="이메일..." class="form-username form-control" id="txtemail" required />
			                        </div>
			                        <div class="form-group">
			                        	<label class="sr-only" for="form-password">Password</label>
			                        	<input type="password" name="txtpass" placeholder="비밀번호..." class="form-password form-control" id="txtpass" required />
			                        </div>
			                        <button type="submit" class="btn" name="btn-signup">회원가입!</button>
									<br></br>
									이미 회원이세요? <a href="index.php"><b>여기서 로그인</b></a>
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