<?php
class SinhVien extends Config {

    private $table_name = "sinhvien";

    public function __construct() {
		parent::__construct();
	}


    public function create () {

        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->password = hash('sha256', $this->password);
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->phone = htmlspecialchars(strip_tags($this->phone));
        $this->birthday = htmlspecialchars(strip_tags($this->birthday));
        $this->class = htmlspecialchars(strip_tags($this->class));
        $this->ethnic = htmlspecialchars(strip_tags($this->ethnic));
        $this->status = htmlspecialchars(strip_tags($this->status));
        $this->timelife = htmlspecialchars(strip_tags($this->timelife));

        $exec = $this->conn->in($this->table_name)->insert([
            //'id'     => 2,
            'username' => $this->username,
            'password' => $this->password,
            'phone' => $this->phone,
            'birthday' => $this->birthday,
            'class' => $this->class,
            'ethnic' => $this->ethnic,
            'name' => $this->name,
            'status' => $this->status,
            'timelife' => $this->timelife
        ]);

        // execute the query
        if ($exec) {
            return true;
        } else {
            return false;
        }

    }


    public function update () {

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->phone = htmlspecialchars(strip_tags($this->phone));
        $this->birthday = htmlspecialchars(strip_tags($this->birthday));
        $this->class = htmlspecialchars(strip_tags($this->class));
        $this->ethnic = htmlspecialchars(strip_tags($this->ethnic));
        if ($this->timelife) {
            $this->status = htmlspecialchars(strip_tags($this->status));
            $this->timelife = htmlspecialchars(strip_tags($this->timelife));
        }

        if ($this->timelife) {
            $exec = $this->conn->in($this->table_name)->where('username', $this->username)->update([
                'username' => $this->username,
                'password' => $this->password,
                'phone' => $this->phone,
                'birthday' => $this->birthday,
                'class' => $this->class,
                'ethnic' => $this->ethnic,
                'name' => $this->name,
                'status' => $this->status,
                'timelife' => $this->timelife
            ]);
        } else {
            $exec = $this->conn->in($this->table_name)->where('username', $this->username)->update([
                'username' => $this->username,
                'password' => $this->password,
                'phone' => $this->phone,
                'birthday' => $this->birthday,
                'class' => $this->class,
                'ethnic' => $this->ethnic,
                'name' => $this->name
            ]);
        }

        if ($exec) {
            return true;
        } else {
            return false;
        }

	}

    function lock() {

        $this->status = htmlspecialchars(strip_tags($this->status));
        $this->timelife = htmlspecialchars(strip_tags($this->timelife));

        $exec = $this->conn->in($this->table_name)->where('username', $this->username)->update([
            'status' => $this->status,
            'timelife' => $this->timelife
        ]);

		// execute the query
		if ($exec) return true;
		else return false;
    }

    public function updatePassword () {

        $this->password = hash('sha256', $this->password);

        $exec = $this->conn->in($this->table_name)->where('username', $this->username)->update([
            'password' => $this->password
        ]);

		// execute the query
		if ($exec) return true;
		else return false;

    }


    public function openaccount () {
        $exec = $this->conn->in($this->table_name)->where('username', $this->username)->update([
            'status' => 0
        ]);

		// execute the query
		if ($exec) return true;
		else return false;
    }

	public function delete () {
        $exec = $this->conn->from($this->table_name)
            ->where('username', $this->username)
            ->limit(1)
            ->delete();

        if ($exec) {
            return true;
        } else {
            return false;
        }
	}


    public function readAll () {
        $this->conn->from($this->table_name)
        ->join('dantoc' ,'ethnic', 'id')
        ->select('*')
        ->join('lop' ,'class', 'id')
        ->select('*');

        $rows = $this->conn->getAll();
        $rows = json_decode(json_encode($rows), true);

		foreach ($rows as $row) {
            //$row['username'] = '<a href="'.MAIN_URL.'/taxi/'.$row['username'].'"></a>';
            //delete($row['password']);
            $row['id'] = $row['username'];
            $row['username'] = '<a href="'.MAIN_URL.'/sinhvien/'.$row['username'].'">'.$row['username'].'</a>';
            $row['ethnic'] = '<a href="'.MAIN_URL.'/dantoc/'.$row['dantoc_id'].'">'.$row['dantoc_name'].'</a>';
            $row['class'] = '<a href="'.MAIN_URL.'/lop/'.$row['lop_id'].'">'.$row['lop_name'].'</a>';
            $this->all_list[] = $row;
        }
        return $this->all_list;
    }


    public function readOne () {
        $this->conn->from($this->table_name)
        ->select('*')
        ->where('username', $this->username);

        $row = $this->conn->getRow();
        $row = json_decode(json_encode($row), true);

        if ($row['id']) {
            $this->id = $row['id'];
            $this->username = $row['username'];
            $this->name = $row['name'];
            $this->phone = $row['phone'];
            $this->birthday = $row['birthday'];
            $this->ethnic = $row['ethnic'];
            $this->class = $row['class'];
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
