
    <!DOCTYPE html>
    <html>
    <body>
       
  
    <?php
   if (isset($_GET['pdf'])){

// Store the file name into variable
$pdf ="./text/".$_GET['pdf'] ;
$file = $pdf;
$filename = $pdf;

// Header content type
header('Content-type: application/docx');

header('Content-Disposition: inline; filename="' . $filename . '"');

header('Content-Transfer-Encoding: binary');

header('Accept-Ranges: bytes');

// Read the file
 @readfile($file);
    }
//     //pdf("cv.pdf");


if (isset($_GET['rec'])){
$record = "./records/".$_GET['rec'] ;
header("Cache-Control: private");
header("Content-type: audio/mpeg3");
header("Content-Transfer-Encoding: binary");
header("Content-Disposition: attachment; filename=".$record);
//So the browser can display the download progress
header("Content-Length: ".filesize($record));

 return readfile($record);
}
//record("records/נתיב התורה04 - כה מרחשון תשסא.mp3")  ile(/records): Failed to open stream: No such file or directory in <b>C:\xampp\htdocs\end_project\downloads.php</b> on line 
?>

     
    </body>
    </html>

    
    
    
