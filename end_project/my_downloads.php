<?php  
        require_once "./permissions.php";
    
        
        $user     = $_SESSION["user"];
        $userid   = $_SESSION["userid"];
       
       
        
 ?>
    <!DOCTYPE html>
    <html>
    <head>
  <title>Lessons</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
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
      <a class="navbar-brand" href="#">הסטורית הורדות</a>
    </div>
    <br>
    <ul class="nav navbar-header">
      <li><a href="./main.php">נושאים</a></li>
      <li><a href="./profile.php">Edit profile</a></li>
    </ul>
<br>
        <br>
        <br>
        
        <div id ="result" ></div>
        <?php if ($user=="admin"){ echo '
        <button class="btn btn-defult" id="all_downloads">כל ההורדות</button>
        <script>$("#all_downloads").click(function(data){
            
            AjaxMethod({"action":"get_all_downloads"},function (data) {
        console.log(data.data);
        $("#result").html(data.data);
    });
        });
     </script>'; } ?>
    <script src="./assets/pages/helper.js"></script>
     <script>
        user_id =  <?php echo $userid ; ?> ;
      AjaxMethod({"action":"get_downloads","data":user_id},function (data) {
        console.log(data.data);
        $("#result").html(data.data);
    });
        
       
        
     </script>
    </body>
    </html>

    
    
    
