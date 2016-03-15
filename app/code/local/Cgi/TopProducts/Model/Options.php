<?php
/**
 * TopProducts Options Model
 *
 * @category   Cgi
 * @package    TopProducts
 * @author      Bobok Aleksandr CGI Trainee Group
 */
class Cgi_TopProducts_Model_Options extends Varien_Object
{
    const IS_TOP_YES = 1;
    const IS_TOP_NO = 0;

    /** Options for column creation in the observer
     * @return array
     */
    public static function getOptionArray()
    {
        return array(
            self::IS_TOP_YES => Mage::helper('catalog')->__('Yes'),
            self::IS_TOP_NO => Mage::helper('catalog')->__('No'),
        );
    }

}