<?php
class EM_BoughtOfRecentViewedProducts_Block_Wrap extends Mage_Core_Block_Template implements Mage_Widget_Block_Interface
{
	protected function _construct()
    {
        parent::_construct();
		$cacheLifeTime = $this->getCacheLifetime() ? $this->getCacheLifetime() : 7200;
        $cacheTags = array(Mage_Cms_Model_Page::CACHE_TAG);
        $this->addData(array(
            'cache_lifetime'    => $cacheLifeTime,
            'cache_tags'        => $cacheTags
        ));
    }
	
	public function getAjaxData(){
		$string = "{";
		$data = $this->getData();
		unset($data['type']);
		unset($data['cache_tags']);
		unset($data['module_name']);
		unset($data['callback_js']);
		foreach($data as $key => $value){
			$string .= "'widget[$key]':'$value',";
		}
		$string .= "'widget[package_name]':'".Mage::getDesign()->getPackageName()."',";
		$string .= "'widget[theme_template]':'".Mage::getDesign()->getTheme('template')."'";
		$string .= "}";
		return $string;
	}
	
	
	/*public function isUseAjax(){
		return !$this->getIsLoadCache();
	}
	
	/*public function getContent(){
		if(!$this->isUseAjax()){
			$data = $this->getData();
			unset($data['type']);
			return $this->getLayout()->createBlock('boughtofrecentviewedproducts','bdrvp.products.list')->setData($data)->toHtml();
		}
		return '';
	}*/
	
	public function getCacheKeyInfo(){
		return array(
			'boughtofrecentviewedproducts_wrapper',
			serialize($this->getData())
		);
	}
	
	protected function _toHtml()
	{	
		$this->setTemplate('em_boughtofrecentviewedproducts/wrap.phtml');	
		return parent::_toHtml();
	}
}