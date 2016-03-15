<?php
/** @var Mage_Eav_Model_Entity_Setup $installer */
$installer = $this;
$installer->startSetup();
echo 'Sql installer is working <br />';

//Add a new attribute and group for it

// Set data:
$attributeName  = 'Is Top'; // Name of the attribute
$attributeCode  = 'is_top'; // Code of the attribute
$attributeGroup = 'Education'; // Group to add the attribute to

//Add a new attribute group
$entityTypeId = $installer->getEntityTypeId('catalog_product');
$attributeSetId = $installer->getDefaultAttributeSetId($entityTypeId);

//check if group is already exist

//Get the attribute group id
$attributeGroupId = $installer->getAttributeGroupId($entityTypeId, $attributeSetId, $attributeGroup);
if ($attributeGroupId == NULL) {
    //add an attribute group
    $installer->addAttributeGroup($entityTypeId, $attributeSetId, $attributeGroup, 1000);
}

//Add a new attribute
//Form an attribute data
$attributeData = array(
    'group' => $attributeGroup,
    'input'    => 'boolean', // Input type
    'type'  => 'int', // Attribute type
    'source' => 'eav/entity_attribute_source_boolean',
    'option' =>
        array (
            'values' =>
                array (
                    false => 'No',
                    true => 'Yes',
                ),
        ),
    'global'    => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,    // Attribute scope
    'required'  => false, // Is this attribute required?
    'user_defined' => true,
    'searchable' => false,
    'filterable' => false,
    'comparable' => false,
    'visible_on_front' => false,
    'unique' => false,
    'default' => false,
    'used_in_product_listing' => true,
    // Filled from above:
    'label' => $attributeName,

);
//check if attribute is already exist
$attribute = Mage::getResourceModel('catalog/eav_attribute')->loadByCode('catalog_product', $attributeCode);
if ($attribute->getId() == NULL) {
    //Add the attribute
    $installer->addAttribute('catalog_product', $attributeCode, $attributeData);
}

$installer->endSetup();