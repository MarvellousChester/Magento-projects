<?php
/**
 * AddShippingCost Varien Object Create Helper
 *
 * @category   Cgi
 * @package    TopProducts
 * @author      Bobok Aleksandr CGI Trainee Group
 */
class Cgi_AddShippingCost_Helper_VarienObjectCreate extends Mage_Core_Helper_Abstract
{
    public function create($amount)
    {
        $obj = new Varien_Object(array(
            'code'      => 'addshippingcost',
            'value'     => $amount,
            'base_value'=> $amount,
            'label'     => 'Additional Shipping Cost',
        ), array('shipping', 'add_cost'));

        return $obj;
    }

}