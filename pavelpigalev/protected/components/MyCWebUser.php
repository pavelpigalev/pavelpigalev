<?php

class MyCWebUser extends CWebUser
{

    protected function afterLogin($fromCookie)
    {
        /* @var $user User */
        //$userMapper = new UserMapper();

        if ($fromCookie) {
            /*$user = $userMapper->getById($this->id, array(), array('roles'));
            if (!$user->exists()) {
                $this->logout();
                exit();
            }*/
            $this->setState('fullName', $user->getFullName());
            $this->setState('isFemale', $user->isFemale());
            $this->setState('roles', $user->roles);
        }

        //$userMapper->updateLastRequest($this->id);
        $this->updateAuthStatus();

        // TODO удалить после некоторого времени тестирования
        $date = date('Y-m-d H:i:s');
        $f    = fopen(Yii::app()->params['webRoot'] . '/files/authentication.txt', 'a');
        if ($fromCookie) {
            fwrite($f, 'logged in WITH COOKIE' . ' (' . $date . ")\n");
        }
        else {
            fwrite($f, 'logged in ' . ' (' . $date . ")\n");
        }
        fwrite($f, 'id   -> ' . $this->id . "\n");
        fwrite($f, 'name -> ' . $this->name . "\n\n");
        fclose($f);
    }
}