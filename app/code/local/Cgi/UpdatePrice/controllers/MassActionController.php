<?php
/**
 * UpdatePrice MassAction Controller
 *
 * @category   Cgi
 * @package    UpdatePrice
 * @author     Bobok Aleksandr CGI Trainee Group
 */
class Cgi_UpdatePrice_MassActionController extends Mage_Adminhtml_Controller_Action
{
    /**
     * @var bool error.
     */
    protected $error = false;

    /**
     * Mass update prices action.
     *
     * @return void
     */
    public function updatePricesAction()
    {
        //Get action parameters
        /** @var TYPE_NAME $productIds */
        $productIds = $this->getRequest()->getPost('product', array());
        $operation = $this->getRequest()->getPost('operation');
        $amount = $this->getRequest()->getPost('amount');

        /** @var Cgi_UpdatePrice_Helper_PriceHandler $helper */
        $helper = Mage::helper('updateprice/priceHandler');

        $productCollection = null;

        if (isset($productIds, $operation, $amount)) {
            $productCollection = Mage::getModel('catalog/product')
                ->getCollection()
                ->addAttributeToSelect('price')
                ->addAttributeToFilter('entity_id', array('in' => $productIds));

            foreach ($productCollection as $product) {

                //Using a helper to calculate a new price
                $newPrice = $helper->calcPrice(
                    $product->getPrice(), $operation, $amount
                );
                //Check if resulting price is correct
                if ($newPrice < 0) {
                    Mage::getSingleton('adminhtml/session')->addError(
                        'The resulting price is less than 0. Product ID: '
                        . $product->getId()
                    );
                    $this->error = true;

                } else {
                    //Set a new price
                    $product->setPrice($newPrice);
                }
            }
        } else {
            Mage::getSingleton('adminhtml/session')->addError(
                'Missing action parameters'
            );
            $this->error = true;
        }

        if (!$this->error) {
            if (!is_null($productCollection)) {
                $productCollection->save();
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    'Total of ' . count($productIds)
                    . ' record(s) have been updated.'
                );
            }
        }
        $this->_redirectReferer();
    }
}