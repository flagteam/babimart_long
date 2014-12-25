<?php

/**
 * News List Admin Grid
 * 
 * @author Van NH <hoangvan87@gmail.com>
 */
class Cakiem8x_News_Block_Adminhtml_News_Grid extends Mage_Adminhtml_Block_Widget_Grid {

    /**
     * Init Grid default properties
     * 
     */
    public function __construct() {
        parent::__construct();
        $this->setId('news_list_grid');
        $this->setDefaultSort('created_at');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
    }

    /**
     * Prepare collection for Grid
     * 
     * @return \Cakiem8x_News_Block_Adminhtml_News_Grid
     */
    protected function _prepareCollection() {
        $collection = Mage::getResourceModel('cakiem8x_news/news')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    /**
     * Prepate Grid columns
     * 
     * @return  \Cakiem8x_News_Block_Adminhtml_News_Grid 
     */
    protected function _prepareColumns() {
        $this->addColumn('news_id', array(
            'header' => Mage::helper('cakiem8x_news')->__('ID')
            , 'width' => '50px'
            , 'index' => 'news_id'
        ));

        $this->addColumn('title', array(
            'header' => Mage::helper('cakiem8x_news')->__('News Title'),
            'index' => 'title'
        ));

        $this->addColumn('author', array(
            'header' => Mage::helper('cakiem8x_news')->__('Author'),
            'index' => 'author'
        ));

        $this->addColumn('published_at', array(
            'header' => Mage::helper('cakiem8x_news')->__('Published')
            , 'sortable' => true
            , 'width' => '170px'
            , 'index' => 'published_at'
            , 'type' => 'date'
        ));

        $this->addColumn('created_at', array(
            'header' => Mage::helper('cakiem8x_news')->__('Created')
            , 'width' => '170px'
            , 'sortable' => true
            , 'index' => 'created_at'
            , 'type' => 'date'
        ));

        $this->addColumn('action', array(
            'header' => Mage::helper('cakiem8x_news')->__('Action')
            , 'width' => '100px'
            , 'getter' => 'getId'
            , 'actions' => array(array(
                    'caption' => Mage::helper('cakiem8x_news')->__('Edit')
                    , 'url' => array('*/*/edit')
                    , 'field' => 'id'
                ))
            , 'filter' => false
            , 'sortable' => false
            , 'index' => 'news'
        ));
        return parent::_prepareColumns();
    }

    /**
     * Return row URL for js handlers
     * 
     * @param Cakiemx8x_News_Model_News $row
     * @return string
     */
    public function getRowUrl($row) {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }

    public function getGridUrl() {
        return $this->getUrl('*/*/grid', array('_current' => true));
    }

}