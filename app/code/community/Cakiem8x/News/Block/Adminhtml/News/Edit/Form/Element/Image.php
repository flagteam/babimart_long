<?php

/**
 * Custom image form elment that generates correct thumbnail image URL
 * 
 * @author Van NH <hoangvan87@gmail.com>
 */
class Cakiem8x_News_Block_Adminhtml_News_Edit_Form_Element_Image extends Varien_Data_Form_Element_Image {

    /**
     * Get image preview url
     * 
     * @return string
     */
    protected function _getUrl() {
        $url = false;

        if ($this->getValue()) {
            $url = Mage::helper('cakiem8x_news/image')->getBaseUrl() . '/' . $this->getValue();
        }

        return $url;
    }

}