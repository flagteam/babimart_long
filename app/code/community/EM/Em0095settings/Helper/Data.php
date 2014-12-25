<?php
/**
 * @methods:
 * - get[Section]_[ConfigName]($defaultValue = '')
 */
class EM_Em0095settings_Helper_Data extends Mage_Core_Helper_Abstract
{
	protected $_isShowOfferPrice;
	public function __call($name, $args) {
		if (method_exists($this, $name))
			call_user_func_array(array($this, $name), $args);
			
		elseif (preg_match('/^get([^_][a-zA-Z0-9_]+)$/', $name, $m)) {
			$segs = explode('_', $m[1]);
			foreach ($segs as $i => $seg)
				$segs[$i] = strtolower(preg_replace('/([^A-Z])([A-Z])/', '$1_$2', $seg));

			$value = Mage::getStoreConfig('em0095/'.implode('/', $segs));
			if (!$value) $value = @$args[0];
			return $value;
		}
		
		else 
			call_user_func_array(array($this, $name), $args);
	}
	
	public function getAllCssConfig() {
		$page_bgimage = Mage::getStoreConfig('em0095/typography/page_bg_file') ? 
			'url(' . Mage::getBaseUrl('media') . 'background/' . Mage::getStoreConfig('em0095/typography/page_bg_file') . ')'
			: (Mage::getStoreConfig('em0095/general/page_bgimage') ? 'url(../images/stripes/'.Mage::getStoreConfig('em0095/general/page_bgimage').')' : '');
			
		$header_bgimage = Mage::getStoreConfig('em0095/typography/page_bg_file') ? 
			'url(' . Mage::getBaseUrl('media') . 'background/' . Mage::getStoreConfig('em0095/typography/page_bg_file') . ')'
			: (Mage::getStoreConfig('em0095/typography/header_bgimage') ? 'url(../images/stripes/'.Mage::getStoreConfig('em0095/typography/header_bgimage').')' : '');
			
		$body_bgimage = Mage::getStoreConfig('em0095/typography/page_bg_file') ? 
			'url(' . Mage::getBaseUrl('media') . 'background/' . Mage::getStoreConfig('em0095/typography/page_bg_file') . ')'
			: (Mage::getStoreConfig('em0095/typography/body_bgimage') ? 'url(../images/stripes/'.Mage::getStoreConfig('em0095/typography/body_bgimage').')' : '');
			
		$footer_bgimage = Mage::getStoreConfig('em0095/typography/page_bg_file') ? 
			'url(' . Mage::getBaseUrl('media') . 'background/' . Mage::getStoreConfig('em0095/typography/page_bg_file') . ')'
			: (Mage::getStoreConfig('em0095/typography/footer_bgimage') ? 'url(../images/stripes/'.Mage::getStoreConfig('em0095/typography/footer_bgimage').')' : '');
			
		return array(
			'box_shadow' => Mage::getStoreConfig('em0095/typography/box_shadow'),
			'rounded_corner' => Mage::getStoreConfig('em0095/typography/rounded_corner'),
			'google_fonts' => Mage::getStoreConfig('em0095/typography/google_fonts'),
			'google_fonts_weights' => Mage::getStoreConfig('em0095/typography/google_fonts_weights'),
			'general_font' => Mage::getStoreConfig('em0095/typography/general_font'),
			'h1_font' => Mage::getStoreConfig('em0095/typography/h1_font'),
			'h2_font' => Mage::getStoreConfig('em0095/typography/h2_font'),
			'h3_font' => Mage::getStoreConfig('em0095/typography/h3_font'),
			'h4_font' => Mage::getStoreConfig('em0095/typography/h4_font'),
			'h5_font' => Mage::getStoreConfig('em0095/typography/h5_font'),
			'h6_font' => Mage::getStoreConfig('em0095/typography/h6_font'),
			
			'page_bgcolor' => Mage::getStoreConfig('em0095/general/page_bgcolor'),
			'page_bgimage' => $page_bgimage,
			'page_bgposition' => Mage::getStoreConfig('em0095/general/page_bgposition'),
			'page_bgrepeat' => Mage::getStoreConfig('em0095/general/page_bgrepeat'),

			'header_bgcolor1' => Mage::getStoreConfig('em0095/typography/header_bgcolor1'),
			'header_bgcolor2' => Mage::getStoreConfig('em0095/typography/header_bgcolor2'),
			'header_bxshadow' => Mage::getStoreConfig('em0095/typography/header_bxshadow'),
			'header_line1' => Mage::getStoreConfig('em0095/typography/header_line1'),
			'header_line2' => Mage::getStoreConfig('em0095/typography/header_line2'),
			'header_line3' => Mage::getStoreConfig('em0095/typography/header_line3'),
			'header_text_color1' => Mage::getStoreConfig('em0095/typography/header_text_color1'),
			'header_text_color2' => Mage::getStoreConfig('em0095/typography/header_text_color2'),
			'header_text_color3' => Mage::getStoreConfig('em0095/typography/header_text_color3'),
			'header_text_color4' => Mage::getStoreConfig('em0095/typography/header_text_color4'),
			'header_text_color5' => Mage::getStoreConfig('em0095/typography/header_text_color5'),
			'header_bgimage' => $header_bgimage,
			'header_bgposition' => Mage::getStoreConfig('em0095/typography/header_bgposition'),
			'header_bgrepeat' => Mage::getStoreConfig('em0095/typography/header_bgrepeat'),

			'menu_top_bgcolor' => Mage::getStoreConfig('em0095/typography/menu_top_bgcolor'),
			'menu_top_hover_bgcolor' => Mage::getStoreConfig('em0095/typography/menu_top_hover_bgcolor'),
			'menu_top_text_color' => Mage::getStoreConfig('em0095/typography/menu_top_text_color'),
			'menu_active_text_color' => Mage::getStoreConfig('em0095/typography/menu_active_text_color'),
			'menu_line' => Mage::getStoreConfig('em0095/typography/menu_line'),
			'menu_drop_bgcolor' => Mage::getStoreConfig('em0095/typography/menu_drop_bgcolor'),
			'menu_drop_hover_bgcolor' => Mage::getStoreConfig('em0095/typography/menu_drop_hover_bgcolor'),
			'menu_drop_text_color1' => Mage::getStoreConfig('em0095/typography/menu_drop_text_color1'),
			'menu_drop_text_color2' => Mage::getStoreConfig('em0095/typography/menu_drop_text_color2'),
			'menu_drop_text_color3' => Mage::getStoreConfig('em0095/typography/menu_drop_text_color3'),
			'menu_drop_line' => Mage::getStoreConfig('em0095/typography/menu_drop_line'),

			'body_bgcolor1' => Mage::getStoreConfig('em0095/typography/body_bgcolor1'),
			'body_bgcolor2' => Mage::getStoreConfig('em0095/typography/body_bgcolor2'),
			'body_bgfile' => Mage::getStoreConfig('em0095/typography/body_bgfile'),
			'body_bgimage' => $body_bgimage,
			'body_bgposition' => Mage::getStoreConfig('em0095/typography/body_bgposition'),
			'body_bgrepeat' => Mage::getStoreConfig('em0095/typography/body_bgrepeat'),
			'body_line1' => Mage::getStoreConfig('em0095/typography/body_line1'),
			'body_line2' => Mage::getStoreConfig('em0095/typography/body_line2'),
			'body_line3' => Mage::getStoreConfig('em0095/typography/body_line3'),
			'body_line4' => Mage::getStoreConfig('em0095/typography/body_line4'),
			'body_text_color1' => Mage::getStoreConfig('em0095/typography/body_text_color1'),
			'body_text_color2' => Mage::getStoreConfig('em0095/typography/body_text_color2'),
			'body_text_color3' => Mage::getStoreConfig('em0095/typography/body_text_color3'),
			'body_text_color4' => Mage::getStoreConfig('em0095/typography/body_text_color4'),
			'body_text_color5' => Mage::getStoreConfig('em0095/typography/body_text_color5'),
			'body_text_color6' => Mage::getStoreConfig('em0095/typography/body_text_color6'),
			'body_text_color7' => Mage::getStoreConfig('em0095/typography/body_text_color7'),
			'body_text_color8' => Mage::getStoreConfig('em0095/typography/body_text_color8'),
			'body_text_color9' => Mage::getStoreConfig('em0095/typography/body_text_color9'),
			'body_text_color10' => Mage::getStoreConfig('em0095/typography/body_text_color10'),
			'body_text_color11' => Mage::getStoreConfig('em0095/typography/body_text_color11'),
			'body_text_color12' => Mage::getStoreConfig('em0095/typography/body_text_color12'),

			'footer_bgcolor' => Mage::getStoreConfig('em0095/typography/footer_bgcolor'),
			'footer_bgcolor2' => Mage::getStoreConfig('em0095/typography/footer_bgcolor2'),
			'footer_bgimage' => $footer_bgimage,
			'footer_bgposition' => Mage::getStoreConfig('em0095/typography/footer_bgposition'),
			'footer_bgrepeat' => Mage::getStoreConfig('em0095/typography/footer_bgrepeat'),
			'footer_text_color1' => Mage::getStoreConfig('em0095/typography/footer_text_color1'),
			'footer_text_color2' => Mage::getStoreConfig('em0095/typography/footer_text_color2'),
			'footer_text_color3' => Mage::getStoreConfig('em0095/typography/footer_text_color3'),
			'footer_line1' => Mage::getStoreConfig('em0095/typography/footer_line1'),
			'footer_line2' => Mage::getStoreConfig('em0095/typography/footer_line2'),
			
			'button1_bgcolor1' => Mage::getStoreConfig('em0095/typography/button1_bgcolor1'),
			'button1_bgcolor2' => Mage::getStoreConfig('em0095/typography/button1_bgcolor2'),
			'button1_line' => Mage::getStoreConfig('em0095/typography/button1_line'),
			'button1_color' => Mage::getStoreConfig('em0095/typography/button1_color'),
			'button2_bgcolor1' => Mage::getStoreConfig('em0095/typography/button2_bgcolor1'),
			'button2_bgcolor2' => Mage::getStoreConfig('em0095/typography/button2_bgcolor2'),
			'button2_line' => Mage::getStoreConfig('em0095/typography/button2_line'),
			'button2_color' => Mage::getStoreConfig('em0095/typography/button2_color'),
			'button3_bgcolor1' => Mage::getStoreConfig('em0095/typography/button3_bgcolor1'),
			'button3_bgcolor2' => Mage::getStoreConfig('em0095/typography/button3_bgcolor2'),
			'button3_line' => Mage::getStoreConfig('em0095/typography/button3_line'),
			'button3_color' => Mage::getStoreConfig('em0095/typography/button3_color'),
			
			'additional_css_file' => Mage::getStoreConfig('em0095/typography/additional_css_file'),	
		);
	}
	
	public function getImageBackgroundColor() {
		$color = Mage::getStoreConfig('em0095/general/image_bgcolor');
		if (!$color) $color = '#ffffff';
		$color = str_replace('#', '', $color);
		if (strlen ($color )==6){
			return array(
				hexdec(substr($color, 0, 2)),
			    hexdec(substr($color, 2, 2)),
			    hexdec(substr($color, 4, 2))
			);
		  }else{
		  	$color = str_replace('rgba(', '', $color); 
		    $color = str_replace(')', '', $color); 
		    $arr = explode(",", $color);
		    return array(intval($arr[0]),intval($arr[1]),intval($arr[2]));
	  	}
	}
	
    public function getCategoriesCustom($parent,$curId){
				
		$result = '';
		if($parent->getLevel() == 1)
			$result = "<option value='0'>".$this->getCatNameCustom($parent)."</option>";
		else{
			$result = "<option value='".$parent->getId()."' ";
			
			if($curId){
				if($curId	==	$parent->getId()) $result .= " selected='selected'";
			}
			$result .= ">".$this->getCatNameCustom($parent)."</option>";			
		}
		
		try{
			$children = $parent->getChildrenCategories();
			
			if(count($children) > 0){
				foreach($children as $cat){
					$result .= $this->getCategoriesCustom($cat,$curId);
				}
			}
		}
		catch(Exception $e){
			return '';
		}
		return $result;
	}
	
	public function getCatNameCustom($category){
		$level = $category->getLevel();
		$html = '';
		for($i = 0;$i < $level;$i++){
			$html .= '';
		}
		if($level == 1)	return $html.' '.$this->__("All Categories");
		else return $html.' '.$category->getName();
	}
	
	public function insertStaticBlock($dataBlock) {
		// insert a block to db if not exists
		$block = Mage::getModel('cms/block')->getCollection()->addFieldToFilter('identifier', $dataBlock['identifier'])->getFirstItem();
		if (!$block->getId())
			$block->setData($dataBlock)->save();
		return $block;
	}
	
	public function insertPage($dataPage) {
		$page = Mage::getModel('cms/page')->getCollection()->addFieldToFilter('identifier', $dataPage['identifier'])->getFirstItem();
		if (!$page->getId())
			$page->setData($dataPage)->save();
		return $page;
	}
    
    public function checkMobilePhp() {
		require_once(Mage::getBaseDir('lib') . DS . 'em/Mobile_Detect.php');
		$detect = new Mobile_Detect();
        $checkmobile = $detect->isMobile();
        $checktablet = $detect->isTablet();
        if($checkmobile){
            if($checktablet){
                return false;
            }else{
                return true;
            }
            
        }else{
            return false;
        }
	}
	
	public function isShowOfferPrice($productPrice){
		if(!Mage::registry('current_product'))
			return false;
		return Mage::registry('current_product')->getId() == $productPrice->getId();
	}
    
	public function getHomeUrl() {
        return array(
            "label" => $this->__('Home'),
            "title" => $this->__('Home Page'),
            "link" => Mage::getUrl('')
        );
    }

    public function getIsLoginCustomer(){
    	if (Mage::getSingleton('customer/session')->isLoggedIn()==0):
    		return 0;
    	endif;
    	return 1;
    }

    public function array_sort($array, $on, $order=SORT_ASC)
	{
		$new_array = array();
		$sortable_array = array();

		if (count($array) > 0) {
			foreach ($array as $k => $v) {
				if (is_array($v)) {
					foreach ($v as $k2 => $v2) {
						if ($k2 == $on) {
							$sortable_array[$k] = $v2;
						}
					}
				} else {
					$sortable_array[$k] = $v;
				}
			}

			switch ($order) {
				case SORT_ASC:
					asort($sortable_array);
				break;
				case SORT_DESC:
					arsort($sortable_array);
				break;
			}

			foreach ($sortable_array as $k => $v) {
				$new_array[$k] = $array[$k];
			}
		}

		return $new_array;
	}
	
	public function getHeightImageResized($imageUrl){
		$dirImg = Mage::getBaseDir().str_replace("/",DS,strstr($imageUrl,'/media'));
		$imageObj = new Varien_Image($dirImg);
		return $imageObj->getOriginalHeight();
	}

	public function getActionReview(){
		$url = Mage::helper('core/url')->getCurrentUrl();
		$url_check = 'wishlist/index/configure';
		if(stripos($url,$url_check)):
			$id = Mage::registry('current_product')->getId();
			return Mage::getUrl('review/product/post/', array('id' => $id,'_secure' => true));
		else:
			$productId = Mage::app()->getRequest()->getParam('id', false);
        	return Mage::getUrl('review/product/post', array('id' => $productId,'_secure' => true));
		endif;
	}

}
