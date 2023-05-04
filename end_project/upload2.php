<?php
        function upload($file){
    
            $target_dir = "images/" ;
            $target_file = $target_dir . basename($file["fileToUpload"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            $log = "";

            // Check if image file is a actual image or fake image
            if(isset($_POST["submit"])) {
            $check = getimagesize($file["fileToUpload"]["tmp_name"]);
            if($check !== false) {
                $log .=( "File is an image - " . $check["mime"] . "." );
                $uploadOk = 1;
            } else {
                $log .=( "File is not an image." );
                $uploadOk = 0;
            }
            }

            // Check if file already exists
            if (file_exists($target_file)) {
                $log .=( "Sorry, file already exists." );
            $uploadOk = 0;
            }

            // Check file size
            if ($file["fileToUpload"]["size"] > 5000000) {
                $log .=( "Sorry, your file is too large.");
            $uploadOk = 0;
            }

            // Allow certain file formats
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
            $log .= "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
            }

            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                $log .=( " Sorry, your file was not uploaded.");
            // if everything is ok, try to upload file
            } else {
            if (move_uploaded_file($file["fileToUpload"]["tmp_name"], $target_file)) {

                $log .= ("The file ". htmlspecialchars( basename( $file["fileToUpload"]["name"])). " has been uploaded.");
                return htmlspecialchars( basename( $file["fileToUpload"]["name"]));
            } else {
                $log .=( "Sorry, there was an error uploading your file.");
            }
            }
    
            echo "<script>alert('".$log."')</script>";


        }


        function upload_text($file){
    
            $target_dir = "text/" ;
            $target_file = $target_dir . basename($file["fileToUpload"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            $log = "";

            

            // Check if file already exists
            if (file_exists($target_file)) {
                $log .=( "Sorry, file already exists." );
            $uploadOk = 0;
            }

            // Check file size
            if ($file["fileToUpload"]["size"] > 50000000) {
                $log .=( "Sorry, your file is too large.");
            $uploadOk = 0;
            }

            // Allow certain file formats
            if($imageFileType != "pdf" && $imageFileType != "docx" ) {
            $log .= "Sorry, only PDF & DOCX files are allowed.";
            $uploadOk = 0;
            }

            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                $log .=( " Sorry, your file was not uploaded.");
            // if everything is ok, try to upload file
            } else {
            if (move_uploaded_file($file["fileToUpload"]["tmp_name"], $target_file)) {

                $log .= ("The file ". htmlspecialchars( basename( $file["fileToUpload"]["name"])). " has been uploaded.");
                return htmlspecialchars( basename( $file["fileToUpload"]["name"]));
            } else {
                $log .=( "Sorry, there was an error uploading your file.");
            }
            }
    
            echo "<script>alert('".$log."')</script>";








        }
        function upload_record($file){
    
            $target_dir = "records/" ;
            $target_file = $target_dir . basename($file["fileToUpload"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            $log = "";

            

            // Check if file already exists
            if (file_exists($target_file)) {
                $log .=( "Sorry, file already exists." );
            $uploadOk = 0;
            }

            // Check file size
            if ($file["fileToUpload"]["size"] > 5000000000000) {
                $log .=( "Sorry, your file is too large.");
            $uploadOk = 0;
            }

            // Allow certain file formats
            if($imageFileType != "mp3" && $imageFileType != "mp4" && $imageFileType != "m4a" && $imageFileType != "wav" ) {
            $log .= "Sorry, only mp3 , mp4 , m4a / wav files are allowed.";
            $uploadOk = 0;
            }

            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                $log .=( " Sorry, your file was not uploaded.");
            // if everything is ok, try to upload file
            } else {
            if (move_uploaded_file($file["fileToUpload"]["tmp_name"], $target_file)) {

                $log .= ("The file ". htmlspecialchars( basename( $file["fileToUpload"]["name"])). " has been uploaded.");
                return htmlspecialchars( basename( $file["fileToUpload"]["name"]));
            } else {
                $log .=( "Sorry, there was an error uploading your file.");
            }
            }
    
            echo "<script>alert('".$log."')</script>";








        }
?>







        
        
