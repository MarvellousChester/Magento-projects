<?php
class Cgi_Topproducts_Model_Adminhtml_Observer
{
    public function onBlockHtmlBefore(Varien_Event_Observer $observer)
    {
        $block = $observer->getBlock();
        if (!isset($block)) return;

        switch ($block->getType()) {
            case 'adminhtml/catalog_product_grid':
                /* @var $block Mage_Adminhtml_Block_Catalog_Product_Grid */
                $block->addColumn('is_top', array(
                    'header' => Mage::helper('topproducts')->__('Is Top'),
                    'index' => 'is_top',
                    'sortable'  => false,
                    'type'  => 'options',
                    'options' => Mage::getModel('topproducts/options')->getOptionArray()
                ));
                break;
        }
    }

    public function onEavLoadBefore(Varien_Event_Observer $observer)
    {
        $collection = $observer->getCollection();
        if (!isset($collection)) return;

        $collection->addAttributeToSelect('is_top');
    }

}