<?php
    // Require the following PHP files:
    require_once "./permissions.php";
    require_once "./CommonInterface.php";
    require_once "./DatabaseInterface.php";

    // Get the user ID and username from the session:
    $userid = $_SESSION["userid"];
    $username = $_SESSION["user"];

    // Create a new instance of the DatabaseInterface class:
    $databaseObj = new DatabaseInterface();
    
    // Require the following PHP files again (this looks like a duplicate block of code):
    require_once "./permissions.php";
    require_once "./CommonInterface.php";
    require_once "./DatabaseInterface.php";

    // Decode JSON input from the request body:
    $input = json_decode(file_get_contents('php://input'),false);

    // Check if the input is an object:
    if(!is_object($input))
    {
        return_error("nice try :)");
    }

    // Check if the "action" property is set in the input:
    if(!isset($input->action))
    {
        return_error("nice try :)");
    }

    // Use a switch statement to determine the action to perform based on the "action" property of the input object:
    switch ($input->action)
    {
        // If the action is "all_trans" and the user ID is 1, call the GetAllTrans method of the DatabaseInterface class and return the data as a success response. Otherwise, return an error response:
        case "all_trans":
            if ($userid == 1){
                if ($data = $databaseObj->GetAllTrans(1))
                {
                    return_success($data);
                }
                else
                {
                    return_error("Malformed request");
                }
            }
            break;
        
        // If the action is "change_pw", call the change_pw method of the DatabaseInterface class with the user ID and the data property of the input object, and return the data as a success response. Otherwise, return an error response:
        case "change_pw":
            if ($data = $databaseObj->change_pw($userid,$input->data)){
                return_success($data);
            }
            else
            {
                return_error("Malformed request");
            }
            break;
        case "trans":
                if ($data = $databaseObj->trans($input->user_to_trans,$input->money,$userid)){
                    return_success($data);
                }
                else
                {
                    return_error("Malformed request");
                }
                break;
        // If the action is "new_un", call the change_username method of the DatabaseInterface class with the user ID and the data property of the input object, and return the data as a success response. Otherwise, return an error response:
          
        case "new_un":
            if ($data = $databaseObj->change_username($userid,$input->data)){
                if ($data['success']){ 
                $_SESSION["user"] = $input->data;
                return_success($data);
                }
            }
            
            return_success($data);
            
    
        break;
        

            // If the action is "load", attempt to load the user's data
        case "load":
            if ($data = $databaseObj->load($userid, intval($input->data)))
            {
                // If the load was successful, return the data
                return_success($data);
            }
            else
            {
                // If the request was malformed, return an error
                return_error("Malformed request");
            }
            break;
        
        // If the action is "logout", destroy the session and return success
        case "logout":
            session_destroy();
            return_success("logged out");
            break;
        
        // If the action is not recognized, return an error
        default:
            return_error("Malformed request");
    }

        
       

    
    

