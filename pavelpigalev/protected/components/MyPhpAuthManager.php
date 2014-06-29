<?php

class MyPhpAuthManager extends CPhpAuthManager
{
    public function init()
    {
        if ($this->authFile === null) {
            $this->authFile = Yii::getPathOfAlias('application.config.auth') . '.php';
        }

        parent::init();

        //$this->defaultRoles = array(UserRoleDB::ROLE_GUEST);

        /* @var $user MyCWebUser */
        /*$user = Yii::app()->user;
        if (!$user->isGuest) {
            $roles = $user->getState('roles');
            $i     = 0;
            if (!empty($roles)) {
                foreach ($roles as $role) {
                    if (isset(UserRoleDB::$activeRoles[$role])) {
                        $this->assign($role, $user->id);
                        $i++;
                    }
                }
            }
            if (!$i) {
                $this->assign(UserRoleDB::ROLE_USER, $user->id);
            }
        }*/
    }
}