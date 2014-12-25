<?php
class EM_EM0095settings_Model_System_Config_Source_Attribute
{
	/**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
		$attributes = Mage::getSingleton('catalogsearch/advanced')->getAttributes();
		$result = array();
		foreach($attributes as $attribute){
			if($attribute->getFrontendInput()=='select'){
				$result[] = array(
					'value'	=>	$attribute->getAttributeCode(),
					'label'	=>	$attribute->getStoreLabel()
				);
			}
		}
		return $result;
    }
}
?>