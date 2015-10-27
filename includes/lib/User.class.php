<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/../includes/init.php');
require_once('lib/DAL.php');

class User
{
    private $u_id;
    private $u_email;
    private $u_password;
    private $u_nickname;
    private $u_birthdate;
    private $u_about_myself;
    private $u_picture;
    private $u_secret_pic;

    public function __construct($u_email, $u_password, $u_nickname, $u_birthdate, $u_about_myself, $u_picture, $u_secret_pic)
    {
        $this->setUEmail($u_email);
        $this->setUPassword($u_password);
        $this->setUNickname($u_nickname);
        $this->setUBirthdate($u_birthdate);
        $this->setUAboutMyself($u_about_myself);
        $this->setUPicture($u_picture);
        $this->setUSecretPic($u_secret_pic);
    }


    public function getUEmail()
    {
        return $this->u_email;
    }

    public function setUEmail($u_email)
    {
        if ($u_email == "") {
            return false;
        }
        $this->u_email = $u_email;
        return true;
    }


    public function getUPassword()
    {
        return $this->u_password;
    }


    public function setUPassword($u_password)
    {
        if ($u_password == "") {
            return false;
        }
        $this->u_password = $u_password;
        return true;
    }


    public function getUNickname()
    {
        return $this->u_nickname;
    }


    public function setUNickname($u_nickname)
    {
        if ($u_nickname == "") {
            return false;
        }
        $this->u_nickname = $u_nickname;
        return true;
    }


    public function getUBirthdate()
    {
        return $this->u_birthdate;
    }


    public function setUBirthdate($u_birthdate)
    {
        if ($u_birthdate == "") {
            return false;
        }
        $this->u_birthdate = $u_birthdate;
        return true;
    }


    public function getUAboutMyself()
    {
        return $this->u_about_myself;
    }


    public function setUAboutMyself($u_about_myself)
    {
        $this->u_about_myself = $u_about_myself;
        return true;
    }


    public function getUPicture()
    {
        return $this->u_picture;
    }


    public function setUPicture($u_picture)
    {
        $this->u_picture = $u_picture;
    }


    public function getUSecretPic()
    {
        return $this->u_secret_pic;
    }

    public function setUSecretPic($u_secret_pic)
    {
        $this->u_secret_pic = $u_secret_pic;
    }


    public function createAndGet()
    {
        $errors =$this->getErrors(true);
        if(count($errors) == 0) {
            $sql = "INSERT INTO `users` (u_email, u_password, u_nickname, u_birthdate, u_about_myself, u_picture, u_secret_pic) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $insertedId = insert($sql, [$this->u_email, $this->u_password, $this->u_nickname, $this->u_birthdate, $this->u_about_myself, $this->u_picture, $this->u_secret_pic]);

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
            $values = [$this->u_email, $this->u_password, $this->u_nickname, $this->u_birthdate, $this->u_about_myself];
            $sql = "UPDATE `users` SET u_email=?, u_password=?, u_nickname=?, u_birthdate=?, u_about_myself=?";

            if ($this->u_picture) {
                array_push($values, $this->u_picture);
                $sql .= ", u_picture=?";
            }
            if ($this->u_secret_pic) {
                array_push($values, $this->u_secret_pic);
                $sql .= ", u_secret_pic=?";
            }
            array_push($values, $this->u_id);
            $sql .= " WHERE u_id=?";

            $updatedRows = update($sql, $values);
            if ($updatedRows === false) {
                return false;
            }
            $sql = "SELECT * FROM `users` WHERE u_id=?";
            $existingUser = get_record($sql, [$this->u_id]);
            return $existingUser;
        }
        return $errors;
    }

    /**
     * @return mixed
     */
    public function getUId()
    {
        return $this->u_id;
    }

    public function getErrors($isToCheckMail) {
        $errors = array();
        if ($this->u_email == "" || $this->u_password == "" || $this->u_nickname == "" || $this->u_birthdate == "") {
            $errors['non_empty'] = "Email, password, username and birthday should not be empty";
        }
        if (!preg_match("/([A-Za-z0-9]+)/", $this->u_password)) {
            $errors['u_password'] = "Only letters and numbers allowed";
        }

        if ($isToCheckMail) {
            $sql = "SELECT * FROM `users` WHERE u_email=?";
            $email = get_record($sql, [$this->u_email]);
            if ($email) {
                $errors['u_email'] = "Your email should be unique";
            }
        }
        return $errors;
    }

    function selectByEmailAndPassword()
    {
        $sql = "SELECT * FROM `users` WHERE u_email=? AND u_password=? ";
        $loggedInUser = get_record($sql, [$this->u_email, $this->u_password]);
        if ($loggedInUser === false) {
            return false;
        }
        return $loggedInUser;
    }



}

