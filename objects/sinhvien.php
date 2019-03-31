<?php
class SinhVien extends Config {

    private $table_name = "sinhvien";

    public function __construct() {
		parent::__construct();
	}


    public function create () {
        //write query
        if ($this->timelife) {
			$query = "INSERT INTO
					" . $this->table_name . "
				SET
					username = ?, password = ?, name = ?, phone = ?, birthday = ?, class = ?, ethnic = ?, status = ?, timelife = ?";
        } else {
            $query = "INSERT INTO
					" . $this->table_name . "
				SET
					username = ?, password = ?, name = ?, phone = ?, birthday = ?, class = ?, ethnic = ?";
        }

		$stmt = $this->conn->prepare($query);

		// posted values
        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->password = hash('sha256', $this->password);
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->phone = htmlspecialchars(strip_tags($this->phone));
        $this->birthday = htmlspecialchars(strip_tags($this->birthday));
        $this->class = htmlspecialchars(strip_tags($this->class));
        $this->ethnic = htmlspecialchars(strip_tags($this->ethnic));
        $this->status = htmlspecialchars(strip_tags($this->status));
        $this->timelife = htmlspecialchars(strip_tags($this->timelife));

        // bind parameters
        $stmt->bindParam(1, $this->username);
        $stmt->bindParam(2, $this->password);
        $stmt->bindParam(3, $this->name);
        $stmt->bindParam(4, $this->phone);
        $stmt->bindParam(5, $this->birthday);
        $stmt->bindParam(6, $this->class);
        $stmt->bindParam(7, $this->ethnic);
        if ($this->timelife) {
            $stmt->bindParam(8, $this->status);
            $stmt->bindParam(9, $this->timelife);
        }

        // execute the query
		if ($stmt->execute()) {
			return true;
		} else
			return false;
    }


    public function update () {
        if ($this->timelife) $para = "name = ?, phone = ?, birthday = ?, class = ?, ethnic = ?, status = ?, timelife = ?";
        else $para = "name = ?, phone = ?, birthday = ?, class = ?, ethnic = ?";
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
        $this->birthday = htmlspecialchars(strip_tags($this->birthday));
        $this->class = htmlspecialchars(strip_tags($this->class));
        $this->ethnic = htmlspecialchars(strip_tags($this->ethnic));
        if ($this->timelife) {
            $this->status = htmlspecialchars(strip_tags($this->status));
            $this->timelife = htmlspecialchars(strip_tags($this->timelife));
        }

        // bind parameters
        $stmt->bindParam(1, $this->name);
        $stmt->bindParam(2, $this->phone);
        $stmt->bindParam(3, $this->birthday);
        $stmt->bindParam(4, $this->class);
        $stmt->bindParam(5, $this->ethnic);
        if ($this->timelife) {
            $stmt->bindParam(6, $this->status);
            $stmt->bindParam(7, $this->timelife);
            $stmt->bindParam(8, $this->username);
        }
        else $stmt->bindParam(6, $this->username);

		// execute the query
		if ($stmt->execute()) return true;
		else return false;
	}

    function lock() {
        $para = "status = ?, timelife = ?";
		$query = "UPDATE
					" . $this->table_name . "
				SET
					{$para}
				WHERE
					username = ?";

		$stmt = $this->conn->prepare($query);

		// posted values
            $this->status = htmlspecialchars(strip_tags($this->status));
            $this->timelife = htmlspecialchars(strip_tags($this->timelife));

        // bind parameters
            $stmt->bindParam(1, $this->status);
            $stmt->bindParam(2, $this->timelife);
            $stmt->bindParam(3, $this->username);

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


    public function openaccount () {
        $query = "UPDATE
					" . $this->table_name . "
				SET
					status = 0
				WHERE
					username = :username";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $this->username);

        // execute the query
    	if ($stmt->execute()) return true;
    	else return false;
    }

	public function delete () {

		$query = "DELETE FROM " . $this->table_name . " WHERE username = ?";

		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->username);

        // execute the query
		if ($result = $stmt->execute()) return true;
		else return false;
	}


    public function readAll () {
        $cond = '';
        $query = "SELECT
				    SV.id, SV.username, SV.name, SV.status, SV.phone, SV.birthday, SV.ethnic AS ethnic_id, SV.class AS class_id,
                    E.name AS ethnic_name,
                    C.name AS class_name
				FROM sinhvien SV
                LEFT JOIN dantoc E
                    ON SV.ethnic = E.id
                LEFT JOIN lop C
                    ON SV.class = C.id
                ORDER BY SV.id DESC";

		$stmt = $this->conn->prepare($query);
		$stmt->execute();

		$this->all_list = array();

		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        //    $row['username'] = '<a href="'.MAIN_URL.'/taxi/'.$row['username'].'"></a>';
            //delete($row['password']);
            $row['id'] = $row['username'];
            $row['username'] = '<a href="'.MAIN_URL.'/sinhvien/'.$row['username'].'">'.$row['username'].'</a>';
            $row['ethnic'] = '<a href="'.MAIN_URL.'/dantoc/'.$row['ethnic_id'].'">'.$row['ethnic_name'].'</a>';
            $row['class'] = '<a href="'.MAIN_URL.'/lop/'.$row['class_id'].'">'.$row['class_name'].'</a>';
            $this->all_list[] = $row;
        }
        return $this->all_list;
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
            $this->birthday = $row['birthday'];
            $this->ethnic = $row['ethnic'];
            $this->timelife = $row['timelife'];
            $this->status = $row['status'];
            $this->created = $row['created'];
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
