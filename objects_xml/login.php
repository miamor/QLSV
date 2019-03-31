<?php
class Login extends Config {

    private $table_name = "admin";

    public function __construct() {
		parent::__construct();
	}

    public function login () {
        /*
        $query = "SELECT
					*
				FROM
					" . $this->table_name . "
				WHERE username = ?";
        $stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->username);
		$stmt->bindParam(2, md5($this->password));

		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set values
        if ($row['id']) {
            if ( hash('sha256', $this->password) === $row['password'] ) {
                return true;
            }
        }*/
        $this->conn->from($this->table_name)->select('*')->where('username', $this->username)->where('password', md5($this->password));
        $row = $this->conn->getRow();
        //$row = json_decode(json_encode($row), true);

        return ($row->id ? true : false);
    }

}

 ?>
