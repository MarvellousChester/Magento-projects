<?php
class Cgi_AddShippingCost_Model_QuoteTotals extends Mage_Sales_Model_Quote_Address_Total_Abstract
{
    public function collect(Mage_Sales_Model_Quote_Address $address)
    {
        parent::collect($address);

        $this->_setAmount(0);
        $this->_setBaseAmount(0);
        $items = $this->_getAddressItems($address);
        if (!count($items)) {
            return $this;
        }

        $finalAddCost = $address->getQuote()->getData('add_cost');
        $address->setGrandTotal($address->getGrandTotal() + $finalAddCost);
        $address->setBaseGrandTotal($address->getBaseGrandTotal() + $finalAddCost);
    }

    public function fetch(Mage_Sales_Model_Quote_Address $address)
    {
        if ($address->getData('address_type') == 'billing')
            return $this;
        $finalAddCost = $address->getQuote()->getData('add_cost');

        $address->addTotal(array(
            'code' => $this->getCode(),
            'title' => 'Additional Shipping Cost',
            'value' => $finalAddCost
        ));
        return $address;
    }

}