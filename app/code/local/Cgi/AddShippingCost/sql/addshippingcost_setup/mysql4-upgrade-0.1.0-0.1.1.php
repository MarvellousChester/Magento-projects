<?php
/**
 * AddShippingCost Sql upgrade script
 *
 * @category   Cgi
 * @package    AddShippingCost
 * @author      Bobok Aleksandr CGI Trainee Group
 */
/** @var Mage_Sales_Model_Mysql4_Setup $installer */
$installer = new Mage_Sales_Model_Mysql4_Setup($this->_resourceName);

$installer->startSetup();
echo 'Additional Shipping Cost module. Sql upgrade script is working <br />';
$installer->getTable('sales/quote_item');

$options = array(
    'type'     => Varien_Db_Ddl_Table::TYPE_INTEGER,
    'visible'  => true,
    'required' => false
);

$installer->addAttribute('quote', 'add_cost', $options);
$installer->addAttribute('order', 'add_cost', $options);

$installer->endSetup();

