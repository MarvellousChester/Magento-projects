<?php
/**
 * UpdatePrice PriceHandler
 *
 * @category   Cgi
 * @package    UpdatePrice
 * @author      Bobok Aleksandr CGI Trainee Group
 */
class Cgi_UpdatePrice_Helper_PriceHandler extends Mage_Core_Helper_Abstract
{
    //100 percent
    const ENTIRE = 100;
    /**
     * Update Price Mass Action operations
     */
    const OPERATION_ADD = '+ n';
    const OPERATION_SUB = '− n';
    const OPERATION_ADD_PERCENT = '+ n%';
    const OPERATION_SUB_PERCENT = '− n%';
    const OPERATION_MUL = '* n';

    /**Calculate the price using $operation value
     * @param $price
     * @param $operation
     * @param $amount
     *
     * @return int|string
     * @throws Exception
     */
    public function calcPrice($price, $operation, $amount){
        if(!is_numeric($amount)) {
            throw new Exception(
                "Parameter n expected to be a number " . gettype($amount)
                . " given"
            );
        }
        //calculate the price
        switch ($operation) {
            case self::OPERATION_ADD: $price += $amount;
                break;
            case self::OPERATION_SUB: $price -= $amount;
                break;
            case self::OPERATION_ADD_PERCENT: $price += $price * ($amount / self::ENTIRE);
                break;
            case self::OPERATION_SUB_PERCENT: $price -= $price * ($amount / self::ENTIRE);
                break;
            case self::OPERATION_MUL: $price *= $amount;
                break;
            default: Mage::getSingleton('adminhtml/session')->addError(
                'Invalid operation');
        }

        return $price;
    }
}