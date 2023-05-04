<?php
    require_once "./CommonInterface.php";
    require_once "./permissions.php";
    require_once './DatabaseInterface.php';
    $databaseObj = new DatabaseInterface();
    $userid = $_SESSION['userid'];

  
$input = json_decode(file_get_contents('php://input'),false);
if ($_SESSION['user']=='admin' && isset($_FILES["fileToUpload"]["name"])){
    if (isset($_POST['sub'])){
    // $_SESSION["sub"] = $_POST['sub'] ;
    require_once "./upload2.php";
    $img = upload($_FILES);

    if ($img){
        $sub = $_POST['sub'] ;
        if ($data = $databaseObj->new_sub($sub,$img)){
            
            die(header('./upload_sub.php?succses="1"')) ;
        }
    
        else{
            die(header('./upload_sub.php?succses="2"')) ;
       
        }
    }
    else{
        require_once './upload_sub.php';
        die() ;
       
       
    }
    }
    else{ 
    if (isset($_POST['lesson'])){
        $_SESSION['lesson'] = $_POST['lesson'] ;
        require_once "./upload2.php";
        $text = upload_text($_FILES);
        if ($text){
            $lesson = $_POST['lesson'] ;
            if ($data = $databaseObj->new_lesson($lesson,$text,$_SESSION["sub"])){
                echo "<script>alert('".$data."')</script>" ;
            require_once './upload_record.php';
            die() ;
        }
    
        else{
            echo "<script>alert('error')</script>";
            require_once './upload_lesson.php';
            die() ;
       
        }
    }
    else{
        require_once './upload_lesson.php';
        die() ;
           
        }
    }
    if (isset($_POST['add_record'])){
        require_once "./upload2.php";
        $record = upload_record($_FILES);
        if ($record){
            $lesson = $_SESSION['lesson'] ;
            if ($data = $databaseObj->add_record($lesson,$record)){
                echo "<script>alert('".$data."')</script>" ;
            require_once './upload_lesson.php';
            die() ;
        }
    
        else{
            echo "<script>alert('error')</script>";
            require_once './upload_record.php';
            die() ;
       
        }
    }
    else{
        require_once './upload_record.php';
        die() ;
           
        }
    }
}
}
else{
if(!is_object($input))
{
    return_error("nice try :)");
}

if(!isset($input->action))
{
    return_error("nice try :)");
}

switch ($input->action)
{ 
    case "new_un":
        if ($data = $databaseObj->change_username($_SESSION['userid'],$input->data)){
            $_SESSION["user"] = $input->data;
            return_success($data);
            }
        else{
        
            return_error("Malformed request");
        }
        
        
    break;

    case "get_posts":
        if ($data = $databaseObj->get_posts($_SESSION['userid'],$input->lesson_id)){
         
        return_success($data);
            
        }
        else{
            return_error("Malformed request");
        }

    break;
    case "add_post":
        if ($databaseObj->NewPost($userid, $input->data, $input->lesson_id ))
        {
            return_success($input->data);
        }
        else
        {
            return_error("Malformed request");
        }
        break;

    case "edit_post":
        if ($databaseObj->EditPost($input->post_id, $input->data))
        {
            return_success($input->data);
        }
        else
        {
            return_error("Malformed request");
        }
        break;

    case "change_pw":
    if ($data = $databaseObj->change_pw($_SESSION['userid'],$input->data)){
        return_success($data);
    }
    else
    {
        return_error("Malformed request");
    }
    break;

    case "download":
       // return_success($values["id"]);
        switch ($input->data)
        {
            case "all" :
                
                if ($data = $databaseObj->download($_SESSION["userid"],$input->lesson_id,1)){
                    return_success($data);
                }
                else
                {
                    return_error("Malformed request");
                }
                break;
            case "pdf":
                if ($data = $databaseObj->download($_SESSION["userid"],$input->lesson_id,2)){
                    
                    return_success($data);
                }
                else
                {
                    return_error("Malformed request");
                }
                break;
            case "rec" :
                if ($data = $databaseObj->download($_SESSION["userid"],$input->lesson_id,3)){
                    return_success($data);
                }
                else
                {
                    return_error("Malformed request");
                }
                break;
        }
        break;

        case "get_subs":
            if ($data = $databaseObj->get_subs()){
                return_success($data);
            }
            else
            {
                return_error("Malformed request");
            }
            break;

        case "get_lessons":
            if ($data = $databaseObj->get_lessons($_SESSION['sub'])){
                return_success($data);
            }
            else
            {
                return_error("Malformed request");
            }
            break;
        case "get_downloads":
            if ($data = $databaseObj->get_downloads(intval($input->data))){
                return_success($data);
            }
            else
            {
                return_error("Malformed request");
            }
            break;
        case "get_all_downloads":
            if ($_SESSION['user']=='admin' && $data = $databaseObj->get_downloads("all")){
                return_success($data);
            }
            else
            {
                return_error("Malformed request");
            }
            break;
        case "logout":
            session_destroy();
            return_success("logged out");
            break;
        // If the action is not recognized, return an error
        default:
        return_error("Malformed request");

}


}


   
?>