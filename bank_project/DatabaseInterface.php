<?php

require_once './CommonInterface.php';

class DatabaseInterface
{
    const debug = true;

    public function __construct()
    {
        $this->MySQLdb = new PDO("mysql:host=127.0.0.1;dbname=bank", "root", "");
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
    public function GetMyTrans($id)
     {
         try
         {
             $cursor = $this->MySQLdb->prepare("SELECT d.receiver_id, d.transferor_name , c.username receiver_name , d.money_to_trans, d.date_of_trans  FROM (SELECT b.username as transferor_name ,a.receiver_id, a.money_to_trans, a.date_of_trans FROM `transfers` a LEFT JOIN users b ON transferor_id = user_id  WHERE a.transferor_id = :id  OR a.receiver_id =:id) d LEFT JOIN users c ON d.receiver_id = user_id ;"); // echo implode(",", $obj); 
             $cursor->execute(array(":id"=>$id));
             $retval = "";

             $cuonter = 0 ;

             foreach ($cursor->fetchAll() as $obj)
             {
                $cuonter ++;
            
                 if ($obj["receiver_id"] != $id)
                 {
                    $retval.="<tr class='table-danger'><th scope='row'>{$cuonter}</th><td>{$obj["transferor_name"]}</td><td>{$obj["receiver_name"]}</td><td>-{$obj["money_to_trans"]}$</td><td>{$obj["date_of_trans"]}</td></tr>";
                     
                     
                     
                 }
                else
                 
                {
                    $retval.="<tr class='table-success'><th scope='row'>{$cuonter}</th><td>{$obj["transferor_name"]}</td><td>{$obj["receiver_name"]}</td><td>{$obj["money_to_trans"]}$</td><td>{$obj["date_of_trans"]}</td></tr>";
                           
                                }                
            }

            return  $retval;
        }
        catch(PDOException $e)
        {
            $this->CheckErrors($e);
        }
        return false;
    }

    public function GetBalance($userid){
            try
            {
                # Check if the username or email is taken
                $cursor = $this->MySQLdb->prepare("SELECT balance FROM bank_account WHERE user_id = :user_id ");
                $cursor->execute( array(":user_id"=>$userid) );
                return array("success"=>true,"data"=>$cursor->fetch());
            }
            catch(PDOException $e) {
                $this->CheckErrors($e);
            }
             
    }    

    public function Register($username, $password)
    {
        try
        {
            # Check if the username or email is taken
            $cursor = $this->MySQLdb->prepare("SELECT username FROM users WHERE username=:username");
            $cursor->execute( array(":username"=>$username) );
        }
        catch(PDOException $e) {
            $this->CheckErrors($e);
        }

        /* New User */
        if(!($cursor->rowCount())){
            try
            {
                $cursor = $this->MySQLdb->prepare("INSERT INTO users (username, password , date) value (:username,:password, :date)");
                $cursor->execute(array(":password"=>$password, ":username"=>$username, ":date"=>date("Y-m-d")));
                // create account
                $cursor = $this->MySQLdb->prepare('INSERT INTO bank_account (user_id) VALUES ((SELECT user_id FROM users WHERE username = :username) )');
                $cursor->execute(array(":username"=>$username));
                return array("success"=>true,"data"=>"You have successfully registered<br>");
            }
            catch(PDOException $e) {
                $this->CheckErrors($e);
            }
        }
        /* Already exists */
        else
        {
            return array("success"=>false,"data"=>"username already exists in the system<br>");
        }
    }
    public function GetAllTrans(){
        try
         {
             $cursor = $this->MySQLdb->prepare("SELECT  d.transferor_name , c.username receiver_name , d.money_to_trans, d.date_of_trans  FROM (
                SELECT b.username as transferor_name ,a.receiver_id, a.money_to_trans, a.date_of_trans FROM `transfers` a 
                LEFT JOIN users b ON transferor_id = user_id) d 
                LEFT JOIN users c ON d.receiver_id = user_id ;"); 
             $cursor->execute();
             $retval = "";

             $cuonter = 0 ;

             foreach ($cursor->fetchAll() as $obj)
             {
                $cuonter ++;
            
                 if ($obj["transferor_name"] == "admin")
                 {
                    $retval.="<tr class='table-danger'><th scope='row'>{$cuonter}</th><td>{$obj["transferor_name"]}</td><td>{$obj["receiver_name"]}</td><td>-{$obj["money_to_trans"]}$</td><td>{$obj["date_of_trans"]}</td></tr>";
                 }
                 else if ($obj["receiver_name"] == "admin")
                {
                    $retval.="<tr class='table-success'><th scope='row'>{$cuonter}</th><td>{$obj["transferor_name"]}</td><td>{$obj["receiver_name"]}</td><td>{$obj["money_to_trans"]}$</td><td>{$obj["date_of_trans"]}</td></tr>";
                }
                else{

                    $retval.="<tr class = 'table-dark'><th scope='row'>{$cuonter}</th><td>{$obj["transferor_name"]}</td><td>{$obj["receiver_name"]}</td><td>{$obj["money_to_trans"]}$</td><td>{$obj["date_of_trans"]}</td></tr>";

                }                
            }
            return  $retval;
        }
        catch(PDOException $e)
        {
            $this->CheckErrors($e);
        }
        return false;
    }


    

    public function load($user_id,$money){
        try{
        $cursor = $this->MySQLdb->prepare("UPDATE `bank_account` SET `balance` = (SELECT balance FROM bank_account WHERE user_id = :user_id) + :money WHERE `bank_account`.`user_id` = :user_id; ");
        $cursor->execute(array(":user_id"=>$user_id ,":money"=>$money));
        return array("success"=>true,"data"=>"you load :{$money}$");
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
        return array("success"=>true,"data"=>"password changed");
        }
        catch(PDOException $e)
        {
            $this->CheckErrors($e);
        }

    }
    public function change_username($user_id,$username){
        try
        {
            # Check if the username or email is taken
            $cursor = $this->MySQLdb->prepare("SELECT username FROM users WHERE username=:username ;");
            $cursor->execute( array(":username"=>$username) );

        }
        catch(PDOException $e) {
            $this->CheckErrors($e);
        }
        

        /* New User */
        if(!($cursor->rowCount())){
       
            try{
            $cursor = $this->MySQLdb->prepare("UPDATE users SET username = :username  WHERE user_id = :user_id ;");
            $cursor->execute(array(":user_id"=>$user_id ,":username"=>$username));
            return array("success"=>true,"data"=>"user name changed");
            }
            catch(PDOException $e)
            {
                $this->CheckErrors($e);
            }

        }
        else{
            return array("success"=>false,"data"=>"username already exists in the system");
        }
    }
    public function trans($user,$money,$user_id){
        
        try
        { 
            $date = date("Y-m-d");
            $cursor = $this->MySQLdb->prepare("UPDATE `bank_account` SET `balance` = (SELECT balance FROM bank_account WHERE user_id = :user_id) - :money WHERE `bank_account`.`user_id` = :user_id;         UPDATE `bank_account` SET `balance` = (SELECT balance FROM bank_account WHERE user_id = :user) + :money WHERE `bank_account`.`user_id` = :user;");
            $cursor->execute(array(":user_id"=>$user_id ,":user"=>$user,":money"=>$money));

            $cursor = $this->MySQLdb->prepare("INSERT INTO `transfers` ( trans_id , `transferor_id`, `receiver_id`, `money_to_trans`, `date_of_trans`) VALUES (NULL, :user_id, :user, :money, :date) ;");
            $cursor->execute(array(":user_id"=>$user_id ,":user"=>$user,":money"=>$money,":date"=>$date)) ;
           
            return "true" ;
             
        }
        catch(PDOException $e) {
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

 
