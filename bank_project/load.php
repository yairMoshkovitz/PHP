<?php
    require_once "./permissions.php";
    // require_once './DatabaseInterface.php';
    
    // $databaseObj = new DatabaseInterface();

    $user     = $_SESSION["user"];
    $userid   = $_SESSION["userid"];

    // if (isset($_POST["money"])){
    //     if ($databaseObj->load($userid,$_POST["money"])){
    //         echo "<script>alert('success')</script>";
    //     }
        
    // }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Load money</title>
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
      <a class="navbar-brand" href="#">Load money</a>
    </div>
    <br>
    <ul class="nav navbar-header">
      <li class="active"><a href="./main.php">My trans</a>
      <li><a href="./trans.php">New trans</a></li>
      <li><a href="./profile.php">Edit profile</a></li>
    </ul>
</div>



    <div class="container col-md-offset-3 col-md-6">
        <div class="form-group col-md-8 col-md-offset-2">

            <div class="panel panel-default">
                <div class="panel-heading"><h3>Load money</h3></div>
                    <div class="panel-body" id="load-panel">
                
                    
                                <div class="input group">
                                    <label for="money">Money to load: </label>
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></span>
                                    <input name="money" class="form-control" type="number" id="money" placeholder= "How mach money you want to load?">
                                </div>
                                <br>
                                <button id="submit" type="submit" class="btn btn-default" style="background-color: #f5f5f5" >Submit</button>
                                <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="./assets/pages/helper.js"></script>
  
            <script>
                $("#submit").click(function(){
                    $money =$("#money").val();
                    AjaxMethod({"action":"load","data":$money},function (data) {
                        console.log(data.data.data);
                        alert(data.data.data);
                    });
                });
            </script>
    </body>
</html>