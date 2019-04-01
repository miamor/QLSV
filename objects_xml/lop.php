<?php
class Lop extends Config
{

    private $table_name = "lop";

    public function __construct()
    {
        parent::__construct();
    }

    public function create()
    {
        $this->name = htmlspecialchars(strip_tags($this->name));
        $exec = $this->conn->in($this->table_name)->insert([
            //'id'     => 2,
            'name' => $this->name,
        ]);

        // execute the query
        if ($exec) {
            return true;
        } else {
            return false;
        }

    }

    public function update()
    {
        // posted values
        $this->name = htmlspecialchars(strip_tags($this->name));

        $exec = $this->conn->in($this->table_name)->where('id', $this->id)->update([
            'name' => $this->name,
        ]);

        if ($exec) {
            return true;
        } else {
            return false;
        }

    }

    public function delete()
    {
        $updateSV = $this->conn->in('sinhvien')->where('class', $this->id)->update([
            'class' => '',
        ]);

        $exec = $this->conn->from($this->table_name)
            ->where('id', $this->id)
            ->limit(1)
            ->delete();

        if ($exec) {
            return true;
        } else {
            return false;
        }

    }

    public function readAll()
    {
        //var_dump($this->conn);
        $this->all_list = [];
        $this->conn->from($this->table_name)->select('*');
        $rows = $this->conn->getAll();
        if ($rows) {
            $rows = json_decode(json_encode($rows), true);
            foreach ($rows as $row) {
                //$row['username'] = '<a href="'.MAIN_URL.'/taxi/'.$row['username'].'"></a>';
                //delete($row['password']);
                $row['name'] = '<a href="' . MAIN_URL . '/lop/' . $row['id'] . '">' . $row['name'] . '</a>';
                $row['created'] = '';
                $this->all_list[] = $row;
            }
        }
        return $this->all_list;
            
    }

    public function readOne()
    {
        $this->conn->from($this->table_name)->select('*')->where('id', $this->id);
        $row = $this->conn->getRow();
        $row = json_decode(json_encode($row), true);

        //$row['name'] = '<a href="' . MAIN_URL . '/lop/' . $row['id'] . '">' . $row['name'] . '</a>';

        if ($row['id']) {
            $this->id = $row['id'];
            $this->name = $row['name'];
            $this->created = $row['created'];
        }

        return ($row['id'] ? $row : null);
    }

    public function readAllSimple()
    {
        $this->all_list = [];
        $this->conn->from($this->table_name)->select('id,name');
        $rows = $this->conn->getAll();
        if ($rows) {
            $rows = json_decode(json_encode($rows), true);
        } else {
            $rows = [];
        }
        return $rows;

    }

}
