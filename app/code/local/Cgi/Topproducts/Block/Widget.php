<?php
class Cgi_Topproducts_Block_Widget
    extends Mage_Core_Block_Template
    implements Mage_Widget_Block_Interface
{
    protected  $widgetName = '';
    protected $NumberOfProducts = 3;

    protected function _construct()
    {
        $this->widgetName = $this->getData('widget_name');
        $this->NumberOfProducts = $this->getData('products_count');

        parent::_construct();
    }

    protected function getTopProductsList()
    {
        $collection = Mage::getModel('catalog/product')
            ->getCollection()
            ->addAttributeToSelect('*')
            ->addAttributeToFilter('is_top', array('eq' => 1))
            ->addStoreFilter($this->getStoreId());

        $collection->getSelect()->limit($this->NumberOfProducts)->order('rand()');

        return $collection;
    }
}