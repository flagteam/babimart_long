<?php

/**
 * News List Admin grid container
 * 
 * @author Van Nh <hoangvan87@gmail.com>
 */
class Cakiem8x_News_Block_Adminhtml_News extends Mage_Adminhtml_Block_Widget_Grid_Container {

    /**
     * Block constructor
     */
    public function __construct() {
        $this->_blockGroup = 'cakiem8x_news';
        $this->_controller = 'cakiem8x_news';
        $this->_headerText = Mage::helper('cakiem8x_news')->__('Manage News');

        parent::__construct();

        if (Mage::helper('cakiem8x_news/Admin')->isActionAllowed('save')) {
            $this->_updateButton('add', 'label', Mage::helper('cakiem8x_news')->__('Add New News'));
        } else {
            $this->_removeButton('add');
        }

        $this->_addButton('news_flush_images_cache', array(
            'label' => Mage::helper('cakiem8x_news')->__('Flush Images Cache'),
            'onclick' => 'setLocation(\'' . $this->getUrl('*/*/flush') . '\')'
        ));
    }

}