<?php
namespace models;

use config\Db;

class TerritoryModel extends Model {

    public $table = "t_koatuu_tree";

    public function getSection($level = 1) {

        $query = "SELECT * FROM " . $this->table . " WHERE ter_level = " . $level;

        $this->result = mysqli_query(Db::getConnect(), $query);

        return $this->createArray($this->result);
    }

    public function getChildren($id) {

        $query = "SELECT * FROM " . $this->table . " WHERE ter_pid = " . $id;

        $this->result = mysqli_query(Db::getConnect(), $query);

        return $this->createArray($this->result);
    }

}