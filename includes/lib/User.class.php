<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/../includes/init.php');
require_once('lib/DAL.php');
require_once('lib/AL.php');
require_once('lib/TableRecord.class.php');

class User extends TableRecord
{
    protected $props = array();
    protected $fields = array('u_id', 'u_email', 'u_password', 'u_nickname', 'u_birthdate', 'u_about_myself', 'u_picture', 'u_secret_pic');
    protected $table = 'users';
    protected $primary_key = 'u_id';


    public function createAndGet()
    {
        $errors =$this->getErrors(true);
        if(count($errors) == 0) {
            return $this->al->insert_one($this->table, $this->props);
        }
        return $errors;
    }

    public function updateAndGet()
    {
        $errors = $this->getErrors(false);
        if(count($errors) == 0) {
            return $this->al->update_one($this->table, $this->props['u_id'], $this->props);
        }
        return $errors;
    }



    public function selectById($id)
    {
        return $this->al->select_one($this->table, $id);
    }




    public function deactivate($id)
    {
        return $this->al->update_one('users', $id, array('u_is_frozen_account' => 1));
    }

    public function activate($id)
    {
        return $this->al->update_one('users', $id, array('u_is_frozen_account' => 0));
    }

    public function authorize($props)
    {
        $preds = array(
            'u_email' => $props['u_email'],
            'u_password' => md5($props['u_password'])
        );
        return $this->al->select_many($this->table, $preds);
    }


    public function getErrors($isToCheckMail)
    {
        $errors = array();
        if ($this->props['u_email'] == "" || $this->props['u_password'] == "" || $this->props['u_nickname'] == "" || $this->props['u_birthdate'] == "") {
            $errors['non_empty'] = "Email, password, username and birthday should not be empty";
        }
        if (!preg_match("/([A-Za-z0-9]+)/", $this->props['u_password'])) {
            $errors['u_password'] = "Only letters and numbers allowed";
        }

        if ($isToCheckMail) {
            $users = $this->al->select_many('users', ['u_email' => $this->props['u_email']]);
            if (count($users)) {
                $errors['u_email'] = "Your email should be unique";
            }
        }
        return $errors;
    }
}

