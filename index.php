<?php
$display='d-none';
$notice="";
include_once('core/function.php');
if(isLogin()==true){
    header('location:myaccount.php');
} 
    if(isset($_GET['notice']) && $_GET['notice'] == "signup_success")
    {
        $notice = "You have successfully register.";
        $display ='d-block';
    }
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>CrediShare 1.0</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <!-- Custom styles for this template -->
    <style type="text/css">
        body {
            padding-top: 5rem;
            margin:0;
            font-family: helvitica;
        }
        a
        {
            text-decoration: none;
            color: white;
        }
        a:hover
        {
            color: white;
            text-decoration: none;
            display:block;
        }
        
        @media(min-width:750px){
            .loginform
            {
                margin:auto;
                width: 40% !important;
            }
            .ml-auto
            {
                margin-right: 50px !important;
            }
        }
        
    </style>
</head>    
<body>
<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
      <a class="navbar-brand" href="#">Credishare</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a href="register.php" class="nav-link" href="#">Sign up</a>
          </li>
         <!-- <li class="nav-item">
            <a class="nav-link disabled" href="#">Disabled</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="https://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
              <a class="dropdown-item" href="#">Action</a>
              <a class="dropdown-item" href="#">Another action</a>
              <a class="dropdown-item" href="#">Something else here</a>
            </div>
          </li> -->
        </ul>
        
      </div>
    </nav>

<div class="loginform container">
   <div class="alert alert-success <?php echo $display?>"><?php echo $notice ?></div>
<form method="POST" id ="auth" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
       <div id="result_auth"></div>
        <div class="form-group">
            <label for="exampleInputEmail1">Email address or Username</label>
            <input type="text" class="form-control" id="username" aria-describedby="emailHelp" value="<?php echo $val=(isset($_GET['user']))?$_GET['user']:''?>" placeholder="Username">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" id="password" placeholder="Password">
        </div>

        <button type="submit" class="btn btn-primary btn-block">Login</button>

        <button class="btn btn-primary btn-block"><a href="register.php">Register</a></button>
    </form>
</div>
<!-- /.container -->
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#auth').submit(function(e){
                e.preventDefault();
            var user = $('#username').val();
            var pass =  $('#password').val();
             $.ajax({
                type:"post",
                 url:"core/account.php",
                 data:{action:"auth",username:user,password:pass},
                 success:function(response){
                     if(response == "true")
                         {
                            $('#result_auth').html('<div class="alert alert-success">Login success. Please wait</div>');   
                             setTimeout("pageRedirect('true')", 5000);
                         } 
                        else if(response =="admin")
                        {
                           $('#result_auth').html('<div class="alert alert-success">Login success. Redirecting to dashboard</div>');   
                             setTimeout("pageRedirect('admin')", 5000);                   
                        } else { $('#result_auth').html('<div class="alert alert-danger">Invalid Username or Password</div>');     }
                 }
             });
              
            });
        });
        
         function pageRedirect(e) {
             var data = e;
             if( data == "true"){
            window.location.href = "myaccount.php";
             } else {
                   window.location.href = "admin/dashboard.php";
             }
            }      
   
    </script>
</body>
</html>