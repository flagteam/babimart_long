<?php

$installer = $this;

$installer->startSetup();

/*
  $installer->run("CREATE TABLE `{$installer->getTable('weblog/blogpost')}` (
  `blogpost_id` int(11) NOT NULL auto_increment,
  `title` text,
  `post` text,
  `date` datetime default NULL,
  `timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`blogpost_id`)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

  INSERT INTO `{$installer->getTable('weblog/blogpost')}` VALUES (1,'My New Title','This is a blog post','2013-10-11 10:00:00','2013-10-11 22:12:30');");
 */

$table = $installer->getConnection()
        ->newTable($installer->getTable('weblog/blogpost'))
        ->addColumn('blogpost_id', Varien_Db_Ddl_Table::TYPE_INTEGER, NULL, array(
            'unsigned' => true
            , 'nullable' => false
            , 'primary' => true
            , 'identity' => true
                ), 'Blogpost ID')
        ->addColumn('title', Varien_Db_Ddl_Table::TYPE_TEXT, null, array('nullable' => false)
                , 'Blogpost title')
        ->addColumn('post', Varien_Db_Ddl_Table::TYPE_TEXT, NULL, array('nullable' => false)
                , 'Blogpost body')
        ->addColumn('date', Varien_Db_Ddl_Table::TYPE_DATETIME, NULL, array()
                , 'Blogpost date')
        ->addColumn('timestamp', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, NULL, array()
                , 'Timestamp')
        ->setComment('Cakiem8x Weblog/blogpost entity table');

$installer->getConnection()->createTable($table);

$installer->run("INSERT INTO `" . $installer->getTable('weblog/blogpost') . "` VALUES (1,'My New Title','This is a blog post','2013-10-11 10:00:00','2013-10-11 22:12:30');");

$installer->endSetup();