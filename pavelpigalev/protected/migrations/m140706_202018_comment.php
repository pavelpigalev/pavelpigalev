<?php

class m140706_202018_comment extends CDbMigration
{
    public function up()
    {
        $this->createTable('comment', array(
            'id'         => "int(11) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY",
            'author_id'  => "int(11) unsigned DEFAULT NULL",
            'blog_id'    => "int(11) unsigned DEFAULT NULL",
            'spam'       => "tinyint(1) NOT NULL DEFAULT '0'",
            'text'       => "text NOT NULL DEFAULT ''",
            'created_at' => "timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'",
            'updated_at' => "timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP",
        ), 'ENGINE=InnoDB DEFAULT CHARSET=utf8');

        $this->createIndex('blog', 'comment', 'blog_id');
    }

    public function down()
    {
        $this->dropTable('comment');
    }
}