<?php
class Cgi_UpdatePrice_MassActionController extends Mage_Adminhtml_Controller_Action
{
    protected $error = false;
    /**Mass update prices action
     *
     */
    public function updatePricesAction()
    {
        $productIds = $this->getRequest()->getPost('product', array());
        $operation = $this->getRequest()->getPost('operation');
        $amount = $this->getRequest()->getPost('amount');
        try {
            if (isset($productIds, $operation, $amount)) {
                foreach ($productIds as $productId) {
                    $product = Mage::getModel('catalog/product')->load(
                        $productId
                    );

                    $helper = Mage::helper('updateprice/priceHandler');

                    $newPrice = $helper->calcPrice(
                        $product->getPrice(), $operation, $amount
                    );
                    if ((float)$newPrice < 0.0) {
                        throw new Exception(
                            'The resulting price is less than 0'
                        );
                    }
                    $product->setPrice($newPrice);
                    $product->save();
                }
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