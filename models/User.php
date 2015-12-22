<?php

namespace app\models;

use dektrium\user\models\User;

/**
 *
 */
class User extends User
{
    const ROLE_USER = 10;
    const ROLE_MODERATOR = 20;
    const ROLE_ADMIN = 30;

    public function register()
    {
        // do your magic
    }

    /**
     * @return boolean [description]
     */
    public function isAdmin()
    {
        if ($this->role == ROLE_ADMIN) {
            return true;
        } else {
            return false;
        }
    }
}
 ?>
