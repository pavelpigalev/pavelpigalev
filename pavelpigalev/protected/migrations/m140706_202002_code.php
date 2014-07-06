<?php

class m140706_202002_code extends CDbMigration
{
    public function up()
    {
        $this->createTable('code', array(
            'id'          => "int(11) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY",
            'text'        => "text NULL DEFAULT NULL",
            'description' => "VARCHAR(255) NOT NULL DEFAULT ''",
        ), 'ENGINE=InnoDB DEFAULT CHARSET=utf8');
    }

    public function down()
    {
        $this->dropTable('code');
    }
}