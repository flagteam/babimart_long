<?php
class EM_BoughtOfRecentViewedProducts_Model_Observer
{
	/**
     * View Catalog Product action
     *
     * @param Varien_Event_Observer $observer
     * @return EM_BoughtOfRecentViewedProducts_Model_Observer
     */
    public function catalogProductView(Varien_Event_Observer $observer)
    {   
		Mage::app()->getCacheInstance()->clean(array(EM_BoughtOfRecentViewedProducts_Block_List::CACHE_TAG.'_'.Mage::getSingleton('log/visitor')->getId()));
        return $this;
    }
	
	/**
     * After invoice order
     *
     * @param Varien_Event_Observer $observer
     * @return EM_BoughtOfRecentViewedProducts_Model_Observer
     */
    public function afterInvoiceOrder(Varien_Event_Observer $observer)
    {
        Mage::app()->getCacheInstance()->clean(array(EM_BoughtOfRecentViewedProducts_Block_List::CACHE_TAG));
        return $this;
    }
}
?>