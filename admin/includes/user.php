<?php

class User
{
    public $id;
    public $username;
    public $password;
    public $fullname;
    public static function find_all_users()
    {
        global $database;
        return self::find_this_query("SELECT * FROM user");
    }
    public static function find_user_by_id($id)
    {
        global $database;
        $the_result_array = self::find_this_query("SELECT * FROM user WHERE id=$id LIMIT 1");
        return !empty($the_result_array) ? array_shift($the_result_array) : false;
    }
    public static function find_this_query($sql)
    {
        global $database;
        $result_set = $database->query($sql);
        // return $result_set;
        $the_object_array = array();
        while ($row = mysqli_fetch_array($result_set)) {
            $the_object_array[] = self::instantiation($row);
        };
        return $the_object_array;
    }
    public static function varify_user($username, $password)
    {
        global $database;
        $username = $database->escape_string($username);
        $password = $database->escape_string($password);
        $sql = "SELECT * FROM user WHERE username = '{$username}' AND password = '$password' LIMIT 1";
        $the_result_array = self::find_this_query($sql);
        return !empty($the_result_array) ? array_shift($the_result_array) : false;
    }
    public static function instantiation($the_record)
    {
        $the_object = new self;
        foreach ($the_record as $the_attribute => $value) {
            if ($the_object->has_the_attribute($the_attribute)) {
                $the_object->$the_attribute = $value;
            }
        }

        return $the_object;
    }
    private function has_the_attribute($the_attribute)
    {
        $object_properties = get_object_vars($this);
        return array_key_exists($the_attribute, $object_properties);
    }
    public function create()
    {
        global $database;
        $sql = "INSERT INTO user (username, password, fullname)";
        $sql .= "VALUES ('";
        $sql .= $database->escape_string($this->username) . "', '";
        $sql .= $database->escape_string($this->password) . "', '";
        $sql .= $database->escape_string($this->fullname) . "')";
        if ($database->query($sql)) {
            $this->id = $database->the_insert_id();
            return true;
        } else {
            return false;
        }
    }
    public function update()
    {
        global $database;
        $sql = "UPDATE user SET ";
        $sql .= "username= '" . $database->escape_string($this->username) . "', ";
        $sql .= "password= '" . $database->escape_string($this->password) . "', ";
        $sql .= "fullname= '" . $database->escape_string($this->fullname) . "' ";
        $sql .= " WHERE id= " . $database->escape_string($this->id);
        $database->query($sql);
        return (mysqli_affected_rows($database->connection) == 1) ? true : false;
    }
    public function delete()
    {
        global $database;
        $sql = "DELETE FROM user ";
        $sql .= "WHERE id = " . $database->escape_string($this->id);
        $sql .= " LIMIT 1";
        $database->query($sql);
        return (mysqli_affected_rows($database->connection) == 1) ? true : false;
    
    }
}
