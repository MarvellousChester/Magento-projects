<?php
/**
 * AddShippingCost Sales Order Totals rewrite block
 *
 * @category   Cgi
 * @package    AddShippingCost
 * @author     Bobok Aleksandr CGI Trainee Group
 *
 */
class Cgi_AddShippingCost_Block_Adminhtml_Sales_Order_Totals extends Mage_Adminhtml_Block_Sales_Order_Totals
{
    /**
     * Initialize order totals array
     *
     * @return Mage_Sales_Block_Order_Totals
     */
    protected function _initTotals()
    {
        parent::_initTotals();
        $amount = $this->getSource()->getAddCost();
        $createHelper = Mage::helper('addshippingcost/varienObjectCreate');
        if ($amount) {
            $this->addTotalBefore($createHelper->create($amount));
        }

        return $this;
    }

}