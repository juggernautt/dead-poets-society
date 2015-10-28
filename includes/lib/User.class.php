<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/../includes/init.php');
require_once('lib/DAL.php');

class User
{
    private $props = array();
    private $fields = array('u_id', 'u_email', 'u_password', 'u_nickname', 'u_birthdate', 'u_about_myself', 'u_picture', 'u_secret_pic');


    private function pickElements($array, $keys)
    {
        $result = array();
        foreach ($keys as $key) {
            $result[$key] = isset($array[$key]) ? $array[$key] : "";
        }
        return $result;
    }

    public function setProps($props) {
        $this->props = $this->pickElements($props, $this->fields);
    }

    public function getProps($props) {
        return $this->props;
    }

    public function __construct($props)
    {
        $this->setProps($props);
    }

    public function createAndGet()
    {
        $errors =$this->getErrors(true);
        if(count($errors) == 0) {
            $sql = "INSERT INTO `users` (u_email, u_password, u_nickname, u_birthdate, u_about_myself, u_picture, u_secret_pic) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $insertedId = insert($sql, [$this->props['u_email'], $this->props['u_password'], $this->props['u_nickname'],
                $this->props['u_birthdate'], $this->props['u_about_myself'], $this->props['u_picture'], $this->props['u_secret_pic']]);

            if (!$insertedId) {
                return false;
            }

            $newUser = $this->selectByEmailAndPassword();
            return $newUser;

        }
        return $errors;
    }

    public function updateAndGet() {
        $errors = $this->getErrors(false);
        if(count($errors) == 0) {
            $values = [$this->props['u_email'], $this->props['u_password'], $this->props['u_nickname'], $this->props['u_birthdate'], $this->props['u_about_myself']];
            $sql = "UPDATE `users` SET u_email=?, u_password=?, u_nickname=?, u_birthdate=?, u_about_myself=?";

            if ($this->props['u_picture']) {
                array_push($values, $this->props['u_picture']);
                $sql .= ", u_picture=?";
            }
            if ($this->props['u_secret_pic']) {
                array_push($values, $this->props['u_secret_pic']);
                $sql .= ", u_secret_pic=?";
            }
            array_push($values, $this->props['u_id']);
            $sql .= " WHERE u_id=?";

            $updatedRows = update($sql, $values);
            if ($updatedRows === false) {
                return false;
            }
            $existingUser = $this->selectUserById();
            return $existingUser;
        }
        return $errors;
    }



    public function getErrors($isToCheckMail) {
        $errors = array();
        if ($this->props['u_email'] == "" || $this->props['u_password'] == "" || $this->props['u_nickname'] == "" || $this->props['u_birthdate'] == "") {
            $errors['non_empty'] = "Email, password, username and birthday should not be empty";
        }
        if (!preg_match("/([A-Za-z0-9]+)/", $this->props['u_password'])) {
            $errors['u_password'] = "Only letters and numbers allowed";
        }

        if ($isToCheckMail) {
            $sql = "SELECT * FROM `users` WHERE u_email=?";
            $email = get_record($sql, [$this->props['u_email']]);
            if ($email) {
                $errors['u_email'] = "Your email should be unique";
            }
        }
        return $errors;
    }

    function selectByEmailAndPassword()
    {
        $sql = "SELECT * FROM `users` WHERE u_email=? AND u_password=? ";
        $loggedInUser = get_record($sql, [$this->props['u_email'], $this->props['u_password']]);
        if ($loggedInUser === false) {
            return false;
        }
        return $loggedInUser;
    }

    function selectUserById()
    {
        $sql = "SELECT * FROM `users` WHERE u_id=? ";
        $user = get_record($sql, [$this->props['u_id']]);
        if ($user === false) {
            return false;
        }
        return $user;
    }


}

