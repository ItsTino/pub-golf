<?php
require_once('../src/gameApiFuncs.php');

//$teamArray = (getTeams('c05f5fd0-f207-4abd-8ee4-5f3f66b86bd0'));
//print_r($teamArray);
//print_r($teamArray[1]['teamName']);

$curround = getCurrentRoundInfo('c05f5fd0-f207-4abd-8ee4-5f3f66b86bd0');
print_r($curround);

?>