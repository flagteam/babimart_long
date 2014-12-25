<?php
/**
 * @deprecated use Mage::helper('em0095settings') instead
 * @methods:
 * - get[Section]_[ConfigName]($defaultValue = '')
 */
class EM_Em0095settings_Em0095settings
{
	static function __callStatic($name, $args) {
		if (method_exists(self, $name))
			call_user_func_array(array(self, $name), $args);
			
		elseif (preg_match('/^get([^_][a-zA-Z0-9_]+)$/', $name, $m)) {
			$segs = explode('_', $m[1]);
			foreach ($segs as $i => $seg)
				$segs[$i] = strtolower(preg_replace('/([^A-Z])([A-Z])/', '$1_$2', $seg));

			$value = Mage::getStoreConfig('em0095/'.implode('/', $segs));
			if (!$value) $value = @$args[0];
			return $value;
		}
		
		else 
			call_user_func_array(array(self, $name), $args);
	}

	
	/**
	 * @return array
	 */
	public static function getAllCssConfig() {
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
			'page_bgimage' => Mage::getStoreConfig('em0095/general/page_bgimage'),
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
			'header_bgimage' => Mage::getStoreConfig('em0095/typography/header_bgimage'),
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
			'body_bgimage' => Mage::getStoreConfig('em0095/typography/body_bgimage'),
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
			'footer_bgimage' => Mage::getStoreConfig('em0095/typography/footer_bgimage'),
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
}