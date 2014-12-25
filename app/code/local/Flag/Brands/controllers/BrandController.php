<?php
/**
 * @author Flagteam Kazu
 */

class Flag_Brands_BrandController extends Mage_Core_Controller_Front_Action
{

    public function viewAction()
    {
        $brand_id = $this->getRequest()->getParam('id');
        Mage::register('current_brand_id', $brand_id);

        $attributeCode = 'manufacturer';
        $attribute = Mage::getModel('catalog/product')->getResource()->getAttribute($attributeCode);
        $attribute_label = $attribute->getSource()->getOptionText($brand_id);

        Mage::dispatchEvent(
            'catalog_controller_category_init_before',
            array(
                'controller_action' => $this
            )
        );

        $rootCategoryId = (int) Mage::app()->getStore()->getRootCategoryId();
        if (!$rootCategoryId) {
            $this->_forward('noRoute');
            return;
        }

        $rootCategory = Mage::getModel('catalog/category')
            ->load($rootCategoryId)

            // TODO: Fetch from config
            ->setName($this->__('Thương hiệu '.$attribute_label))
            ->setMetaTitle($this->__('Thương hiệu '.$attribute_label))
            ->setMetaDescription($this->__('Sale'))
            ->setMetaKeywords($this->__('Sale'));

        Mage::register('current_category', $rootCategory);

        Mage::getSingleton('catalog/session')
            ->setLastVisitedCategoryId($rootCategory->getId());

        try {
            Mage::dispatchEvent('catalog_controller_category_init_after',
                array(
                    'category' => $rootCategory,
                    'controller_action' => $this
                )
            );
        } catch (Mage_Core_Exception $e) {
            Mage::logException($e);
            return;
        }

        // Observer can change category
        if (!$rootCategory->getId()){
            $this->_forward('noRoute');
            return;
        }

        $this->loadLayout();

        $this->_initLayoutMessages('catalog/session');
        $this->_initLayoutMessages('checkout/session');

        $this->renderLayout();
    }

}