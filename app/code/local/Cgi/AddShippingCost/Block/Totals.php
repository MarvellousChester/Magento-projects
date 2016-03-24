<?php
/**
 * AddShippingCost Sales Order Totals block for template
 * Add new Additional Shipping Cost to customer account front-end and to emails
 *
 * @category   Cgi
 * @package    AddShippingCost
 * @author     Bobok Aleksandr CGI Trainee Group
 *
 */
class Cgi_AddShippingCost_Block_Totals
    extends Mage_Core_Block_Template
    //implements Mage_Widget_Block_Interface
{
    /**
     * Initialize order totals array
     *
     */
    public function initTotals()
    {
        $amount = $this->getParentBlock()->getSource()->getAddCost();
        $createHelper = Mage::helper('addshippingcost/varienObjectCreate');
        if ($amount) {
            $this->getParentBlock()->addTotalBefore($createHelper->create($amount));
        }

        return $this;
    }

}