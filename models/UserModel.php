<?php
namespace models;

use config\Db;

class UserModel extends Model {

    protected $table = "users";

    public function insertUser($data) {

        $name       = htmlspecialchars(mysqli_real_escape_string(Db::getConnect(), trim($data['name'])));
        $email      = htmlspecialchars(mysqli_real_escape_string(Db::getConnect(), trim($data['email'])));
        $region     = htmlspecialchars(mysqli_real_escape_string(Db::getConnect(), trim($data['region'])));
        $city       = htmlspecialchars(mysqli_real_escape_string(Db::getConnect(), trim($data['city'])));
        $regionCity = htmlspecialchars(mysqli_real_escape_string(Db::getConnect(), trim($data['city-region'])));

        if (!($name && $email && $region != 'null' && $city != 'null')) {
            return false;
        }

        $ter = $regionCity != 'null' ? $regionCity : $city;

        $query = "INSERT INTO " . $this->table . " (name, email, territory) VALUES (?,?,?)";

        $insert = Db::getConnect()->prepare($query);
        $insert->bind_param('sss', $name, $email, $ter);

        $insert->execute();
        $newId = $insert->insert_id ?: 0;
        $insert->close();
        return $newId;
    }

    public function userInfoByEmail($email) {

        $email      = htmlspecialchars(mysqli_real_escape_string(Db::getConnect(), trim($email)));

        $query = "SELECT u.*,
                        t1.ter_name as region,
                        t2.ter_name as city,
                        t3.ter_name as city_reg
                FROM " . $this->table . " u 
                INNER JOIN t_koatuu_tree t3 ON u.territory = t3.ter_id  
                INNER JOIN t_koatuu_tree t2 ON t3.ter_pid = t2.ter_id 
                LEFT JOIN t_koatuu_tree  t1 ON t2.ter_pid = t1.ter_id
                WHERE u.email = '" . $email . "'";

        $this->result = mysqli_query(Db::getConnect(), $query);

        return $this->createArray($this->result);
    }
}