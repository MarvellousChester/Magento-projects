<?php
/**
 * Created by PhpStorm.
 * User: aleksandr
 * Date: 09.03.16
 * Time: 15:16
 */

/** @var Mage_Eav_Model_Entity_Setup $installer */
$installer = $this;
$installer->startSetup();
echo 'Sql installer is working <br />';

//Add a new attribute and group for it

// Set data:
$attributeName  = 'Is Top'; // Name of the attribute
$attributeCode  = 'is_top'; // Code of the attribute
$attributeGroup = 'Education';          // Group to add the attribute to

//Add a new attribute group
$entityTypeId = $installer->getEntityTypeId('catalog_product');
$attributeSetId = $installer->getDefaultAttributeSetId($entityTypeId);
$installer->addAttributeGroup($entityTypeId, $attributeSetId, $attributeGroup, 1000);

//Add a new attribute
//Form an attribute data
$attributeData = array(
    'input'                     => 'select', // Input type
    'type'                      => 'int', // Attribute type
    'source'                    => 'eav/entity_attribute_source_boolean',
    'option' =>
        array (
            'values' =>
                array (
                    NULL => 'No',
                    1 => 'Yes',
                ),
        ),
    'global'    => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,    // Attribute scope
    'required'  => false,           // Is this attribute required?
    'user_defined' => false,
    'searchable' => false,
    'filterable' => false,
    'comparable' => false,
    'visible_on_front' => false,
    'unique' => false,
    'default' => NULL,
    'used_in_product_listing' => true,
    // Filled from above:
    'label' => $attributeName,

);
//Add the attribute
$installer->addAttribute('catalog_product', $attributeCode, $attributeData);

//Get the attribute id
$attributeId = $installer->getAttributeId($entityTypeId, $attributeCode);
//Get the attribute group id
$attributeGroupId = $installer->getAttributeGroupId($entityTypeId, $attributeSetId, $attributeGroup);
//Add the attribute to the group
$installer->addAttributeToGroup($entityTypeId, $attributeSetId, $attributeGroupId, $attributeId, null);

$installer->endSetup();