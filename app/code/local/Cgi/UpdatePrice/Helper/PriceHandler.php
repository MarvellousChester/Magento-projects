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

    /**Calculate the price using $$operation value
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
            case '+ n': $price += $amount;
                break;
            case '− n': $price -= $amount;
                break;
            case '+ n%': $price += $price * ($amount / self::ENTIRE);
                break;
            case '− n%': $price -= $price * ($amount / self::ENTIRE);
                break;
            case '* n': $price *= $amount;
                break;
            default: throw new Exception('Invalid operation parameter');
        }

        return $price;
    }
}