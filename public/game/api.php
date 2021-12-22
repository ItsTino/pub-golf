<?php
include '../../src/mariadbconn.php';
// Load Composer's autoloader
require '../../vendor/autoload.php';

// Processing form data when form is submitted
//If it's not POST we die 
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //Get our dbconnection from mariadbconn
    $dbconnect = get_dbc();


    //Try to join a game using code
    // 3 possible behaviours 
    //Join if game is not started yet
    //View read-only results if game is finished
    //Alert if game is in progress (Joining in progress game is not planned at this time) 
    if ($_POST['action'] == 'joingame') {
        //Check game code to see if it exists
        
        $gameID = filter_var($_POST['gameID'], FILTER_SANITIZE_STRING);
        if ($stmt = mysqli_prepare($dbconnect, "SELECT * FROM tblGameInfo WHERE gameJoinCode=?")) {

            /* bind parameters for markers */
            $stmt->bind_param("s", $gameID);

            $stmt->execute();

            $result = $stmt->get_result();

            while ($row = $result->fetch_all(MYSQLI_BOTH)) {
                foreach ($row as $r) {
                    $passhash = $r['uPassHash'];
                }
            }
        }
    }





 } else {
     echo "Hi, you shouldn't be accessing this directly :)";
    exit();
 }



?>
