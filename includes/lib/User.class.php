<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/../includes/init.php');
require_once('lib/DAL.php');
require_once('lib/AL.php');
require_once('lib/TableRecord.class.php');

class User extends TableRecord
{
    protected $props = array();
    protected $fields = array('u_email', 'u_password', 'u_nickname', 'u_birthdate', 'u_about_myself', 'u_picture', 'u_secret_pic', 'u_is_frozen_account');
    protected $table = 'users';


    public function deactivate()
    {
        $this->setProp('u_is_frozen_account', 1);
        $this->save();
        return $this->getProps(TRUE);
    }


    public function activate()
    {
        $this->setProps('u_is_frozen_account', 0);
        $this->save();
        return $this->getProps(TRUE);
    }

    public function isDeactivated()
    {
        return $this->getProp('u_is_frozen_account');
    }


    public static function authorize($email, $password)
    {
        global $config;
        $al = new AL($config['database']);
        $preds = array(
            'u_email' => $email,
            'u_password' => md5($password)
        );
        $userProperties =  $al->select_many('users', $preds);
        return $userProperties ? new User($userProperties) : false;
    }



    public static function selectAllActive($props) {
        global $config;
        $al = new AL($config['database']);
        $sql = "SELECT * FROM `users` WHERE u_id!=? AND u_is_frozen_account != 1 ORDER BY `u_nickname` {$props['order_by']}";
        $users = $al->query($sql, [$props['id']]);
        if (!$users) {
            return array();
        }
        return $users;
    }

    public static function selectActiveFriends($props) {
        global $config;
        $al = new AL($config['database']);
        $sql = "SELECT * FROM `users` LEFT JOIN `relationship` ON (users.u_id=relationship.u_id1 OR users.u_id=relationship.u_id2)
            WHERE r_status='FRIENDS' AND u_is_frozen_account != 1 AND u_id!= ? AND (u_id1= ? OR u_id2 = ?) ORDER BY  `u_nickname` {$props['order_by']}";
        $userFriends = $al->query($sql, [$props['id'], $props['id'], $props['id']]);
        if (!$userFriends) {
            return array();
        }
        return $userFriends;
    }




    public function getErrors()
    {
        $errors = array();
        if ($this->props['u_email'] == "" || $this->props['u_password'] == "" || $this->props['u_nickname'] == "" || $this->props['u_birthdate'] == "") {
            $errors['non_empty'] = "Email, password, username and birthday should not be empty";
        }
        if (!preg_match("/([A-Za-z0-9]+)/", $this->props['u_password'])) {
            $errors['u_password'] = "Only letters and numbers allowed";
        }

        if (!$this->primary_key_value) {
            $users = $this->al->select_many('users', ['u_email' => $this->props['u_email']]);
            if ($users) {
                $errors['u_email'] = "Your email should be unique";
            }
        }
        return $errors;
    }
}

