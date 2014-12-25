<?php
/**
 * @author Flagteam Kazu
 */
class Flag_Brands_Model_Catalog_Category extends Mage_Catalog_Model_Category {

    public function getProductCollection()
    {
        if(Mage::app()->getRequest()->getModuleName()=="brands"||Mage::app()->getRequest()->getModuleName()=="san-pham-moi"
            ||Mage::app()->getRequest()->getModuleName()=="san-pham-giam-gia"
            ||Mage::app()->getRequest()->getModuleName()=="san-pham-noi-bat"){
            $collection = Mage::getResourceModel('catalog/product_collection')
                ->setStoreId($this->getStoreId());
        }else{
            $collection = Mage::getResourceModel('catalog/product_collection')
                ->setStoreId($this->getStoreId())
                ->addCategoryFilter($this);
        }
        return $collection;
    }

}