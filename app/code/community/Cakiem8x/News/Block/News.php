<?php

class Cakiem8x_News_Block_News extends Mage_Core_Block_Template {

    /**
     * Current news item instance
     * @var Cakiem8x_News_Model_News
     */
    protected $_item;

    /**
     * Return parameters for back url
     * @param array $additionalParams
     * @return array
     */
    protected function _getBackUrlQueryParams($additionalParams = array()) {
        return array_merge(array('p' => $this->getPage()), $additionalParams);
    }

    public function getBackUrl() {
        return $this->getUrl('*/', array('_query' => $this->_getBackUrlQueryParams()));
    }

    /**
     * Return URL for resized News item image
     * @param Cakiem8x_News_Model_News $item
     * @param interger $width
     * @return string | false
     */
    public function getImageUrl($item, $width) {
        return Mage::helper('cakiem8x_news/image')->resize($item, $width);
    }

}
