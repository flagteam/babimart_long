<?php
class EM_BoughtOfRecentViewedProducts_Block_List extends Mage_Catalog_Block_Product_Abstract
{
	const CACHE_TAG = 'em_boughtofrecentviewedproducts';
    protected function _construct()
    {
        parent::_construct();
        $cacheLifeTime = $this->getCacheLifeTime() ? $this->getCacheLifeTime() : 7200;
        $cacheTags = array(Mage_Catalog_Model_Product::CACHE_TAG,Mage_Cms_Model_Page::CACHE_TAG,self::CACHE_TAG,self::CACHE_TAG.'_'.Mage::getSingleton('log/visitor')->getId());
        if($this->ShowLabel()){
            $cacheTags[] = EM_Productlabels_Model_Productlabels::CACHE_TAG;
        }
		$this->addData(array(
            'cache_lifetime'    => $cacheLifeTime,
            'cache_tags'        => $cacheTags
        ));
    }
	
	public function getCacheKeyInfo()
	{
		return array(
			'boughtofrecentviewedproducts',
			Mage::app()->getStore()->getId(),
			(int)Mage::app()->getStore()->isCurrentlySecure(),
			Mage::getDesign()->getPackageName(),
			Mage::getDesign()->getTheme('template'),
			Mage::app()->getStore()->getCurrentCurrencyCode(),
            Mage::getSingleton('customer/session')->getCustomerGroupId(),
			Mage::getSingleton('log/visitor')->getId(),
			serialize($this->getData())
		);
	}
    
	protected function _toHtml()
	{	
		if($this->getData('choose_template')	==	'custom_template')
		{
			if($this->getData('custom_theme'))
				$this->setTemplate($this->getData('custom_theme'));	
			else 
				$this->setTemplate('em_boughtofrecentviewedproducts/custom.phtml');	
		}
		else
		{
			$this->setTemplate($this->getData('choose_template'));	
		}
		return parent::_toHtml();
	}
    
	public function getCategories()
	{
		$strCategories=  $this->getData('new_category');
		$arrCategories = explode(",", $strCategories);
		return $arrCategories;
	}
    
	public function getColumnCount(){
		return $this->getData('column_count');
	}
    
    public function getCustomClass(){
		return $this->getData('custom_class');
	}
    
	public function getLimitCount(){
		if($this->getData('limit_count'))
			return $this->getData('limit_count');
		return 10;
	}
	
	public function getPageSize(){
		return $this->getLimitCount();
	}
    
	public function getFeatureChoosed(){
		return $this->getData('featured_choose');
	}
    
	public function getOrderBy(){
	   return $this->getData('order_by');
	}
	
	public function getCacheLifeTime(){		
	   return $this->getData('cache_lifetime');
	}
    
    public function getThumbnailWidth(){
        $tempwidth = $this->getData('thumbnail_width');
        if (!(is_numeric($tempwidth)))
            $tempwidth = 150;
        return $tempwidth;
	}
    
    public function getThumbnailHeight(){
        $tempheight = $this->getData('thumbnail_height');
       if (!(is_numeric($tempheight)))
            $tempheight = 150;
        return $tempheight;
	}
	
	public function getItemWidth(){
        $tempwidth = $this->getData('item_width');
        if (!(is_numeric($tempwidth)))
            $tempwidth = null;
        return $tempwidth;
	}
    
    public function getItemHeight(){
        $tempheight = $this->getData('item_height');
       if (!(is_numeric($tempheight)))
            $tempheight = null;
        return $tempheight;
	}
	
	public function getItemSpacing(){
        $tempheight = $this->getData('item_spacing');
       if (!(is_numeric($tempheight)))
            $tempheight = null;
        return $tempheight;
	}
    
    public function getFrontendTitle(){
        return $this->getData('frontend_title');
	}
    
    public function getFrontendDescription(){
        return $this->getData('frontend_description');
	}
	
    public function ShowThumb(){
        return $this->getData('show_thumbnail');
	}
    
    public function getAltImg(){
        return $this->getData('alt_img');
	}
    
    public function ShowProductName(){
        return $this->getData('show_product_name');
	}
    
    public function ShowDesc(){
        return $this->getData('show_description');
	}
    
    public function ShowPrice(){
        return $this->getData('show_price');
	}
    
    public function ShowReview(){
        return $this->getData('show_reviews');
	}
    
    public function ShowAddtoCart(){
        return $this->getData('show_addtocart');
	}
    
    public function ShowAddto(){
        return $this->getData('show_addto');
	}
    
    public function ShowLabel(){
        return $this->getData('show_label') && Mage::helper('core')->isModuleEnabled('EM_Megamenupro');
	}

    /**
     * Retrieve array product id
     *
     * @return array
     */
    public function getItemIds()
    {
		$coreResource = Mage::getSingleton('core/resource');
		$viewedTable = $coreResource->getTableName('report_viewed_product_index');
		$orderItemTable = $coreResource->getTableName('sales_flat_order_item');
		$orderTable = $coreResource->getTableName('sales_flat_order');
		$visitorId = Mage::getSingleton('log/visitor')->getId();
		echo $visitorId.'<br/>';
		$storeId = Mage::app()->getStore()->getId();
		$limit = $this->getLimitCount();
		$sql = "SELECT DISTINCT soi2.product_id as product_id
				FROM $viewedTable AS viewed
				INNER JOIN $orderItemTable AS soi1
				ON viewed.visitor_id=$visitorId AND viewed.product_id=soi1.product_id AND viewed.store_id=$storeId AND soi1.parent_item_id IS NULL AND soi1.store_id=$storeId
				INNER JOIN $orderTable AS ord1
				ON ord1.state <> 'canceled' AND ord1.store_id=$storeId
				LEFT JOIN $orderItemTable AS soi2
				ON soi1.order_id = soi2.order_id AND soi2.parent_item_id IS NULL
				LEFT JOIN $orderTable AS ord2
				ON ord2.state <> 'canceled' AND ord2.store_id=$storeId
				ORDER BY viewed.added_at DESC
				LIMIT 0,$limit";
        //echo $sql;
		return $coreResource->getConnection('core_read')->fetchCol($sql);		
    }
    
    protected function getProductCollection()
	{
		$ids = $this->getItemIds();
		$products = Mage::getModel('catalog/product')->getCollection();
		$products->setVisibility(Mage::getSingleton('catalog/product_visibility')->getVisibleInCatalogIds());
		$products = $this->_addProductAttributesAndPrices($products)
            ->addStoreFilter()
			->addAttributeToFilter('entity_id',array('in' => $ids));
		
		$config2 = $this->getData('order_by');
        if(isset($config2)){      
           $orders = explode(' ',$config2);
        }
		
		//Filter by categories
		$config1 = $this->getData('new_category');
		if($config1)
		{
			$alias = 'cat_index';
			$categoryCondition = $products->getConnection()->quoteInto(
			$alias.'.product_id=e.entity_id AND '.$alias.'.store_id=? AND ',
			$products->getStoreId()
			);
			$categoryCondition.= $alias.'.category_id IN ('.$config1.')';

			$products->getSelect()->joinInner(
			array($alias => $products->getTable('catalog/category_product_index')),
			$categoryCondition,
			array()
			);
			$products->_categoryIndexJoined = true;
			$products->distinct(true);
		}
        return $products;

	}
}