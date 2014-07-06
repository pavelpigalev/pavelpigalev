<?php

class m140706_202011_blog_code extends CDbMigration
{
    public function up()
    {
        $this->createTable('blog_code', array(
            'id'      => "int(11) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY",
            'blog_id' => "int(11) unsigned DEFAULT NULL",
            'code_id' => "int(11) unsigned DEFAULT NULL",
        ), 'ENGINE=InnoDB DEFAULT CHARSET=utf8');

        $this->createIndex('unique', 'blog_code', 'blog_id, code_id', true);
        $this->createIndex('index', 'blog_code', 'code_id, blog_id');
    }

    public function down()
    {
        $this->dropTable('blog_code');
    }
}