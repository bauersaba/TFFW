<?php

include'connect.php';
$e = '';
// is set 
if(isset($_POST['sub'])){
    $u=$_POST['user'];
    $p=$_POST['pass'];
    
   $s= "select * from usuario_dadospessoais where nomeUsuario='$u' and senha= '$p'";   
   $qu= mysqli_query($con, $s);
   if(mysqli_num_rows($qu)>0){
      $f= mysqli_fetch_assoc($qu);
      $_SESSION['id']=$f['id'];
      header ('location:index.php');
      
   }
   else{
     
          $e = 'username or password does not exist';
   }
  
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="AdminLTE-3.2.0/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="AdminLTE-3.2.0/dist/css/adminlte.min.css">

  <link rel="stylesheet" href="css/login.css">
</head>
<body class="hold-transition login-page">
     <div class="container" id="container">
          <div class="form-container sign-up-container">
               <form method="post">
                    <h1>Create Account</h1>
                    <div class="social-container">
                         <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                         <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                         <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                    <span>or use your email for registration</span>
                    <input type="text" placeholder="Name" />
                    <input type="email" placeholder="Email" />
                    <input type="password" placeholder="Password" />
                    <button>Sign Up</button>
               </form>
          </div>
          <div class="form-container sign-in-container">
               <form method="post">
                    <h1>Sign in</h1>
                    <div class="social-container">
                         <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                         <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                         <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                    <span>or use your account</span>
                    <input type="text" name="user" placeholder="Email" />
                    <input type="password" name="pass" placeholder="Password" />
                    <span><?php echo $e; ?></span>
                    <a href="#">Forgot your password?</a>
                    <button type="submit" name="sub">Sign In</button>
               </form>
          </div>
          <div class="overlay-container">
               <div class="overlay">
                    <div class="overlay-panel overlay-left">
                         <h1>Welcome Back!</h1>
                         <p>To keep connected with us please login with your personal info</p>
                         <button class="ghost" id="signIn">Sign In</button>
                    </div>
                    <div class="overlay-panel overlay-right">
                         <h1>Hello, Friend!</h1>
                         <p>Enter your personal details and start journey with us</p>
                         <button class="ghost" id="signUp">Sign Up</button>
                    </div>
               </div>
          </div>
     </div>

<!-- jQuery -->
<script src="AdminLTE-3.2.0/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="AdminLTE-3.2.0/dist/js/adminlte.min.js"></script>

<script src="js/login.js"></script>
</body>
</html>
