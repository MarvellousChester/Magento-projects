<?php
/**
 * Created by PhpStorm.
 * User: aleksandr
 * Date: 09.03.16
 * Time: 15:16
 */

/** @var Mage_Eav_Model_Entity_Setup $installer */
$installer = $this;
$installer->startSetup();
echo 'Data installer is working <br />';

Mage::app()->setCurrentStore(Mage_Core_Model_App::ADMIN_STORE_ID);

//Block content
$content = '{{widget type="topproducts/widget" widget_name="Top products" products_count="3" template="topproducts/widget.phtml"}}';


$block = Mage::getModel('cms/block');
$block->setTitle('Top products');
$block->setIdentifier('top_products');
$block->setIsActive(1);
$block->setStores(array(0));
$block->setContent($content);
$block->save();

$installer->endSetup();