<?php

/**
 * News module observer
 * 
 * @author Van NH <hoangvan87@gmail.com>
 */
class Cakiem8x_News_Model_Observer {

    /**
     * Event before show news item on frontend
     * If s
     * @param Varien_Event_Observer $observer
     */
    public function beforeNewsDisplayed(Varien_Event_Observer $observer) {

        $newsItem = $observer->getEvent()->getNewsItem();
        $currentDate = Mage::app()->getLocale()->date();
        $newsCreatedAt = Mage::app()->getLocale()->date(strtotime($newsItem->getCreatedAt()));

        $daysDifference = $currentDate->sub($newsCreatedAt)->getTimestamp() / (60 * 60 * 24);

        if ($daysDifference < Mage::helper('cakiem8x_news')->getDaysDifference()) {
            Mage::getSingleton("core/session")
                    ->addSuccess(Mage::helper('cakiem8x_news')->__('Recently added'));
        }
    }

}