<?php
/**
 * AddShippingCost Invoice Totals Model
 *
 * @category   Cgi
 * @package    AddShippingCost
 * @author     Bobok Aleksandr CGI Trainee Group
 *
 */
class Cgi_AddShippingCost_Model_CreditmemoTotals extends Mage_Sales_Model_Order_Creditmemo_Total_Abstract
{
    public function collect(Mage_Sales_Model_Order_Creditmemo $creditmemo)
    {
        parent::collect($creditmemo);

        if (($creditmemo->getAddressType() == 'billing')) {
            return $this;
        }
        $quote = $creditmemo->getOrder();
        $amount = $quote->getData('add_cost');
        if ($amount) {
            $creditmemo->setGrandTotal($creditmemo->getGrandTotal() + $amount);
        }

    }
}