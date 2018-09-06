<?php 
require_once('MessageClass.php');

$messageBoard = new Messages;
// echo 'test';
$messageBoard->setSaleID("1");
// $messageBoard->createMessageBoards();
// $messageBoard->insertNewMessage("AHMED", "TSET");
// $messageBoard->insertReplyMessage("1", "reply", "TSET");
$messageBoard->dropMessageBoards();




 ?>