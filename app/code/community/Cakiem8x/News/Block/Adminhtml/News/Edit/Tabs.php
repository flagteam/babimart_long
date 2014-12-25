<?php

/**
 * News List Admin edit form tabs block
 * 
 * @author Van Nh <hoangvan87@gmail.com>
 */
class Cakiem8x_News_Block_Adminhtml_News_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs {

    /**
     * Initialize tabs and define tabs block settings
     */
    public function __construct() {
        parent::__construct();
        $this->setId('page_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('cakiem8x_news')->__('News item info'));
    }

}