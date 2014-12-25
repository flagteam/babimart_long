<?php
/**
 * @author Flagteam Kazu
 * @var $installer Mage_Core_Model_Resource_Setup
 */
$installer = $this;

$installer->startSetup();

$attributeCode = 'manufacturer';

$objCatalogEavSetup = Mage::getResourceModel('catalog/eav_mysql4_setup', 'core_setup');
$objCatalogEavSetup->updateAttribute('catalog_product', $attributeCode, 'is_visible_in_advanced_search', '1');

$installer->endSetup();
