<?php


function clArray() {
    //Predefine the course list
//This is cheating but enough database stuff for now and this isn't dynamic yet
$courseList = [];
$courseList[1] = array('step' => '1', 'name' => 'The Lark Rise', 'drink' => 'Lager', 'par' => '3', 'partotal' => '3');
$courseList[2] = array('step' => '2', 'name' => 'Parkstone & Heatherlands', 'drink' => 'Lager', 'par' => '3', 'partotal' => '6');
$courseList[3] = array('step' => '3', 'name' => 'Buffalo', 'drink' => 'Cider', 'par' => '3', 'partotal' => '9');
$courseList[4] = array('step' => '4', 'name' => 'Richmond Arms', 'drink' => 'Lager', 'par' => '3', 'partotal' => '12');
$courseList[5] = array('step' => '5', 'name' => 'Tesco Express', 'drink' => 'Tinny', 'par' => '3', 'partotal' => '15');
$courseList[6] = array('step' => '6', 'name' => 'Christopher Creeke', 'drink' => 'Spirit x2', 'par' => '2', 'partotal' => '17');
$courseList[7] = array('step' => '7', 'name' => 'George Tapps', 'drink' => 'Wine', 'par' => '2', 'partotal' => '20');
$courseList[8] = array('step' => '8', 'name' => 'Brasshouse', 'drink' => 'Dark Fruit', 'par' => '3', 'partotal' => '23');
$courseList[9] = array('step' => '9', 'name' => 'Moon', 'drink' => 'Pitcher (1x per Team)', 'par' => '3', 'partotal' => '26');
$courseList[10] = array('step' => '10', 'name' => 'Shelley', 'drink' => 'Lager', 'par' => '3', 'partotal' => '29');



 return $courseList;
}
?>