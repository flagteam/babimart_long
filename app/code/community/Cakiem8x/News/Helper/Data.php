<?php

class Cakiem8x_News_Helper_Data extends Mage_Core_Helper_Data {
    /**
     * Path to store config if frontend output is enabled
     * 
     * @var  string
     */

    const XML_PATH_ENABLED = 'news/view/enabled';

    /**
     * Path to store config where count of news posts per page is stored
     * 
     * @var string 
     */
    const XML_PATH_ITEMS_PER_PAGE = 'news/view/items_per_page';

    /**
     * Path to store config where count of days while news is still recently added is stored
     * 
     * @var string
     */
    const XML_PATH_DAYS_FIFFERENCE = 'news/view/days_difference';

    /**
     * News item instance for lazy loading
     * 
     * @var Cakiem8x_News_Model_News
     */
    protected $_newsItemInstance;

    /**
     * Checks whether news can be displayed in the frontend
     * 
     * @param interger|string|Mage_Core_Model_Store $store
     * @return boolean
     */
    public function isEnabled($store = null) {
        return Mage::getStoreConfigFlag(self::XML_PATH_ENABLED, $store);
    }

    /**
     * Return the number of items per page
     * 
     * @param interger|string|Mage_Core_Store_Model $store
     * @return int
     */
    public function getNewsPerPage($store = NULL) {
        return abs((int) Mage::getStoreConfig(self::XML_PATH_ITEMS_PER_PAGE, $store));
    }

    /**
     * Return difference in days while news is recently added
     * 
     * @param interger|string|Mage_Core_Store_Model $store
     * @return int
     */
    public function getDaysDifference($store) {
        return abs((int) Mage::getStoreConfig(self::XML_PATH_DAYS_FIFFERENCE, $store));
    }

    /**
     * Return current news item instance from the Registry
     * 
     * @return Cakiem8x_News_Model_News
     */
    public function getNewsItemInstance() {
        if (!$this->_newsItemInstance) {
            $this->_newsItemInstance = Mage::registry('news_item');

            if (!$this->_newsItemInstance) {
                Mage::throwException($this->__('News item instance does not exsits in Registry'));
            }
        }

        return $this->_newsItemInstance;
    }

}