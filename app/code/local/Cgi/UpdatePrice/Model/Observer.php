<?php
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
                            '+ n' => '+ n',
                            '− n' => '− n',
                            '+ n%' => '+ n%',
                            '− n%' => '− n%',
                            '* n' => '* n')
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