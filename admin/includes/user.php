<?php

class User extends Db_object
{
   
    protected static $db_table_fields = array('username', 'password', 'fullname');
    public $id;
    public $username;
    public $password;
    public $fullname;
  
    public static function varify_user($username, $password)
    {
        global $database;
        $username = $database->escape_string($username);
        $password = $database->escape_string($password);
        $sql = "SELECT * FROM user WHERE username = '{$username}' AND password = '$password' LIMIT 1";
        $the_result_array = self::find_by_query($sql);
        return !empty($the_result_array) ? array_shift($the_result_array) : false;
    }
   
    public function properties(){
        // return get_object_vars($this);
        $properties = array();
        foreach (self::$db_table_fields as $db_field) {
            if (property_exists($this, $db_field)) {
                $properties[$db_field] = $this->$db_field;
            }
        }
        return $properties;
    }
  
}
