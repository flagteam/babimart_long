<?php

class Cakiem8x_News_Model_Resource_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract {

    /**
     * Define collection model
     */
    protected function _init() {
        parent::_init('cakiem8x_news/news');
    }

    /**
     * Prepare for displaying in list
     * 
     * @param interger $page
     * @return \Cakiem8x_News_Model_Resource_Collection
     */
    public function prepareForList($page) {
        $this->setPageSize(Mage::helper('cakiem8x_news')->getNewsPerPage());
        $this->setCurPage($page)->setOrder('published_at', Varien_Data_Collection::SORT_ORDER_DESC);
        return $this;
    }

}
