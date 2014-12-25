<?php

$installer = $this;

$installer->startSetup();

$table = $installer->getConnection()
        ->createTable($installer->getTable('cakiem8x_news/news'))
        ->addColumn('news_id', Varien_Db_Ddl_Table::TYPE_INTEGER, NULL, array(
            'unsigned' => true
            , 'identity' => true
            , 'nullable' => false
            , 'primary' => true
                ), 'Entity ID')
        ->addColumn('title', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
            'nullable' => true
                ), 'Title')
        ->addColumn('author', Varien_Db_Ddl_Table::TYPE_TEXT, 100, array(
            'nullable' => true
            , 'default' => NULL
                ), 'Author')
        ->addColumn('content', Varien_Db_Ddl_Table::TYPE_TEXT, '2M', array(
            'nullable' => true,
            'default' => NULL
                ), 'Content')
        ->addColumn('image', Varien_Db_Ddl_Table::TYPE_TEXT, NULL, array(
            'nullable' => true,
            'default' => NULL
                ), 'News image media path')
        ->addColumn('published_at', Varien_Db_Ddl_Table::TYPE_DATE, NULL, array(
            'nullable' => true
            , 'default' => NULL
                ), 'World publish date')
        ->addColumn('created_at', Varien_Db_Ddl_Table::TYPE_DATE, NULL, array(
            'nullable' => true
            , 'default' => NULL
                ), 'Creation Time')
        ->addIndex($installer->getIdxName(
                        $installer->getTable('cakiem8x_news/news'), array('published_at'), Varien_Db_Adapter_Interface::INDEX_TYPE_INDEX)
                , array('published_at')
                , array('type' => Varien_Db_Adapter_Interface::INDEX_TYPE_INDEX))
        ->setComment('News item');

$installer->getConnection()->createTable($table);

$installer->endSetup();
