<?php
class Cgi_Topproducts_Block_Widget
    extends Mage_Core_Block_Template
    implements Mage_Widget_Block_Interface
{
    protected  $widgetName = ''; // The name of the widget
    protected $NumberOfProducts = 3; //Default number of top products to display

    /**pseudo-constructor for widget class
     *
     */
    protected function _construct()
    {
        $this->widgetName = $this->getData('widget_name');
        $this->NumberOfProducts = $this->getData('products_count');

        parent::_construct();
    }

    /** Return top products collection based on widget settings and product tag 'is_top'
     * @return mixed
     */
    protected function getTopProductsList()
    {
        $collection = Mage::getModel('catalog/product')
            ->getCollection()
            ->addAttributeToSelect('*')
            ->addAttributeToFilter('is_top', array('eq' => 1))
            ->addAttributeToFilter('status', array('eq' => 1))
            ->addStoreFilter($this->getStoreId());
            /*->joinField(
                'qty',
                'cataloginventory/stock_item',
                'qty',
                'product_id=entity_id',
                '{{table}}.stock_id=1',
                'left'
            )
            ->addAttributeToFilter('qty', array('gt' => 0));*/


        $collection->getSelect()->limit($this->NumberOfProducts)->order('rand()');

        return $collection;
    }
}