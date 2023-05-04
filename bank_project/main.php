<?php  
        require_once "./permissions.php";
        require_once './DatabaseInterface.php';
    
        $databaseObj = new DatabaseInterface();

        $user     = $_SESSION["user"];
        $userid   = $_SESSION["userid"];
       
        // echo gettype($userid);
        // die();  
        $balance = $databaseObj->GetBalance($userid) ;
        $_SESSION["balance"] = $balance['data']['balance'] ;
        
        $data = $databaseObj->GetMyTrans($userid);   
        
 ?>
 <!DOCTYPE html>
<html lang="en">
<head>
  <title>My trans</title>
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
                      <!-- insert the table of trans that send from database -->

        <a class="navbar-brand" href="#">Hello <?php echo $user ."! your balance is: ".$_SESSION["balance"]."$"
        ?></a>
</div>
        <ul class="nav navbar-nav" style="float: right">
            <li><a href="#" id="logout">Logout</a></li>
        </ul>
    </div>
      </nav>

  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">My trans</a>
    </div>
    <br>
    <ul class="nav navbar-header">
      <li><a href="./trans.php">New trans</a></li>
      <li><a href="./load.php">Load money</a></li>
      <li><a href="./profile.php">Edit profile</a></li>
    </ul>
  </div>

  

  
<div class="container col-sm-4 col-md-offset-4">
  
  <table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">from</th>
      <th scope="col">to</th>
      <th scope="col">money</th>
      <th scope="col">date</th>
    </tr>
  </thead>
  
    
    
  
 <tbody id= 'input'> 
  <?php 
  //if($all_data){echo $all_data,'<h1>aaa</h1>';} else {
    echo $data;
   // } 
    ?>
</tbody></table></div>

<!-- <form id = "from" action="POST" > -->
  
  

    <?php if($userid == 1){ echo "<input id='all' type='submit' class='btn btn-primary mt-2' name='submit' value= 'get all trans'>";} ?>
  
<!-- </form> -->
</div>
<script src="./assets/pages/helper.js"></script>

<script>
  $("#all").click(function(){
    AjaxMethod({"action":"all_trans"},function (data) {
        console.log(data.data);

    // $.post('main.php',{"action":"all_trans"},function(data){
      // console.log(data);
      document.getElementById("input").innerHTML = data.data;
   //    = data;
     });
  });
  
  $("#logout").click(function(){
    AjaxMethod({"action":"logout"},function (data) {
        console.log(data.data);
        window.location.assign("./index.php")
      });
  });
// $("#page").slideDown("slow");

   
// $.post('./DatabaseInterface.php',JSON.stringify({"action":"Get_My_Trans"}), function(data){
//     $("#aaa").html(data.data); 
// });

//   $("#form").submit(function(){
//       $.get('api.php',function(data,status){
//       console.log(data);
//     });
//   });

</script>


</body>
</html>