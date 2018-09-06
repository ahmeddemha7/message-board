<?php 

class Messages {


	const SALESTABLE = "sales";
	public $saleID = "";

	public function setSaleID($propertyValue) {
		require_once('./database/SQLQuery.php');

		// check if sale exists first
		$checkID = $propertyValue;

		$queryObj = new SQLQuery;
		$queryObj->setTable(self::SALESTABLE);
		$queryObj->setWhere("saleid = $checkID");
		$result = $queryObj->rowExists();

		if ($result) {
			echo "SALEID SET!"."<BR>";		
			$this->saleID = $propertyValue;
		} else {			
			echo "SALEID NOT FOUND"."<BR>";
			// echo $result;
		}
		
	}


	public function createMessageBoards() {
		require_once('./database/SQLQuery.php');

		$messageTable = "messageboard_".$this->saleID;
		$replyTable = "replyboard_".$this->saleID;

		// check if sale exists first
		$queryObj = new SQLQuery;
		$queryObj->createTable("CREATE TABLE `whalesale`.`$messageTable` ( `MessageID` INT NOT NULL AUTO_INCREMENT , `SaleID` INT NOT NULL , `User` TINYTEXT NOT NULL , `Message` TEXT NOT NULL , `Reply` TINYTEXT, `CreateDate` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`MessageID`)) ENGINE = INNODB;");

		echo "MESSAGE BOARD CREATED!!"."<BR>";

		$queryObj->createTable("CREATE TABLE `whalesale`.`$replyTable` ( `ReplyID` INT NOT NULL AUTO_INCREMENT ,`MessageID` INT NOT NULL, `User` TINYTEXT NOT NULL , `Message` TEXT NOT NULL , `CreateDate` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`ReplyID`)) ENGINE = INNODB;");

		echo "REPLY BOARD CREATED!!"."<BR>";





	}


	public function insertNewMessage($user, $message) {
		require_once('./database/SQLQuery.php');


		$queryObj = new SQLQuery;
		$messageTable = "messageboard_".$this->saleID;
		// echo $messageTable."<BR>";
		$queryObj->setTable($messageTable);
		$queryObj->setInsertColumns("SaleID, User, Message");
		$queryObj->setInsertValues("$this->saleID, '$user', '$message'");
		$queryObj->insertRow();

		echo "MESSAGE INSERTED"."<BR>";


	}


	public function insertReplyMessage($messageID, $user, $message) {
		require_once('./database/SQLQuery.php');

		$queryObj = new SQLQuery;
		$replyTable = "replyboard_".$this->saleID;
		// echo $replyTable."<BR>";
		$queryObj->setTable($replyTable);
		$queryObj->setInsertColumns("MessageID, User, Message");
		$queryObj->setInsertValues("$messageID, '$user', '$message'");
		$queryObj->insertRow();

		echo "REPLY INSERTED"."<BR>";

	}


	public function dropMessageBoards() {
		require_once('./database/SQLQuery.php');

		$messageTable = "messageboard_".$this->saleID;
		$replyTable = "replyboard_".$this->saleID;

		$queryObj = new SQLQuery;
		$queryObj->dropTable($messageTable);
		$queryObj->dropTable($replyTable);

		echo "TABLES DROPPED"."<BR>";


	}



}




 ?>