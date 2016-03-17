<?php
/**
* TopProducts Observer
*
* @category   Cgi
* @package    TopProducts
* @author      Bobok Aleksandr CGI Trainee Group
*/
class Cgi_TopProducts_Model_Adminhtml_Observer
{
    /**Add a new 'is_top' column to the grid
     * @param Varien_Event_Observer $observer
     *
     * @throws Exception
     */
    public function onBlockHtmlBefore(Varien_Event_Observer $observer)
    {
        //Get current block
        $block = $observer->getBlock();

        //If out block is the one we are looking for
        if ($this->checkBlock($block, 'adminhtml/catalog_product_grid')) {
            /* @var $block Mage_Adminhtml_Block_Catalog_Product_Grid */
            //Add new column
            $block->addColumn(
                'is_top', array(
                    'header'   => Mage::helper('topproducts')->__('Is Top'),
                    'index'    => 'is_top',
                    'sortable' => false,
                    'type'     => 'options',
                    'options'  => Mage::getModel('topproducts/options')
                        ->getOptionArray()
                )
            );
        }
    }

    /**Add a new 'is_top' attribute to display in the grid
     * @param Varien_Event_Observer $observer
     */
    public function onEavLoadBefore(Varien_Event_Observer $observer)
    {
        //Get current block
        $block = $observer->getBlock();
        //If out block is the one we are looking for
        if ($this->checkBlock($block, 'adminhtml/catalog_product_grid')) {
            $collection = $observer->getCollection();
            if (!isset($collection)) return;

            $collection->addAttributeToSelect('is_top');
        }
    }

    /** Check if our block is one we are needed
     * @param $currentBlock
     * @param $neededBlock
     *
     * @return bool
     */
    protected function checkBlock($currentBlock, $neededBlock)
    {
        if (!isset($currentBlock)) {
            return false;
        }
        if($currentBlock->getType() == $neededBlock) {
            return true;
        }
        return false;
    }
}