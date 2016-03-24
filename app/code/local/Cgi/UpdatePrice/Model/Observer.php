<?php
/**
 * UpdatePrice Observer
 *
 * @category   Cgi
 * @package    UpdatePrice
 * @author      Bobok Aleksandr CGI Trainee Group
 */
class Cgi_UpdatePrice_Model_Observer
{
    /**Update price mass action
     * @param Varien_Event_Observer $observer
     */
    public function addMassAction(Varien_Event_Observer $observer)
    {
        //Get current block
        $block = $observer->getEvent()->getBlock();
        //If our block is the one we are looking for
        if(get_class($block) =='Mage_Adminhtml_Block_Widget_Grid_Massaction')
        {
            //Add new mass action option to the grid
            $helper = Mage::helper('updateprice/priceHandler');
            $block->addItem('update_price', array(
                'label'=> Mage::helper('catalog')->__('Update Price'),
                'url'  => $block->getUrl('*/massAction/updatePrices', array('_current'=>true)),
                'additional' => array(
                    'operations' => array(
                        'name' => 'operation',
                        'type' => 'select',
                        'class' => 'required-entry',
                        'label' => Mage::helper('catalog')->__('Operation'),
                        'values' => array(
                            '+ n' => $helper::OPERATION_ADD,
                            '− n' => $helper::OPERATION_SUB,
                            '+ n%' => $helper::OPERATION_ADD_PERCENT,
                            '− n%' => $helper::OPERATION_SUB_PERCENT,
                            '* n' => $helper::OPERATION_MUL)
                    ),
                    'amount' => array(
                        'name' => 'amount',
                        'type' => 'text',
                        'class' => 'required-entry',
                        'label' => Mage::helper('catalog')->__('n value'),
                    )
                )
            ));
        }
    }
}