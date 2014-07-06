<?php

class m140706_200754_blog extends CDbMigration
{
    public function up()
    {
        $this->createTable('blog', array(
            'id'         => "int(11) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY",
            'active'     => "tinyint(1) NOT NULL DEFAULT '1'",
            'url_code'   => "varchar(100) DEFAULT NULL",
            'title'      => "varchar(255) DEFAULT NULL",
            'text'       => "text NULL DEFAULT NULL",
            'author_id'  => "int(11) unsigned DEFAULT NULL",
            'created_at' => "timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'",
            'updated_at' => "timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP",
        ), 'ENGINE=InnoDB DEFAULT CHARSET=utf8');

        $this->createIndex('url_code', 'blog', 'url_code', true);
        $this->createIndex('author', 'blog', 'author_id');
    }

    public function down()
    {
        $this->dropTable('blog');
    }
}