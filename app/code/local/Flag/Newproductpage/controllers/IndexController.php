<?php
/**
 * @author Flagteam Kazu
 */

class Flag_Newproductpage_IndexController extends Mage_Core_Controller_Front_Action
{

    public function indexAction()
    {


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
            ->setName($this->__('Sản phẩm mới'))
            ->setMetaTitle($this->__('Sản phẩm mới'))
            ->setMetaDescription($this->__('Sản phẩm mới'))
            ->setMetaKeywords($this->__('Sản phẩm mới'));

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