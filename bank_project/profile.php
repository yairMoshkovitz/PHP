<?php
    // Require the files needed for database interaction and user permissions

    require_once "./permissions.php";
    require_once './DatabaseInterface.php';

    

    $user     = $_SESSION["user"];
    $userid   = $_SESSION["userid"];

   
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Profile</title>
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
      <a class="navbar-brand" href="#">Profile</a>
    </div>
    <br>
    <ul class="nav navbar-header">
      <li class="active"><a href="./main.php">My trans</a>
      <li><a href="./trans.php">New trans</a></li>
      <li><a href="./load.php">load momey</a></li>
    </ul>
</div>



    <div class="container col-md-offset-3 col-md-6">
        <div class="form-group col-md-8 col-md-offset-2">

            <div class="panel panel-default">
                <div class="panel-heading"><h3>Helow <?php echo $user ?></h3></div>
                    <div class="panel-body" id="load-panel">
                
                    
                                <div id ="ch_passwd" >
                                    <div class="input group">
                                        <label for="change password">New password: </label>
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                        <input name="change_password" class="form-control" type="password" id="new_pw" placeholder= "choose a strong password">
                                    </div>
                                    <br>
                                    <div class="input group">
                                        <label for="change password">confirm password: </label>
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                        <input name="confirm_password" class="form-control" type="password" id="confirm_pw" placeholder= "confirm the password">
                                    </div>
                                    <br>
                                    <button id = 'submit' type="submit" class="col-md-3 btn btn-default" style="background-color: #f5f5f5" >Submit</button>
                                    <div class= "col-offset-6 col-md-3">
                                        <input id='ch_user' type='submit' class='btn btn-primary mt-2' name='submit' value= 'Change user name'>
                                    </div><br>
                                </div>


                                <div id ="ch_user_name" style="display:none">
                                    <div class="input group" >
                                        <label for="change user_name">New user name: </label>
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input name="change_user_name" class="form-control" type="text" id="new_un" placeholder= "choose new name">
                                    </div>
                                    <br>
                                    <button id = 'submit2' type="submit" class="col-md-3 btn btn-default" style="background-color: #f5f5f5" >Submit</button>
                                    <div class= "col-offset-6 col-md-3">
                                    <input id='ch_pw' type='submit' class='btn btn-primary mt-2' name='submit' value= 'Change password'>
                                    </div><br>
                                </div>
                            



                            

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="./assets/pages/helper.js"></script>

            <script>
                 $("#submit").click(function(){
                    new_pw = $("#new_pw").val();
                    if (new_pw == $("#confirm_pw").val()){
                        AjaxMethod({"action":"change_pw","data":new_pw},function (data) {
                            alert(data.data.data);   
                        });
                    }
                    else{
                        alert("confirm your password");
                    }
                });
                $("#submit2").click(function(){
                    new_un = $("#new_un").val();
                    AjaxMethod({"action":"new_un","data":new_un},function (data) {
                            alert(data.data.data);
                            location.reload() ; 
                        
                        }
                        
                );

                });

                
                
                $("#ch_user").click(function(){
                    document.getElementById("ch_user_name").style.display = "block" ;
                    document.getElementById("ch_passwd").style.display = "none" ;
                });
                $("#ch_pw").click(function(){
                    document.getElementById("ch_passwd").style.display = "block" ;
                    document.getElementById("ch_user_name").style.display = "none";
                });

              
            </script>
    </body>
</html>