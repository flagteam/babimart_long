<?php

/**
 * News Admin Helper
 * 
 * @author Van NH <hoangvan87@gmail.com>
 */
class Cakiem8x_News_Helper_Admin extends Mage_Core_Helper_Abstract {

    /**
     * Check permissions for passed action
     * 
     * @param string $action
     * @return bool
     */
    public function isActionAllowed($action) {
        return Mage::getSingleton('Admin/session')->isAllowed('news/first_child/' . $action);
    }

}