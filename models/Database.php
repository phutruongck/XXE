<?php
class Database
{
	private $hostname = 'localhost';
	private $username = 'root';
	private $password = '';
	private $database = 'xss';

	public $cn;

	public function __construct() {
		$this->cn = mysqli_connect($this->hostname, $this->username, $this->password, $this->database);
	}

	public function query($sql = null) {
		if($this->cn) {
			return mysqli_query($this->cn, $sql);
		}
	}

	public function num_rows($sql = null) {
		if($this->cn) {
			$query = mysqli_query($this->cn, $sql);
			$num_rows = mysqli_num_rows($query);
			return $num_rows;
		}
	}

	public function fetch_assoc($sql = null, $type) {
		if($this->cn) {
			$query = mysqli_query($this->cn, $sql);
			if($type == 1){
				$data = mysqli_fetch_assoc($query);
				return $data;
			}
			else if($type == 0){
				while($row = mysqli_fetch_assoc($query)){
					$data[] = $row;
				}
				return $data;
			}
		}
	}

	public function real_escape_string($string) {
    	if ($this->cn) {
            $string = mysqli_real_escape_string($this->cn, $string);
        }
        else{
            $string = $string;
        }
        return $string;
    }

    public function insert_id() {
        if($this->cn) {
            return mysqli_insert_id($this->cn);
        }
    }

	public function insert($table_name, $data) {
    	if($this->cn) {
			$string = "INSERT INTO ".$table_name." (";
			$string .= implode(",", array_keys($data)) . ') VALUES (';
			$string .= "'" . implode("','", array_values($data)) . "')";
			if(mysqli_query($this->cn, $string))  
			{
		    	return true;
			}
			else
			{
				return mysqli_error($this->cn);
			}
    	}
    }

    public function close() {
        if($this->cn) {
            mysqli_close($this->cn);
        }
    }

    public function set_char($uni) {
        if($this->cn) {
            mysqli_set_charset($this->cn, $uni);
        }
    }
}
?>