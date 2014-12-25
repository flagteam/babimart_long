<?php

class Cakiem8x_Complexworld_Model_Resource_Eavblogpost_Collection extends Mage_Eav_Model_Entity_Collection_Abstract {

    protected function _construct() {
        $this->_init('complexworld/eavblogpost');
    }

    protected function _initSelect() {
        $this->getSelect()->from(array('e' => $this->getEntity()->getEntityTable()));

        if ($this->getEntity()->getTypeId()) {
            /**
             * We override the Mage_Eav_Model_Entity_Collection_Abstract->_initSelect() 
             * because we want to remove the call to addAttributeToFilter for 'entity_type_id' 
             * as it is causing invalid SQL select, thus making the User model load failing.
             */
            //$this->addAttributeToFilter('entity_type_id', $this->getEntity()->getTypeId());
        }

        return $this;
    }

}