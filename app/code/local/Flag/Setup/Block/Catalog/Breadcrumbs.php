<?php
/**
 * Created by PhpStorm.
 * User: lct
 * Date: 12/22/14
 * Time: 8:29 AM
 */ 
class Flag_Setup_Block_Catalog_Breadcrumbs extends Mage_Catalog_Block_Breadcrumbs {

    /**
     * Preparing layout
     *
     * @return Mage_Catalog_Block_Breadcrumbs
     */
    protected function _prepareLayout()
    {
        if ($breadcrumbsBlock = $this->getLayout()->getBlock('breadcrumbs')) {
            $breadcrumbsBlock->addCrumb('home', array(
                'label'=>Mage::helper('catalog')->__('Home'),
                'title'=>Mage::helper('catalog')->__('Go to Home Page'),
                'link'=>Mage::getBaseUrl()
            ));
            // MOD to add the full category breadcrumb path.
            $current_category = Mage::registry('current_category');
            $current_product = Mage::registry('current_product');

            if($current_product){
                $categories = $current_product->getCategoryCollection()->addAttributeToSelect('name');
                $maxLv = 0;
                foreach($categories as $category) {
                    if($category->getLevel()>$maxLv){
                        $maxLv = $category->getLevel();
                    }
                }
                foreach($categories as $category) {
                    if($category->getLevel()==$maxLv){
                        Mage::unregister('current_category');
                        Mage::register('current_category', $category);
                        break;
                    }
                }
            }

            $title = array();
            $path  = Mage::helper('catalog')->getBreadcrumbPath();

            foreach ($path as $name => $breadcrumb) {
                $breadcrumbsBlock->addCrumb($name, $breadcrumb);
                $title[] = $breadcrumb['label'];
            }

            if ($headBlock = $this->getLayout()->getBlock('head')) {
                $headBlock->setTitle(join($this->getTitleSeparator(), array_reverse($title)));
            }
        }
        return parent::_prepareLayout();
    }
}