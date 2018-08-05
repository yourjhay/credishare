<?php
include_once('core/function.php');
if(isLogin() == true) {
    $message = "WELCOME BACK";
} else {
    header('location: index.php');
}

if(isset($_GET['logout'])) 
{
    include_once('core/logout.php');
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

    <title><?php echo $_SESSION['username']?></title>
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
            <a class="nav-link" href="admin/dashboard.php">Dashboard</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="https://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['username']?></a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
              <a class="dropdown-item" href="#">Update Profile</a>
              <a class="dropdown-item" href="#">Settings</a>
              <a href="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>?logout=ref"  class="dropdown-item" href="#">Logout</a>
            </div>
          </li>
        </ul>
        
      </div>
    </nav>
<div class="container">
<div id="notifier" class="alert alert-danger d-none"></div>
    <div class="jumbotron jumbotron-fluid">
        <div class="container" id="main_container">
           <div id="main_">
               <img style="margin-left:40%;" src="assets/images/Pacman-1s-96px.svg">
           </div>
            <p class="lead">This is your current credits. You  can see your transaction below.</p>
        </div>
    </div>
    <div id="history">
    </div>
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
            var username = "<?php echo $_SESSION['username']?>";
            $.ajax({
                    type:"post",
                    url:"core/mycredits.php",
                    data:{action:"getcredits",user:username},
                    success: function(response)  {
                        $('#main_').html(response);
                        getmyHistory(username);
                    },
                 error: function(){
                        $('#notifier').removeClass('d-none');
                 }
            });
        });
        function getmyHistory(e)
        {
            var username = e;
                 $.ajax({
                    type:"post",
                    url:"core/mycredits.php",
                    data:{action:"gethistory",user:username},
                    success: function(response)  {
                        $('#history').html(response);   
                    },
                     error: function(){
                        $('#notifier').removeClass('d-none');
                 }
                     
            });
        }
    </script>
</body>
</html>