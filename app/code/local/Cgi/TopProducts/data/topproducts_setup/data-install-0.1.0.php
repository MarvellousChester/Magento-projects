<?php
/**
 * TopProducts data install script
 *
 * @category   Cgi
 * @package    TopProducts
 * @author      Bobok Aleksandr CGI Trainee Group
 */

/**
 * @var Mage_Eav_Model_Entity_Setup $installer
 */
$installer = $this;
$installer->startSetup();
echo 'Data installer is working <br />';

Mage::app()->setCurrentStore(Mage_Core_Model_App::ADMIN_STORE_ID);

//Block identifiers
$blockTitle = 'Top products';
$blockId = 'top_products';
//Block content
$blockContent = '{{widget type="topproducts/widget" widget_name="Top products" products_count="3" template="topproducts/widget.phtml"}}';


$block = Mage::getModel('cms/block');
//Check if block already exists
if(Mage::getModel('cms/block')->load($blockId)->getId() == NULL) {
    //Add a new block
    $block->setTitle($blockTitle);
    $block->setIdentifier($blockId);
    $block->setIsActive(1);
    $block->setStores(array(0));
    $block->setContent($blockContent);
    $block->save();
}
$installer->endSetup();