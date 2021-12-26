<?php
require_once('mariadbconn.php');
require_once('globalVars.php');

function guidv4($data = null)
{
    // Generate 16 bytes (128 bits) of random data or use the data passed into the function.
    $data = $data ?? random_bytes(16);
    assert(strlen($data) == 16);

    // Set version to 0100
    $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
    // Set bits 6-7 to 10
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80);

    // Output the 36 character UUID.
    return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
}

function checkGameStatus($gameID)
{
}

function getTeams($gameID)
{
    $dbconnect = get_dbc();
    $teamArray = [];
    if ($stmt = mysqli_prepare($dbconnect, "SELECT uTeamID, teamName FROM tblTeamInfo WHERE teamActiveGameID=?")) {

        /* bind parameters for markers */
        $stmt->bind_param("s", $gameID);

        $stmt->execute();

        $result = $stmt->get_result();

        while ($row = $result->fetch_all(MYSQLI_BOTH)) {
            foreach ($row as $r) {
                array_push($teamArray, array('teamID' => $r['uTeamID'], 'teamName' => $r['teamName']));
            }
        }
        return $teamArray;
    }
}

function getCurrentRoundInfo($gameID)
{
    $dbconnect = get_dbc();
    $clArray = clArray();
    $currentRoundArray = [];

    if ($stmt = mysqli_prepare($dbconnect, "SELECT gameRound FROM tblGameInfo WHERE uGameID=?")) {

        /* bind parameters for markers */
        $stmt->bind_param("s", $gameID);

        $stmt->execute();

        $result = $stmt->get_result();

        while ($row = $result->fetch_all(MYSQLI_BOTH)) {
            foreach ($row as $r) {
                return $r['gameRound'];
            }
        }
    }
}


function getScores($gameID)
{
    $dbconnect = get_dbc();
    $teamArray = [];
    if ($stmt = mysqli_prepare($dbconnect, "SELECT uTeamID, teamName FROM tblTeamInfo WHERE teamActiveGameID=?")) {

        /* bind parameters for markers */
        $stmt->bind_param("s", $gameID);

        $stmt->execute();

        $result = $stmt->get_result();

        while ($row = $result->fetch_all(MYSQLI_BOTH)) {
            foreach ($row as $r) {
                array_push($teamArray, array('teamID' => $r['uTeamID'], 'teamName' => $r['teamName']));
            }
        }
        return $teamArray;
    }
}

function getSingleTeamInfo($teamID)
{
    $teamInfoArray = [];
    $dbconnect = get_dbc();

    if ($stmt = mysqli_prepare($dbconnect, "SELECT uTeamID, teamName FROM tblTeamInfo WHERE teamActiveGameID=?")) {

        /* bind parameters for markers */
        $stmt->bind_param("s", $gameID);

        $stmt->execute();

        $result = $stmt->get_result();

        while ($row = $result->fetch_all(MYSQLI_BOTH)) {
            foreach ($row as $r) {
                array_push($teamArray, array('teamID' => $r['uTeamID'], 'teamName' => $r['teamName']));
            }
        }
        return $teamArray;
    }
}

function getTeamScore($gameID, $teamID)
{
    $teamScore = 0;
    $dbconnect = get_dbc();
    if ($stmt = mysqli_prepare($dbconnect, "SELECT * FROM tblRoundScore WHERE rsGameID=? AND rsTeamID = ?")) {

        /* bind parameters for markers */
        $stmt->bind_param("ss", $gameID, $teamID);

        $stmt->execute();

        $result = $stmt->get_result();

        while ($row = $result->fetch_all(MYSQLI_BOTH)) {
            foreach ($row as $r) {
                $teamScore += $r['rsScore'];
            }
        }
        return $teamScore;
    }
}

function getTeamName($teamID)
{
    $dbconnect = get_dbc();

    if ($stmt = mysqli_prepare($dbconnect, "SELECT * FROM tblTeamInfo WHERE uTeamID=?")) {

        /* bind parameters for markers */
        $stmt->bind_param("s", $teamID);

        $stmt->execute();

        $result = $stmt->get_result();

        while ($row = $result->fetch_all(MYSQLI_BOTH)) {
            foreach ($row as $r) {
                return $r['teamName'];
            }
        }
    }
}

function getScoreBoard($gameID, $roundNo)
{
    $dbconnect = get_dbc();
    $tempResArray = [];

    if ($stmt = mysqli_prepare($dbconnect, "SELECT * FROM tblRoundScore INNER JOIN tblTeamInfo ON `tblRoundScore`.`rsTeamID` = `tblTeamInfo`.`uTeamID` WHERE rsGameID=?")) {

        /* bind parameters for markers */
        $stmt->bind_param("s", $gameID);

        $stmt->execute();

        $result = $stmt->get_result();

        while ($row = $result->fetch_all(MYSQLI_BOTH)) {
            foreach ($row as $r) {
                array_push($tempResArray, array('round' => $r['rsRound'], 'score' => $r['rsScore'], 'team' => $r['teamName']));
            }
        }
        //Get totalPar for the whole
        //Assume 2 players per team
        $roundInfoArray = clArray();
        $roundInfo = $roundInfoArray[$roundNo];
        $parTotal = $roundInfo['partotal'];
        $realPar = $parTotal * 2;



        $unique_team = array_unique(array_map(function ($elem) {
            return $elem['team'];
        }, $tempResArray));


        $teamScoreArr = [];
        $counter = 1;
        foreach ($unique_team as $team) {
            $scoreCount = 0;
            foreach ($tempResArray as $gSBarr) {
                if ($gSBarr['team'] == $team)
                    $scoreCount = $scoreCount + $gSBarr['score'];
            }
            //$parDif = $realPar - $scoreCount;
            $parDif = $scoreCount - $realPar;
            array_push($teamScoreArr, array('team' => $team, 'score' => $scoreCount, 'parDif' => $parDif));
        }
        //add partotal as team for leaderboard
        array_push($teamScoreArr, array('team' => 'Course Par', 'score' => $realPar, 'parDif' => '==='));

        //Sort array from low to high score (lower is better)


        $price = array_column($teamScoreArr, 'score');

        array_multisort($price, SORT_ASC, $teamScoreArr);

        return ($teamScoreArr);
    }
}

function getScoreForRound($roundNo) //todo also search with game ID
{
    $dbconnect = get_dbc();
    $curRoundScoreArray = [];
    if ($stmt = mysqli_prepare($dbconnect, "SELECT `tblTeamInfo`.`teamName`, `tblRoundScore`.`rsScore` FROM tblRoundScore INNER JOIN tblTeamInfo ON `tblRoundScore`.`rsTeamID` = `tblTeamInfo`.`uTeamID` WHERE rsRound=?")) {

        /* bind parameters for markers */
        $stmt->bind_param("i", $roundNo);

        $stmt->execute();

        $result = $stmt->get_result();

        while ($row = $result->fetch_all(MYSQLI_BOTH)) {
            foreach ($row as $r) {
                array_push($curRoundScoreArray, array('team' => $r['teamName'], 'score' => $r['rsScore']));
            }
        }
        return $curRoundScoreArray;
    }
}
