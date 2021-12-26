<?php
session_start();
require_once '../../src/mariadbconn.php';
require_once '../../src/gameApiFuncs.php';
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

        $joinID = filter_var($_POST['joinID'], FILTER_SANITIZE_STRING);
        if ($stmt = mysqli_prepare($dbconnect, "SELECT * FROM tblGameInfo WHERE gameJoinCode=?")) {

            /* bind parameters for markers */
            $stmt->bind_param("s", $joinID);

            $stmt->execute();

            $result = $stmt->get_result();

            while ($row = $result->fetch_all(MYSQLI_BOTH)) {
                foreach ($row as $r) {
                    $_SESSION['gameInviteCode'] = $joinID;
                    $_SESSION['currentGameSession'] = $r['uGameID'];
                    if ($_SESSION['uuID'] == $r['gameOwnerID']) {
                        $_SESSION['isMod'] = true;
                    } else {
                        $_SESSION['isMod'] = false;
                    }
                    echo 'success';
                }
            }
        }
    }

    //Return game status by gameID
    //Return 0 => waiting
    //Return 1 => started
    //Return 2 => done
    if ($_POST['action'] == 'checkgamestatus') {
        $gameID = filter_var($_POST['gameID'], FILTER_SANITIZE_STRING);

        if ($stmt = mysqli_prepare($dbconnect, "SELECT * FROM tblGameInfo WHERE uGameID=?")) {

            /* bind parameters for markers */
            $stmt->bind_param("s", $gameID);

            $stmt->execute();

            $result = $stmt->get_result();

            while ($row = $result->fetch_all(MYSQLI_BOTH)) {
                foreach ($row as $r) {
                    $gameStatusNo = $r['gameStatus'];
                }

                switch ($gameStatusNo) {
                    case '0':
                        echo 'waiting';
                        break;
                    case '1':
                        echo 'started';
                        break;
                    case '2':
                        echo 'done';
                        break;
                    default:
                        echo ('error');
                }
            }
        }
    }

    if ($_POST['action'] == 'incRound') {
        $gameID = filter_var($_POST['gameID'], FILTER_SANITIZE_STRING);

        if ($stmt = mysqli_prepare($dbconnect, "UPDATE tblGameInfo SET `gameRound` = `gameRound` + 1 WHERE `uGameID`=?")) {

            /* bind parameters for markers */
            $stmt->bind_param("s", $gameID);

            $stmt->execute();

            echo 'success';

        }
    }

    if ($_POST['action'] == 'saveScore') {
        $gameID = filter_var($_POST['gameID'], FILTER_SANITIZE_STRING);
        $teamID = filter_var($_POST['teamID'], FILTER_SANITIZE_STRING);
        $round = filter_var($_POST['round'], FILTER_SANITIZE_STRING);
        $score = filter_var($_POST['score'], FILTER_SANITIZE_STRING);

        if ($stmt = mysqli_prepare($dbconnect, "UPDATE `tblRoundScore` SET `rsScore` = ? WHERE `rsGameID` = ? AND `rsTeamID` = ? AND `rsRound` = ?")) {

            /* bind parameters for markers */
            $stmt->bind_param("issi", $score, $gameID, $teamID, $round);

            $stmt->execute();

            echo 'success';

        }
    }
} else {
    echo "Hi, you shouldn't be accessing this directly :)";
    exit();
}
