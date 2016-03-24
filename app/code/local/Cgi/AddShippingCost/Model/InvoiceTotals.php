<?php
/**
 * AddShippingCost Invoice Totals Model
 *
 * @category   Cgi
 * @package    AddShippingCost
 * @author     Bobok Aleksandr CGI Trainee Group
 *
 */
class Cgi_AddShippingCost_Model_InvoiceTotals extends Mage_Sales_Model_Order_Invoice_Total_Abstract
{
    public function collect(Mage_Sales_Model_Order_Invoice $invoice)
    {
        parent::collect($invoice);

        if (($invoice->getAddressType() == 'billing')) {
            return $this;
        }
        $quote = $invoice->getOrder();
        $amount = $quote->getData('add_cost');
        if ($amount) {
            $invoice->setGrandTotal($invoice->getGrandTotal() + $amount);
            $invoice->setBaseGrandTotal($invoice->getBaseGrandTotal() + $amount);
        }

    }
}