<?php
class Cgi_AddShippingCost_Model_Observer
{
    public function coreBlockAbstractToHtmlBefore($observer)
    {
        $block = $observer->getBlock();

        if ($this->checkBlock($block, 'adminhtml/sales_order_grid')) {
            $block->addColumn(
                'add_cost', array(
                    'header'   => Mage::helper('addshippingcost')->__('Add Cost'),
                    'index'    => 'add_cost',
                    'sortable' => false,
                    'type'  => 'currency',
                )
            );
        }
    }

    public function salesOrderGridCollectionLoadBefore(Varien_Event_Observer $observer)
    {
        //Get collection

        $collection = $observer->getOrderGridCollection();
        if (!isset($collection)) {
            return;
        }

        $collection->getSelect()->join(
            'sales_flat_order',
            'main_table.entity_id = sales_flat_order.entity_id',
            'sales_flat_order.add_cost'
        );
    }

    public function salesQuoteItemSetProduct(Varien_Event_Observer $observer)
    {
        $finalAddCost = 0;
        $quote = $observer->getEvent()->getQuoteItem()->getQuote();
        $items = $quote->getAllVisibleItems();
        foreach($items as $item) {
            $itemQty = $item->getData('qty');
            $itemAddCost = Mage::getModel('catalog/product')->load($item->getProduct()->getId())->getAddCost();
            $finalAddCost += $itemAddCost * $itemQty;
            if(!is_null($finalAddCost)) {
                $quote->setData('add_cost', $finalAddCost);
            }
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