<?php

class Cakiem8x_News_Block_List extends Mage_Core_Block_Template {

    /**
     * News collection
     * @var Cakiem8x_News_Model_Resource_News_Collection
     */
    protected $_newsCollection = null;

    /**
     * Retrieve news collection
     * @return Cakiem8x_News_Model_Resource_News_Collection
     */
    protected function _getCollection() {
        return Mage::getResourceModel('cakiem8x_news/news_collection');
    }

    /**
     * Retrieve prepared news collection
     * @return Cakiem8x_News_Model_Resource_News_Collection
     */
    public function getCollection() {
        if (is_null($this->_newsCollection)) {
            $this->_newsCollection = $this->_getCollection();
            $this->_newsCollection->prepareForList($this->getCurrentPage());
        }

        return $this->_newsCollection;
    }

    /**
     * Return Url to item's view page
     * @param Cakiem8x_News_Model_News $newsItem
     * @return string
     */
    public function getItemUrl($newsItem) {
        return $this->getUrl('/*/*/view', array('id' => $newsItem->getId()));
    }

    /**
     * Fetch the current page for the news list
     * @return int
     */
    public function getCurrentPage() {
        return $this->getData('current_page') ? $this->getData('current_page') : 1;
    }

    /**
     * Get a pager
     * @return string | Null 
     */
    public function getPager() {

        $pager = $this->getChild('news_list_pager');

        if ($pager) {
            $newsPerPage = Mage::helper('cakiem8x_news')->getNewsPerPage();
            $pager->setAvailableLimit(array($newsPerPage => $newsPerPage));
            $pager->setTotalNum($this->getCollection()->getSize());
            $pager->setCollection($this->getCollection());
            $pager->setShowPerPage(true);

            return $pager->toHtml();
        }

        return null;
    }

    /**
     * Return URL for resized News item image
     * @param Cakiem8x_News_Model_News $item
     * @param interger $width
     * @return string | false
     */
    public function getImageUrl($item, $width) {
        return Mage::helper("cakiem8x_news/image")->resize($item, $width);
    }

}
