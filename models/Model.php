<?php
namespace models;
use config\Db;

include_once 'config/db.php';

class Model {

    private $columns = [];
    private $pk_name;
    protected $result;

    public $values = [];

    protected function createArray($result) {

        if (!$result) {
            return false;
        }

        $n_rows = mysqli_num_rows($result);
        $array = [];

        for ($i = 0; $i < $n_rows; $i++) {

            $row = mysqli_fetch_assoc($result);
            $array[] = $row;

        }
        return $array;
    }

    private function readStructure() {

        $this->result = mysqli_query(Db::getConnect(), "DESC " . $this->table);
        $res = $this->createArray($this->result);
        $k = 1;

        for ($i = 0; $i < count($res); $i++) {

            if ($res[$i]["Key"] == "PRI") {
                $this->columns[0] = $res[$i]["Field"];
            } else {

                $this->columns[$k++] = $res[$i]["Field"];
            }

        }
        $this->pk_name = $this->columns[0];
    }

    public function get($value = '', $field = '') {

        if ($field) {

            $query = "SELECT * FROM " . $this->table . " WHERE " . $field . " = " . $value;

            $this->result = mysqli_query(Db::getConnect(), $query);

            return $this->createArray($this->result);

        } elseif ($value) {

            $query = "SELECT * FROM " . $this->table . " WHERE " . $this->pk_name . " = " . $value;

            $this->result = mysqli_query(Db::getConnect(), $query);

            $row = mysqli_fetch_assoc($this->result);

            return $row;

        } else {

            $query = "SELECT * FROM " . $this->table;

            $this->result = mysqli_query(Db::getConnect(), $query);

            return $this->createArray($this->result);
        }
    }

    public function getColomns() {

        return $this->columns;
    }

    public function __construct($values = [])
    {
        $this->readStructure();
    }

    public function create() {}

    public function delete() {}

    public function update() {}
}