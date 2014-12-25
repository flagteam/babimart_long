<?php

class Mage_Customer_Model_Entity_Customer extends Mage_Eav_Model_Entity_Abstract {

    public function __construct() {
        $this->setType('userconnect');
        $resource = Mage::getSingleton('core/resource');

        $this->setConnection($resource->getCollection('userconnect_read')
                , $resource->getCollection('userconnect_write'));
    }

    public function _getDefaultEntities() {
        return array();
    }

}