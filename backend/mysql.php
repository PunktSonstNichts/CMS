<?php
class mysql{ 
    private $last_injection = ''; 
    private $connection = null; 
   
    public function __construct(){
	global $dbhost;
	global $dbuser;
	global $dbpass;
	global $dbname;
        $this->host     = $dbhost;
        $this->user     = $dbuser;
        $this->dbpass   = $dbpass;
        $this->dbname   = $dbname;
        $this->connect();
        return($this->connection);
    }
    private function connect(){ 
        $this->connection = mysql_connect($this->host,$this->user,$this->dbpass); 
        if($this->connection === false){ 
            $message  = "Verbindung zur Datenbank nicht m&ouml;glich.-";
            $message .= mysql_error();
            new error("mysql", $message); 
            }else{ 
            $this->select_db(); 
        } 
    } 
    private function select_db(){ 
        $select = mysql_select_db($this->dbname,$this->connection); 
        if($select === false){ 
            $message  = "Die angegebene Datenbank \"".$this->dbname."\" existiert nicht.<br />\n"; 
            $message .= "Mysql-fehlermeldung: <br />\n"; 
            $message .= mysql_error(); 
             
            trigger_error($message); 
        } 
    } 
     
     
     
    public function query($sqlcode){ 
        $this->last_injection = mysql_query($sqlcode); 
         
            if($this->last_injection === false){ 
                $message  = "Fehler bei dem Ausf&uuml;hren eines Mysql-codes!<br />\n"; 
                $message .= "Mysql-Code: " . htmlspecialchars($sqlcode, ENT_QUOTES) . "<br />\n"; 
                $message .= "Mysql-fehlermeldung:<br />\n"; 
                $message .= mysql_error(); 
                trigger_error($message); 
            } 
            
        return($this->last_injection); 
    } 
     
     
     
    public function result($sql = NULL, $type = "array", &$row = ''){ 
        $inc = ''; 
        if($sql === NULL){ 
            $inc = $this->last_injection; 
            } else { 
            $inc = $sql; 
        }
		switch($type){
			case "array":
				$row = mysql_fetch_array($inc);
				break;
			case "row":
				$row = mysql_fetch_row($inc); 
				break;
			case "object":
				$row = mysql_fetch_object($inc);
				break;
			case "assoc":
				$row = mysql_fetch_assoc($inc); 
				break;
			case "num":
				$row = mysql_num_rows($inc);
				break;
		}
        return($row); 
    }    
    
	public function free_result($sql = NULL){ 
        $inc = ''; 
        if($sql === NULL) 
        { 
            $inc = $this->last_injection; 
            } else { 
            $inc = $sql; 
        } 
         
        mysql_free_result($inc); 
    }   
     
    public function sql_string($string){ 
        return(mysql_real_escape_string($string)); 
    }
	  
     
     
    public function insert_id(&$row = '') 
    { 
     
        $row = mysql_insert_id(); 
         
        return($row); 
    } 
     
     
     
    public function close_connect(){ 
        mysql_close($this->connection); 
    } 
}
?>