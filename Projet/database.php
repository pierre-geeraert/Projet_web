<?php
require ("identifier.php");
class Database
{
  private $HOST = HOST;
  private $USER = USER;
  private $PASS = PASS;
  private $_connect,$_error,$_stmt;
  function __construct()
  {
    // Define attributes for PDO instance
    $ATTR = array(
        PDO::ATTR_PERSISTENT => true,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    );
    // New PDO instance
    try{
        $this->_connect = new PDO($this->HOST, $this->USER, $this->PASS, $ATTR);
    } catch (PDOException $e) {
        $this->_error = $e->getMessage();
    }
  }

  public function query ($sql, $data = array()){
		$this->_stmt = $this->_connect->prepare($sql);
		$this->_stmt->execute($data);
		return $this->_stmt->fetchAll(PDO::FETCH_OBJ);
	}
    public function prepare ($sql, $data = array()){
		$this->_stmt = $this->_connect->prepare($sql);
		$this->_stmt->execute($data);
		return $this->_stmt->fetchAll(PDO::FETCH_OBJ);
	}
 
  // execute method
  public function execute(){
      return $this->_stmt->execute();
  }
  // fetch method
  public function fetch(){
      $this->execute();
      return $this->_stmt->fetch(PDO::FETCH_ASSOC);
  }
  // fetchAll method
  public function fetchAll(){
      $this->execute();
      return $this->_stmt->fetchAll(PDO::FETCH_ASSOC);
  }
  // rowCount method
  public function rowCount(){
      return $this->_stmt->rowCount();
  }
  // lastInsertId method
  public function lastInsertId(){
    return $this->_connect->lastInsertId();
  }
  // bindParam method
  public function bindParam($param, $value, $type = null){
      if(is_null($type)){
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
      $this->_stmt->bindvalue($param,$value,$type);
  }
  // closeCursor method
  public function closeCursor() {
    return $this->_stmt->closeCursor();
  }
}
 ?>