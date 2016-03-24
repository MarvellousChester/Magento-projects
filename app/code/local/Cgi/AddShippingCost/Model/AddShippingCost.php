<?php
class Cgi_AddShippingCost_Model_AddShippingCost extends Varien_Object
{
    /** Check if additional cost should be applied or not
     * @param $address
     *
     * @return bool
     */
    public static function canApply($item)
    {
        if($item->getAddCost())

        return true;
    }

}