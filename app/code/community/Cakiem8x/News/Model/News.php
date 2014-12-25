<?php

class Cakiem8x_News_Model_News extends Mage_Core_Model_Abstract {

    protected function _construct() {
        $this->_init('cakiem8x_news/news');
    }

    protected function _beforeSave() {
        parent::_beforeSave();
        if ($this->isObjectNew())
            $this->setData('created_at', Varien_Date::now());
        return $this;
    }

}
