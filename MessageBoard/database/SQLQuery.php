<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);
/**
* SQLQuery
*/
class SQLQuery {

	public $tableName;
	public $columns = "*";
	public $where;
	public $insertCols;
	public $insertVals;

	public function setTable($tableName) {
		$this->tableName = $tableName;
	}

	public function setWhere($where) {
		$this->where = $where;
	}

	// coma separated column names
	public function setInsertColumns($insertCols) {
		$this->insertCols = $insertCols;
	}

	// coma separated column values
	public function setInsertValues($insertVals) {
		$this->insertVals = $insertVals;
	}

	public function insertRow() {

		require_once('DBConnect.php');

		$conObj = new DBH();
		$conn = $conObj->connect();
		// echo "SQLQUERY CLASS CONNETION OBJET"."<BR>";
		// var_dump($conn)."<BR>";
		// echo "INSERT INTO $this->tableName ($this->insertCols) VALUES ($this->insertVals)"."<BR>";

		$insert = $conn->prepare("INSERT INTO $this->tableName ($this->insertCols) VALUES ($this->insertVals)");
		$insert->execute();

		echo "INSERTED NEW ROW"."<BR>";

	}


	public function getRow() {

		echo "getRow function"."<BR>";

		require_once('DBConnect.php');
		$conObj = new DBH();
		$conn = $conObj->connect();

		$result = $conn->prepare("SELECT $this->columns FROM $this->tableName WHERE $this->where");
		$result->execute();

		foreach ($result as $row) {
			print_r($row);
		}

		if (condition) {
			# code...
		}

		echo "<BR>";

		// var_dump($result);

		return $result;


	}


	public function rowExists() {

		// echo "rowExists function"."<BR>";

		require_once('DBConnect.php');
		$conObj = new DBH();
		$conn = $conObj->connect();

		$result = $conn->prepare("SELECT COUNT(*) FROM $this->tableName WHERE $this->where");
		$result->execute();
		$count = $result->fetchColumn();
		// echo $count;

		// var_dump($result);

		// foreach ($result as $row) {
		// 	print_r($row);
		// }
		// echo "<BR>";

		if ($count == 0) {
			// echo "FALSE"."<BR>";
			return false;
		} else {
			// echo "TRUE"."<BR>";
			return true;			
		}





	}


	public function getTableData() {

		require_once('DBConnect.php');
		$conObj = new DBH();
		$conn = $conObj->connect();

		$result = $conn->prepare("SELECT $this->columns FROM $this->tableName");
		$result->execute();

		foreach ($result as $row) {
			print_r($row);
		}

		// var_dump($result);

		return $result;


	}


	public function createTable($createQuery) {

		require_once('DBConnect.php');
		$conObj = new DBH();
		$conn = $conObj->connect();

		$result = $conn->prepare("$createQuery");
		$result->execute();

		// foreach ($result as $row) {
		// 	print_r($row);
		// }

		// var_dump($result);

		// return $result;
		echo "TABLE CREATED"."<BR";
		return;


	}

	public function dropTable($tableName) {

		require_once('DBConnect.php');
		$conObj = new DBH();
		$conn = $conObj->connect();

		$result = $conn->prepare("DROP TABLE $tableName");
		$result->execute();

		// foreach ($result as $row) {
		// 	print_r($row);
		// }

		// var_dump($result);

		// return $result;
		// echo "TABLE CREATED"."<BR";
		return;


	}


	public function tableExists() {
		require_once('DBConnect.php');
		$conObj = new DBH();
		$conn = $conObj->connect();

		$result = $conn->prepare("SHOW TABLES LIKE '$this->tableName'");
		$result->execute();

		echo "$this->tableName";

		if ($result->fetchColumn() > 0) {
			return true;
		} else {
			return false;
			// echo "TABLE NOT FOUND!";
		}



	}



}

?>