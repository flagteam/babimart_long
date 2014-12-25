<?php
/**
 * @author Flagteam Kazu
 * @var $installer Mage_Core_Model_Resource_Setup
 */
$installer = $this;

$installer->startSetup();

$attributeCode = 'manufacturer';
$configPath = 'em0095/brandproduct/attributecode';

$config = new Mage_Core_Model_Config();
$config->saveConfig($configPath, $attributeCode, 'default', 0);

$installer->endSetup();
