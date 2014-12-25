<?php
class EM_Em0095settings_Block_Brand extends Mage_Core_Block_Template
{
    public function getBrandList()
    {
        $product = Mage::getModel('catalog/product');
        $attributes = Mage::getResourceModel('eav/entity_attribute_collection')
            ->setEntityTypeFilter($product->getResource()->getTypeId())
            ->addFieldToFilter('attribute_code', Mage::getStoreConfig('em0095/brandproduct/attributecode'));
        $attribute = $attributes->getFirstItem()->setEntity($product->getResource());
        $manufacturers = $attribute->getSource()->getAllOptions(false);
	$manufacturers = Mage::helper('em0095settings/data')->array_sort($manufacturers, 'label', SORT_ASC);
        return $manufacturers; 
    }

   
}
?>