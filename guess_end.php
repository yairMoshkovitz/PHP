<?php
    // Start a new session or resume an existing one
    session_start();

    // Check if "new" parameter is set in the URL
    if (isset($_GET["new"])){
      // If "new" parameter is set, destroy the current session and start a new one
      session_destroy();
      session_start();
     }
    
    // Check if "num" parameter is set in the URL and if the value is valid
    if (isset($_SESSION["num"]) && isset($_GET["num"]) && isset($_GET["guess"])){  
        
            // Check if the value of "num" is greater than 0 and less than 10000
            if (intval($_GET["num"]) > 0 && intval($_GET["num"]) < 10000){
    
                // Compare the value of "num" with the randomly generated number
                if ($_SESSION['num'] > $_GET["num"]){
                    // If "num" is smaller than the generated number, display "bigger"
                    echo "bigger" ;
                }
                else if ($_SESSION['num'] < $_GET["num"]){
                    // If "num" is greater than the generated number, display "lower"
                    echo "lower" ;
                }
                else if (intval($_GET["guess"]) == 1){
                  // If "num" is equal to the generated number and the number of "guess" is 1 display "you rock the challenge!"
                    echo "you rock the challenge!";
                }
                else{
                  // If "num" is equal to the generated number, start a new game and display "new-game! you right",
                  $_SESSION['num'] = rand(0,11);
                  echo  "new-game! you right";
                  
                }
                die(); // Stop executing the script
            }
            else {
                // If "num" is not a valid value, display "no valid"
                echo "no valide";
                die(); // Stop executing the script
            }
        }
    else {
        // If "num" parameter is not set, generate a new random number and store it in the session
        $_SESSION['num'] = rand(0,11);
        
    }
?>

<!-- HTML code starts here -->
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>guess_num</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <!-- Load Bootstrap CSS and jQuery -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    </head>

    <body>
        <div class="container text-center col-md-offset-1 col-sm-10 ">
            
            <div class="bg-image img-circle" style="background-image: url('http://127.0.0.1/my_ajax/loto.jfif');">
                <!-- Display the game description -->
                <h3 id="discreption" class= 'col-md-offset-3 col-sm-6'>try to guess the number in 1 guesses. use js!</h3>

                <!-- Display the input field for the user to enter their guess -->
                <input type="text" id="num1" placeholder="guess a number: > 0 <11" class="text-center input-lg col-md-offset-3 col-sm-6">
                <br>
                
                <!-- Display the "send" button to submit the guess -->
                <button id="go" class ="col-md-offset-3 col-sm-3 btn-lg">send</button>
                
                <!-- Display the "new game" button to start a new game -->
                <button id="new" name="new" class ="col-sm-3 btn-lg" >new game</button>
                <h2 id="answer" class = "col-md-offset-4 col-sm-4">waiting for your guess</h2>
        
        <br>
        <br>
        <br>
        <br><br>
        <br><br><br>
        <br><br><br>
    </div>
</div>


<style>
  /* Set the background color and text alignment of h2 and h3 elements */
  h2 {
    background-color:white;
    text-align: center;
  }
  h3 {
    background-color:white;
    text-align: center;
  }
</style>

<script>
  // Initialize the number of guesses to zero
  var gesss = 0;
  
  // Define the function that sends the guess to the server and displays the result
  function gess(num2){
    // Increment the number of guesses
    gesss++;
    // Send a GET request to guess_new.php with the guessed number as a parameter
    $.get('guess_end.php',{"num":num2,"guess":gesss}, function(data,status){
      console.log(num2+ ":" +data);
      if (data == 'new-game! you right') {
        gesss = 0;
      }
      // If the guess is correct and this is the first guess, show a congratulatory message
      if (data == 'you rock the challenge!') {
        alert(data);
      }
      // Update the answer text with the server's response and the number of guesses
      $("#answer").text(data+", "+gesss +" guesses");
    })
    
    
  }
  
  // Attach a click event listener to the "send" button
  $("#go").click(function(){
    // Call the gess() function with the value of the input field as an argument
    gess($("#num1").val());
  })

  // Attach a click event listener to the "new game" button
  $("#new").click(function(){
    // Send a GET request to guess_new.php with a "new" parameter to start a new game
    $.get('guess_end.php',{"new":"yes"} ,function(data,status){
      // Update the answer text to indicate a new game has started
      $("#answer").text("new game");
      // Reset the number of guesses to zero
      gesss = 0;
    })
  })
</script>          

</body>
</html>
