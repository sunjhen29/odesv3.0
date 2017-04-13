<?php
require_once("dbconfig.php");

class Database{
	private $host = DB_HOST;
	private $user = DB_USER;
	private $pass = DB_PASS;
	private $dbname = DB_NAME;

	private $dbh;
	private $error;
	private $stmt;

	public function __construct(){
        // Set DSN
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
        // Set options
        $options = array(
            PDO::ATTR_PERSISTENT    => true,
            PDO::ATTR_ERRMODE       => PDO::ERRMODE_EXCEPTION
        );
        // Create a new PDO instanace
        try{
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
        }
        // Catch any errors
        catch(PDOException $e){
            $this->error = $e->getMessage();
        }
    }

	//bind function
	public function bind($param, $value, $type=null){
		if (is_null($type)) {
		  switch (true) {
			case is_int($value):
			  $type = PDO::PARAM_INT;
			  break;
			case is_bool($value):
			  $type = PDO::PARAM_BOOL;
			  break;
			case is_null($value):
			  $type = PDO::PARAM_NULL;
			  break;
			default:
			  $type = PDO::PARAM_STR;
			}
		}
		$this->stmt->bindValue($param, $value, $type);
	}

	//query function
	public function query($query){
		$this->stmt = $this->dbh->prepare($query);
	}

	//execute prepared statement
	public function execute(){
		return $this->stmt->execute();
	}

	//result set
	public function resultset(){
		$this->execute();
		return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	
	public function resultset_array(){
		$this->execute();
		return $this->stmt->fetchAll(PDO::FETCH_COLUMN);
	}

	//single record search
	public function single(){
		$this->execute();
		return $this->stmt->fetch(PDO::FETCH_ASSOC);
	}
	
	//fetch key pair result
	public function keypair(){
		$this->execute();
		return $this->stmt->fetchAll(PDO::FETCH_KEY_PAIR);
	}

	//row count
	public function rowCount(){
		return $this->stmt->fetchColumn();
	}

	//get last insert id
	public function lastInsertId(){
		return $this->dbh->lastInsertId();
	}

	//begin transactions
	public function beginTransaction(){
		return $this->dbh->beginTransaction();
	}

	//end transactions
	public function endTransaction(){
		return $this->dbh->commit();
	}

	//cancel transactions
	public function cancelTransaction(){
		return $this->dbh->rollBack();
	}

	//function for debugging
	public function debugDumpParams(){
		return $this->stmt->debugDumpParams();
	}	
}
$database = new Database();
?>