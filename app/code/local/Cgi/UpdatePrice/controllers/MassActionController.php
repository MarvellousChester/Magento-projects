<?php
/**
* UpdatePrice MassAction Controller
*
 * @category   Cgi
* @package    UpdatePrice
* @author      Bobok Aleksandr CGI Trainee Group
*/
class Cgi_UpdatePrice_MassActionController extends Mage_Adminhtml_Controller_Action
{
    protected $error = false;
    /**Mass update prices action
     *
     */
    public function updatePricesAction()
    {
        //Get action parameters
        $productIds = $this->getRequest()->getPost('product', array());
        $operation = $this->getRequest()->getPost('operation');
        $amount = $this->getRequest()->getPost('amount');
        try {
            if (!isset($productIds, $operation, $amount)) {
                throw new Exception('Missing action parameters');
            }
            foreach ($productIds as $productId) {
                //Get a product by ID
                $product = Mage::getModel('catalog/product')->load(
                    $productId
                );
                //Using a helper to calculate a new price
                $helper = Mage::helper('updateprice/priceHandler');

                $newPrice = $helper->calcPrice(
                    $product->getPrice(), $operation, $amount
                );
                //Check if resulting price is correct
                if ((float)$newPrice < 0.0) {
                    throw new Exception(
                        'The resulting price is less than 0'
                    );
                }
                //Set a new price
                $product->setPrice($newPrice);
                $product->save();
            }
        } catch (Exception $ex) {
            Mage::getSingleton('adminhtml/session')->addError(
                $ex->getMessage()
            );
            $this->error = true;
        } finally {
            if (!$this->error) {
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    "Prices of " . count($productIds) . " products were updated"
                );
            }
            $this->_redirectReferer();
        }
    }
}