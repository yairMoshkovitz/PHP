<?php  
        require_once "./permissions.php";
    
        
        $user     = $_SESSION["user"];
        $userid   = $_SESSION["userid"];
       
        $_SESSION['sub']  = $_GET['sub'] ;
        
 ?>
    <!DOCTYPE html>
    <html>
    <head>
  <title>Lessons</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="./assets/css/bootstrap4.min.css"  crossorigin="anonymous">
  <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="./assets/css/custom.css">

    <script src="./assets/js/jquery.min.js"></script>
    <script src="./assets/js/bootstrap.min.js"></script>
    <style>
    span{
        font-size: 25px;
        direction:rtl;
text-align: right;
    }
    </style>
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
      <li><a href="./main.php">נושאים</a></li>
      <li><a href="./my_downloads.php">היסטורית הורדות</a></li>
      <li><a href="./profile.php">Edit profile</a></li>
    </ul>
<br>

        <br>
        <br>
        <div id ="result" class="col-md-6 offset-3" ></div>
        <?php if ($user=="admin"){ echo '<a class="btn btn-primary offset-5" target = "_blank" href="./upload_lesson.php">העלאת שיעורים</a>' ;} ?>
     

    <script src="./assets/pages/helper.js"></script>
     <script>
      AjaxMethod({"action":"get_lessons"},function (data) {
        console.log(data.data);
        $("#result").html(data.data);
      });  
      function click_btn(e){
        lesson_id = e.parentElement.parentElement.id ;
        console.log(lesson_id);
        data = e.value; 
        if ((e).name=="pdf"){
          alert("מומלץ לפתוח עם firefox");
          window.open("./downloads.php?pdf="+data , "_blank");
        }
        else if ((e).name=="rec"){
          var result = document.getElementsByName(lesson_id+"rec")[0];
          if (result.style.display=="block"){
            result.style.display="none";
          return
          }
          else{
          audio = '<div class="row"><audio controls><source src="records/'+data+'" type="audio/mpeg"> element.</audio></div>' ;
          result.innerHTML=audio;
          result.style.display="block";
          window.open("./downloads.php?rec="+data , "_blank");
          }
        }
        else if ((e).name=="posts"){
          var result = document.getElementsByName(lesson_id+"posts")[0]
          if (result.style.display=="block"){
            result.style.display="none";
          }
          else{
            result.style.display="block";
            AjaxMethod({"action":"get_posts","lesson_id":lesson_id},function (data) {
              result.innerHTML=data.data;
            
            });
          }
          return
        }
        else if ((e).name=="all") {
          data = data.split(",");    
          window.open("./downloads.php?pdf="+data[0] , "_blank");
          window.open("./downloads.php?rec="+data[1] , "_blank");
        }

        AjaxMethod({"action":"download","data":e.name,"lesson_id":lesson_id},function () {
        //    $("div[name="+lesson_id+"]").html(data)
          });
      };
      function add_post (e, lesson_id){
        data = $("#msg").val();
        AjaxMethod({"action":"add_post","data":data,"lesson_id":lesson_id},function (data) {
          alert(data.data);
          location.reload();
          });
      }
      function post_edit(obj) {
    $(obj.parentNode).html("<input class='full-width' value='"+obj.previousSibling.data+"'/><input type='button' value='save' onclick='post_save(this);'/>");
}

function post_save(obj) {
    AjaxMethod({"action":"edit_post","data":obj.previousSibling.value,"post_id":obj.parentNode.nextSibling.value},function (data) {
		if (data["success"] == true)	{
      alert("succses");
    location.reload();	
    }
    });
}


     </script>
    </body>
    </html>

    
    
    
