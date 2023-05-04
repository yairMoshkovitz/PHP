<?php
 require_once "./permissions.php";
    
        
 $user     = $_SESSION["user"];
 $userid   = $_SESSION["userid"];
?>
<style>
    .card-title{
        font-size: 25px;
text-align: right;
    }
    </style>
 <!DOCTYPE html>
    <html>
    <head>

  <title>Subs</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="./assets/css/bootstrap4.min.css"  crossorigin="anonymous">
  <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
  
    <script src="./assets/js/jquery.min.js"></script>
    <script src="./assets/js/bootstrap.min.js"></script>
  </head>
    <body>
    <nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
        <a class="navbar-brand" href="#">Hello <?php echo $user ?></a>
</div>
        <ul class="nav navbar-nav" style="float: right">
            <li><a href="#" id="logout">Logout</a></li>
        </ul>
    </div>
      </nav>

  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Torat aba</a>
    </div>
    <br>
    <ul class="nav navbar-header">
      <li><a href="./my_downloads.php">היסטורית הורדות</a></li>
      <li><a href="./profile.php">Edit profile</a></li>
    </ul>
<br><br>        <div class="col-md-8 offset-2"><?php if ($user=="admin"){ echo '<a class="btn btn-primary"  href="./upload_sub.php">נושא חדש</a><br><br>' ; } ?></div>

      
        <div id ="result" class=" col-md-8 offset-2" style="height:500px;"></div>
    <script src="./assets/pages/helper.js"></script>
     <script>
        AjaxMethod({"action":"get_subs"},function (data) {
        console.log(data.data);
        $("#result").html(data.data);
    });
      
     </script>
    </body>
    </html>

    