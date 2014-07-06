<?php

class m140706_202026_user extends CDbMigration
{
    public function up()
    {
        $this->createTable('user', array(
            'id'         => "int(11) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY",
            'name'       => "varchar(255) DEFAULT NULL",
            'role_id'    => "int(3) UNSIGNED NULL",
            'ip_address' => "INT UNSIGNED NULL DEFAULT NULL",
            'created_at' => "timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'",
            'updated_at' => "timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP",
        ), 'ENGINE=InnoDB DEFAULT CHARSET=utf8');

        $this->createIndex('ip', 'user', 'ip_address');
    }

    public function down()
    {
        $this->dropTable('user');
    }
}