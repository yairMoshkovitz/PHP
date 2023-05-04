<?php

require_once './CommonInterface.php';

class DatabaseInterface
{
    const debug = true;

    public function __construct()
    {
        $this->MySQLdb = new PDO("mysql:host=127.0.0.1;dbname=tora", "root", "");
        $this->MySQLdb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function GetMySQLdb()
    {
        return $this->MySQLdb;
    }

    /*
     * CheckErrors - if debug mode is set we will output the error in the response, if the debug is off we will be redirected to 404.php
     */
    public function CheckErrors($e,$pass = false)
    {
        if ($pass == true) return true;

        if (self::debug){
            die($e->getMessage());
        }
        else
        {
            // return error if there is something strange in the database
            return_error(":)");
        }
    }
    public function test($table){
        try{
            $query = "SELECT * FROM ".$table ;
        $cursor = $this->MySQLdb->prepare($query);   
        $cursor->execute();
        $retval = "";
             foreach ($cursor->fetchAll() as $obj)
             {
                foreach ($obj as $val){
                 $retval.=$val.",";
                  }
                  $retval.="<br>";
                }
                return $retval;
                }
        catch(PDOException $e)
        {
            $this->CheckErrors($e);
        }
    }
    public function new_sub($sub,$sub_img){
        try{
        $cursor = $this->MySQLdb->prepare("insert into `נושאים` (`נושא`,`תמונת שער`)  value (:sub,:sub_img)");    // INSERT INTO users (username, password , date) value (:username,:password, :date)
        $cursor->execute(array(":sub"=>$sub ,":sub_img"=>$sub_img));
        return "seccses";
        }
        catch(PDOException $e)
        {
            $this->CheckErrors($e);
        }
    }
    public function new_lesson($lesson,$lesson_img,$sub){
        try{
        $cursor = $this->MySQLdb->prepare("insert into `שיעורים` (`שם השיעור`,        `דף מקורות`,        `נושא`)  value (:lesson,:lesson_img , :sub)");    // INSERT INTO users (username, password , date) value (:username,:password, :date)
        $cursor->execute(array(":lesson"=>$lesson ,":lesson_img"=>$lesson_img,":sub"=>$sub)); //UPDATE `שיעורים` SET `record` = 'asdfgh.mp3' WHERE `שיעורים`.`id` = 1
        return "seccses";
        }
        catch(PDOException $e)
        {
            $this->CheckErrors($e);
        }
    }
    public function add_record($lesson,$record){
        try{
        $cursor = $this->MySQLdb->prepare("UPDATE `שיעורים` SET `record` = :record WHERE `שיעורים`.`id` = (select id from `שיעורים` where `שם השיעור`  =  :lesson)");    
        $cursor->execute(array(":lesson"=>$lesson ,":record"=>$record));  
        return "seccses";
        }
        catch(PDOException $e)
        {
            $this->CheckErrors($e);
        }
    }
    public function change_pw($user_id,$passwd){
        try{
        $cursor = $this->MySQLdb->prepare("UPDATE users SET password = :passwd  WHERE user_id = :user_id ;");
        $cursor->execute(array(":user_id"=>$user_id ,":passwd"=>$passwd));
        return "seccses";
        }
        catch(PDOException $e)
        {
            $this->CheckErrors($e);
        }

    }
    public function change_username($user_id,$username){
        try{
        $cursor = $this->MySQLdb->prepare("UPDATE users SET username = :username  WHERE user_id = :user_id ;");
        $cursor->execute(array(":user_id"=>$user_id ,":username"=>$username));
        return "seccses";
        }
        catch(PDOException $e)
        {
            $this->CheckErrors($e);
        }

    }
    

    
    public function download($user_id,$lesson_id,$type){
        try{
        $cursor = $this->MySQLdb->prepare("INSERT INTO downloads (user_id, lesson_id ,type) value (:user_id, :lesson_id, :type2)");
        $cursor->execute(array(":user_id"=>$user_id ,":lesson_id"=>$lesson_id,":type2"=>$type));
        return "seccses";
        }
        catch(PDOException $e)
        {
            $this->CheckErrors($e);
        }

    }
    public function EditPost($id, $data)
    {
        try
        {
            $cursor = $this->MySQLdb->prepare("UPDATE posts SET text=:text WHERE id=:id");
            $cursor->execute(array(":id"=>$id, ":text"=>$data));
			if ($cursor->rowCount()) return true;
        }
        catch(PDOException $e)
        {
            $this->CheckErrors($e);
        }
        return false;
    }
    public function NewPost($user_id,$data,$lesson_id){
        try{
        $cursor = $this->MySQLdb->prepare("INSERT INTO posts (user_id, text, lesson_id ) value (:user_id, :data, :lesson_id)");
        $cursor->execute(array(":user_id"=>$user_id ,":lesson_id"=>$lesson_id,":data"=>$data));
        return "seccses";
        }
        catch(PDOException $e)
        {
            $this->CheckErrors($e);
        }

    }
    
    public function get_downloads($id){
        $where = 'WHERE a.user_id = :id' ;
        $users = '';
        $html1 = "" ;
        $html2 = '' ; 
        if ( $id == "all"){
            $where = '' ;
            $users = 'user_id ,';
            $html1 = '<th scope="col">user_id</th>' ;
            
        }
        try{
        $cursor = $this->MySQLdb->prepare("select ".$users." `שם השיעור`, `נושאים`.`נושא`, a.date, type from (SELECT * FROM downloads inner join שיעורים on downloads.lesson_id = שיעורים.id ) a inner join נושאים on a.`נושא` =  נושאים.id ".$where );
        if ($where){
            $cursor->execute(array(":id"=>$id)) ;
        }
        else{
            $cursor->execute();
        }

       
        

        
        $retval = '
        <div class="container col-sm-4 col-md-offset-4">
          
          <table class="table">
          <thead class="thead-dark">
            <tr>
              <th scope="col">#</th>'.$html1.'
              <th scope="col">תאריך</th>
              <th scope="col">נושא</th>
              <th scope="col">שם השיעור</th>
              <th scope="col">סוג הורדה</th>
            </tr>
          </thead>
         <tbody id= "input">';

        $cuonter = 0 ;

        foreach ($cursor->fetchAll() as $obj)
        {
           $cuonter ++;
           if ( $id == "all"){
            $html2 = "<td>{$obj['user_id']}</td>";
        }
       
            
                switch($obj['type']){
                    case 0:
                        $file_type = "null";
                        break;
                    case 1:
                        $file_type = "all";
                        break;
                    case 2:
                        $file_type = "דף מקורות";
                        break;
                    case 3:
                        $file_type = "הקלטה";
                        break;
                }

               $retval.="<tr class='table-dark'><th scope='row'>{$cuonter}</th>".$html2."<td>{$obj['date']}</td><td>{$obj['נושא']}</td><td>{$obj['שם השיעור']}</td><td>{$file_type}</td></tr>";
              }

        return  '</tbody></table></div>'.$retval;
        }
                 
        catch(PDOException $e)
        {
            $this->CheckErrors($e);
        }
    }
    

    public function get_lessons($sub){
        try{
        $cursor = $this->MySQLdb->prepare("SELECT * FROM `שיעורים` WHERE `נושא` =  :sub ");
        $cursor->execute(array(":sub"=>$sub));
        $retval = "";
             foreach ($cursor->fetchAll() as $obj)
             {
                $rec = '" disabled ="true';
                if ($obj['record']){
                    $rec = $obj['record'] ;
                 }
                 
                 $retval.= '
                                <div  class = "row" name="test" id="'.$obj['id'].'">
                                <div class="col-md-2 text-center">
                                        <button onclick ="click_btn(this)" class="btn btn-defult" style="background-color:#8983f2" name="posts" >תגובות</button>
                                        </div>
                                <div class="col-md-2 text-center">
                                        <button onclick ="click_btn(this)" class="btn btn-defult" style="background-color:#9bee12" name="all" value="'.$rec.','.$obj['דף מקורות'].'">הכל</button>
                                  </div>
                                  
                                  <div class="col-md-2 text-center">
                                        <button onclick ="click_btn(this)" class="btn btn-defult" style="background-color:#08f1f1" name="rec" value="'.$rec.'">הקלטה</button>
                                        </div>
                                        <div class="col-md-2 text-center">
                                        <button onclick ="click_btn(this)" class="btn btn-defult" style="background-color:#f18808" name="pdf" value="'.$obj['דף מקורות'].'">דף מקורות</button>
                                        </div>
                                        <div class="col-md-4 text-center">
                                        <span >  '.$obj['שם השיעור'].'  </span>
                                        </div>
                                 </div>   
                                 <div name="'.$obj['id'].'rec"></div>
                                 <div name="'.$obj['id'].'posts"></div>
                            <br>';              
                  }
                  
                
                return $retval;
        }
        catch(PDOException $e)
        {
            $this->CheckErrors($e);
        }

    }
    public function get_subs(){
        try{
        $cursor = $this->MySQLdb->prepare("SELECT * FROM `נושאים` ");
        $cursor->execute();
        $retval = '<div class="row">';
        $count=1;
             foreach ($cursor->fetchAll() as $obj)
             {
                if ($count==4){
                    $count=1;
                    $retval.='</div><div class="row">';
                }
                 $retval.= '<div class="card col-md-4" style="max-height:20%; min-height:20%" ><div class="card-body" style="height:30%">
                 <div class="card-head row"><a href="./lessons.php?sub='.$obj['id'].'" class="col-4 btn btn-primary">הצג שיעורים</a><div class="card-title col-8">'.$obj['נושא'].' </div> </div>  
                 </div><img class="card-img-top" style="height:200px" src="./images/'.$obj['תמונת שער'].'" alt="Card image cap">  </div>';
                 $count++;
                  }
                  
                
                return '</div>'.$retval;
        }
        catch(PDOException $e)
        {
            $this->CheckErrors($e);
        }

    }

    public function get_posts($userid,$lesson_id){
        try{
        $cursor = $this->MySQLdb->prepare("SELECT * FROM `posts`  inner join users on users.user_id = posts.user_id  WHERE lesson_id = :lesson_id ");
        $cursor->execute(array(':lesson_id'=>$lesson_id));
        $retval = '';
        $count=1;
                foreach ($cursor->fetchAll() as $obj)
                {
                    if ($obj["user_id"] == $userid)
                {
                    $retval.="<div class = 'row'>
                    <li class='speech-bubble-right'><h2>{$obj["username"]}</h2>
                    <p>{$obj["text"]}<a style='float:right;color: white;margin-right: 20px;' href='#' onclick='post_edit(this);'>edit</a>
                    </p><input value={$obj["id"]} hidden></li></div>";
                }
                else
                {
                    $retval.="<div class = 'row'><li class='speech-bubble-left'><h2>{$obj["username"]}</h2>
                    <p>{$obj["text"]}</p>
                    <input name='post_id' value={$obj["id"]} hidden></li></div>";
                }

                // if ($userid==$obj){
                //     $retval.= '<div class="row"> --'.$obj['text'].$obj['date'].'</div>';
                // }
                // else{
                //     $retval.= '<div class="row">'.$obj['text'].$obj['date'].'--</div>';

                //     $count++;
                //     }
                    
                }
                return $retval.'<div class="input-group">
                <input id="msg" type="text" class="form-control" name="msg" placeholder="Write your message here...">
                <span class="input-group-addon">
            <button onclick ="add_post(this, '.$lesson_id.' )">הוסף תגובה</button></span></div>';
        }
            catch(PDOException $e)
            {
                $this->CheckErrors($e);
            }
        }
    public function get_users(){
        
        try
        { 
            $cursor = $this->MySQLdb->prepare("SELECT username , user_id FROM users");
            $cursor->execute();
            $result = "";
            
            foreach ($cursor->fetchAll() as $obj)
            {
                $result.= "<option label={$obj["username"]} value={$obj["user_id"]}></option>" ;                 //  return $cursor->fetch();
            }
            
            return $result;
        }
        catch(PDOException $e) {
            $this->CheckErrors($e);
        }
         
    }
    

    public function Login($username, $password)
    {
        try
        {
            $cursor = $this->MySQLdb->prepare("SELECT * FROM users WHERE username='".$username."' AND password='".$password."'");
            $cursor->execute();
        }
        //SQL injection
        catch(PDOException $e) {
            $this->CheckErrors($e);
        }

        if(!$cursor->rowCount())
        {
            return  array("success"=>false,"data"=>"Wrong Username/Password!<br>");
        }
        else
        {
            $cursor->setFetchMode(PDO::FETCH_ASSOC);
            return array("success"=>true,"data"=>$cursor->fetch());
        }
    }
}

 
