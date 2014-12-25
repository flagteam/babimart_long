<?php
class EM_BoughtOfRecentViewedProducts_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
		$data = $this->getRequest()->getParam('widget');
		Mage::getSingleton('core/design_package')
              ->setPackageName($data['package_name'])
              ->setTheme('template',$data['theme_template']);
		$this->getResponse()->setBody($this->getLayout()->createBlock('boughtofrecentviewedproducts/list')->addData($data)->toHtml());
    }
}