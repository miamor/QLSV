<?php
class User extends Config {

    private $table_name = "User";

    public function __construct() {
		parent::__construct();
	}


    public function create () {
        //write query
			$query = "INSERT INTO
					" . $this->table_name . "
				SET
					username = ?, password = ?, name = ?, phone = ?, idcard = ?, idcar = ?, typecar = ?, seat = ?, coin = ?, status = ?, timelife = ?";

		$stmt = $this->conn->prepare($query);

		// posted values
        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->password = hash('sha256', $this->password);
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->phone = htmlspecialchars(strip_tags($this->phone));
        $this->idcard = htmlspecialchars(strip_tags($this->idcard));
        $this->idcar = htmlspecialchars(strip_tags($this->idcar));
        $this->typecar = htmlspecialchars(strip_tags($this->typecar));
        $this->seat = htmlspecialchars(strip_tags($this->seat));
        $this->coin = htmlspecialchars(strip_tags($this->coin));
        $this->status = htmlspecialchars(strip_tags($this->status));
        $this->timelife = htmlspecialchars(strip_tags($this->timelife));

        // bind parameters
        $stmt->bindParam(1, $this->username);
        $stmt->bindParam(2, $this->password);
        $stmt->bindParam(3, $this->name);
        $stmt->bindParam(4, $this->phone);
        $stmt->bindParam(5, $this->idcard);
        $stmt->bindParam(6, $this->idcar);
        $stmt->bindParam(7, $this->typecar);
        $stmt->bindParam(8, $this->seat);
        $stmt->bindParam(9, $this->coin);
        $stmt->bindParam(10, $this->status);
        $stmt->bindParam(11, $this->timelife);

        // execute the query
		if ($stmt->execute()) {
			return true;
		} else
			return false;
    }


    public function update () {
        if ($this->timelife) $para = "name = ?, phone = ?, idcard = ?, idcar = ?, typecar = ?, seat = ?, status = ?, timelife = ?";
        else $para = "name = ?, phone = ?, idcard = ?, idcar = ?, typecar = ?, seat = ?";
		$query = "UPDATE
					" . $this->table_name . "
				SET
					{$para}
				WHERE
					username = ?";

		$stmt = $this->conn->prepare($query);

		// posted values
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->phone = htmlspecialchars(strip_tags($this->phone));
        $this->idcard = htmlspecialchars(strip_tags($this->idcard));
        $this->idcar = htmlspecialchars(strip_tags($this->idcar));
        $this->typecar = htmlspecialchars(strip_tags($this->typecar));
        $this->seat = htmlspecialchars(strip_tags($this->seat));
        $this->coin = htmlspecialchars(strip_tags($this->coin));
        if ($this->timelife) {
            $this->status = htmlspecialchars(strip_tags($this->status));
            $this->timelife = htmlspecialchars(strip_tags($this->timelife));
        }

        // bind parameters
        $stmt->bindParam(1, $this->name);
        $stmt->bindParam(2, $this->phone);
        $stmt->bindParam(3, $this->idcard);
        $stmt->bindParam(4, $this->idcar);
        $stmt->bindParam(5, $this->typecar);
        $stmt->bindParam(6, $this->seat);
        if ($this->timelife) {
            $stmt->bindParam(7, $this->status);
            $stmt->bindParam(8, $this->timelife);
            $stmt->bindParam(9, $this->username);
        }
        else $stmt->bindParam(7, $this->username);

		// execute the query
		if ($stmt->execute()) return true;
		else return false;
	}

    public function updatePassword () {
		$query = "UPDATE
					" . $this->table_name . "
				SET
					password = ?
				WHERE
					username = ?";

		$stmt = $this->conn->prepare($query);

		// posted values
        $this->password = hash('sha256', $this->password);

        $stmt->bindParam(1, $this->password);
        $stmt->bindParam(2, $this->username);

		// execute the query
		if ($stmt->execute()) return true;
		else return false;
	}

    public function updateCoin ($coin_change) {
        $this->newCoin = $this->coin + $coin_change;
    	$query = "UPDATE
    				" . $this->table_name . "
    			SET
    				coin = ?
    			WHERE
    				username = ?";

    	$stmt = $this->conn->prepare($query);

    	// posted values
        $stmt->bindParam(1, $this->newCoin);
        $stmt->bindParam(2, $this->username);

    	// execute the query
    	if ($stmt->execute()) {
            $this->insertPayCoin($coin_change);
            return true;
        }
    	else return false;
	}

    public function insertPayCoin ($coin) {
        if ($coin > 0) $type = 1;
        else $type = -1;
        $now = date("Y-m-d H:i:s");
        $query = "INSERT INTO PayCoin SET type = ?, taxiID = ?, coin = ?, time = ?";
        $stmt = $this->conn->prepare($query);
        // bind parameters
        $stmt->bindParam(1, $type);
    	$stmt->bindParam(2, $this->id);
        $stmt->bindParam(3, $coin);
        $stmt->bindParam(4, $now);

    	if ($stmt->execute()) {
            return 1;
        } else return 0;
    }

    public function openaccount () {
        $query = "UPDATE
					" . $this->table_name . "
				SET
					status = 0, timelife = 0
				WHERE
					username = :username";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $this->username);

        // execute the query
    	if ($stmt->execute()) return true;
    	else return false;
    }

	public function delete () {

		$query = "DELETE FROM " . $this->table_name . " WHERE id = ?";

		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id);

        // execute the query
		if ($result = $stmt->execute()) return true;
		else return false;
	}


    public function readAll () {
        $cond = '';
        $query = "SELECT
				    username,name,phone,idcard,idcar,typecar,seat,coin,rank,status
				FROM
					" . $this->table_name . "
				{$cond}";

		$stmt = $this->conn->prepare($query);
		$stmt->execute();

		$this->all_list = array();

		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        //    $row['username'] = '<a href="'.MAIN_URL.'/taxi/'.$row['username'].'"></a>';
            $this->all_list[] = $row;
        }
        return $this->all_list;
    }

    public function getPayHistory () {

    }

    public function readOne () {
        $query = "SELECT
					*
				FROM
					" . $this->table_name . "
				WHERE username = ?";
        $stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->username);

		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set values
        if ($row['id']) {
            $this->id = $row['id'];
            $this->username = $row['username'];
            $this->name = $row['name'];
            $this->phone = $row['phone'];
            $this->idcard = $row['idcard'];
            $this->idcar = $row['idcar'];
            $this->typecar = $row['typecar'];
            $this->seat = $row['seat'];
            $this->coin = $row['coin'];
            $this->rank = $row['rank'];
            $this->timelife = $row['timelife'];
            $this->status = $row['status'];
            $this->idboss = $row['idboss'];
        }

        return ($row['id'] ? $row : null);
    }

    public function readAllSimple () {
        $query = "SELECT
				    id,username,name
				FROM
					" . $this->table_name . "
				";

		$stmt = $this->conn->prepare($query);
		$stmt->execute();

		$this->all_list = array();

		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $this->all_list[] = $row;
        }
        return $this->all_list;
    }

}

 ?>
