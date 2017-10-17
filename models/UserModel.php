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

        if (!($name && $email && $region && $city && $regionCity)) {
            return false;
        }

        $ter = $region . '_' . $city . '_' . $regionCity;

        $query = "INSERT INTO " . $this->table . " (name, email, territory) VALUES (?,?,?)";

        $insert = Db::getConnect()->prepare($query);
        $insert->bind_param('sss', $name, $email, $ter);

        $insert->execute();
        $newId = $insert->insert_id ?: 0;
        $insert->close();
        return $newId;
    }
}