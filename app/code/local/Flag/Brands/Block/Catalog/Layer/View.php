<?php

/**
 * @author Flagteam Kazu
 */

class Flag_Brands_Block_Catalog_Layer_View extends Mage_Catalog_Block_Layer_View {

    protected function _construct()
    {
        parent::_construct();
        Mage::register('current_layer', $this->getLayer(), true);
    }

    public function getLayer()
    {
        return Mage::getSingleton('flag_brands/catalog_layer');
    }

}