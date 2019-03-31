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

        $query = 'SELECT * FROM '.$this->table_name.'
            WHERE username = '.$this->username.' AND password = '.md5($this->password);
        $stmt = $this->conn->prepare($query);
        /*$stmt->bindParam(1, $this->username);
        $stmt->bindParam(2, md5($this->password));*/

        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set values
        if ($row['id']) {
            return true;
        }

        return false;
    }

}

 ?>
