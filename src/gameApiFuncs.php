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
                $currentRoundArray = $clArray[$r['gameRound']];
            }
        }

        return $currentRoundArray;
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
    if ($stmt = mysqli_prepare($dbconnect, "SELECT `rsScore` FROM tblRoundScore WHERE rsGameID=? AND rsTeamID = ?")) {

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
