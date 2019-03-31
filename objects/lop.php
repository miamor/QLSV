<?php
class Lop extends Config {

    private $table_name = "lop";

    public function __construct() {
		parent::__construct();
	}


    public function create () {
        //write query
			$query = "INSERT INTO
					" . $this->table_name . "
				SET
					name = ?";

		$stmt = $this->conn->prepare($query);

		// posted values
        $this->name = htmlspecialchars(strip_tags($this->name));

        // bind parameters
        $stmt->bindParam(1, $this->name);

        // execute the query
		if ($stmt->execute()) {
			return true;
		} else
			return false;
    }


    public function update () {
        $para = "name = ?";
		$query = "UPDATE
					" . $this->table_name . "
				SET
					name = ?
				WHERE
					id = ?";

		$stmt = $this->conn->prepare($query);

		// posted values
        $this->name = htmlspecialchars(strip_tags($this->name));

        // bind parameters
        $stmt->bindParam(1, $this->name);
        $stmt->bindParam(2, $this->id);

		// execute the query
		if ($stmt->execute()) return true;
		else return false;
	}

	public function delete () {

        $q = "UPDATE sinhvien SET class = NULL WHERE class = ?";
		$st = $this->conn->prepare($q);
		$st->bindParam(1, $this->id);
		if ($st->execute()) {
            $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $this->id);

            // execute the query
            if ($result = $stmt->execute()) return true;
            else return false;
        }
        return false;
	}


    public function readAll () {
        $cond = '';
        $query = "SELECT *
				FROM lop ORDER BY name ASC";

		$stmt = $this->conn->prepare($query);
		$stmt->execute();

		$this->all_list = array();

		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        //    $row['username'] = '<a href="'.MAIN_URL.'/taxi/'.$row['username'].'"></a>';
            //delete($row['password']);
            $row['name'] = '<a href="'.MAIN_URL.'/dantoc/'.$row['id'].'">'.$row['name'].'</a>';
            $this->all_list[] = $row;
        }
        return $this->all_list;
    }


    public function readOne () {
        $query = "SELECT
					*
				FROM
					" . $this->table_name . "
				WHERE id = ?";
        $stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id);

		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set values
        if ($row['id']) {
            $this->id = $row['id'];
            $this->name = $row['name'];
            $this->created = $row['created'];
        }

        return ($row['id'] ? $row : null);
    }

    public function readAllSimple () {
        $query = "SELECT
				    *
				FROM
					" . $this->table_name . "
				ORDER BY name ASC";

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
