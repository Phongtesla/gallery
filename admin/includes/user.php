<?php

class User extends Db_object
{
    protected static $db_table = "user";
    protected static $db_table_fields = array('username', 'password', 'fullname', 'user_image');
    public $id;
    public $user_image;
    public $username;
    public $password;
    public $upload_directory = 'images';
    public $image_placeholder = "http://placehold.it/62x62&text=image";

    public $fullname;

    public $errors = array();
    public $upload_errors_array = array(
        UPLOAD_ERR_OK => "There is no error",
        UPLOAD_ERR_INI_SIZE => "The uploaded file exceeds  the upload_max_filesize directive in php.ini",
        UPLOAD_ERR_FORM_SIZE => "The uploaded file exceeds the max_file_size",
        UPLOAD_ERR_PARTIAL => "The uploaded file was only partially uploaded.",
        UPLOAD_ERR_NO_FILE => "No file was uploaded",
        UPLOAD_ERR_NO_TMP_DIR => "Missing a temporary folder",
        UPLOAD_ERR_CANT_WRITE => "Failed to write file to disk",
        UPLOAD_ERR_EXTENSION => "A PHP extension  stopped  the file upload.",
    );
    //This is passing $FILES['uploaded_file] as an agrument
    public function set_file($file)
    {
        if (empty($file) || !$file || !is_array($file)) {
            $this->errors[] = "There was no file uploaded here";
            return false;
        } elseif ($file['error'] != 0) {
            $this->errors[] = $this->upload_errors_array[$file['error']];
            return false;
        } else {
            $this->user_image = basename($file['name']);
            $this->tmp_path = $file['tmp_name'];
            $this->type = $file['type'];
            $this->size = $file['size'];
        }
    }
    public function upload_photo()
    {

        if (!empty($this->errors)) {
            return false;
        }
        if (empty($this->user_image) || empty($this->tmp_path)) {
            $this->errors[] = "the file was not available";
            return false;
        }
        $target_path = SITE_ROOT . DS . 'admin' . DS . $this->upload_directory . DS . $this->user_image;
        if (file_exists($target_path)) {
            $this->errors[] = "The file {$this->user_image} already exists";
            return false;
        }
        if (move_uploaded_file($this->tmp_path, $target_path)) {
       
                unset($this->tmp_path);
                return true;
            
        } else {
            $this->errors[] = "the file directory probably does not have permission";
            return false;
        }
    }
    public function image_path_and_placeholder()
    {
        return empty($this->user_image) ? $this->image_placeholder : $this->upload_directory . DS . $this->user_image;
    }
    public static function varify_user($username, $password)
    {
        global $database;
        $username = $database->escape_string($username);
        $password = $database->escape_string($password);
        $sql = "SELECT * FROM user WHERE username = '{$username}' AND password = '$password' LIMIT 1";
        $the_result_array = self::find_by_query($sql);
        return !empty($the_result_array) ? array_shift($the_result_array) : false;
    }
}
