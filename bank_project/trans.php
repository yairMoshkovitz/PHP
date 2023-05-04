
<?php  
// Import necessary files and classes

        require_once "./permissions.php";
        require_once './DatabaseInterface.php';
    
        $databaseObj = new DatabaseInterface();

        // Get user data from session
        $user     = $_SESSION["user"];
        $userid   = $_SESSION["userid"];

        // Get all users from database
        $data = $databaseObj->get_users();        
 ?>
<!-- Start of HTML page -->
<!DOCTYPE html>
<html lang="en">
<head>
  <title>New trans</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Import CSS and JS files -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <script src="./assets/js/jquery.min.js"></script>
    <script src="./assets/js/bootstrap.min.js"></script>
 </head>
<!-- Start of HTML body -->
<body>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <!-- Display user name in navbar -->
            <a class="navbar-brand" href="#">Hello <?php echo $user ?></a>
        </div>

    <!-- Add logout button to navbar -->
    <ul class="nav navbar-nav" style="float: right">
        <li><a href="#" id="logout">Logout</a></li>
    </ul>
</div>
</nav>
<!-- Start of HTML container -->
<div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">New trans</a>
    </div>
    <br>
    <ul class="nav navbar-header">
      <!-- Add links to other pages in website -->
      <li><a href="./main.php">My trans</a>
      <li><a href="./load.php">Load money</a></li>
      <li><a href="./profile.php">Edit profile</a></li>
    </ul>
  </div>
<!-- Start of HTML form -->
<div class="container col-md-6 col-md-offset-3">
<div class="form-group col-md-8 col-md-offset-2">
<!-- Create panel for transfer form -->
<div class="panel panel-default">
    <div class="panel-heading"><h3>Transfers</h3></div>
        <div class="panel-body" id="trans-panel">
            <br>

        <!-- Add dropdown to select user to transfer to -->
        <label for="username">choose user to trans: </label>
        <span class="input-group-addon "><i class="glyphicon glyphicon-user"></i></span>
        <select name="user" id="username" title="choose user to trans" class="form-control " style="height:calc(3rem + 3px)">
            <?php echo $data;?>
        </select>
        <br>

        <!-- Add input field for amount of money to transfer -->
        <div class="input group">
        <label for="money">Money to trans: </label>
        <span class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></span>
        <input name="money" class="form-control" type="number" id="money" placeholder= "remamber your balance!">
</div>
<br>
  <button id = "submit" type="submit" class="btn btn-default" style="background-color: #f5f5f5" >Submit</button>
  <br>
</div>
</div>

</div> 
<script src="./assets/pages/helper.js"></script>

<script>
          // Handle form submission
          $("#submit").click(function(){
                    $money =$("#money").val();
                    $user_to_trans = $("#username").val();
                    AjaxMethod({"action":"trans","user_to_trans":$user_to_trans,"money":$money},function (data) {
                        console.log(data.data);
                        alert("success");
                    });
                });
</script>
</body>
</html>
