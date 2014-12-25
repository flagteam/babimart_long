<?php
/**
 * Created by PhpStorm.
 * User: mb471_253
 * Date: 26/9/14
 * Time: 7:04 AM
 */


class Mage_Catalog_Block_Product_Promotion extends Mage_Catalog_Block_Product_Abstract{
    public function __construct(){
        parent::__construct();
        $storeId    = Mage::app()->getStore()->getId();

        $products = Mage::getResourceModel('reports/product_collection')
            ->addOrderedQty()
            ->addAttributeToSelect('*')
            ->addAttributeToSelect(array('name', 'url', 'small_image', 'price', 'short_description'))
            ->addFieldToFilter('promotion', 1)
            ->addFieldToFilter('status', 1)
            ->setStoreId($storeId)
            ->addStoreFilter($storeId)
            ->addViewsCount()
            ->clear();
        Mage::getSingleton('catalog/product_status')->addVisibleFilterToCollection($products);
        Mage::getSingleton('catalog/product_visibility')->addVisibleInCatalogFilterToCollection($products);
        $products->setPageSize(5)->setCurPage(1);
        $this->setProductCollection($products);
    }
}


