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
    /**
     * Add a new 'is_top' column to the grid
     * @param Varien_Event_Observer $observer
     *
     * @throws Exception
     */
    public function onBlockHtmlBefore(Varien_Event_Observer $observer)
    {
        /**
         * Get current block
         * @var $block Mage_Adminhtml_Block_Catalog_Product_Grid
         */
        $block = $observer->getBlock();

        //If out block is the one we are looking for
        if ($this->checkBlock($block, 'adminhtml/catalog_product_grid')) {

            //Add new column
            $options = array('1' => 'Yes', '0' => 'No');
            $block->addColumn(
                'is_top', array(
                    'header'   => Mage::helper('topproducts')->__('Is Top'),
                    'index'    => 'is_top',
                    'sortable' => false,
                    'type'     => 'options',
                    'options'  => $options
                )
            );
        }
    }

    /**
     * Check if our block is one we are needed
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