<?php
/**
 * @author Flagteam Kazu
 */
class Flag_Brands_Model_Catalog_Layer extends Mage_Catalog_Model_Layer {

    public function prepareProductCollection($collection)
    {
        parent::prepareProductCollection($collection);
        if(Mage::app()->getRequest()->getModuleName()=="brands"){
            $brand_id = Mage::registry('current_brand_id');

            $collection
                ->addAttributeToFilter('manufacturer', $brand_id)
                ->addAttributeToSelect('*');
        }elseif(Mage::app()->getRequest()->getModuleName()=="san-pham-moi"||strstr(Mage::app()->getRequest()->getServer('HTTP_REFERER'),"san-pham-moi")!=false){
            $todayDate  = Mage::app()->getLocale()->date()->toString(Varien_Date::DATETIME_INTERNAL_FORMAT);
            $collection
                ->addAttributeToFilter('news_from_date', array('or'=> array(
                    0 => array('date' => true, 'to' => $todayDate),
                    1 => array('is' => new Zend_Db_Expr('null')))
                ), 'left')
                ->addAttributeToFilter('news_to_date', array('or'=> array(
                    0 => array('date' => true, 'from' => $todayDate),
                    1 => array('is' => new Zend_Db_Expr('null')))
                ), 'left')
                ->addAttributeToFilter(
                    array(
                        array('attribute' => 'news_from_date', 'is'=>new Zend_Db_Expr('not null')),
                        array('attribute' => 'news_to_date', 'is'=>new Zend_Db_Expr('not null'))
                    )
                );
        }elseif(Mage::app()->getRequest()->getModuleName()=="san-pham-giam-gia"||strstr(Mage::app()->getRequest()->getServer('HTTP_REFERER'),"san-pham-giam-gia")!=false){
            $todayDate  = Mage::app()->getLocale()->date()->toString(Varien_Date::DATETIME_INTERNAL_FORMAT);
            $collection
                ->addAttributeToFilter('special_price', array('gt' => 0))//

                ->addAttributeToFilter('visibility',array("neq"=>1))
                ->addAttributeToFilter('special_from_date', array('or'=> array(
                    0 => array('date' => true, 'to' => $todayDate),
                    1 => array('is' => new Zend_Db_Expr('null')))
                ), 'left')
                ->addAttributeToFilter('special_to_date', array('or'=> array(
                    0 => array('date' => true, 'from' => $todayDate),
                    1 => array('is' => new Zend_Db_Expr('null')))
                ), 'left')
                ->addAttributeToFilter(
                    array(
                        array('attribute' => 'special_from_date', 'is'=>new Zend_Db_Expr('not null')),
                        array('attribute' => 'special_to_date', 'is'=>new Zend_Db_Expr('not null'))
                    )
                );
        }elseif(Mage::app()->getRequest()->getModuleName()=="san-pham-noi-bat"||strstr(Mage::app()->getRequest()->getServer('HTTP_REFERER'),"san-pham-noi-bat")!=false){
            $collection
                ->addAttributeToFilter('em_featured', 1)
                ->addAttributeToSelect('*');
        }

        return $this;

    }

}